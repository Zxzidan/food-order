<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sipemma.com'],
            [
                'name' => 'Dandi Azaidane',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'avatar' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@sipemma.com'],
            [
                'name' => 'Kasir Resto',
                'password' => Hash::make('password'),
                'role' => 'cashier',
                'avatar' => null,
            ]
        );
    }
}
