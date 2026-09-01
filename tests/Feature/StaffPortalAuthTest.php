<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StaffPortalAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_portal_mamam_yuk_login_page_is_available(): void
    {
        $response = $this->get('/portal/login');
        $response->assertStatus(200);
        $response->assertSee('Portal Mamam Yuk');

        $responseLogin = $this->get('/login');
        $responseLogin->assertStatus(200);
        $responseLogin->assertSee('Portal Mamam Yuk');
    }

    public function test_kasir_login_page_is_available(): void
    {
        $response = $this->get('/kasir/login');

        $response->assertStatus(200);
        $response->assertSee('Portal Mamam Yuk');
    }

    public function test_admin_login_page_is_available(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Portal Mamam Yuk');
    }

    public function test_owner_login_page_is_available(): void
    {
        $response = $this->get('/owner/login');

        $response->assertStatus(200);
        $response->assertSee('Portal Mamam Yuk');
    }

    public function test_staff_user_can_login_via_portal_mamam_yuk(): void
    {
        $kasir = User::query()->create([
            'name' => 'Kasir Satu',
            'email' => 'kasir@example.com',
            'role' => 'kasir',
            'password' => Hash::make('secret123'),
        ]);

        $admin = User::query()->create([
            'name' => 'Admin Satu',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('secret123'),
        ]);

        $owner = User::query()->create([
            'name' => 'Owner Satu',
            'email' => 'owner@example.com',
            'role' => 'owner',
            'password' => Hash::make('secret123'),
        ]);

        // Kasir login via /portal/login
        $resKasir = $this->post('/portal/login', [
            'email' => 'kasir@example.com',
            'password' => 'secret123',
        ]);
        $resKasir->assertRedirect('/kasir');
        $this->assertEquals('kasir', session('staff_role'));

        // Admin login via /portal/login
        $resAdmin = $this->post('/portal/login', [
            'email' => 'admin@example.com',
            'password' => 'secret123',
        ]);
        $resAdmin->assertRedirect('/admin');
        $this->assertEquals('admin', session('staff_role'));

        // Owner login via /portal/login
        $resOwner = $this->post('/portal/login', [
            'email' => 'owner@example.com',
            'password' => 'secret123',
        ]);
        $resOwner->assertRedirect('/owner');
        $this->assertEquals('owner', session('staff_role'));
    }

    public function test_admin_product_page_is_available(): void
    {
        $user = User::query()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('secret123'),
        ]);

        $this->withSession([
            'staff_role' => 'admin',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->get('/admin/products')->assertStatus(200);
    }

    public function test_kasir_pos_page_is_available(): void
    {
        $user = User::query()->create([
            'name' => 'Kasir Dua',
            'email' => 'kasir2@example.com',
            'role' => 'kasir',
            'password' => Hash::make('secret123'),
        ]);

        $this->withSession([
            'staff_role' => 'kasir',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->get('/kasir/pos')->assertStatus(200);
    }

    public function test_kasir_can_submit_pos_order(): void
    {
        $user = User::query()->create([
            'name' => 'Kasir Tiga',
            'email' => 'kasir3@example.com',
            'role' => 'kasir',
            'password' => Hash::make('secret123'),
        ]);

        $outlet = \App\Models\Outlet::query()->create([
            'name' => 'Outlet Demo',
            'address' => 'Jl. Demo 1',
            'phone' => '08123456789',
            'is_active' => true,
        ]);

        $product = \App\Models\Product::query()->create([
            'name' => 'Bubur Pisang',
            'slug' => 'bubur-pisang',
            'price' => 15000,
            'category' => 'Bubur',
            'age_group' => '6+ Bulan',
            'ingredients' => 'pisang, susu',
            'stock' => 25,
            'initial_stock' => 25,
            'status' => 'Aktif',
            'custom_points' => 0,
        ]);

        $response = $this->withSession([
            'staff_role' => 'kasir',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->post('/kasir/pos', [
            'outlet_id' => $outlet->id,
            'customer_name' => 'Ibu Ani',
            'pay_method' => 'Cash',
            'items' => [[
                'product_id' => $product->id,
                'qty' => 2,
            ]],
        ]);

        $response->assertRedirect('/kasir/pos');
        $this->assertDatabaseHas('pre_orders', [
            'customer_name' => 'Ibu Ani',
            'outlet_id' => $outlet->id,
            'total_amount' => 30000,
        ]);
    }

    public function test_owner_dashboard_is_available(): void
    {
        $user = User::query()->create([
            'name' => 'Owner Utama',
            'email' => 'owner@example.com',
            'role' => 'owner',
            'password' => Hash::make('secret123'),
        ]);

        $this->withSession([
            'staff_role' => 'owner',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->get('/owner')->assertStatus(200);
    }

    public function test_admin_can_create_product(): void
    {
        $user = User::query()->create([
            'name' => 'Admin Produk',
            'email' => 'adminprod@example.com',
            'role' => 'admin',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->withSession([
            'staff_role' => 'admin',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->post('/admin/products', [
            'name' => 'Bubur Jagung',
            'category' => 'Bubur',
            'age_group' => '8+ Bulan',
            'price' => 18000,
            'stock' => 30,
            'ingredients' => 'jagung, susu',
            'status' => 'Aktif',
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Bubur Jagung',
            'price' => 18000,
        ]);
    }

    public function test_admin_can_update_and_delete_product(): void
    {
        $user = User::query()->create([
            'name' => 'Admin Update',
            'email' => 'adminupdate@example.com',
            'role' => 'admin',
            'password' => Hash::make('secret123'),
        ]);

        $product = \App\Models\Product::query()->create([
            'name' => 'Bubur Kacang',
            'slug' => 'bubur-kacang',
            'price' => 12000,
            'category' => 'Bubur',
            'age_group' => '6+ Bulan',
            'ingredients' => 'kacang, susu',
            'stock' => 20,
            'initial_stock' => 20,
            'status' => 'Aktif',
        ]);

        $this->withSession([
            'staff_role' => 'admin',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->put('/admin/products/' . $product->id, [
            'name' => 'Bubur Kacang Hijau',
            'category' => 'Bubur',
            'age_group' => '8+ Bulan',
            'price' => 15000,
            'stock' => 18,
            'ingredients' => 'kacang hijau, susu',
            'status' => 'Aktif',
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Bubur Kacang Hijau',
            'price' => 15000,
        ]);

        $this->withSession([
            'staff_role' => 'admin',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->delete('/admin/products/' . $product->id)->assertRedirect('/admin/products');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_demo_staff_users_can_be_seeded(): void
    {
        $this->artisan('db:seed', ['--class' => 'DemoStaffUserSeeder'])
            ->assertSuccessful();

        $this->assertDatabaseHas('users', ['email' => 'kasir@mpasi.test']);
        $this->assertDatabaseHas('users', ['email' => 'admin@mpasi.test']);
        $this->assertDatabaseHas('users', ['email' => 'owner@mpasi.test']);
    }

    public function test_owner_can_manage_outlet_and_reward_reports(): void
    {
        $user = User::query()->create([
            'name' => 'Owner Laporan',
            'email' => 'ownerreport@example.com',
            'role' => 'owner',
            'password' => Hash::make('secret123'),
        ]);

        $outlet = \App\Models\Outlet::query()->create([
            'name' => 'Outlet Bandung',
            'address' => 'Jl. Bandung 1',
            'phone' => '0812340001',
            'is_active' => true,
        ]);

        \App\Models\PointReward::query()->create([
            'name' => 'Gratis 1 Produk',
            'points_cost' => 250,
            'description' => 'Reward gratis produk',
            'is_active' => true,
        ]);

        $this->withSession([
            'staff_role' => 'owner',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->get('/owner/rewards')->assertStatus(200);

        $this->withSession([
            'staff_role' => 'owner',
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ])->get('/owner/outlets')->assertStatus(200);

        $this->assertDatabaseHas('outlets', ['id' => $outlet->id, 'name' => 'Outlet Bandung']);
        $this->assertDatabaseHas('point_rewards', ['name' => 'Gratis 1 Produk', 'points_cost' => 250]);
    }
}
