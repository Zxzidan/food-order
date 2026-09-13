<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $menus = Menu::where('user_id', auth()->id())->with('category')->where('is_available', true)->get();
        $tables = RestaurantTable::all();

        return view('order', [
            'title' => 'Order',
            'categories' => $categories,
            'menus' => $menus,
            'tables' => $tables,
        ]);
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'member_id' => 'nullable|integer|exists:members,id',
            'points_used' => 'nullable|integer|min:0',
            'order_type' => 'required|in:Dine In,Take Away',
            'table_number' => 'nullable|string|max:50',
            'items' => 'required|json',
        ]);

        return DB::transaction(function () use ($validated) {
            $user = auth()->user();
            $items = json_decode($validated['items'], true);

            if (empty($items)) {
                return back()->with('error', 'Keranjang pesanan kosong.');
            }

            $subtotal = 0;
            $orderItemsData = [];

            // Backend validation and calculation
            foreach ($items as $item) {
                $menuId = null;
                $cleanId = null;

                if (! empty($item['id'])) {
                    $cleanId = str_replace('menu-', '', (string) $item['id']);
                } elseif (! empty($item['menu_id'])) {
                    $cleanId = str_replace('menu-', '', (string) $item['menu_id']);
                }

                $menu = Menu::find($cleanId) ?? Menu::where('name', $item['name'])->first();

                if (! $menu) {
                    throw new \Exception("Menu {$item['name']} tidak ditemukan di database.");
                }

                $price = $menu->price;
                $quantity = (int) ($item['quantity'] ?? $item['qty'] ?? 1);
                $itemSubtotal = $price * $quantity;
                $subtotal += $itemSubtotal;

                $orderItemsData[] = [
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal,
                    'notes' => $item['notes'] ?? $item['note'] ?? null,
                ];
            }

            // Member & Points Discount calculation
            $member = null;
            $pointsUsed = 0;
            $pointsDiscountAmount = 0;

            if (! empty($validated['member_id'])) {
                $member = Member::where('user_id', $user?->id)->find($validated['member_id']);
                if ($member) {
                    $requestedPoints = (int) ($validated['points_used'] ?? 0);
                    if ($requestedPoints > 0) {
                        // Tidak boleh melebihi saldo member
                        $pointsUsed = min($requestedPoints, $member->points_balance);
                        $pointsDiscountAmount = $pointsUsed * 1000;
                        // Tidak boleh melebihi subtotal
                        if ($pointsDiscountAmount > $subtotal) {
                            $pointsDiscountAmount = $subtotal;
                            $pointsUsed = (int) floor($pointsDiscountAmount / 1000);
                        }
                    }
                }
            }

            $taxableSubtotal = max(0, $subtotal - $pointsDiscountAmount);
            $tax = (int) round($taxableSubtotal * 0.10); // PB1 10%
            $totalAmount = $taxableSubtotal + $tax;

            // Generate order number like ORD-YYYYMMDD-XXXX (selalu menaik melampaui nomor terakhir)
            $todayPrefix = 'ORD-'.date('Ymd').'-';
            $latestOrder = Order::where('order_number', 'like', $todayPrefix.'%')
                ->orderByDesc('id')
                ->first();

            $nextSeq = 1;
            if ($latestOrder && preg_match('/-(\d+)$/', $latestOrder->order_number, $matches)) {
                $nextSeq = (int) $matches[1] + 1;
            }

            do {
                $orderNumber = $todayPrefix.str_pad((string) $nextSeq, 4, '0', STR_PAD_LEFT);
                $nextSeq++;
            } while (Order::where('order_number', $orderNumber)->exists());

            $customerName = ! empty($validated['customer_name']) && $validated['customer_name'] !== 'Umum'
                ? $validated['customer_name']
                : ($member ? $member->name : 'Umum');

            // Create order
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user?->id,
                'member_id' => $member?->id,
                'customer_name' => $customerName,
                'order_type' => $validated['order_type'],
                'table_number' => ($validated['order_type'] === 'Dine In') ? ($validated['table_number'] ?? 'Meja 01') : null,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => $pointsDiscountAmount,
                'points_used' => $pointsUsed,
                'points_discount_amount' => $pointsDiscountAmount,
                'points_earned' => 0,
                'total_amount' => $totalAmount,
                'payment_method' => null,
                'payment_status' => 'pending',
                'status' => 'Menunggu Pembayaran',
            ]);

            // Create order items
            foreach ($orderItemsData as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }

            return redirect()->route('payment.show', ['order_number' => $orderNumber]);
        });
    }
}
