<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $nasiGoreng = Menu::where('name', 'Nasi Goreng Ayam')->first();
        $mieGoreng = Menu::where('name', 'Mie Goreng Spesial')->first();
        $esJeruk = Menu::where('name', 'Es Jeruk Segar')->first();
        $gadoGado = Menu::where('name', 'Gado-Gado')->first();
        $esTeh = Menu::where('name', 'Es Teh Manis')->first();
        $kentang = Menu::where('name', 'Kentang Goreng Crispy')->first();
        $pisang = Menu::where('name', 'Pisang Bakar Coklat Keju')->first();

        // 1. Order ORD-20260822-045
        $order1 = Order::updateOrCreate(
            ['order_number' => '#ORD-20260822-045'],
            [
                'user_id' => $admin?->id,
                'customer_name' => 'Ahmad Fauzi',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 04',
                'subtotal' => 50000,
                'tax' => 5000,
                'discount' => 0,
                'total_amount' => 55000,
                'payment_method' => 'QRIS',
                'payment_status' => 'Lunas',
                'status' => 'Selesai',
                'notes' => 'Tanpa bawang goreng di mie',
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(30),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'menu_name' => 'Mie Goreng Spesial'],
            [
                'menu_id' => $mieGoreng?->id,
                'price' => 18000,
                'quantity' => 2,
                'subtotal' => 36000,
                'notes' => 'Pedas sedang',
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'menu_name' => 'Es Jeruk Segar'],
            [
                'menu_id' => $esJeruk?->id,
                'price' => 7000,
                'quantity' => 2,
                'subtotal' => 14000,
                'notes' => 'Sedikit es',
            ]
        );

        // 2. Order ORD-20260822-044
        $order2 = Order::updateOrCreate(
            ['order_number' => '#ORD-20260822-044'],
            [
                'user_id' => $admin?->id,
                'customer_name' => 'Siti Nurhaliza',
                'order_type' => 'Take Away',
                'table_number' => null,
                'subtotal' => 47000,
                'tax' => 4700,
                'discount' => 0,
                'total_amount' => 51700,
                'payment_method' => 'Tunai',
                'payment_status' => 'Lunas',
                'cash_received' => 60000,
                'change_amount' => 8300,
                'status' => 'Selesai',
                'notes' => 'Bungkus rapi',
                'created_at' => Carbon::now()->subHours(1),
                'updated_at' => Carbon::now()->subHours(1),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'menu_name' => 'Nasi Goreng Ayam'],
            [
                'menu_id' => $nasiGoreng?->id,
                'price' => 35000,
                'quantity' => 1,
                'subtotal' => 35000,
                'notes' => null,
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'menu_name' => 'Es Jeruk Segar'],
            [
                'menu_id' => $esJeruk?->id,
                'price' => 12000,
                'quantity' => 1,
                'subtotal' => 12000,
                'notes' => null,
            ]
        );

        // 3. Order ORD-20260822-043
        $order3 = Order::updateOrCreate(
            ['order_number' => '#ORD-20260822-043'],
            [
                'user_id' => $admin?->id,
                'customer_name' => 'Budi Santoso',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 08',
                'subtotal' => 69000,
                'tax' => 6900,
                'discount' => 0,
                'total_amount' => 75900,
                'payment_method' => 'QRIS',
                'payment_status' => 'Lunas',
                'status' => 'Diproses',
                'notes' => 'Bumbu gado-gado pedas',
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order3->id, 'menu_name' => 'Gado-Gado Spesial'],
            [
                'menu_id' => $gadoGado?->id,
                'price' => 16000,
                'quantity' => 3,
                'subtotal' => 48000,
                'notes' => 'Bumbu dipisah',
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order3->id, 'menu_name' => 'Es Jeruk Segar'],
            [
                'menu_id' => $esJeruk?->id,
                'price' => 7000,
                'quantity' => 3,
                'subtotal' => 21000,
                'notes' => null,
            ]
        );

        // 4. Order ORD-20260822-042
        $order4 = Order::updateOrCreate(
            ['order_number' => '#ORD-20260822-042'],
            [
                'user_id' => $admin?->id,
                'customer_name' => 'Dewi Lestari',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 02',
                'subtotal' => 40000,
                'tax' => 4000,
                'discount' => 0,
                'total_amount' => 44000,
                'payment_method' => 'Debit',
                'payment_status' => 'Lunas',
                'status' => 'Selesai',
                'notes' => null,
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(3),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order4->id, 'menu_name' => 'Nasi Goreng Ayam'],
            [
                'menu_id' => $nasiGoreng?->id,
                'price' => 20000,
                'quantity' => 2,
                'subtotal' => 40000,
                'notes' => 'Pedas sedang',
            ]
        );

        // 5. Order ORD-20260822-041
        $order5 = Order::updateOrCreate(
            ['order_number' => '#ORD-20260822-041'],
            [
                'user_id' => $admin?->id,
                'customer_name' => 'Reza Rahardian',
                'order_type' => 'Take Away',
                'table_number' => null,
                'subtotal' => 72000,
                'tax' => 7200,
                'discount' => 0,
                'total_amount' => 79200,
                'payment_method' => 'Tunai',
                'payment_status' => 'Lunas',
                'cash_received' => 100000,
                'change_amount' => 20800,
                'status' => 'Selesai',
                'notes' => 'Porsi banyak sambal',
                'created_at' => Carbon::now()->subHours(4),
                'updated_at' => Carbon::now()->subHours(4),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order5->id, 'menu_name' => 'Mie Goreng Spesial'],
            [
                'menu_id' => $mieGoreng?->id,
                'price' => 18000,
                'quantity' => 4,
                'subtotal' => 72000,
                'notes' => 'Extra pangsit',
            ]
        );

        // 6. Order ORD-20260822-040
        $order6 = Order::updateOrCreate(
            ['order_number' => '#ORD-20260822-040'],
            [
                'user_id' => $admin?->id,
                'customer_name' => 'Rina Wijaya',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 05',
                'subtotal' => 38000,
                'tax' => 3800,
                'discount' => 0,
                'total_amount' => 41800,
                'payment_method' => 'QRIS',
                'payment_status' => 'Lunas',
                'status' => 'Selesai',
                'notes' => null,
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(5),
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order6->id, 'menu_name' => 'Kentang Goreng Crispy'],
            [
                'menu_id' => $kentang?->id,
                'price' => 18000,
                'quantity' => 1,
                'subtotal' => 18000,
                'notes' => null,
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order6->id, 'menu_name' => 'Pisang Bakar Coklat Keju'],
            [
                'menu_id' => $pisang?->id,
                'price' => 20000,
                'quantity' => 1,
                'subtotal' => 20000,
                'notes' => null,
            ]
        );
    }
}
