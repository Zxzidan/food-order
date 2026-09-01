<?php

namespace Database\Seeders;

use App\Models\RestaurantTable;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $tableNumber = 'Meja '.str_pad((string) $i, 2, '0', STR_PAD_LEFT);
            RestaurantTable::updateOrCreate(
                ['table_number' => $tableNumber],
                [
                    'capacity' => ($i % 3 === 0) ? 6 : (($i % 2 === 0) ? 4 : 2),
                    'status' => 'available',
                ]
            );
        }
    }
}
