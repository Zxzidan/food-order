<?php

use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('menu page can be rendered for authenticated user with price formatting elements', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/menu');

    $response->assertStatus(200);
    $response->assertSee('id="input-harga-produk"', false);
    $response->assertSee('id="edit-harga-produk"', false);
    $response->assertSee('inputmode="numeric"', false);
    $response->assertSee('Contoh: 28.000', false);
    $response->assertSee('setupPriceInput(inputHargaProduk)', false);
    $response->assertSee('setupPriceInput(editHargaProduk)', false);
    $response->assertSee('formatNumber', false);
});

test('can store menu with valid price', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Makanan', 'slug' => 'makanan']);

    $response = $this->actingAs($user)->post('/menu', [
        'name' => 'Nasi Goreng Spesial',
        'category' => 'Makanan',
        'price' => 25000,
        'stock' => 15,
        'description' => 'Nasi goreng enak',
    ]);

    $response->assertRedirect('/menu');
    $this->assertDatabaseHas('menus', [
        'name' => 'Nasi Goreng Spesial',
        'price' => 25000,
    ]);
});

test('can update menu price', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Makanan', 'slug' => 'makanan']);
    $menu = Menu::create([
        'category_id' => $category->id,
        'name' => 'Ayam Bakar',
        'price' => 25000,
        'stock' => 10,
        'is_available' => true,
    ]);

    $response = $this->actingAs($user)->put("/menu/{$menu->id}", [
        'name' => 'Ayam Bakar Madu',
        'category' => 'Makanan',
        'price' => 30000,
        'stock' => 10,
    ]);

    $response->assertRedirect('/menu');
    $this->assertDatabaseHas('menus', [
        'id' => $menu->id,
        'price' => 30000,
    ]);
});
