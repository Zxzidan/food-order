<?php

use App\Models\Category;
use App\Models\Member;
use App\Models\MemberPointLog;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('cashier can view members page', function () {
    $user = User::factory()->create();

    Member::create([
        'user_id' => $user->id,
        'member_code' => 'MBR-202609-0001',
        'name' => 'Ahmad Kasir',
        'phone' => '081234567890',
        'points_balance' => 15,
        'total_spend' => 150000,
        'status' => 'active',
    ]);

    $response = $this->actingAs($user)->get(route('members.index'));

    $response->assertStatus(200);
    $response->assertSee('Ahmad Kasir');
    $response->assertSee('MBR-202609-0001');
    $response->assertSee('081234567890');
});

test('cashier can register new member via form and json ajax', function () {
    $user = User::factory()->create();

    // 1. Regular Form POST
    $response = $this->actingAs($user)->post(route('members.store'), [
        'name' => 'Budi Santoso',
        'phone' => '089876543210',
        'email' => 'budi@example.com',
        'status' => 'active',
    ]);

    $response->assertRedirect(route('members.index'));
    $this->assertDatabaseHas('members', [
        'user_id' => $user->id,
        'name' => 'Budi Santoso',
        'phone' => '089876543210',
        'points_balance' => 0,
    ]);

    // 2. JSON AJAX POST (Quick register modal in POS)
    $ajaxResponse = $this->actingAs($user)->postJson(route('members.store'), [
        'name' => 'Citra Lestari',
        'phone' => '081122334455',
    ]);

    $ajaxResponse->assertStatus(200);
    $ajaxResponse->assertJson([
        'success' => true,
        'member' => [
            'name' => 'Citra Lestari',
            'phone' => '081122334455',
            'points_balance' => 0,
        ],
    ]);

    // 3. Duplicate phone validation for same user
    $duplicateResponse = $this->actingAs($user)->post(route('members.store'), [
        'name' => 'Budi Clone',
        'phone' => '089876543210',
    ]);

    $duplicateResponse->assertSessionHasErrors('phone');
});

test('pos can search member by phone or name', function () {
    $user = User::factory()->create();

    $member = Member::create([
        'user_id' => $user->id,
        'member_code' => 'MBR-202609-0010',
        'name' => 'Dewi Sartika',
        'phone' => '08555666777',
        'points_balance' => 25,
        'status' => 'active',
    ]);

    // Search by name
    $resName = $this->actingAs($user)->getJson(route('members.search', ['q' => 'Dewi']));
    $resName->assertStatus(200);
    $resName->assertJsonCount(1);
    $resName->assertJsonFragment(['name' => 'Dewi Sartika']);

    // Search by phone
    $resPhone = $this->actingAs($user)->getJson(route('members.search', ['q' => '08555']));
    $resPhone->assertStatus(200);
    $resPhone->assertJsonCount(1);
    $resPhone->assertJsonFragment(['phone' => '08555666777']);
});

test('order checkout applies member points discount correctly', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Makanan', 'slug' => 'makanan']);
    $menu = Menu::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'name' => 'Nasi Goreng Spesial',
        'price' => 50000,
        'stock' => 20,
        'is_available' => true,
    ]);

    $member = Member::create([
        'user_id' => $user->id,
        'member_code' => 'MBR-202609-0099',
        'name' => 'Eko Prasetyo',
        'phone' => '08777888999',
        'points_balance' => 20, // punya 20 poin = Rp 20.000
        'status' => 'active',
    ]);

    // Checkout: 1x Nasi Goreng (Rp 50.000), tukar 10 poin (= Rp 10.000)
    $items = [
        [
            'id' => 'menu-'.$menu->id,
            'name' => $menu->name,
            'price' => 50000,
            'qty' => 1,
        ],
    ];

    $response = $this->actingAs($user)->post(route('order.checkout'), [
        'customer_name' => '',
        'member_id' => $member->id,
        'points_used' => 10,
        'order_type' => 'Dine In',
        'table_number' => 'Meja 05',
        'items' => json_encode($items),
    ]);

    $order = Order::where('member_id', $member->id)->first();
    expect($order)->not->toBeNull();
    $response->assertRedirect(route('payment.show', ['order_number' => $order->order_number]));

    expect($order->customer_name)->toBe('Eko Prasetyo');
    expect($order->subtotal)->toBe(50000);
    expect($order->points_used)->toBe(10);
    expect($order->points_discount_amount)->toBe(10000);
    expect($order->discount)->toBe(10000);
    // Subtotal setelah diskon: 40.000, PB1 10% = 4.000, Total = 44.000
    expect($order->tax)->toBe(4000);
    expect($order->total_amount)->toBe(44000);
});

