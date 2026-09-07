<?php

use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('dashboard can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertStatus(200);
});

test('reports can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/reports');

    $response->assertStatus(200);
});

test('dashboard displays accurate total customers count from database', function () {
    $user = User::factory()->create();

    // User with 0 orders/customers should display 0
    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(200);
    $response->assertViewHas('totalCustomers', 0);

    // Create orders with distinct customer names
    Order::create([
        'order_number' => 'ORD-TEST-001',
        'user_id' => $user->id,
        'customer_name' => 'Budi',
        'order_type' => 'Dine In',
        'subtotal' => 50000,
        'tax' => 5000,
        'total_amount' => 55000,
        'status' => 'Selesai',
    ]);
    Order::create([
        'order_number' => 'ORD-TEST-002',
        'user_id' => $user->id,
        'customer_name' => 'Siti',
        'order_type' => 'Take Away',
        'subtotal' => 30000,
        'tax' => 3000,
        'total_amount' => 33000,
        'status' => 'Selesai',
    ]);
    Order::create([
        'order_number' => 'ORD-TEST-003',
        'user_id' => $user->id,
        'customer_name' => 'Budi', // duplicate name
        'order_type' => 'Dine In',
        'subtotal' => 20000,
        'tax' => 2000,
        'total_amount' => 22000,
        'status' => 'Selesai',
    ]);

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(200);
    $response->assertViewHas('totalCustomers', 2);
});

test('dashboard displays top 5 best selling menus ordered by sold count', function () {
    $user = User::factory()->create();

    // Create 6 menus with different sold quantities
    for ($i = 1; $i <= 6; $i++) {
        Menu::create([
            'name' => "Menu Item {$i}",
            'price' => 10000 * $i,
            'stock' => 50,
            'sold' => $i * 10,
            'is_available' => true,
        ]);
    }

    $response = $this->actingAs($user)->get('/dashboard');
    $response->assertStatus(200);
    $response->assertViewHas('bestSellingMenus', function ($menus) {
        return $menus->count() === 5
            && $menus->first()->name === 'Menu Item 6'
            && $menus->first()->sold === 60
            && $menus->last()->name === 'Menu Item 2'
            && $menus->last()->sold === 20;
    });
});
