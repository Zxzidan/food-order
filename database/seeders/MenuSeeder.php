<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makanan = Category::where('slug', 'makanan')->first();
        $minuman = Category::where('slug', 'minuman')->first();
        $snack = Category::where('slug', 'snack')->first();
        $dessert = Category::where('slug', 'dessert')->first();

        $menus = [
            [
                'name' => 'Nasi Goreng Ayam',
                'category_id' => $makanan?->id,
                'price' => 35000,
                'stock' => 25,
                'sold' => 98,
                'description' => 'Nasi goreng dengan telur, ayam suwir, udang, dan bumbu spesial.',
                'image' => 'assets/img/NASI GORENG AYAM.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Mie Goreng Spesial',
                'category_id' => $makanan?->id,
                'price' => 40000,
                'stock' => 18,
                'sold' => 124,
                'description' => 'Mie goreng lezat dengan isian ayam cincang, sawi, pangsit dan bumbu rahasia.',
                'image' => 'assets/img/MIE AYAM.jpeg',
                'is_available' => true,
            ],
            [
                'name' => 'Es Jeruk Segar',
                'category_id' => $minuman?->id,
                'price' => 12000,
                'stock' => 40,
                'sold' => 85,
                'description' => 'Perasan buah jeruk segar asli murni dengan es batu yang menyegarkan dahaga.',
                'image' => 'assets/img/ES JERUK.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Gado-Gado',
                'category_id' => $makanan?->id,
                'price' => 25000,
                'stock' => 15,
                'sold' => 64,
                'description' => 'Sayuran segar dengan bumbu kacang gurih khas resep tradisional dan kerupuk.',
                'image' => 'assets/img/GADO GADO.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Es Teh Manis',
                'category_id' => $minuman?->id,
                'price' => 6000,
                'stock' => 50,
                'sold' => 210,
                'description' => 'Teh melati wangi dengan es batu dingin menyegarkan.',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Kentang Goreng Crispy',
                'category_id' => $snack?->id,
                'price' => 18000,
                'stock' => 30,
                'sold' => 45,
                'description' => 'Kentang goreng renyah dengan taburan saus keju dan bumbu gurih.',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Pisang Bakar Coklat Keju',
                'category_id' => $dessert?->id,
                'price' => 20000,
                'stock' => 20,
                'sold' => 38,
                'description' => 'Pisang kepok bakar manis dengan topping keju parut dan lelehan cokelat.',
                'image' => null,
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['name' => $menu['name']],
                $menu
            );
        }
    }
}
