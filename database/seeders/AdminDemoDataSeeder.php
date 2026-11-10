<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdminDemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@sipemma.com')->first();

        if (! $admin) {
            $admin = User::create([
                'name' => 'Dandi Azaidane',
                'email' => 'admin@sipemma.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'avatar' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
            ]);
        }

        $makanan = Category::where('slug', 'makanan')->first();
        $minuman = Category::where('slug', 'minuman')->first();
        $snack = Category::where('slug', 'snack')->first();
        $dessert = Category::where('slug', 'dessert')->first();

        // 1. Buat 10 Menu untuk Akun Admin
        $menuData = [
            [
                'name' => 'Nasi Goreng Spesial',
                'category_id' => $makanan?->id,
                'price' => 32000,
                'stock' => 35,
                'sold' => 124,
                'description' => 'Nasi goreng harum dengan telur mata sapi, suwiran ayam gurih, dan acar segar.',
                'image' => 'assets/img/NASI GORENG AYAM.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Mie Ayam Pangsit',
                'category_id' => $makanan?->id,
                'price' => 25000,
                'stock' => 28,
                'sold' => 95,
                'description' => 'Mie kenyal gurih dengan topping ayam manis gurih dan pangsit goreng renyah.',
                'image' => 'assets/img/MIE AYAM.jpeg',
                'is_available' => true,
            ],
            [
                'name' => 'Beef Rice Bowl',
                'category_id' => $makanan?->id,
                'price' => 45000,
                'stock' => 20,
                'sold' => 88,
                'description' => 'Irisan daging sapi premium dengan saus teriyaki gurih manis disajikan di atas nasi hangat.',
                'image' => 'assets/img/beef-bowl.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Gado-Gado Komplit',
                'category_id' => $makanan?->id,
                'price' => 24000,
                'stock' => 22,
                'sold' => 62,
                'description' => 'Sayuran segar rebus disiram bumbu kacang kental khas nusantara dan emping renyah.',
                'image' => 'assets/img/GADO GADO.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Ayam Bakar Madu',
                'category_id' => $makanan?->id,
                'price' => 38000,
                'stock' => 18,
                'sold' => 76,
                'description' => 'Ayam bakar empuk dengan olesan madu murni dan sambal terasi khas.',
                'image' => 'assets/img/NASI GORENG AYAM.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Es Jeruk Peras Segar',
                'category_id' => $minuman?->id,
                'price' => 12000,
                'stock' => 50,
                'sold' => 150,
                'description' => 'Perasan jeruk segar asli dengan sensasi dingin manis pelepas dahaga.',
                'image' => 'assets/img/ES JERUK.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Es Teh Manis Jasmine',
                'category_id' => $minuman?->id,
                'price' => 8000,
                'stock' => 60,
                'sold' => 180,
                'description' => 'Seduhan teh melati wangi dengan gula alami dan es batu menyegarkan.',
                'image' => 'assets/img/ES JERUK.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Kopi Susu Gula Aren',
                'category_id' => $minuman?->id,
                'price' => 18000,
                'stock' => 40,
                'sold' => 110,
                'description' => 'Espresso pilihan dipadukan susu creamy dan manis legit gula aren murni.',
                'image' => 'assets/img/ES JERUK.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Kentang Goreng Crispy',
                'category_id' => $snack?->id,
                'price' => 18000,
                'stock' => 30,
                'sold' => 85,
                'description' => 'Kentang goreng renyah di luar, lembut di dalam dengan taburan bumbu gurih.',
                'image' => 'assets/img/GADO GADO.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Pisang Bakar Keju Cokelat',
                'category_id' => $dessert?->id,
                'price' => 20000,
                'stock' => 25,
                'sold' => 68,
                'description' => 'Pisang kepok manis dipanggang empuk dengan taburan parutan keju dan meses cokelat premium.',
                'image' => 'assets/img/GADO GADO.jpg',
                'is_available' => true,
            ],
        ];

        $menus = [];
        foreach ($menuData as $data) {
            $menus[$data['name']] = Menu::updateOrCreate(
                ['user_id' => $admin->id, 'name' => $data['name']],
                $data
            );
        }

        // 2. Buat 4 Member Pelanggan untuk Akun Admin
        $memberData = [
            [
                'member_code' => 'MBR-001',
                'name' => 'Siti Aisyah',
                'phone' => '081234567891',
                'email' => 'siti.aisyah@gmail.com',
                'points_balance' => 450,
                'total_spend' => 450000,
                'status' => 'active',
            ],
            [
                'member_code' => 'MBR-002',
                'name' => 'Budi Santoso',
                'phone' => '081234567892',
                'email' => 'budi.santoso@gmail.com',
                'points_balance' => 820,
                'total_spend' => 820000,
                'status' => 'active',
            ],
            [
                'member_code' => 'MBR-003',
                'name' => 'Dewi Lestari',
                'phone' => '081234567893',
                'email' => 'dewi.lestari@gmail.com',
                'points_balance' => 250,
                'total_spend' => 250000,
                'status' => 'active',
            ],
            [
                'member_code' => 'MBR-004',
                'name' => 'Mega Utami',
                'phone' => '081234567894',
                'email' => 'mega.utami@gmail.com',
                'points_balance' => 600,
                'total_spend' => 600000,
                'status' => 'active',
            ],
        ];

        $members = [];
        foreach ($memberData as $mData) {
            $members[$mData['member_code']] = Member::updateOrCreate(
                ['user_id' => $admin->id, 'member_code' => $mData['member_code']],
                $mData
            );
        }

        // 3. Buat 10 Pesanan (Orders) Dummy Realistis untuk Akun Admin
        $now = Carbon::now();

        $orders = [
            // Order 1 (Hari ini, Meja 01, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::now()->format('Ymd').'-0001',
                'customer_name' => 'Ahmad Fauzi',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 01',
                'member_id' => null,
                'items' => [
                    ['name' => 'Nasi Goreng Spesial', 'qty' => 2, 'price' => 32000, 'notes' => 'Pedas level 2'],
                    ['name' => 'Es Jeruk Peras Segar', 'qty' => 2, 'price' => 12000, 'notes' => 'Sedikit es'],
                ],
                'payment_method' => 'Tunai',
                'payment_status' => 'paid',
                'cash_received' => 100000,
                'change_amount' => 3200,
                'status' => 'Selesai',
                'created_at' => (clone $now)->subHours(3),
            ],
            // Order 2 (Hari ini, Member Siti Aisyah, Meja 04, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::now()->format('Ymd').'-0002',
                'customer_name' => 'Siti Aisyah',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 04',
                'member_id' => $members['MBR-001']->id,
                'items' => [
                    ['name' => 'Mie Ayam Pangsit', 'qty' => 1, 'price' => 25000, 'notes' => 'Pangsit dipisah'],
                    ['name' => 'Kopi Susu Gula Aren', 'qty' => 1, 'price' => 18000, 'notes' => 'Less sugar'],
                ],
                'payment_method' => 'QRIS',
                'payment_status' => 'paid',
                'status' => 'Selesai',
                'created_at' => (clone $now)->subHours(2),
            ],
            // Order 3 (Hari ini, Take Away, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::now()->format('Ymd').'-0003',
                'customer_name' => 'Dimas Pratama',
                'order_type' => 'Take Away',
                'table_number' => null,
                'member_id' => null,
                'items' => [
                    ['name' => 'Beef Rice Bowl', 'qty' => 2, 'price' => 45000, 'notes' => 'Bungkus rapi'],
                    ['name' => 'Es Teh Manis Jasmine', 'qty' => 2, 'price' => 8000, 'notes' => 'Es dipisah'],
                ],
                'payment_method' => 'QRIS',
                'payment_status' => 'paid',
                'status' => 'Selesai',
                'created_at' => (clone $now)->subMinutes(90),
            ],
            // Order 4 (Hari ini, Meja 02, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::now()->format('Ymd').'-0004',
                'customer_name' => 'Rina Marlina',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 02',
                'member_id' => null,
                'items' => [
                    ['name' => 'Ayam Bakar Madu', 'qty' => 1, 'price' => 38000, 'notes' => 'Sambal banyak'],
                    ['name' => 'Kentang Goreng Crispy', 'qty' => 1, 'price' => 18000, 'notes' => 'Saus tomat'],
                    ['name' => 'Es Jeruk Peras Segar', 'qty' => 1, 'price' => 12000, 'notes' => 'Normal'],
                ],
                'payment_method' => 'Tunai',
                'payment_status' => 'paid',
                'cash_received' => 80000,
                'change_amount' => 5200,
                'status' => 'Selesai',
                'created_at' => (clone $now)->subMinutes(60),
            ],
            // Order 5 (Hari ini, Member Budi Santoso, Meja 05, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::now()->format('Ymd').'-0005',
                'customer_name' => 'Budi Santoso',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 05',
                'member_id' => $members['MBR-002']->id,
                'items' => [
                    ['name' => 'Gado-Gado Komplit', 'qty' => 2, 'price' => 24000, 'notes' => 'Pedas sedang'],
                    ['name' => 'Pisang Bakar Keju Cokelat', 'qty' => 1, 'price' => 20000, 'notes' => 'Keju melimpah'],
                    ['name' => 'Es Teh Manis Jasmine', 'qty' => 2, 'price' => 8000, 'notes' => 'Manis'],
                ],
                'payment_method' => 'QRIS',
                'payment_status' => 'paid',
                'status' => 'Selesai',
                'created_at' => (clone $now)->subMinutes(40),
            ],
            // Order 6 (Hari ini, Meja 03, Diproses di Dapur)
            [
                'order_number' => 'ORD-'.Carbon::now()->format('Ymd').'-0006',
                'customer_name' => 'Anisa Rahma',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 03',
                'member_id' => null,
                'items' => [
                    ['name' => 'Beef Rice Bowl', 'qty' => 1, 'price' => 45000, 'notes' => 'Nasi sedikit'],
                    ['name' => 'Es Jeruk Peras Segar', 'qty' => 1, 'price' => 12000, 'notes' => 'Gula pisah'],
                ],
                'payment_method' => 'QRIS',
                'payment_status' => 'paid',
                'status' => 'Diproses',
                'created_at' => (clone $now)->subMinutes(15),
            ],
            // Order 7 (Hari ini, Meja 07, Menunggu Pembayaran)
            [
                'order_number' => 'ORD-'.Carbon::now()->format('Ymd').'-0007',
                'customer_name' => 'Hendra Wijaya',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 07',
                'member_id' => null,
                'items' => [
                    ['name' => 'Nasi Goreng Spesial', 'qty' => 1, 'price' => 32000, 'notes' => 'Tidak pedas'],
                    ['name' => 'Kopi Susu Gula Aren', 'qty' => 1, 'price' => 18000, 'notes' => 'Dingin'],
                ],
                'payment_method' => 'QRIS',
                'payment_status' => 'pending',
                'status' => 'Menunggu Pembayaran',
                'created_at' => (clone $now)->subMinutes(5),
            ],
            // Order 8 (Kemarin, Member Dewi Lestari, Take Away, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::yesterday()->format('Ymd').'-0001',
                'customer_name' => 'Dewi Lestari',
                'order_type' => 'Take Away',
                'table_number' => null,
                'member_id' => $members['MBR-003']->id,
                'items' => [
                    ['name' => 'Ayam Bakar Madu', 'qty' => 2, 'price' => 38000, 'notes' => 'Kotak terpisah'],
                    ['name' => 'Es Teh Manis Jasmine', 'qty' => 2, 'price' => 8000, 'notes' => 'Kemasan cup'],
                ],
                'payment_method' => 'Tunai',
                'payment_status' => 'paid',
                'cash_received' => 110000,
                'change_amount' => 8800,
                'status' => 'Selesai',
                'created_at' => (clone $now)->subDay()->setHour(12)->setMinute(30),
            ],
            // Order 9 (Kemarin, Meja 06, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::yesterday()->format('Ymd').'-0002',
                'customer_name' => 'Fajar Nugraha',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 06',
                'member_id' => null,
                'items' => [
                    ['name' => 'Mie Ayam Pangsit', 'qty' => 3, 'price' => 25000, 'notes' => 'Semua kuah panas'],
                    ['name' => 'Kentang Goreng Crispy', 'qty' => 2, 'price' => 18000, 'notes' => 'Garing'],
                ],
                'payment_method' => 'QRIS',
                'payment_status' => 'paid',
                'status' => 'Selesai',
                'created_at' => (clone $now)->subDay()->setHour(18)->setMinute(15),
            ],
            // Order 10 (Kemarin, Member Mega Utami, Meja 08, Selesai)
            [
                'order_number' => 'ORD-'.Carbon::yesterday()->format('Ymd').'-0003',
                'customer_name' => 'Mega Utami',
                'order_type' => 'Dine In',
                'table_number' => 'Meja 08',
                'member_id' => $members['MBR-004']->id,
                'items' => [
                    ['name' => 'Nasi Goreng Spesial', 'qty' => 1, 'price' => 32000, 'notes' => 'Telur ceplok matang'],
                    ['name' => 'Gado-Gado Komplit', 'qty' => 1, 'price' => 24000, 'notes' => 'Lontong saja'],
                    ['name' => 'Pisang Bakar Keju Cokelat', 'qty' => 1, 'price' => 20000, 'notes' => 'Extra susu'],
                    ['name' => 'Es Jeruk Peras Segar', 'qty' => 2, 'price' => 12000, 'notes' => 'Manis'],
                ],
                'payment_method' => 'Transfer Bank',
                'payment_status' => 'paid',
                'status' => 'Selesai',
                'created_at' => (clone $now)->subDay()->setHour(19)->setMinute(45),
            ],
        ];

        foreach ($orders as $o) {
            $subtotal = 0;
            foreach ($o['items'] as $item) {
                $subtotal += ($item['price'] * $item['qty']);
            }
            $tax = (int) round($subtotal * 0.10);
            $totalAmount = $subtotal + $tax;

            $createdOrder = Order::updateOrCreate(
                ['order_number' => $o['order_number']],
                [
                    'user_id' => $admin->id,
                    'customer_name' => $o['customer_name'],
                    'order_type' => $o['order_type'],
                    'table_number' => $o['table_number'],
                    'member_id' => $o['member_id'],
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'discount' => 0,
                    'points_used' => 0,
                    'points_discount_amount' => 0,
                    'points_earned' => $o['member_id'] ? (int) floor($totalAmount / 1000) : 0,
                    'total_amount' => $totalAmount,
                    'payment_method' => $o['payment_method'],
                    'payment_status' => $o['payment_status'],
                    'cash_received' => $o['cash_received'] ?? ($o['payment_method'] === 'Tunai' ? $totalAmount : null),
                    'change_amount' => $o['change_amount'] ?? 0,
                    'status' => $o['status'],
                    'notes' => $o['notes'] ?? null,
                    'created_at' => $o['created_at'],
                    'updated_at' => $o['created_at'],
                ]
            );

            // Bersihkan item lama jika ada
            OrderItem::where('order_id', $createdOrder->id)->delete();

            foreach ($o['items'] as $item) {
                $menu = $menus[$item['name']] ?? null;
                OrderItem::create([
                    'order_id' => $createdOrder->id,
                    'menu_id' => $menu?->id,
                    'menu_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['qty'],
                    'subtotal' => $item['price'] * $item['qty'],
                    'notes' => $item['notes'] ?? null,
                ]);
            }
        }
    }
}