test('cash payment deducts used points, awards earned points, and logs transactions', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Minuman', 'slug' => 'minuman']);
    $menu = Menu::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'name' => 'Kopi Susu Gula Aren',
        'price' => 25000,
        'stock' => 50,
        'is_available' => true,
    ]);

    $member = Member::create([
        'user_id' => $user->id,
        'member_code' => 'MBR-202609-0100',
        'name' => 'Fajar Nugraha',
        'phone' => '08333444555',
        'points_balance' => 15,
        'total_spend' => 0,
        'status' => 'active',
    ]);

    // Pesanan: Subtotal 50.000, pakai 5 poin (diskon Rp 5.000)
    // Sisa subtotal = 45.000, PB1 10% = 4.500, Total bayar = 49.500
    // Total bayar 49.500 / 10.000 = +4 Poin
    $order = Order::create([
        'order_number' => 'ORD-20260913-0001',
        'user_id' => $user->id,
        'member_id' => $member->id,
        'customer_name' => $member->name,
        'order_type' => 'Dine In',
        'table_number' => 'Meja 01',
        'subtotal' => 50000,
        'tax' => 4500,
        'discount' => 5000,
        'points_used' => 5,
        'points_discount_amount' => 5000,
        'points_earned' => 0,
        'total_amount' => 49500,
        'payment_status' => 'pending',
        'status' => 'Menunggu Pembayaran',
    ]);

    $order->items()->create([
        'menu_id' => $menu->id,
        'menu_name' => $menu->name,
        'price' => 25000,
        'quantity' => 2,
        'subtotal' => 50000,
    ]);

    // Bayar tunai Rp 50.000
    $response = $this->actingAs($user)->post(route('payment.cash', $order->order_number), [
        'cash_received' => '50000',
    ]);

    $response->assertRedirect(route('riwayat.pesanan'));

    $order->refresh();
    $member->refresh();

    // Verifikasi order
    expect($order->payment_status)->toBe('paid');
    expect($order->status)->toBe('Selesai');
    expect($order->points_earned)->toBe(4);

    // Saldo awal 15 - 5 (digunakan) + 4 (diperoleh) = 14
    expect($member->points_balance)->toBe(14);
    expect($member->total_spend)->toBe(49500);

    // Verifikasi log mutasi
    $redeemLog = MemberPointLog::where('member_id', $member->id)->where('type', 'redeem')->first();
    expect($redeemLog)->not->toBeNull();
    expect($redeemLog->points)->toBe(-5);

    $earnLog = MemberPointLog::where('member_id', $member->id)->where('type', 'earn')->first();
    expect($earnLog)->not->toBeNull();
    expect($earnLog->points)->toBe(4);
});

test('cashier can update and delete member', function () {
    $user = User::factory()->create();

    $member = Member::create([
        'user_id' => $user->id,
        'member_code' => 'MBR-202609-0200',
        'name' => 'Gita Gutawa',
        'phone' => '08222333444',
        'status' => 'active',
    ]);

    // Update
    $updateRes = $this->actingAs($user)->put(route('members.update', $member), [
        'name' => 'Gita Gutawa Updated',
        'phone' => '08222333445',
        'status' => 'inactive',
    ]);

    $updateRes->assertRedirect(route('members.index'));
    $member->refresh();
    expect($member->name)->toBe('Gita Gutawa Updated');
    expect($member->phone)->toBe('08222333445');
    expect($member->status)->toBe('inactive');

    // Delete
    $deleteRes = $this->actingAs($user)->delete(route('members.destroy', $member));
    $deleteRes->assertRedirect(route('members.index'));
    $this->assertDatabaseMissing('members', ['id' => $member->id]);
});
