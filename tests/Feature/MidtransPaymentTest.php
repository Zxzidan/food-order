<?php

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('markAsPaid updates status and decrements stock idempotently', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Makanan', 'slug' => 'makanan']);

    $menu = Menu::create([
        'category_id' => $category->id,
        'name' => 'Mie Goreng Spesial',
        'slug' => 'mie-goreng-spesial',
        'price' => 20000,
        'stock' => 10,
        'sold' => 0,
        'is_available' => true,
    ]);

    $order = Order::create([
        'order_number' => 'ORD-TEST-0001',
        'user_id' => $user->id,
        'customer_name' => 'Doni',
        'order_type' => 'Dine In',
        'table_number' => '05',
        'subtotal' => 40000,
        'tax' => 4000,
        'discount' => 0,
        'total_amount' => 44000,
        'payment_method' => 'QRIS',
        'payment_status' => 'pending',
        'status' => 'Menunggu Pembayaran',
        'snap_token' => 'dummy-snap-token',
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'menu_id' => $menu->id,
        'menu_name' => $menu->name,
        'price' => 20000,
        'quantity' => 2,
        'subtotal' => 40000,
    ]);

    // First payment completion
    $order->markAsPaid('QRIS', 'trans-test-123', 'qris');

    $order->refresh();
    $menu->refresh();

    expect($order->payment_status)->toBe('paid')
        ->and($order->status)->toBe('Selesai')
        ->and($order->payment_method)->toBe('QRIS')
        ->and($menu->stock)->toBe(8)
        ->and($menu->sold)->toBe(2);

    // Call markAsPaid again (idempotency check)
    $order->markAsPaid('QRIS', 'trans-test-123', 'qris');
    $menu->refresh();

    // Stock should remain 8, not decremented again
    expect($menu->stock)->toBe(8)
        ->and($menu->sold)->toBe(2);
});

test('order history page loads and auto-cancels old unpaid orders', function () {
    $user = User::factory()->create();

    // Order created 20 minutes ago (should be canceled)
    $oldOrder = Order::create([
        'order_number' => 'ORD-OLD-0001',
        'user_id' => $user->id,
        'customer_name' => 'Andi',
        'order_type' => 'Take Away',
        'subtotal' => 20000,
        'tax' => 2000,
        'discount' => 0,
        'total_amount' => 22000,
        'payment_method' => 'QRIS',
        'payment_status' => 'pending',
        'status' => 'Menunggu Pembayaran',
    ]);
    $oldOrder->timestamps = false;
    $oldOrder->created_at = now()->subMinutes(20);
    $oldOrder->save();

    // Fresh order created now
    $newOrder = Order::create([
        'order_number' => 'ORD-NEW-0001',
        'user_id' => $user->id,
        'customer_name' => 'Budi',
        'order_type' => 'Dine In',
        'table_number' => '01',
        'subtotal' => 30000,
        'tax' => 3000,
        'discount' => 0,
        'total_amount' => 33000,
        'payment_method' => 'QRIS',
        'payment_status' => 'pending',
        'status' => 'Menunggu Pembayaran',
        'created_at' => now(),
    ]);

    $response = $this->actingAs($user)->get(route('riwayat.pesanan'));

    $response->assertStatus(200);

    $oldOrder->refresh();
    $newOrder->refresh();

    expect($oldOrder->status)->toBe('Batal')
        ->and($oldOrder->payment_status)->toBe('expired')
        ->and($newOrder->status)->toBe('Menunggu Pembayaran');
});

test('sync status endpoint returns json response', function () {
    $user = User::factory()->create();

    $order = Order::create([
        'order_number' => 'ORD-SYNC-0001',
        'user_id' => $user->id,
        'customer_name' => 'Charlie',
        'order_type' => 'Dine In',
        'table_number' => '03',
        'subtotal' => 25000,
        'tax' => 2500,
        'discount' => 0,
        'total_amount' => 27500,
        'payment_method' => 'QRIS',
        'payment_status' => 'pending',
        'status' => 'Menunggu Pembayaran',
        'snap_token' => 'dummy-snap-token-xyz',
    ]);

    $response = $this->actingAs($user)->post(route('order.sync_status', $order->order_number));

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'success',
        'status',
        'payment_status',
        'message',
    ]);
});
