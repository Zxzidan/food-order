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

    // Create 6 menus with different sold quantities for this user
    for ($i = 1; $i <= 6; $i++) {
        Menu::create([
            'user_id' => $user->id,
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

test('newly registered user has completely empty data across all pages', function () {
    // 1. Another user exists with menus and orders
    $otherUser = User::factory()->create(['email' => 'other@example.com']);
    $menu = Menu::create([
        'user_id' => $otherUser->id,
        'name' => 'Menu User Lain',
        'price' => 20000,
        'stock' => 10,
        'sold' => 5,
        'is_available' => true,
    ]);
    Order::create([
        'user_id' => $otherUser->id,
        'order_number' => 'ORD-OTHER-001',
        'customer_name' => 'Pelanggan Lain',
        'total_amount' => 22000,
        'status' => 'Selesai',
        'payment_status' => 'paid',
    ]);

    // 2. Register a brand new user
    $this->post('/register', [
        'name' => 'User Baru',
        'email' => 'userbaru@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect('/dashboard');

    $newUser = User::where('email', 'userbaru@example.com')->first();
    expect($newUser)->not->toBeNull();

    // 3. Check Dashboard is empty
    $dashResponse = $this->actingAs($newUser)->get('/dashboard');
    $dashResponse->assertStatus(200);
    $dashResponse->assertViewHas('totalCustomers', 0);
    $dashResponse->assertViewHas('totalOrders', 0);
    $dashResponse->assertViewHas('menusAvailable', 0);
    $dashResponse->assertViewHas('bestSellingMenus', fn ($m) => $m->isEmpty());
    $dashResponse->assertSee('Belum ada data menu terlaris');

    // 4. Check Menu catalog is empty
    $menuResponse = $this->actingAs($newUser)->get('/menu');
    $menuResponse->assertStatus(200);
    $menuResponse->assertViewHas('menus', fn ($m) => $m->isEmpty());
    $menuResponse->assertSee('Belum ada menu di database.');
    $menuResponse->assertDontSee('Menu User Lain');

    // 5. Check POS Order catalog is empty
    $orderResponse = $this->actingAs($newUser)->get('/order');
    $orderResponse->assertStatus(200);
    $orderResponse->assertViewHas('menus', fn ($m) => $m->isEmpty());
    $orderResponse->assertSee('Belum ada menu tersedia.');
    $orderResponse->assertDontSee('Menu User Lain');

    // 6. Check Reports are empty
    $reportResponse = $this->actingAs($newUser)->get('/reports');
    $reportResponse->assertStatus(200);
    $reportResponse->assertViewHas('orders', fn ($o) => $o->isEmpty());
    $reportResponse->assertViewHas('topSelling', fn ($t) => $t->isEmpty());
    $reportResponse->assertViewHas('kpi', fn ($kpi) => $kpi['total_revenue'] === 0 && $kpi['total_transactions'] === 0);
    $reportResponse->assertSee('Belum ada data transaksi');

    // 7. Check Order History is empty
    $historyResponse = $this->actingAs($newUser)->get('/riwayat-pesanan');
    $historyResponse->assertStatus(200);
    $historyResponse->assertViewHas('orders', fn ($o) => $o->isEmpty());
    $historyResponse->assertSee('Belum ada data transaksi');
});
