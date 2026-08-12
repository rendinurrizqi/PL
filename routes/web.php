<?php

use App\Http\Controllers\MpasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MpasiController::class, 'index'])->name('mpasi.index');
Route::get('/api/products', [MpasiController::class, 'getProducts'])->name('mpasi.products');
Route::get('/api/outlets', [MpasiController::class, 'getOutlets'])->name('mpasi.outlets');
Route::get('/api/menu-data', [MpasiController::class, 'getMenuData'])->name('mpasi.menu-data');
Route::get('/api/members', [MpasiController::class, 'getMembers'])->name('mpasi.members');
Route::get('/api/rewards', [MpasiController::class, 'getPointRewards'])->name('mpasi.rewards');
Route::get('/api/inventory', [MpasiController::class, 'getInventory'])->name('mpasi.inventory');

Route::post('/api/products', [MpasiController::class, 'apiStoreProduct']);
Route::put('/api/products/{id}', [MpasiController::class, 'apiUpdateProduct']);
Route::delete('/api/products/{id}', [MpasiController::class, 'apiDeleteProduct']);
Route::post('/api/outlets', [MpasiController::class, 'apiStoreOutlet']);
Route::put('/api/outlets/{id}', [MpasiController::class, 'apiUpdateOutlet']);
Route::delete('/api/outlets/{id}', [MpasiController::class, 'apiDeleteOutlet']);
Route::post('/api/outlets/verify-pin', [MpasiController::class, 'apiVerifyOutletPin']);
Route::put('/api/outlets/{id}/pin', [MpasiController::class, 'apiUpdateOutletPin']);
Route::post('/api/daily-menu', [MpasiController::class, 'apiSaveDailyMenu']);

Route::post('/checkout', [MpasiController::class, 'processCheckout'])->name('mpasi.checkout');
Route::post('/pos/checkout', [MpasiController::class, 'posCheckout'])->name('mpasi.pos.checkout');
Route::post('/member/login', [MpasiController::class, 'loginMember'])->name('mpasi.member.login');
Route::post('/member/profile', [MpasiController::class, 'updateMemberProfile'])->name('mpasi.member.profile');
Route::post('/member/redeem-reward', [MpasiController::class, 'redeemReward'])->name('mpasi.member.redeem');
Route::post('/points/rate', [MpasiController::class, 'updatePointsRate'])->name('mpasi.points.rate');

Route::prefix('kasir')->group(function () {
    Route::get('/login', [MpasiController::class, 'kasirLoginPage'])->name('kasir.login');
    Route::post('/login', [MpasiController::class, 'kasirLogin'])->name('kasir.login.submit');
    Route::get('/', [MpasiController::class, 'kasirDashboard'])->name('kasir.dashboard');
    Route::get('/pos', [MpasiController::class, 'kasirPosPage'])->name('kasir.pos');
    Route::post('/pos', [MpasiController::class, 'kasirPosSubmit'])->name('kasir.pos.submit');
    Route::post('/logout', [MpasiController::class, 'kasirLogout'])->name('kasir.logout');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [MpasiController::class, 'adminLoginPage'])->name('admin.login');
    Route::post('/login', [MpasiController::class, 'adminLogin'])->name('admin.login.submit');
    Route::get('/', [MpasiController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/products', [MpasiController::class, 'adminProductsPage'])->name('admin.products');
    Route::post('/products', [MpasiController::class, 'adminStoreProduct'])->name('admin.products.store');
    Route::put('/products/{product}', [MpasiController::class, 'adminUpdateProduct'])->name('admin.products.update');
    Route::delete('/products/{product}', [MpasiController::class, 'adminDeleteProduct'])->name('admin.products.delete');
    Route::post('/logout', [MpasiController::class, 'adminLogout'])->name('admin.logout');
});

Route::prefix('owner')->group(function () {
    Route::get('/login', [MpasiController::class, 'ownerLoginPage'])->name('owner.login');
    Route::post('/login', [MpasiController::class, 'ownerLogin'])->name('owner.login.submit');
    Route::get('/', [MpasiController::class, 'ownerDashboard'])->name('owner.dashboard');
    Route::get('/outlets', [MpasiController::class, 'ownerOutletsPage'])->name('owner.outlets');
    Route::get('/rewards', [MpasiController::class, 'ownerRewardsPage'])->name('owner.rewards');
    Route::post('/logout', [MpasiController::class, 'ownerLogout'])->name('owner.logout');
});

Route::get('/db-seed-now', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
    return "Database migrated & seeded successfully!";
});

