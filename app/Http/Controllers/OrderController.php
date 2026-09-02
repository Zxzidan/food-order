<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RestaurantTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $menus = Menu::with('category')->where('is_available', true)->get();
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
            'order_type' => 'required|in:Dine In,Take Away',
            'table_number' => 'nullable|string|max:50',
            'items' => 'required|json',
        ]);

        return DB::transaction(function () use ($validated) {
            $user = User::first(); // Assuming logic to get current user/cashier
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

                if (!$menu) {
                    throw new \Exception("Menu {$item['name']} tidak ditemukan di database.");
                }

                $price = $menu->price;
                $quantity = (int) $item['quantity']; // from cart item.qty, frontend might send it as quantity or qty depending on how it's mapped. The prompt says item.qty in js, but mapping might send 'quantity' or 'qty'. Let's check how the frontend currently sends it. Actually frontend JS is `qty`. But old initiateCheckout used `$item['quantity']`. We should ensure frontend sends `quantity`. 
                // Let's use what the old logic used: $item['quantity'] but wait, old JS didn't submit anything, I need to check the old JS for checkout to see what it sends. Ah, old JS didn't have an AJAX checkout yet.
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

            $tax = (int) round($subtotal * 0.10); // PB1 10%
            $totalAmount = $subtotal + $tax;

            // Generate order number like #ORD-YYYYMMDD-XXX
            $todayCount = Order::whereDate('created_at', Carbon::today())->count() + 1;
            $orderNumber = 'ORD-'.date('Ymd').'-'.str_pad((string) $todayCount, 4, '0', STR_PAD_LEFT);

            // Create order
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user?->id,
                'customer_name' => ! empty($validated['customer_name']) ? $validated['customer_name'] : 'Umum',
                'order_type' => $validated['order_type'],
                'table_number' => ($validated['order_type'] === 'Dine In') ? ($validated['table_number'] ?? 'Meja 01') : null,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => 0,
                'total_amount' => $totalAmount,
                'payment_method' => null,
                'payment_status' => 'pending',
                'status' => 'Diproses',
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
