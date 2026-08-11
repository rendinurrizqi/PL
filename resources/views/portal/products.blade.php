@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="d-flex min-vh-100">
        <aside class="role-sidebar p-3">
            <div class="d-flex align-items-center gap-2 mb-4 px-2">
                <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-user-gear"></i></div>
                <div>
                    <div class="fw-bold fs-6 text-white">Portal Admin</div>
                    <div class="text-warning fs-8 fw-bold">{{ $userName }}</div>
                </div>
            </div>
            <nav class="nav flex-column fs-7">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                <a class="nav-link active" href="{{ route('admin.products') }}"><i class="fa-solid fa-boxes-stacked"></i> Master Produk</a>
                <a class="nav-link" href="#"><i class="fa-solid fa-calendar-days"></i> Menu Harian</a>
            </nav>
            <div class="mt-4 px-2">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-brand-yellow w-100 fw-bold text-dark" type="submit"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar</button>
                </form>
            </div>
        </aside>

        <main class="flex-grow-1 p-4 bg-light">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-brand-purple mb-1">Master Produk MPASI</h2>
                        <p class="text-muted mb-0">Kelola daftar produk karena ini area operasional admin.</p>
                    </div>
                </div>

                <div class="card-custom p-3 mb-4">
                    @include('portal.forms.product-form')
                </div>

                <div class="card-custom p-3">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Umur</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>{{ $product->age_group }}</td>
                                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <span class="badge {{ $product->stock < 10 ? 'bg-warning text-dark' : 'bg-success' }}">
                                                {{ $product->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
