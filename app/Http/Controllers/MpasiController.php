<?php

namespace App\Http\Controllers;

use App\Models\DailyMenu;
use App\Models\InventoryItem;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\PointRedemption;
use App\Models\PointReward;
use App\Models\PreOrder;
use App\Models\PreOrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MpasiController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('id')->get();
        $outlets = Outlet::query()->orderBy('id')->get();
        $dailyMenus = DailyMenu::query()->get();
        $rewards = PointReward::query()->where('is_active', true)->get();
        $settings = Setting::query()->pluck('value', 'key')->toArray();

        $member = null;

        return view('mpasi.index', compact(
            'products',
            'outlets',
            'dailyMenus',
            'rewards',
            'settings',
            'member'
        ));
    }

    public function kasirLoginPage()
    {
        return $this->staffLoginPage('kasir');
    }

    public function adminLoginPage()
    {
        return $this->staffLoginPage('admin');
    }

    public function ownerLoginPage()
    {
        return $this->staffLoginPage('owner');
    }

    public function kasirLogin(Request $request)
    {
        return $this->handleStaffLogin($request, 'kasir');
    }

    public function adminLogin(Request $request)
    {
        return $this->handleStaffLogin($request, 'admin');
    }

    public function ownerLogin(Request $request)
    {
        return $this->handleStaffLogin($request, 'owner');
    }

    public function kasirDashboard()
    {
        if (session('staff_role') !== 'kasir') {
            return redirect()->route('kasir.login');
        }

        return $this->renderFullPortal('kasir');
    }

    public function adminDashboard()
    {
        if (session('staff_role') !== 'admin') {
            return redirect()->route('admin.login');
        }

        return $this->renderFullPortal('admin');
    }

    public function ownerDashboard()
    {
        if (session('staff_role') !== 'owner') {
            return redirect()->route('owner.login');
        }

        return $this->renderFullPortal('owner');
    }

    protected function renderFullPortal(string $role = 'pelanggan')
    {
        $products = Product::query()->orderBy('id')->get();
        $outlets = Outlet::query()->orderBy('id')->get();
        $dailyMenus = DailyMenu::query()->get();
        $rewards = PointReward::query()->where('is_active', true)->get();
        $settings = Setting::query()->pluck('value', 'key')->toArray();
        $initialRole = $role;

        return view('mpasi.index', compact(
            'products',
            'outlets',
            'dailyMenus',
            'rewards',
            'settings',
            'initialRole'
        ));
    }

    public function ownerOutletsPage()
    {
        if (session('staff_role') !== 'owner') {
            return redirect()->route('owner.login');
        }

        return $this->renderFullPortal('owner');
    }

    public function ownerRewardsPage()
    {
        if (session('staff_role') !== 'owner') {
            return redirect()->route('owner.login');
        }

        return $this->renderFullPortal('owner');
    }

    public function kasirLogout()
    {
        return $this->staffLogout('kasir');
    }

    public function adminLogout()
    {
        return $this->staffLogout('admin');
    }

    public function ownerLogout()
    {
        return $this->staffLogout('owner');
    }

    public function getProducts()
    {
        return response()->json(Product::query()->orderBy('id')->get());
    }

    public function getOutlets()
    {
        return response()->json(Outlet::query()->orderBy('id')->get());
    }

    public function getMenuData()
    {
        return response()->json([
            'products' => Product::query()->orderBy('id')->get(),
            'outlets' => Outlet::query()->orderBy('id')->get(),
            'dailyMenus' => DailyMenu::query()->orderBy('id')->get(),
            'rewards' => PointReward::query()->where('is_active', true)->get(),
            'pointsEarnRate' => (int) ($this->getSetting('points_earn_rate', 1000)),
        ]);
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'whatsapp' => 'required|string',
            'outlet_id' => 'required',
            'pay_method' => 'required|string',
            'items' => 'required|array',
            'member_identifier' => 'nullable|string',
        ]);

        $outletObj = Outlet::query()->where('id', $validated['outlet_id'])->orWhere('name', $validated['outlet_id'])->first();
        $outletId = $outletObj ? $outletObj->id : (Outlet::query()->first()?->id ?? 1);

        $member = null;
        if (!empty($validated['member_identifier'])) {
            $member = Member::query()->firstOrCreate([
                'email' => $validated['member_identifier'],
            ], [
                'name' => $validated['customer_name'],
                'whatsapp' => $validated['whatsapp'],
                'points_balance' => 0,
            ]);

            if ($member->whatsapp !== $validated['whatsapp']) {
                $member->whatsapp = $validated['whatsapp'];
            }
            $member->save();
        }

        $totalAmount = 0;
        $itemsDetail = [];

        foreach ($validated['items'] as $item) {
            $product = Product::query()->find($item['product_id']);
            if (!$product) {
                continue;
            }

            $qty = max(1, (int) ($item['qty'] ?? 1));
            $subtotal = $product->price * $qty;
            $totalAmount += $subtotal;

            $itemsDetail[] = [
                'product_id' => $product->id,
                'qty' => $qty,
                'unit_price' => $product->price,
                'subtotal' => $subtotal,
            ];
        }

        $preOrder = PreOrder::query()->create([
            'member_id' => $member?->id,
            'outlet_id' => $outletId,
            'customer_name' => $validated['customer_name'],
            'whatsapp' => $validated['whatsapp'],
            'total_amount' => $totalAmount,
            'pay_method' => $validated['pay_method'],
            'is_paid' => $validated['pay_method'] === 'Transfer',
            'is_taken' => false,
            'cancel_status' => null,
            'cancel_reason' => null,
            'points_awarded' => 0,
        ]);

        foreach ($itemsDetail as $detail) {
            $detail['pre_order_id'] = $preOrder->id;
            PreOrderItem::query()->create($detail);
        }

        $pointsEarned = 0;
        if ($member) {
            $pointsEarned = $this->calculateEarnedPoints($itemsDetail);
            $member->points_balance += $pointsEarned;
            $member->save();

            $preOrder->points_awarded = $pointsEarned;
            $preOrder->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil disimpan.',
            'order' => $preOrder,
            'points_earned' => $pointsEarned,
        ]);
    }

    public function posCheckout(Request $request)
    {
        $validated = $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'items' => 'required|array',
        ]);

        foreach ($validated['items'] as $item) {
            $product = Product::query()->find($item['product_id']);
            if (!$product) {
                continue;
            }

            $qty = max(1, (int) ($item['qty'] ?? 1));
            $product->stock = max(0, (int) $product->stock - $qty);
            $product->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaksi POS berhasil diproses.',
        ]);
    }

    public function loginMember(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'identifier' => 'required|string',
        ]);

        $identifier = trim($validated['identifier']);

        $member = Member::query()
            ->where('email', $identifier)
            ->orWhere('whatsapp', $identifier)
            ->first();

        if (!$member) {
            $member = Member::query()->create([
                'name' => $validated['name'] ?: 'Bunda ' . $identifier,
                'whatsapp' => $identifier,
                'email' => $identifier,
                'password' => null,
                'points_balance' => 0,
                'last_login_at' => Carbon::now(),
            ]);
        }

        $member->last_login_at = Carbon::now();
        $member->name = $validated['name'] ?: $member->name;
        $member->save();

        return response()->json([
            'success' => true,
            'member' => $member,
        ]);
    }

    public function updateMemberProfile(Request $request)
    {
        $validated = $request->validate([
            'identifier' => 'required|string',
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'favorite_outlet' => 'nullable|string|max:255',
        ]);

        $identifier = trim($validated['identifier']);
        $newWa = trim($validated['whatsapp']);

        $member = Member::query()
            ->where('email', $identifier)
            ->orWhere('whatsapp', $identifier)
            ->first();

        if ($member) {
            $member->name = $validated['name'];
            $member->whatsapp = $newWa;
            if (isset($validated['favorite_outlet'])) {
                $member->favorite_outlet = $validated['favorite_outlet'];
            }
            $member->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui.',
            'member' => $member,
        ]);
    }

    public function redeemReward(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'reward_id' => 'required|exists:point_rewards,id',
        ]);

        $member = Member::query()->findOrFail($validated['member_id']);
        $reward = PointReward::query()->findOrFail($validated['reward_id']);

        if ($member->points_balance < $reward->points_cost) {
            return response()->json([
                'success' => false,
                'message' => 'Poin member tidak cukup.',
            ], 422);
        }

        $member->points_balance -= $reward->points_cost;
        $member->save();

        $redemptionCode = 'RDM-' . rand(1000, 9999);

        PointRedemption::query()->create([
            'member_id' => $member->id,
            'point_reward_id' => $reward->id,
            'points_used' => $reward->points_cost,
            'redemption_code' => $redemptionCode,
            'status' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Reward berhasil ditukar.',
            'redemption_code' => $redemptionCode,
            'remaining_points' => $member->points_balance,
        ]);
    }

    public function updatePointsRate(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|integer|min:1',
        ]);

        $this->setSetting('points_earn_rate', (int) $validated['rate']);

        return response()->json([
            'success' => true,
            'rate' => (int) $validated['rate'],
        ]);
    }

    public function getMembers()
    {
        return response()->json(Member::query()->orderBy('id')->get());
    }

    public function getPointRewards()
    {
        return response()->json(PointReward::query()->where('is_active', true)->get());
    }

    public function getInventory()
    {
        return response()->json(InventoryItem::query()->with('outlet')->get());
    }

    protected function staffLoginPage(string $role)
    {
        return view('portal.login', [
            'role' => $role,
            'portalTitle' => $this->staffRoleLabel($role),
        ]);
    }

    protected function handleStaffLogin(Request $request, string $role)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()
            ->where('email', $validated['email'])
            ->where('role', $role)
            ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withInput()->withErrors([
                'email' => 'Kredensial tidak valid untuk portal ' . $this->staffRoleLabel($role) . '.',
            ]);
        }

        session([
            'staff_role' => $role,
            'staff_user_id' => $user->id,
            'staff_name' => $user->name,
        ]);

        return redirect()->route($role . '.dashboard');
    }

    protected function staffDashboard(string $role)
    {
        if (session('staff_role') !== $role) {
            return redirect()->route($role . '.login');
        }

        $stats = [
            'products' => Product::query()->count(),
            'orders_today' => PreOrder::query()->whereDate('created_at', Carbon::today())->count(),
            'members' => Member::query()->count(),
            'revenue_today' => PreOrder::query()->whereDate('created_at', Carbon::today())->sum('total_amount'),
            'outlets' => Outlet::query()->count(),
            'stock_low' => Product::query()->where('stock', '<', 10)->count(),
        ];

        return view('portal.dashboard', [
            'role' => $role,
            'portalTitle' => $this->staffRoleLabel($role),
            'userName' => session('staff_name', 'Staff'),
            'stats' => $stats,
            'products' => Product::query()->orderBy('id')->limit(5)->get(),
            'orders' => PreOrder::query()->with('outlet')->latest()->limit(5)->get(),
        ]);
    }

    public function adminProductsPage()
    {
        if (session('staff_role') !== 'admin') {
            return redirect()->route('admin.login');
        }

        return $this->renderFullPortal('admin');
    }

    public function adminStoreProduct(Request $request)
    {
        if (session('staff_role') !== 'admin') {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'age_group' => 'required|string|max:100',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'ingredients' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $slug = Str::slug($validated['name']);

        Product::query()->create([
            'name' => $validated['name'],
            'slug' => $slug,
            'price' => $validated['price'],
            'category' => $validated['category'],
            'age_group' => $validated['age_group'],
            'ingredients' => $validated['ingredients'] ?? null,
            'stock' => $validated['stock'],
            'initial_stock' => $validated['stock'],
            'status' => $validated['status'] ?? 'Aktif',
            'custom_points' => 0,
        ]);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function adminUpdateProduct(Request $request, Product $product)
    {
        if (session('staff_role') !== 'admin') {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'age_group' => 'required|string|max:100',
            'price' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'ingredients' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $product->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'category' => $validated['category'],
            'age_group' => $validated['age_group'],
            'ingredients' => $validated['ingredients'] ?? null,
            'stock' => $validated['stock'],
            'status' => $validated['status'] ?? $product->status,
        ]);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function adminDeleteProduct(Product $product)
    {
        if (session('staff_role') !== 'admin') {
            return redirect()->route('admin.login');
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus.');
    }

    public function kasirPosPage()
    {
        if (session('staff_role') !== 'kasir') {
            return redirect()->route('kasir.login');
        }

        return $this->renderFullPortal('kasir');
    }

    public function kasirPosSubmit(Request $request)
    {
        if (session('staff_role') !== 'kasir') {
            return redirect()->route('kasir.login');
        }

        $validated = $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'customer_name' => 'required|string',
            'pay_method' => 'required|string',
            'items' => 'required|array',
        ]);

        $total = 0;
        $items = [];

        foreach ($validated['items'] as $item) {
            $product = Product::query()->find($item['product_id'] ?? null);
            if (!$product) {
                continue;
            }

            $qty = max(1, (int) ($item['qty'] ?? 1));
            $subtotal = $product->price * $qty;
            $total += $subtotal;

            $items[] = [
                'product_id' => $product->id,
                'qty' => $qty,
                'unit_price' => $product->price,
                'subtotal' => $subtotal,
            ];

            $product->stock = max(0, $product->stock - $qty);
            $product->save();
        }

        $order = PreOrder::query()->create([
            'member_id' => null,
            'outlet_id' => $validated['outlet_id'],
            'customer_name' => $validated['customer_name'],
            'whatsapp' => 'POS-WALKIN',
            'total_amount' => $total,
            'pay_method' => $validated['pay_method'],
            'is_paid' => true,
            'is_taken' => false,
            'cancel_status' => null,
            'cancel_reason' => null,
            'points_awarded' => 0,
        ]);

        foreach ($items as $item) {
            PreOrderItem::query()->create([
                'pre_order_id' => $order->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('kasir.pos')->with('success', 'Transaksi POS berhasil disimpan.');
    }

    protected function staffLogout(string $role)
    {
        session()->forget(['staff_role', 'staff_user_id', 'staff_name']);

        return redirect()->route($role . '.login');
    }

    protected function staffRoleLabel(string $role): string
    {
        return match ($role) {
            'kasir' => 'Kasir',
            'admin' => 'Admin',
            'owner' => 'Owner',
            default => 'Staff',
        };
    }

    protected function calculateEarnedPoints(array $items): int
    {
        $rate = (int) $this->getSetting('points_earn_rate', 1000);
        $total = 0;

        foreach ($items as $item) {
            $product = Product::query()->find($item['product_id'] ?? null);
            if (!$product) {
                continue;
            }

            $quantity = (int) ($item['qty'] ?? 1);

            if (!empty($product->custom_points)) {
                $total += $product->custom_points * $quantity;
                continue;
            }

            $total += intdiv($product->price * $quantity, $rate);
        }

        return $total;
    }

    protected function getSetting(string $key, $default = null)
    {
        $value = Setting::query()->where('key', $key)->value('value');

        if ($value === null) {
            return $default;
        }

        return $value;
    }

    protected function setSetting(string $key, $value): void
    {
        Setting::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public function apiStoreProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:1',
            'stock' => 'nullable|integer|min:0',
            'category' => 'nullable|string',
            'age_group' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'stock' => $validated['stock'] ?? 0,
            'initial_stock' => $validated['stock'] ?? 0,
            'category' => $validated['category'] ?? 'Bubur',
            'age_group' => $validated['age_group'] ?? '6+ Bulan',
            'ingredients' => $validated['ingredients'] ?? 'Bahan segar alami',
            'image' => $validated['image'] ?? null,
            'status' => $validated['status'] ?? 'Aktif',
            'custom_points' => 0,
        ]);

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function apiUpdateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|integer|min:1',
            'stock' => 'nullable|integer|min:0',
            'category' => 'nullable|string',
            'age_group' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
            'custom_points' => 'nullable|integer',
        ]);

        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if (isset($validated['age'])) {
            $validated['age_group'] = $validated['age'];
            unset($validated['age']);
        }

        $product->update(array_filter($validated, fn($v) => $v !== null));

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function apiDeleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => true]);
    }

    public function apiStoreOutlet(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:outlets,name',
        ]);

        $outlet = Outlet::create([
            'name' => $validated['name'],
            'address' => $validated['name'],
            'phone' => '08123456789',
            'is_active' => true,
        ]);

        return response()->json(['success' => true, 'outlet' => $outlet]);
    }

    public function apiUpdateOutlet(Request $request, $id)
    {
        $outlet = Outlet::where('id', $id)->orWhere('name', $id)->firstOrFail();
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $outlet->update(['name' => $validated['name'], 'address' => $validated['name']]);

        return response()->json(['success' => true, 'outlet' => $outlet]);
    }

    public function apiDeleteOutlet($id)
    {
        $outlet = Outlet::where('id', $id)->orWhere('name', $id)->firstOrFail();
        $outlet->delete();

        return response()->json(['success' => true]);
    }

    public function apiSaveDailyMenu(Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string',
            'product_ids' => 'present|array',
        ]);

        DailyMenu::updateOrCreate(
            ['day_name' => $validated['day']],
            ['product_ids' => $validated['product_ids']]
        );

        return response()->json(['success' => true]);
    }
}
