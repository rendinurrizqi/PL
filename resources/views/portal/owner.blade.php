@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
    <div class="d-flex min-vh-100">
        <aside class="role-sidebar p-3">
            <div class="d-flex align-items-center gap-2 mb-4 px-2">
                <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-user-shield"></i></div>
                <div>
                    <div class="fw-bold fs-6 text-white">Portal Owner</div>
                    <div class="text-warning fs-8 fw-bold">{{ $userName }}</div>
                </div>
            </div>
            <nav class="nav flex-column fs-7">
                <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}" href="{{ route('owner.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard Owner</a>
                <a class="nav-link {{ request()->routeIs('owner.outlets') ? 'active' : '' }}" href="{{ route('owner.outlets') }}"><i class="fa-solid fa-store"></i> Outlet</a>
                <a class="nav-link {{ request()->routeIs('owner.rewards') ? 'active' : '' }}" href="{{ route('owner.rewards') }}"><i class="fa-solid fa-coins"></i> Reward</a>
            </nav>
            <div class="mt-4 px-2">
                <form method="POST" action="{{ route('owner.logout') }}">
                    @csrf
                    <button class="btn btn-brand-yellow w-100 fw-bold text-dark" type="submit"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar</button>
                </form>
            </div>
        </aside>

        <main class="flex-grow-1 p-4 bg-light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-brand-purple mb-1">Dashboard Owner</h2>
                        <p class="text-muted mb-0">Ringkasan performa bisnis dan outlet.</p>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card-custom p-3 h-100">
                            <div class="text-muted small">Total Revenue</div>
                            <div class="fw-bold fs-3 text-brand-purple">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-custom p-3 h-100">
                            <div class="text-muted small">Total Pesanan</div>
                            <div class="fw-bold fs-3 text-brand-purple">{{ $totalOrders }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-custom p-3 h-100">
                            <div class="text-muted small">Outlet Aktif</div>
                            <div class="fw-bold fs-3 text-brand-purple">{{ $outletSummary->count() }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-custom p-3 h-100">
                            <div class="text-muted small">Produk Terjual</div>
                            <div class="fw-bold fs-3 text-brand-purple">{{ $topProducts->sum('sold_qty') }}</div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-lg-7">
                        <div class="card-custom p-3 h-100">
                            <h5 class="fw-bold text-brand-purple mb-3">Revenue Bulanan</h5>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($monthlyRevenue as $row)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($row['month'] . '-01')->translatedFormat('F Y') }}</td>
                                                <td>Rp {{ number_format($row['total'], 0, ',', '.') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">Belum ada data revenue.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card-custom p-3 h-100">
                            <h5 class="fw-bold text-brand-purple mb-3">Produk Terlaris</h5>
                            <div class="list-group list-group-flush">
                                @forelse($topProducts as $item)
                                    <div class="list-group-item px-0">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $item->product->name ?? 'Produk' }}</strong>
                                            <span class="badge bg-brand-purple">{{ $item->sold_qty }}x</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-muted small">Belum ada data penjualan.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
