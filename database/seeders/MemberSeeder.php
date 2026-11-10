<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberPointLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = User::where('role', 'admin')->get();
        if ($admins->isEmpty()) {
            $admins = User::all();
        }

        $membersData = [
            [
                'code_num' => '001',
                'name' => 'Siti Nurhaliza',
                'phone' => '081234567890',
                'email' => 'siti.nurhaliza@gmail.com',
                'points_balance' => 45,
                'total_spend' => 450000,
                'status' => 'active',
            ],
            [
                'code_num' => '002',
                'name' => 'Budi Santoso',
                'phone' => '085712345678',
                'email' => 'budi.santoso@gmail.com',
                'points_balance' => 133,
                'total_spend' => 1330000,
                'status' => 'active',
            ],
            [
                'code_num' => '003',
                'name' => 'Dewi Lestari',
                'phone' => '082198765432',
                'email' => 'dewi.lestari@gmail.com',
                'points_balance' => 80,
                'total_spend' => 800000,
                'status' => 'active',
            ],
            [
                'code_num' => '004',
                'name' => 'Ahmad Fauzi',
                'phone' => '081399887766',
                'email' => 'ahmad.fauzi@gmail.com',
                'points_balance' => 50,
                'total_spend' => 500000,
                'status' => 'active',
            ],
        ];

        foreach ($admins as $admin) {
            $pfx = ($admin->email === 'admin@sipemma.com') ? '' : ('U'.$admin->id.'-');

            foreach ($membersData as $mData) {
                $code = 'MBR-'.$pfx.$mData['code_num'];
                $member = Member::updateOrCreate(
                    [
                        'member_code' => $code,
                    ],
                    [
                        'user_id' => $admin->id,
                        'name' => $mData['name'],
                        'phone' => $mData['phone'],
                        'email' => $mData['email'],
                        'points_balance' => $mData['points_balance'],
                        'total_spend' => $mData['total_spend'],
                        'status' => $mData['status'],
                    ]
                );

                MemberPointLog::firstOrCreate(
                    [
                        'member_id' => $member->id,
                        'description' => "Perolehan poin awal pendaftaran member {$member->member_code}",
                    ],
                    [
                        'type' => 'earn',
                        'points' => $member->points_balance,
                        'balance_after' => $member->points_balance,
                    ]
                );
            }
        }
    }
}
