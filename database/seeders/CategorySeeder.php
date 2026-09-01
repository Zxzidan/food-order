<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Makanan', 'slug' => 'makanan', 'icon' => 'food'],
            ['name' => 'Minuman', 'slug' => 'minuman', 'icon' => 'drink'],
            ['name' => 'Snack', 'slug' => 'snack', 'icon' => 'snack'],
            ['name' => 'Dessert', 'slug' => 'dessert', 'icon' => 'dessert'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
