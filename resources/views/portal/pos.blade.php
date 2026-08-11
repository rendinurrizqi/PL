@extends('layouts.app')

@section('title', 'POS Kasir')

@section('content')
    <div class="d-flex min-vh-100">
        <aside class="role-sidebar p-3">
            <div class="d-flex align-items-center gap-2 mb-4 px-2">
                <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-cash-register"></i></div>
                <div>
                    <div class="fw-bold fs-6 text-white">Kasir Outlet</div>
                    <div class="text-warning fs-8 fw-bold">{{ $userName }}</div>
                </div>
            </div>
            <nav class="nav flex-column fs-7">
                <a class="nav-link" href="{{ route('kasir.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                <a class="nav-link active" href="{{ route('kasir.pos') }}"><i class="fa-solid fa-cash-register"></i> POS Walk-In</a>
            </nav>
            <div class="mt-4 px-2">
                <form method="POST" action="{{ route('kasir.logout') }}">
                    @csrf
                    <button class="btn btn-brand-yellow w-100 fw-bold text-dark" type="submit"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar</button>
                </form>
            </div>
        </aside>

        <main class="flex-grow-1 p-4 bg-light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold text-brand-purple mb-1">POS Walk-In</h2>
                        <p class="text-muted mb-0">Input transaksi langsung untuk pelanggan yang datang ke outlet.</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('kasir.pos.submit') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nama Pelanggan</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Masukkan nama pelanggan" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Outlet</label>
                            <select name="outlet_id" class="form-select" required>
                                <option value="">Pilih outlet</option>
                                @foreach($outlets as $outlet)
                                    <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Metode Bayar</label>
                            <select name="pay_method" class="form-select" required>
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-custom p-3 mt-4">
                        <h5 class="fw-bold text-brand-purple mb-3">Daftar Produk</h5>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                <input type="number" name="items[{{ $product->id }}][product_id]" value="{{ $product->id }}" hidden>
                                                <input type="number" name="items[{{ $product->id }}][qty]" class="form-control" min="0" max="{{ $product->stock }}" value="0">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-brand-purple px-4 py-2 fw-bold">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
