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
            'customer_name' => 'nullable|string|max:255',
            'order_type' => 'required|in:Dine In,Take Away',
            'table_number' => 'nullable|string|max:50',
            'payment_method' => 'required|in:Tunai,QRIS,Debit,Transfer',
            'cash_received' => 'nullable|numeric',
            'change_amount' => 'nullable|numeric',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'nullable',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.notes' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($validated, $request) {
            $user = User::first();
            $subtotal = 0;

            foreach ($validated['items'] as $item) {
                $subtotal += ($item['price'] * $item['quantity']);
            }

            $tax = (int) round($subtotal * 0.10); // PB1 10%
            $totalAmount = $subtotal + $tax;

            // Generate order number like #ORD-YYYYMMDD-XXX
            $todayCount = Order::whereDate('created_at', Carbon::today())->count() + 1;
            $orderNumber = '#ORD-' . date('Ymd') . '-' . str_pad((string) $todayCount, 3, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user?->id,
                'customer_name' => !empty($validated['customer_name']) ? $validated['customer_name'] : 'Umum',
                'order_type' => $validated['order_type'],
                'table_number' => ($validated['order_type'] === 'Dine In') ? ($validated['table_number'] ?? 'Meja 01') : null,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => 0,
                'total_amount' => $totalAmount,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'Lunas',
                'cash_received' => $validated['cash_received'] ?? null,
                'change_amount' => $validated['change_amount'] ?? null,
                'status' => 'Selesai',
            ]);

            foreach ($validated['items'] as $item) {
                $menuId = null;
                if (!empty($item['menu_id'])) {
                    $cleanId = str_replace('menu-', '', (string) $item['menu_id']);
                    $menu = Menu::find($cleanId) ?? Menu::where('name', $item['name'])->first();
                    if ($menu) {
                        $menuId = $menu->id;
                        $menu->decrement('stock', $item['quantity']);
                        $menu->increment('sold', $item['quantity']);
                        if ($menu->stock <= 0) {
                            $menu->update(['is_available' => false]);
                        }
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

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'order' => $order->load('items'),
                ]);
            }

            return redirect()->route('history.index')->with('success', 'Pesanan berhasil diproses!');
        });
    }
}
