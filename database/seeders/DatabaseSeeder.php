<?php

namespace Database\Seeders;

use App\Models\DailyMenu;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\PointReward;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Staff Users
        $users = [
            ['name' => 'Kasir Demo', 'email' => 'kasir@mpasi.test', 'role' => 'kasir', 'password' => 'kasir123'],
            ['name' => 'Admin Demo', 'email' => 'admin@mpasi.test', 'role' => 'admin', 'password' => 'admin123'],
            ['name' => 'Owner Demo', 'email' => 'owner@mpasi.test', 'role' => 'owner', 'password' => 'owner123'],
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

        // 2. Outlets
        $outlets = [
            [
                'name' => 'Outlet Pusat (Jl. Pajajaran)',
                'address' => 'Jl. Pajajaran No. 123, Bogor Utara',
                'phone' => '081234567891',
                'is_active' => true,
            ],
            [
                'name' => 'Outlet Cabang 1 (Suryakencana)',
                'address' => 'Jl. Suryakencana No. 45, Bogor Tengah',
                'phone' => '081234567892',
                'is_active' => true,
            ],
            [
                'name' => 'Outlet Cabang 2 (Cibinong)',
                'address' => 'Jl. Raya Jakarta-Bogor KM 46, Cibinong',
                'phone' => '081234567893',
                'is_active' => true,
            ],
        ];

        foreach ($outlets as $o) {
            Outlet::query()->updateOrCreate(['name' => $o['name']], $o);
        }

        // 3. Products
        $products = [
            [
                'name' => 'Puree Daging Sapi & Wortel',
                'price' => 15000,
                'category' => 'Bubur Saring',
                'age_group' => '6-8 Bulan',
                'ingredients' => 'Daging sapi segar, wortel organik, kaldu tulang sapi asli',
                'stock' => 30,
                'status' => 'Aktif',
            ],
            [
                'name' => 'Bubur Tim Ayam Kampung & Bayam',
                'price' => 18000,
                'category' => 'Tim Lembut',
                'age_group' => '9-11 Bulan',
                'ingredients' => 'Ayam kampung, bayam jepang, beras organik, keju ungu',
                'stock' => 25,
                'status' => 'Aktif',
            ],
            [
                'name' => 'Nasi Tim Salmon Butter & Broccoli',
                'price' => 22000,
                'category' => 'Nasi Tim',
                'age_group' => '12+ Bulan',
                'ingredients' => 'Salmon norwegia, unsalted butter, brokoli, nasi beras merah',
                'stock' => 20,
                'status' => 'Aktif',
            ],
            [
                'name' => 'Puree Kabocha & Keju',
                'price' => 14000,
                'category' => 'Puree Buah',
                'age_group' => '6-8 Bulan',
                'ingredients' => 'Labu kabocha jepang, keju bayi khusus, minyak zaitun EVOO',
                'stock' => 35,
                'status' => 'Aktif',
            ],
            [
                'name' => 'Pudding Mamam Yuk Mangga Avocado',
                'price' => 12000,
                'category' => 'Snack Healthy',
                'age_group' => '8+ Bulan',
                'ingredients' => 'Mangga harum manis, alpukat mentega, agar-agar murni',
                'stock' => 40,
                'status' => 'Aktif',
            ],
            [
                'name' => 'Sup Macaroni Hati Ayam & Buncis',
                'price' => 17000,
                'category' => 'Sup Mamam Yuk',
                'age_group' => '10+ Bulan',
                'ingredients' => 'Macaroni gandum, hati ayam segar, buncis, kaldu ayam',
                'stock' => 22,
                'status' => 'Aktif',
            ],
        ];

        foreach ($products as $p) {
            Product::query()->updateOrCreate(
                ['name' => $p['name']],
                array_merge($p, [
                    'slug' => Str::slug($p['name']),
                    'initial_stock' => $p['stock'],
                    'custom_points' => 0,
                ])
            );
        }

        // 4. Point Rewards
        $rewards = [
            ['name' => 'Voucher Potongan Rp 5.000', 'points_cost' => 50, 'description' => 'Potongan langsung Rp 5.000 untuk pembelian berikutnya di semua outlet.', 'is_active' => true],
            ['name' => 'Voucher Potongan Rp 10.000', 'points_cost' => 90, 'description' => 'Potongan langsung Rp 10.000 untuk pembelian berikutnya di semua outlet.', 'is_active' => true],
            ['name' => 'Voucher Potongan Rp 25.000', 'points_cost' => 220, 'description' => 'Potongan langsung Rp 25.000, cocok untuk belanja borongan mingguan.', 'is_active' => true],
            ['name' => 'Gratis 1 Cup Puding Alpukat Kurma', 'points_cost' => 150, 'description' => 'Tukar poin dengan 1 cup Puding Alpukat Kurma gratis, tunjukkan kode ke Kasir saat ambil.', 'is_active' => true],
        ];

        foreach ($rewards as $r) {
            PointReward::query()->updateOrCreate(['name' => $r['name']], $r);
        }

        // 5. Members
        Member::query()->updateOrCreate([
            'email' => '081298765432',
        ], [
            'name' => 'Bunda Siti Rahmawati',
            'whatsapp' => '081298765432',
            'points_balance' => 45,
        ]);

        // 6. Settings
        Setting::query()->updateOrCreate(['key' => 'store_hours'], ['value' => 'BUKA 24 Jam']);
        Setting::query()->updateOrCreate(['key' => 'points_earn_rate'], ['value' => '1000']);

        // 7. Daily Menus (Variasi rotasi menu per hari)
        $allProductIds = Product::query()->pluck('id')->toArray();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        foreach ($days as $index => $day) {
            $assignedIds = match ($day) {
                'Senin' => array_slice($allProductIds, 0, 2),
                'Selasa' => array_slice($allProductIds, 1, 2),
                'Rabu' => array_slice($allProductIds, 2, 2),
                'Kamis' => array_slice($allProductIds, 3, 2),
                'Jumat' => array_slice($allProductIds, 4, 2),
                'Sabtu' => array_slice($allProductIds, 0, 3),
                'Minggu' => $allProductIds,
                default => $allProductIds,
            };
            DailyMenu::query()->updateOrCreate(
                ['day_name' => $day],
                ['product_ids' => $assignedIds]
            );
        }
    }
}

