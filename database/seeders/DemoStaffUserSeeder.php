<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoStaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Kasir Demo',
                'email' => 'kasir@mpasi.test',
                'role' => 'kasir',
                'password' => 'kasir123',
            ],
            [
                'name' => 'Admin Demo',
                'email' => 'admin@mpasi.test',
                'role' => 'admin',
                'password' => 'admin123',
            ],
            [
                'name' => 'Owner Demo',
                'email' => 'owner@mpasi.test',
                'role' => 'owner',
                'password' => 'owner123',
            ],
        ];

        foreach ($users as $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'password' => Hash::make($user['password']),
                ]
            );
        }
    }
}
