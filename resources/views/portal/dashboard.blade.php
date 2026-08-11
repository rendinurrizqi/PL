@extends('layouts.app')

@section('title', 'Dashboard ' . $portalTitle)

@section('content')
    <div class="d-flex min-vh-100">
        <aside class="role-sidebar p-3">
            <div class="d-flex align-items-center gap-2 mb-4 px-2">
                <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <div class="fw-bold fs-6 text-white">Portal {{ $portalTitle }}</div>
                    <div class="text-warning fs-8 fw-bold">{{ $userName }}</div>
                </div>
            </div>

            <nav class="nav flex-column fs-7">
                <a class="nav-link {{ request()->routeIs($role . '.dashboard') ? 'active' : '' }}" href="{{ route($role . '.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                @if($role === 'admin')
                    <a class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}" href="{{ route('admin.products') }}"><i class="fa-solid fa-boxes-stacked"></i> Master Produk</a>
                @elseif($role === 'kasir')
                    <a class="nav-link {{ request()->routeIs('kasir.pos') ? 'active' : '' }}" href="{{ route('kasir.pos') }}"><i class="fa-solid fa-cash-register"></i> POS Walk-In</a>
                @elseif($role === 'owner')
                    <a class="nav-link {{ request()->routeIs('owner.outlets') ? 'active' : '' }}" href="{{ route('owner.outlets') }}"><i class="fa-solid fa-store"></i> Outlet</a>
                    <a class="nav-link {{ request()->routeIs('owner.rewards') ? 'active' : '' }}" href="{{ route('owner.rewards') }}"><i class="fa-solid fa-coins"></i> Reward</a>
                @endif
            </nav>

            <div class="mt-4 px-2">
                <form method="POST" action="{{ route($role . '.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-brand-yellow w-100 fw-bold text-dark">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-grow-1 p-4 bg-light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-brand-purple mb-1">Selamat datang, {{ $userName }}</h2>
                        <p class="text-muted mb-0">Anda sedang masuk di portal {{ strtolower($portalTitle) }}.</p>
                    </div>
                    <span class="badge bg-brand-purple px-3 py-2">{{ strtoupper($role) }}</span>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card-custom p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Transaksi Hari Ini</span>
                                <i class="fa-solid fa-cart-shopping text-brand-purple"></i>
                            </div>
                            <div class="fw-bold fs-3 text-brand-purple">{{ $stats['orders_today'] }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-custom p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Produk Aktif</span>
                                <i class="fa-solid fa-box text-brand-purple"></i>
                            </div>
                            <div class="fw-bold fs-3 text-brand-purple">{{ $stats['products'] }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-custom p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Pendapatan Hari Ini</span>
                                <i class="fa-solid fa-coins text-brand-purple"></i>
                            </div>
                            <div class="fw-bold fs-3 text-brand-purple">Rp {{ number_format($stats['revenue_today'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-lg-7">
                        <div class="card-custom p-3 h-100">
                            <h5 class="fw-bold text-brand-purple mb-3">Produk Terbaru</h5>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    <span class="badge {{ $product->stock < 10 ? 'bg-warning text-dark' : 'bg-success' }}">
                                                        {{ $product->stock < 10 ? 'Stok Rendah' : 'Aktif' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Belum ada produk.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card-custom p-3 h-100">
                            <h5 class="fw-bold text-brand-purple mb-3">Pesanan Terakhir</h5>
                            <div class="list-group list-group-flush">
                                @forelse($orders as $order)
                                    <div class="list-group-item px-0">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $order->customer_name }}</strong>
                                            <span class="text-muted small">{{ $order->created_at->format('d M') }}</span>
                                        </div>
                                        <div class="text-muted small">{{ $order->outlet->name ?? 'Outlet' }} · Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                    </div>
                                @empty
                                    <div class="text-muted small">Belum ada pesanan.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
