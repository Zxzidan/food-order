<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('checkout view renders formatted cash received input', function () {
    $user = User::factory()->create();

    $order = Order::create([
        'order_number' => 'ORD-20260907-0001',
        'user_id' => $user->id,
        'customer_name' => 'Budi',
        'order_type' => 'Dine In',
        'table_number' => '01',
        'subtotal' => 35000,
        'tax' => 3500,
        'discount' => 0,
        'total_amount' => 38500,
        'payment_method' => 'Tunai',
        'payment_status' => 'Belum Lunas',
        'status' => 'Diproses',
    ]);

    $response = $this->actingAs($user)->get(route('payment.show', $order->order_number));

    $response->assertStatus(200);
    $response->assertSee('38.500');
    $response->assertSee('cash_received_display');
});

test('cash payment handles formatted input with dots', function () {
    $user = User::factory()->create();

    $order = Order::create([
        'order_number' => 'ORD-20260907-0002',
        'user_id' => $user->id,
        'customer_name' => 'Siti',
        'order_type' => 'Dine In',
        'table_number' => '02',
        'subtotal' => 35000,
        'tax' => 3500,
        'discount' => 0,
        'total_amount' => 38500,
        'payment_method' => 'Tunai',
        'payment_status' => 'pending',
        'status' => 'Diproses',
    ]);

    $response = $this->actingAs($user)->post(route('payment.cash', $order->order_number), [
        'cash_received' => '50.000',
    ]);

    $response->assertRedirect(route('riwayat.pesanan'));

    $order->refresh();
    expect($order->payment_status)->toBe('paid');
    expect((int) $order->cash_received)->toBe(50000);
    expect((int) $order->change_amount)->toBe(11500);
});
