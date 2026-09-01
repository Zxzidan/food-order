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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|in:Tunai,QRIS,Debit,Transfer',
            'cash_received' => 'nullable|numeric',
            'change_amount' => 'nullable|numeric',
        ]);

        return DB::transaction(function () use ($validated) {
            $order = Order::findOrFail($validated['order_id']);

            // Update order with payment details
            $order->update([
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'paid',
                'cash_received' => $validated['cash_received'] ?? null,
                'change_amount' => $validated['change_amount'] ?? null,
                'status' => 'Selesai',
            ]);

            // Decrement menu stock
            foreach ($order->items as $item) {
                if ($item->menu_id) {
                    $menu = Menu::find($item->menu_id);
                    if ($menu) {
                        $menu->decrement('stock', $item->quantity);
                        $menu->increment('sold', $item->quantity);
                        if ($menu->stock <= 0) {
                            $menu->update(['is_available' => false]);
                        }
                    }
                }
            }

            return redirect()->route('history.index')->with('success', 'Pesanan berhasil diproses!');
        });
    }

    public function initiateCheckout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'order_type' => 'required|in:Dine In,Take Away',
            'table_number' => 'nullable|string|max:50',
            'items' => 'required|json',
        ]);

        return DB::transaction(function () use ($validated) {
            $user = User::first();
            $items = json_decode($validated['items'], true);

            $subtotal = 0;
            foreach ($items as $item) {
                $subtotal += ($item['price'] * $item['quantity']);
            }

            $tax = (int) round($subtotal * 0.10); // PB1 10%
            $totalAmount = $subtotal + $tax;

            // Generate order number like #ORD-YYYYMMDD-XXX
            $todayCount = Order::whereDate('created_at', Carbon::today())->count() + 1;
            $orderNumber = '#ORD-'.date('Ymd').'-'.str_pad((string) $todayCount, 3, '0', STR_PAD_LEFT);

            // Create order (status pending checkout)
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
            foreach ($items as $item) {
                $menuId = null;
                if (! empty($item['menu_id'])) {
                    $cleanId = str_replace('menu-', '', (string) $item['menu_id']);
                    $menu = Menu::find($cleanId) ?? Menu::where('name', $item['name'])->first();
                    if ($menu) {
                        $menuId = $menu->id;
                    }
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'menu_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                    'notes' => $item['notes'] ?? null,
                ]);
            }

            return redirect()->route('order.checkout', ['order_number' => $orderNumber]);
        });
    }

    public function checkout($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();

        return view('checkout', [
            'title' => 'Pembayaran',
            'order' => $order->load('items'),
        ]);
    }
}
