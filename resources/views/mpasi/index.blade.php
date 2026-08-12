@extends('layouts.app')

@section('title', 'MPASI - MPASI Harian Untuk Si Kecil')

@section('content')
    @include('mpasi.partials.data-json')

    <div id="loading-overlay">
        <div class="spinner-border text-warning" style="width: 3.5rem; height: 3.5rem;" role="status"></div>
        <div class="mt-3 fw-bold text-brand-purple">Memuat MPASI - MPASI Harian Si Kecil...</div>
    </div>

    <div id="app">

        <div id="role-portal-pelanggan" class="role-portal-page">
            <nav class="navbar navbar-expand-lg navbar-custom px-3">
                <div class="container-fluid max-w-1600">
                    <a class="navbar-brand d-flex align-items-center gap-2 text-brand-purple" href="#" onclick="switchCustView('beranda')">
                        <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-baby"></i></div>
                        <div>
                            <span class="fs-5 fw-bold text-brand-purple">MPASI</span>
                            <div class="text-muted fs-8 fw-semibold" style="margin-top:-4px;">MPASI Harian Untuk Si Kecil</div>
                        </div>
                    </a>

                    <!-- Jam Toko Status Header Desktop -->
                    <div class="d-none d-md-flex align-items-center bg-purple-light px-3 py-1 rounded-pill border border-purple-200 ms-3">
                        <span class="fs-8 fw-bold me-2 text-brand-purple"><i class="fa-solid fa-clock me-1"></i> Jam Toko:</span>
                        <span id="store-hours-label" class="fw-bold text-dark fs-8 d-flex align-items-center gap-1">
                            <span id="store-hours-dot" class="d-inline-block rounded-circle bg-success" style="width:8px;height:8px;"></span>
                            BUKA (06.00 - 16.00)
                        </span>
                    </div>

                    <!-- Jam Toko Status Header Mobile -->
                    <div class="d-flex d-md-none align-items-center bg-purple-light px-2 py-1 rounded-pill border border-purple-200 ms-auto me-1" style="font-size:0.75rem;">
                        <span id="store-hours-label-mobile" class="fw-bold text-dark d-flex align-items-center gap-1">
                            <span id="store-hours-dot-mobile" class="d-inline-block rounded-circle bg-success" style="width:7px;height:7px;"></span>
                            BUKA
                        </span>
                    </div>

                    <button class="navbar-toggler d-none d-md-block" type="button" data-bs-toggle="collapse" data-bs-target="#custNavContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse d-none d-md-block" id="custNavContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1 align-items-center">
                            <li class="nav-item"><a class="nav-link active" id="cust-nav-beranda" href="#" onclick="switchCustView('beranda')"><i class="fa-solid fa-house me-1"></i> Beranda</a></li>
                            <li class="nav-item"><a class="nav-link" id="cust-nav-menu" href="#" onclick="switchCustView('menu')"><i class="fa-solid fa-utensils me-1"></i> Menu Hari Ini</a></li>
                            <li class="nav-item"><a class="nav-link" id="cust-nav-riwayat" href="#" onclick="switchCustView('riwayat')"><i class="fa-solid fa-clock-rotate-left me-1"></i> Riwayat Pesanan</a></li>
                            <li class="nav-item">
                                <a class="nav-link position-relative" id="cust-nav-poin" href="#" onclick="switchCustView('poin')">
                                    <i class="fa-solid fa-coins me-1"></i> Poin Saya
                                    <span id="poin-nav-badge" class="badge rounded-pill bg-brand-yellow text-dark fs-8 ms-1" style="display:none;">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link position-relative" id="cust-nav-keranjang" href="#" onclick="switchCustView('keranjang')">
                                    <i class="fa-solid fa-cart-shopping me-1"></i> Keranjang
                                    <span id="cart-badge" class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle" style="display:none;">0</span>
                                </a>
                            </li>
                            <li class="nav-item ms-lg-2" id="cust-nav-auth-container">
                                <button class="btn btn-outline-brand-purple btn-sm rounded-pill px-3 fw-bold text-brand-purple" onclick="switchCustView('login')"><i class="fa-solid fa-user me-1"></i> Masuk</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Mobile Bottom Navigation Bar (Khusus Handphone) -->
            <nav class="mobile-bottom-nav d-md-none fixed-bottom py-1 px-2" style="display: none;">
                <div class="d-flex justify-content-around align-items-center h-100">
                    <a href="#" class="mobile-nav-item active d-flex flex-column align-items-center text-decoration-none py-1 px-1 rounded-3" id="mobile-nav-beranda" onclick="switchCustView('beranda')">
                        <i class="fa-solid fa-house nav-icon"></i>
                        <span class="nav-label mt-1">Beranda</span>
                    </a>
                    <a href="#" class="mobile-nav-item d-flex flex-column align-items-center text-decoration-none py-1 px-1 rounded-3" id="mobile-nav-menu" onclick="switchCustView('menu')">
                        <i class="fa-solid fa-utensils nav-icon"></i>
                        <span class="nav-label mt-1">Menu</span>
                    </a>
                    <a href="#" class="mobile-nav-item d-flex flex-column align-items-center text-decoration-none py-1 px-1 rounded-3" id="mobile-nav-riwayat" onclick="switchCustView('riwayat')">
                        <i class="fa-solid fa-clock-rotate-left nav-icon"></i>
                        <span class="nav-label mt-1">Riwayat</span>
                    </a>
                    <a href="#" class="mobile-nav-item d-flex flex-column align-items-center text-decoration-none py-1 px-1 rounded-3 position-relative" id="mobile-nav-poin" onclick="switchCustView('poin')">
                        <div class="position-relative">
                            <i class="fa-solid fa-coins nav-icon"></i>
                            <span id="mobile-poin-badge" class="badge rounded-pill bg-brand-yellow text-dark position-absolute top-0 start-100 translate-middle fs-9" style="display:none;">0</span>
                        </div>
                        <span class="nav-label mt-1">Poin</span>
                    </a>
                    <a href="#" class="mobile-nav-item d-flex flex-column align-items-center text-decoration-none py-1 px-1 rounded-3 position-relative" id="mobile-nav-keranjang" onclick="switchCustView('keranjang')">
                        <div class="position-relative">
                            <i class="fa-solid fa-cart-shopping nav-icon"></i>
                            <span id="mobile-cart-badge" class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle fs-9" style="display:none;">0</span>
                        </div>
                        <span class="nav-label mt-1">Keranjang</span>
                    </a>
                    <a href="#" class="mobile-nav-item d-flex flex-column align-items-center text-decoration-none py-1 px-1 rounded-3" id="mobile-nav-akun" onclick="switchCustView(state.currentUser ? 'akun' : 'login')">
                        <i class="fa-solid fa-user nav-icon" id="mobile-nav-user-icon"></i>
                        <span class="nav-label mt-1" id="mobile-nav-user-label">Masuk</span>
                    </a>
                </div>
            </nav>

            <div id="closed-hours-alert" class="bg-danger text-white py-2 px-3 text-center fw-bold fs-7 shadow-sm" style="display:none;">
                <i class="fa-solid fa-triangle-exclamation text-warning me-2 fs-6"></i>
                Maaf pesanan hari ini sudah tutup, lanjut memesan lagi besok jam 06.00 atau bisa langsung datang ke tempat jam 06.00 – 09.00
            </div>

            <div class="container-fluid p-3 p-md-4 max-w-1600">
                <div id="cust-view-beranda" class="cust-view">
                    <div class="hero-banner mb-4">
                        <span class="badge bg-brand-yellow text-dark mb-2 font-extrabold px-3 py-1"><i class="fa-solid fa-heart me-1"></i> Nutrisi Terbaik Untuk Si Kecil</span>
                        <h2 class="fw-bold mb-2">Nutrisi Sehat, Alami & Bergizi Tinggi Setiap Hari</h2>
                        <p class="text-white opacity-90 fs-7 max-w-600 mb-3">Dibuat khusus dari bahan segar pilihan tanpa pengawet. Masak fresh setiap pagi untuk tumbuh kembang optimal si kecil.</p>
                        <button class="btn btn-brand-yellow px-4 py-2 text-dark font-bold" onclick="switchCustView('menu')"><i class="fa-solid fa-utensils me-1"></i> Lihat Menu Hari Ini</button>
                    </div>

                    <h5 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-fire text-danger me-2"></i> Menu Spesial Hari Ini</h5>
                    <div id="home-products-grid" class="row g-3 mb-4"></div>
                </div>

                <div id="cust-view-menu" class="cust-view" style="display:none;">
                    <h3 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-utensils me-2"></i> Katalog Menu MPASI Hari Ini</h3>
                    <div id="full-products-grid" class="row g-3"></div>
                </div>

                <div id="cust-view-keranjang" class="cust-view" style="display:none;">
                    <h3 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-cart-shopping me-2"></i> Keranjang Belanja MPASI</h3>
                    <div class="row g-3">
                        <div class="col-lg-8">
                            <div class="card-custom p-3">
                                <div class="table-responsive">
                                    <table class="table align-middle fs-7">
                                        <thead class="bg-light">
                                            <tr><th>Varian MPASI</th><th>Harga / Cup</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
                                        </thead>
                                        <tbody id="cart-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-custom p-3">
                                <h6 class="fw-bold border-bottom pb-2 mb-3">Ringkasan Pesanan</h6>
                                <div class="d-flex justify-content-between mb-2 fs-7"><span>Subtotal</span><span id="cart-summary-subtotal">Rp 0</span></div>
                                <div class="d-flex justify-content-between mb-3 fs-7"><span>Kemasan Higienis</span><span class="text-success fw-bold">GRATIS</span></div>
                                <hr>
                                <div class="d-flex justify-content-between fs-5 fw-bold mb-3"><span>Total:</span><span id="cart-summary-total" class="text-brand-purple">Rp 0</span></div>
                                <button class="btn btn-brand-yellow w-100 py-2.5 fw-bold text-dark" onclick="proceedToCheckoutPage()">Lanjut Checkout <i class="fa-solid fa-arrow-right me-1"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="cust-view-checkout" class="cust-view" style="display:none;">
                    <h3 class="fw-bold text-brand-purple mb-4 text-center"><i class="fa-solid fa-credit-card me-2"></i> Form Checkout Pemesanan MPASI</h3>
                    <div class="row g-4 max-w-1000 mx-auto">
                        <div class="col-md-5">
                            <div class="card-custom p-3 border-purple-200">
                                <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3">Ringkasan Belanja</h6>
                                <div id="checkout-items-list" class="d-flex flex-column gap-2 mb-3 fs-7"></div>
                                <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2">
                                    <span>Total Tagihan:</span>
                                    <span id="checkout-total-amount" class="text-brand-purple">Rp 0</span>
                                </div>
                                <div id="checkout-points-preview" class="fs-8 text-success fw-bold mt-2"></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-custom p-4">
                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Formulir Data Pemesan <span class="text-danger">*Wajib Isi</span></h6>
                                <form id="checkout-form" onsubmit="handleProcessCheckout(event)">
                                    <div class="mb-3">
                                        <label class="form-label fs-7 fw-bold">Nama Lengkap Bunda / Pemesan <span class="text-danger">*</span></label>
                                        <input type="text" id="co-name" class="form-control" placeholder="Contoh: Bunda Siti Rahmawati" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fs-7 fw-bold">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                                        <input type="tel" id="co-wa" class="form-control" placeholder="Contoh: 081298765432" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fs-7 fw-bold">Pilih Outlet Pengambilan <span class="text-danger">*</span></label>
                                        <select id="co-outlet" class="form-select fs-7" required>
                                            <option value="Outlet Pusat (Jl. Pajajaran)">Outlet Pusat (Jl. Pajajaran)</option>
                                            <option value="Outlet Cabang 1 (Suryakencana)">Outlet Cabang 1 (Suryakencana)</option>
                                            <option value="Outlet Cabang 2 (Cibinong)">Outlet Cabang 2 (Cibinong)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fs-7 fw-bold">Metode Pembayaran <span class="text-danger">*</span></label>
                                        <div class="d-flex flex-column gap-2">
                                            <label class="border p-2.5 rounded-3 d-flex align-items-center gap-3 cursor-pointer bg-light">
                                                <input type="radio" name="paymethod" value="Transfer" checked>
                                                <i class="fa-solid fa-building-columns fs-5 text-primary"></i>
                                                <div><div class="fw-bold fs-7">Transfer BCA / QRIS (Lunas Langsung)</div><div class="text-muted fs-8">No. Rek BCA: 8830192831 a/n MPASI Si Kecil</div></div>
                                            </label>
                                            <label class="border p-2.5 rounded-3 d-flex align-items-center gap-3 cursor-pointer bg-light">
                                                <input type="radio" name="paymethod" value="COD">
                                                <i class="fa-solid fa-hand-holding-dollar fs-5 text-success"></i>
                                                <div><div class="fw-bold fs-7">Bayar Saat Ambil di Tempat (COD Outlet)</div><div class="text-muted fs-8">Bayar tunai/QRIS saat ambil pesanan di outlet</div></div>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-brand-yellow w-100 py-3 fw-bold text-dark fs-6">
                                        <i class="fa-solid fa-paper-plane me-2"></i> KONFIRMASI PESANAN
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="cust-view-riwayat" class="cust-view" style="display:none;">
                    <h3 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-clock-rotate-left me-2"></i> Riwayat Pesanan Saya</h3>
                    <div class="card-custom p-3">
                        <div class="table-responsive">
                            <table class="table align-middle fs-7 mb-0">
                                <thead class="bg-light">
                                    <tr><th>ID Pesanan</th><th>Tanggal Ambil</th><th>Metode Bayar</th><th>Total</th><th>Status Ambil</th><th class="text-center">Aksi</th></tr>
                                </thead>
                                <tbody id="riwayat-tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="cust-view-poin" class="cust-view" style="display:none;">
                    <h3 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-coins me-2"></i> Poin Saya & Tukar Reward</h3>
                    <div id="poin-page-content"></div>
                </div>

                <div id="cust-view-akun" class="cust-view" style="display:none;">
                    <h3 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-circle-user me-2"></i> Profil & Akun Saya</h3>
                    <div id="akun-page-content"></div>
                </div>

                <div id="cust-view-login" class="cust-view" style="display:none;">
                    <div class="card-custom p-4 max-w-500 mx-auto shadow-lg">
                        <div class="text-center mb-4">
                            <div class="bg-brand-yellow text-dark d-inline-flex p-3 rounded-circle mb-2 fs-2"><i class="fa-solid fa-baby"></i></div>
                            <h4 class="fw-bold text-brand-purple mb-0">Member MPASI Si Kecil</h4>
                            <p class="text-muted fs-7">Masuk Member (+Poin) atau Belanja Tanpa Akun</p>
                        </div>
                        <form onsubmit="handleLogin(event)">
                            <div class="mb-3">
                                <label class="form-label fs-7 fw-bold">Nama Panggilan Bunda</label>
                                <input type="text" id="login-name" class="form-control" placeholder="Contoh: Bunda Siti">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-7 fw-bold">Nomor WhatsApp / Email</label>
                                <input type="text" id="login-identifier" class="form-control" placeholder="081298765432" required>
                            </div>
                            <button type="submit" class="btn btn-brand-purple w-100 py-2.5 fw-bold mb-3"><i class="fa-solid fa-right-to-bracket me-1"></i> MASUK MEMBER (+Poin)</button>
                        </form>
                        <button class="btn btn-outline-secondary btn-sm w-100 fw-bold mb-3" onclick="continueAsGuest()"><i class="fa-solid fa-user-slash me-1"></i> Lanjut Belanja Tanpa Akun (Tamu)</button>
                        <div class="text-center border-top pt-3">
                            <button class="btn btn-link text-danger fs-8 fw-bold" onclick="requestResetPasswordModal()">Lupa Kata Sandi? Minta Reset ke Owner</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="role-portal-kasir" class="role-portal-page" style="display:none;">
            <div class="d-flex">
                <div class="role-sidebar p-3">
                    <div class="d-flex align-items-center gap-2 mb-3 px-2">
                        <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-cash-register"></i></div>
                        <div>
                            <div class="fw-bold fs-6 text-white">Kasir Outlet</div>
                            <div class="text-warning fs-8 fw-bold">Portal Penjaga</div>
                        </div>
                    </div>

                    <div class="mb-3 px-1">
                        <label class="form-label text-warning fs-8 fw-bold mb-1"><i class="fa-solid fa-store me-1"></i> Cabang Bertugas:</label>
                        <select id="kasir-active-outlet" class="form-select form-select-sm fs-8 fw-bold text-dark border-warning" onchange="changeKasirOutlet(this.value)">
                            <option value="Outlet Pusat (Jl. Pajajaran)">Outlet Pusat (Jl. Pajajaran)</option>
                            <option value="Outlet Cabang 1 (Suryakencana)">Outlet Cabang 1 (Suryakencana)</option>
                            <option value="Outlet Cabang 2 (Cibinong)">Outlet Cabang 2 (Cibinong)</option>
                        </select>
                    </div>

                    <nav class="nav flex-column fs-7" id="kasir-sidebar-nav">
                        <a class="nav-link active" href="#" onclick="switchKasirTab('preorder')"><i class="fa-solid fa-clipboard-check"></i> Daftar Pre-Order</a>
                        <a class="nav-link" href="#" onclick="switchKasirTab('pos')"><i class="fa-solid fa-store"></i> Kasir POS Walk-In</a>
                        <a class="nav-link" href="#" onclick="switchKasirTab('leftover')"><i class="fa-solid fa-clipboard-list"></i> Lapor Sisa Produk</a>
                    </nav>
                </div>

                <div class="flex-grow-1 p-4 overflow-auto">
                    <div id="kasir-tab-preorder" class="kasir-tab-content">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-clipboard-check text-brand-purple me-2"></i> Pre-Order Checklist Online</h4>
                                <p class="text-muted fs-7 mb-0">Ceklis Bunda yang mengambil pesanan online dan perbarui status pembayaran.</p>
                            </div>
                            <div class="badge bg-purple-light text-brand-purple border border-purple-200 fs-7 px-3 py-2 fw-bold" id="kasir-active-outlet-badge">
                                <i class="fa-solid fa-location-dot me-1 text-danger"></i> Outlet Pusat (Jl. Pajajaran)
                            </div>
                        </div>
                        <div class="card-custom p-3 border-purple-200">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">Ceklis Ambil</th>
                                            <th>ID & Nama Bunda</th>
                                            <th>WhatsApp</th>
                                            <th>Detail Pesanan</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Ambil</th>
                                            <th>Info Pembatalan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kasir-preorder-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="kasir-tab-pos" class="kasir-tab-content" style="display:none;">
                        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-store text-brand-purple me-2"></i> Kasir POS Pembelian Langsung (Walk-In)</h4>
                        <p class="text-muted fs-7 mb-4">Proses pembelian langsung di outlet untuk pembeli non pre-order.</p>
                        <div class="row g-3">
                            <div class="col-md-7">
                                <div class="card-custom p-3">
                                    <h6 class="fw-bold mb-3" id="pos-products-heading"><i class="fa-solid fa-calendar-day text-brand-purple me-1"></i> Pilih Produk MPASI Ready Stock</h6>
                                    <div id="pos-products-grid" class="row g-2"></div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card-custom p-3">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3">Keranjang Transaksi POS</h6>
                                    <div id="pos-cart-list" class="d-flex flex-column gap-2 mb-3 fs-7"></div>
                                    <div class="border-top pt-2">
                                        <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                                            <span>Total:</span>
                                            <span id="pos-total-display" class="text-brand-purple">Rp 0</span>
                                        </div>
                                        <button class="btn btn-brand-yellow w-100 py-2.5 fw-bold text-dark" onclick="processPosCheckout()">
                                            <i class="fa-solid fa-receipt me-1"></i> Selesaikan Transaksi Kasir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="kasir-tab-leftover" class="kasir-tab-content" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold text-danger mb-0"><i class="fa-solid fa-clipboard-list me-2"></i> Laporan Sisa Produk Tidak Laku Hari Ini</h4>
                                <div class="text-muted fs-8">Terhitung otomatis bersih dari stok alokasi dikurangi penjualan POS kasir.</div>
                            </div>
                            <button class="btn btn-danger fw-bold rounded-pill px-3" onclick="submitAllKasirLeftovers()">
                                <i class="fa-solid fa-paper-plane me-1"></i> Kirim Rekap Sisa Hari Ini
                            </button>
                        </div>
                        <div class="card-custom p-3 border-danger border-opacity-50">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Varian Produk MPASI</th>
                                            <th>Harga / Cup</th>
                                            <th>Stok Alokasi Hari Ini</th>
                                            <th>Terjual (Cup)</th>
                                            <th>Sisa Tidak Laku (Cup)</th>
                                            <th>Nilai Kerugian (Rp)</th>
                                            <th class="text-center">Status Laporan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kasir-leftover-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="role-portal-admin" class="role-portal-page" style="display:none;">
            <div class="d-flex">
                <div class="role-sidebar p-3">
                    <div class="d-flex align-items-center gap-2 mb-4 px-2">
                        <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-user-gear"></i></div>
                        <div>
                            <div class="fw-bold fs-6 text-white">Portal Admin</div>
                            <div class="text-warning fs-8 fw-bold">Operational Control</div>
                        </div>
                    </div>
                    <nav class="nav flex-column fs-7" id="admin-sidebar-nav">
                        <a class="nav-link active" href="#" onclick="switchAdminTab('menu')"><i class="fa-solid fa-calendar-days"></i> Atur Menu Harian</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('produk')"><i class="fa-solid fa-bowl-food"></i> Master Produk MPASI</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('pesanan')"><i class="fa-solid fa-cart-shopping"></i> Pesanan Per Outlet</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('dapur')"><i class="fa-solid fa-industry"></i> Rekap Dapur Masak</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('stok')"><i class="fa-solid fa-boxes-stacked"></i> Persediaan Bahan Baku</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('laporan-outlet')"><i class="fa-solid fa-file-invoice-dollar"></i> Laporan Per Outlet</a>
                    </nav>
                </div>

                <div class="flex-grow-1 p-4 overflow-auto">
                    <div id="admin-tab-menu" class="admin-tab-content">
                        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-calendar-days text-brand-purple me-2"></i> Pengaturan Menu Rotasi Harian</h4>
                        <p class="text-muted fs-7 mb-4">Rotasi menu berjalan otomatis di website pelanggan berdasarkan jadwal hari.</p>
                        <div id="admin-daily-menu-grid" class="row g-3"></div>
                    </div>

                    <div id="admin-tab-produk" class="admin-tab-content" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-bowl-food text-brand-purple me-2"></i> Master Data Produk MPASI</h4>
                                <p class="text-muted fs-7 mb-0">Kelola varian produk, harga, dan ketersediaan stok ready di outlet.</p>
                            </div>
                            <button class="btn btn-brand-yellow fw-bold" onclick="showAddProductModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Varian Baru</button>
                        </div>
                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr><th>Foto</th><th>ID</th><th>Varian MPASI</th><th>Harga / Cup</th><th>Kategori</th><th>Usia</th><th>Stok Ready</th><th>Status</th><th class="text-center">Aksi Admin</th></tr>
                                    </thead>
                                    <tbody id="adm-products-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="admin-tab-pesanan" class="admin-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-cart-shopping text-brand-purple me-2"></i> Pesanan Pelanggan Per Outlet</h4>
                                <p class="text-muted fs-7 mb-0">Pantau siapa memesan apa di cabang mana. Data real-time dari pre-order online seluruh outlet.</p>
                            </div>
                            <select id="adm-pesanan-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderAdminPesananPerOutlet()">
                                <option value="ALL">SEMUA CABANG OUTLET</option>
                            </select>
                        </div>

                        <div class="row g-3 mb-4" id="adm-pesanan-outlet-cards"></div>

                        <div class="card-custom p-3 border-purple-200">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID & Nama Bunda</th>
                                            <th>Cabang Outlet</th>
                                            <th>WhatsApp</th>
                                            <th>Detail Pesanan</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Ambil</th>
                                            <th>Status Pembatalan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adm-pesanan-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="admin-tab-dapur" class="admin-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-industry text-brand-purple me-2"></i> Rekapitulasi Dapur Masak Esok Hari</h4>
                                <p class="text-muted fs-7 mb-0">Terintegrasi dengan data Pesanan Per Outlet: Total Porsi Masak dihitung murni dari pre-order online yang masih berlaku (tanpa buffer walk-in).</p>
                            </div>
                            <select id="adm-dapur-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderAdminProduction()">
                                <option value="ALL">SEMUA OUTLET (KONSOLIDASI)</option>
                            </select>
                        </div>

                        <div class="row g-3 mb-4 mt-1" id="adm-dapur-outlet-cards"></div>

                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light"><tr><th>Varian MPASI</th><th>Pre-Order Online</th><th>Total Porsi Masak</th></tr></thead>
                                    <tbody id="adm-production-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="admin-tab-stok" class="admin-tab-content" style="display:none;">
                        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-boxes-stacked text-brand-purple me-2"></i> Persediaan Bahan Baku Dapur</h4>
                        <p class="text-muted fs-7 mb-4">Pantau ketersediaan bahan mentah dapur dan peringatan stok menipis.</p>
                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light"><tr><th>Nama Bahan</th><th>Stok</th><th>Min Stok</th><th>Satuan</th><th>Status</th></tr></thead>
                                    <tbody id="adm-inventory-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="admin-tab-laporan-outlet" class="admin-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-file-invoice-dollar text-brand-purple me-2"></i> Laporan Penjualan & Keuntungan Per Cabang Outlet</h4>
                                <p class="text-muted fs-7 mb-0">Pantau omset harian & bulanan, kerugian produk sisa, serta laba bersih per cabang.</p>
                            </div>
                            <div class="d-flex gap-2">
                                <select id="adm-report-period-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderAdminOutletReports()">
                                    <option value="HARIAN">Periode: Harian Hari Ini</option>
                                    <option value="BULANAN">Periode: Bulanan Bulan Ini</option>
                                </select>
                                <select id="adm-report-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderAdminOutletReports()">
                                    <option value="ALL">KONSOLIDASI SEMUA OUTLET</option>
                                    <option value="Outlet Pusat (Jl. Pajajaran)">Outlet Pusat (Jl. Pajajaran)</option>
                                    <option value="Outlet Cabang 1 (Suryakencana)">Outlet Cabang 1 (Suryakencana)</option>
                                    <option value="Outlet Cabang 2 (Cibinong)">Outlet Cabang 2 (Cibinong)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-4" id="adm-outlet-metric-cards"></div>

                        <div class="card-custom p-3 mb-4">
                            <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3"><i class="fa-solid fa-list-check me-2"></i> Rekapitulasi Rincian Per Cabang Outlet</h6>
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Nama Cabang Outlet</th>
                                            <th>Omset Kotor (Rp)</th>
                                            <th>Porsi Terjual</th>
                                            <th>Kerugian Sisa (Rp)</th>
                                            <th>Estimasi Untung / Laba Bersih (Rp)</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adm-outlet-report-tbody"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-custom p-3 border-danger border-opacity-25">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                <h6 class="fw-bold text-danger mb-0"><i class="fa-solid fa-clipboard-list me-2"></i> Laporan Sisa Produk Tidak Laku Diterima Dari Kasir Outlet</h6>
                                <span class="badge bg-danger fs-8"><i class="fa-solid fa-circle-check me-1"></i> Terhubung Live Kasir</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Cabang Outlet</th>
                                            <th>Varian Produk MPASI</th>
                                            <th>Stok Alokasi</th>
                                            <th>Terjual (Cup)</th>
                                            <th>Sisa Tidak Laku (Cup)</th>
                                            <th>Nilai Kerugian (Rp)</th>
                                            <th class="text-center">Status Laporan Kasir</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adm-leftover-report-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="role-portal-owner" class="role-portal-page" style="display:none;">
            <div class="d-flex">
                <div class="role-sidebar p-3">
                    <div class="d-flex align-items-center gap-2 mb-4 px-2">
                        <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-user-shield"></i></div>
                        <div>
                            <div class="fw-bold fs-6 text-white">Portal Owner</div>
                            <div class="text-warning fs-8 fw-bold">Akses Penuh Bisnis</div>
                        </div>
                    </div>
                    <nav class="nav flex-column fs-7" id="owner-sidebar-nav">
                        <a class="nav-link active" href="#" onclick="switchOwnerTab('dashboard')"><i class="fa-solid fa-gauge-high"></i> Dashboard Owner</a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('outlet')"><i class="fa-solid fa-shop"></i> Kelola Outlet</a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('menu')"><i class="fa-solid fa-calendar-days"></i> Atur Menu Harian</a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('produk')"><i class="fa-solid fa-bowl-food"></i> Master Produk MPASI</a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('praorder')">
                            <i class="fa-solid fa-clipboard-check"></i> Pre-Order Semua Outlet
                            <span id="owner-cancel-badge" class="badge bg-danger fs-8 ms-auto" style="display:none;">0</span>
                        </a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('dapur')"><i class="fa-solid fa-industry"></i> Rekap Dapur Masak</a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('stok')"><i class="fa-solid fa-boxes-stacked"></i> Persediaan Bahan Baku</a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('laporan')"><i class="fa-solid fa-file-invoice-dollar"></i> Laporan Semua Outlet</a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('poin')">
                            <i class="fa-solid fa-coins"></i> Poin & Reward Pelanggan
                        </a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('resetpass')">
                            <i class="fa-solid fa-key"></i> Reset Password Pelanggan
                            <span id="owner-resetpass-badge" class="badge bg-danger fs-8 ms-auto" style="display:none;">0</span>
                        </a>
                    </nav>
                </div>

                <div class="flex-grow-1 p-4 overflow-auto">
                    <div id="owner-tab-dashboard" class="owner-tab-content">
                        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-gauge-high text-brand-purple me-2"></i> Dashboard Ringkasan Bisnis</h4>
                        <p class="text-muted fs-7 mb-4">Pantau performa seluruh cabang outlet secara konsolidasi dalam satu layar.</p>
                        <div class="row g-3 mb-4" id="owner-dashboard-cards"></div>
                        <div class="row g-3">
                            <div class="col-lg-7">
                                <div class="card-custom p-3 h-100">
                                    <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3"><i class="fa-solid fa-store me-2"></i> Performa Cepat Per Cabang (Hari Ini)</h6>
                                    <div class="table-responsive">
                                        <table class="table align-middle fs-7 mb-0">
                                            <thead class="bg-light"><tr><th>Cabang Outlet</th><th>Omset</th><th>Porsi Terjual</th><th>Laba Bersih</th></tr></thead>
                                            <tbody id="owner-dashboard-outlet-tbody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="card-custom p-3 h-100 border-danger border-opacity-50">
                                    <h6 class="fw-bold text-danger border-bottom pb-2 mb-3"><i class="fa-solid fa-key me-2"></i> Tiket Reset Password Menunggu</h6>
                                    <div id="owner-dashboard-resetpass-list" class="d-flex flex-column gap-2 fs-7"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-outlet" class="owner-tab-content" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-shop text-brand-purple me-2"></i> Kelola Cabang Outlet</h4>
                                <p class="text-muted fs-7 mb-0">Tambah, ubah nama, atau hapus cabang outlet. Perubahan otomatis sinkron ke semua dropdown outlet di seluruh portal.</p>
                            </div>
                            <button class="btn btn-brand-yellow fw-bold" onclick="showAddOutletModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Outlet Baru</button>
                        </div>
                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr><th>Nama Cabang Outlet</th><th>Total Pre-Order</th><th>Pre-Order Belum Diambil</th><th class="text-center">Aksi Owner</th></tr>
                                    </thead>
                                    <tbody id="own-outlets-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-menu" class="owner-tab-content" style="display:none;">
                        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-calendar-days text-brand-purple me-2"></i> Pengaturan Menu Rotasi Harian</h4>
                        <p class="text-muted fs-7 mb-4">Owner dapat menambah maupun menghapus varian menu untuk tiap hari, otomatis sinkron ke pelanggan.</p>
                        <div id="own-daily-menu-grid" class="row g-3"></div>
                    </div>

                    <div id="owner-tab-produk" class="owner-tab-content" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-bowl-food text-brand-purple me-2"></i> Master Data Produk MPASI</h4>
                                <p class="text-muted fs-7 mb-0">Owner dapat menambah, mengedit, restok, mengubah status, maupun menghapus varian produk.</p>
                            </div>
                            <button class="btn btn-brand-yellow fw-bold" onclick="showAddProductModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Varian Baru</button>
                        </div>
                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr><th>Foto</th><th>ID</th><th>Varian MPASI</th><th>Harga / Cup</th><th>Kategori</th><th>Usia</th><th>Stok Ready</th><th>Status</th><th class="text-center">Aksi Owner</th></tr>
                                    </thead>
                                    <tbody id="own-products-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-praorder" class="owner-tab-content" style="display:none;">
                        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-clipboard-check text-brand-purple me-2"></i> Monitor Pre-Order Seluruh Cabang</h4>
                        <p class="text-muted fs-7 mb-4">Owner bisa melihat dan mengubah status pembayaran/ambil, serta menyetujui atau menolak permintaan pembatalan dari pelanggan.</p>
                        <div class="card-custom p-3 border-purple-200">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">Ceklis Ambil</th>
                                            <th>ID & Nama Bunda</th>
                                            <th>Cabang Outlet</th>
                                            <th>WhatsApp</th>
                                            <th>Detail Pesanan</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Ambil</th>
                                            <th>Permintaan Pembatalan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="owner-preorder-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-dapur" class="owner-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-industry text-brand-purple me-2"></i> Rekapitulasi Dapur Masak Esok Hari</h4>
                                <p class="text-muted fs-7 mb-0">Terintegrasi dengan data Pesanan Per Outlet: Total Porsi Masak dihitung murni dari pre-order online yang masih berlaku (tanpa buffer walk-in).</p>
                            </div>
                            <select id="own-dapur-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderOwnerProduction()">
                                <option value="ALL">SEMUA OUTLET (KONSOLIDASI)</option>
                            </select>
                        </div>

                        <div class="row g-3 mb-4 mt-1" id="own-dapur-outlet-cards"></div>

                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light"><tr><th>Varian MPASI</th><th>Pre-Order Online</th><th>Total Porsi Masak</th></tr></thead>
                                    <tbody id="own-production-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-stok" class="owner-tab-content" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-boxes-stacked text-brand-purple me-2"></i> Persediaan Bahan Baku Dapur</h4>
                                <p class="text-muted fs-7 mb-0">Owner dapat menambah bahan baru maupun mengubah jumlah stok bahan mentah.</p>
                            </div>
                            <button class="btn btn-brand-yellow fw-bold" onclick="showAddInventoryModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Bahan Baku</button>
                        </div>
                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light"><tr><th>Nama Bahan</th><th>Stok</th><th>Min Stok</th><th>Satuan</th><th>Status</th><th class="text-center">Aksi</th></tr></thead>
                                    <tbody id="own-inventory-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-laporan" class="owner-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-file-invoice-dollar text-brand-purple me-2"></i> Laporan Penjualan & Keuntungan Semua Cabang</h4>
                                <p class="text-muted fs-7 mb-0">Owner memantau omset harian & bulanan, kerugian produk sisa, serta laba bersih per cabang.</p>
                            </div>
                            <div class="d-flex gap-2">
                                <select id="own-report-period-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderOwnerOutletReports()">
                                    <option value="HARIAN">Periode: Harian Hari Ini</option>
                                    <option value="BULANAN">Periode: Bulanan Bulan Ini</option>
                                </select>
                                <select id="own-report-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderOwnerOutletReports()">
                                    <option value="ALL">KONSOLIDASI SEMUA OUTLET</option>
                                    <option value="Outlet Pusat (Jl. Pajajaran)">Outlet Pusat (Jl. Pajajaran)</option>
                                    <option value="Outlet Cabang 1 (Suryakencana)">Outlet Cabang 1 (Suryakencana)</option>
                                    <option value="Outlet Cabang 2 (Cibinong)">Outlet Cabang 2 (Cibinong)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-4" id="own-outlet-metric-cards"></div>

                        <div class="card-custom p-3 mb-4">
                            <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3"><i class="fa-solid fa-list-check me-2"></i> Rekapitulasi Rincian Per Cabang Outlet</h6>
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Nama Cabang Outlet</th>
                                            <th>Omset Kotor (Rp)</th>
                                            <th>Porsi Terjual</th>
                                            <th>Kerugian Sisa (Rp)</th>
                                            <th>Estimasi Untung / Laba Bersih (Rp)</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="own-outlet-report-tbody"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-custom p-3 border-danger border-opacity-25">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                <h6 class="fw-bold text-danger mb-0"><i class="fa-solid fa-clipboard-list me-2"></i> Laporan Sisa Produk Tidak Laku Diterima Dari Kasir Outlet</h6>
                                <span class="badge bg-danger fs-8"><i class="fa-solid fa-circle-check me-1"></i> Terhubung Live Kasir</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Cabang Outlet</th>
                                            <th>Varian Produk MPASI</th>
                                            <th>Stok Alokasi</th>
                                            <th>Terjual (Cup)</th>
                                            <th>Sisa Tidak Laku (Cup)</th>
                                            <th>Nilai Kerugian (Rp)</th>
                                            <th class="text-center">Status Laporan Kasir</th>
                                        </tr>
                                    </thead>
                                    <tbody id="own-leftover-report-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-poin" class="owner-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-coins text-brand-purple me-2"></i> Kelola Poin & Reward Pelanggan</h4>
                                <p class="text-muted fs-7 mb-0">Atur poin member secara manual (tambah/kurangi/reset), kelola katalog reward, dan atur rasio poin yang didapat pelanggan saat belanja.</p>
                            </div>
                        </div>

                        <ul class="nav nav-pills mb-3 fs-7 fw-bold gap-2" id="owner-poin-subnav">
                            <li class="nav-item">
                                <a class="nav-link active bg-purple-light text-brand-purple border border-purple-200" href="#" onclick="switchOwnerPoinSubTab('member')">
                                    <i class="fa-solid fa-users me-1"></i> Poin Member
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border" href="#" onclick="switchOwnerPoinSubTab('reward')">
                                    <i class="fa-solid fa-gift me-1"></i> Katalog Reward
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border" href="#" onclick="switchOwnerPoinSubTab('rate')">
                                    <i class="fa-solid fa-sliders me-1"></i> Pengaturan Perolehan Poin
                                </a>
                            </li>
                        </ul>

                        <div id="owner-poin-sub-member">
                            <div class="card-custom p-3 border-purple-200">
                                <div class="table-responsive">
                                    <table class="table align-middle fs-7 mb-0">
                                        <thead class="bg-light">
                                            <tr><th>Nama Member</th><th>WhatsApp / Email</th><th>Poin Aktif</th><th class="text-center">Aksi</th></tr>
                                        </thead>
                                        <tbody id="own-members-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="owner-poin-sub-reward" style="display:none;">
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-brand-yellow fw-bold" onclick="showAddRewardModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Reward Baru</button>
                            </div>
                            <div class="card-custom p-3 border-purple-200">
                                <div class="table-responsive">
                                    <table class="table align-middle fs-7 mb-0">
                                        <thead class="bg-light">
                                            <tr><th>Nama Reward</th><th>Biaya Poin</th><th>Deskripsi</th><th class="text-center">Aksi</th></tr>
                                        </thead>
                                        <tbody id="own-rewards-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="owner-poin-sub-rate" style="display:none;">
                            <div class="card-custom p-3 border-purple-200 mb-4">
                                <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3"><i class="fa-solid fa-coins me-2"></i> Rasio Poin Global (Berdasarkan Total Belanja)</h6>
                                <p class="text-muted fs-8 mb-3">Atur berapa Rupiah belanja yang setara dengan 1 Poin. Rasio ini otomatis berlaku untuk seluruh transaksi checkout online pelanggan yang login sebagai member, kecuali produk memiliki Poin Kustom di bawah.</p>
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-5">
                                        <label class="form-label fs-7 fw-bold">Setiap Belanja Rp Berapa = 1 Poin?</label>
                                        <div class="input-group">
                                            <span class="input-group-text fw-bold">Rp</span>
                                            <input type="number" id="owner-points-rate-input" class="form-control fw-bold" min="1" value="1000">
                                            <span class="input-group-text fw-bold">= 1 Poin</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-brand-purple fw-bold w-100" onclick="saveOwnerPointsRate()"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan Rasio Poin</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="fs-8 text-muted fst-italic" id="owner-points-rate-example">Contoh: belanja Rp 15.000 akan mendapat 15 Poin.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-custom p-3 border-purple-200">
                                <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3"><i class="fa-solid fa-bowl-food me-2"></i> Poin Kustom Per Varian Produk (Opsional)</h6>
                                <p class="text-muted fs-8 mb-3">Tetapkan jumlah Poin tetap untuk tiap cup varian tertentu jika ingin berbeda dari rasio global di atas. Kosongkan / set ke 0 agar produk memakai rasio global.</p>
                                <div class="table-responsive">
                                    <table class="table align-middle fs-7 mb-0">
                                        <thead class="bg-light">
                                            <tr><th>Varian MPASI</th><th>Harga / Cup</th><th>Poin Kustom / Cup</th><th class="text-center">Aksi</th></tr>
                                        </thead>
                                        <tbody id="own-product-points-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-resetpass" class="owner-tab-content" style="display:none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-key text-brand-purple me-2"></i> Kelola Reset Password Pelanggan</h4>
                                <p class="text-muted fs-7 mb-0">Proses permintaan reset kata sandi dari pelanggan, atau reset manual berdasarkan nomor WhatsApp.</p>
                            </div>
                            <button class="btn btn-brand-purple fw-bold" onclick="showManualResetPasswordModal()"><i class="fa-solid fa-user-lock me-1"></i> Reset Manual Pelanggan</button>
                        </div>
                        <div class="card-custom p-3 border-purple-200">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr><th>ID Tiket</th><th>Nama Pelanggan</th><th>WhatsApp</th><th>Waktu Permohonan</th><th>Status</th><th class="text-center">Aksi</th></tr>
                                    </thead>
                                    <tbody id="own-resetpass-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let state = {
            activeRole: window.MPASI_DATA?.initialRole || 'pelanggan',
            outlets: (Array.isArray(window.MPASI_DATA?.outlets) && window.MPASI_DATA.outlets.length > 0)
                ? window.MPASI_DATA.outlets.map(o => typeof o === 'string' ? o : (o.name || ''))
                : ['Outlet Pusat (Jl. Pajajaran)', 'Outlet Cabang 1 (Suryakencana)', 'Outlet Cabang 2 (Cibinong)'],
            kasirActiveOutlet: 'Outlet Pusat (Jl. Pajajaran)',
            authenticatedKasirOutlet: (() => { try { return sessionStorage.getItem('auth_kasir_outlet'); } catch(e) { return null; } })(),
            isStoreOpen: true,
            currentUser: (() => { try { const saved = localStorage.getItem('mpasi_current_user'); return saved ? JSON.parse(saved) : null; } catch(e) { return null; } })(),
            cart: [],
            posCart: [],
            products: Array.isArray(window.MPASI_DATA?.products) ? window.MPASI_DATA.products.map((product, index) => ({
                id: product.id || `PRD-${index + 1}`,
                name: product.name || `Produk ${index + 1}`,
                price: Number(product.price || 0),
                initialStock: Number(product.stock ?? 20),
                stock: Number(product.stock ?? 20),
                category: product.category || 'Bubur',
                age: product.age_group || '6+ Bulan',
                ingredients: product.ingredients || product.description || 'Bahan segar alami',
                status: product.status || 'Aktif',
                image: product.image || product.image_url || '',
                customPoints: Number(product.custom_points || 0),
            })) : [
                { id: 'PRD-1', name: 'Bubur Salmon Bayam Organik', price: 15000, initialStock: 20, stock: 20, category: 'Bubur', age: '6+ Bulan', ingredients: 'Salmon, Bayam, Beras Merah', status: 'Aktif', image: '', customPoints: 0 },
                { id: 'PRD-2', name: 'Bubur Ayam Kampung Labu', price: 12000, initialStock: 20, stock: 20, category: 'Bubur', age: '6+ Bulan', ingredients: 'Ayam Kampung, Labu Parang', status: 'Aktif', image: '', customPoints: 0 },
                { id: 'PRD-3', name: 'Bubur Sapi Brokoli Keju', price: 16000, initialStock: 20, stock: 20, category: 'Bubur', age: '8+ Bulan', ingredients: 'Daging Sapi, Brokoli, Keju', status: 'Aktif', image: '', customPoints: 0 },
                { id: 'PRD-4', name: 'Puding Alpukat Kurma', price: 10000, initialStock: 20, stock: 20, category: 'Snack', age: '8+ Bulan', ingredients: 'Alpukat Mentega, Sari Kurma', status: 'Aktif', image: '', customPoints: 0 }
            ],
            dailyMenu: Array.isArray(window.MPASI_DATA?.dailyMenus) && window.MPASI_DATA.dailyMenus.length > 0
                ? window.MPASI_DATA.dailyMenus.map(dm => {
                    let pIds = dm.product_ids;
                    if (typeof pIds === 'string') {
                        try { pIds = JSON.parse(pIds); } catch(e) { pIds = []; }
                    }
                    return {
                        day: dm.day_name,
                        productIds: Array.isArray(pIds) ? pIds.map(String) : []
                    };
                })
                : [
                    { day: 'Senin', productIds: [] },
                    { day: 'Selasa', productIds: [] },
                    { day: 'Rabu', productIds: [] },
                    { day: 'Kamis', productIds: [] },
                    { day: 'Jumat', productIds: [] },
                    { day: 'Sabtu', productIds: [] },
                    { day: 'Minggu', productIds: [] }
                ],
            preOrders: (() => { try { const saved = localStorage.getItem('mpasi_customer_orders'); return saved ? JSON.parse(saved) : []; } catch(e) { return []; } })(),
            outletSalesRecords: {
                'Outlet Pusat (Jl. Pajajaran)': {},
                'Outlet Cabang 1 (Suryakencana)': {},
                'Outlet Cabang 2 (Cibinong)': {}
            },
            resetTickets: [],
            inventory: [
                { name: 'Beras Organik', stock: '25 Kg', min: '5 Kg', status: 'Aman' },
                { name: 'Salmon Fresh', stock: '2 Kg', min: '3 Kg', status: 'Menipis' }
            ],
            members: {},
            pointRewards: [
                { id: 'RWD-1', name: 'Voucher Potongan Rp 5.000', pointsCost: 50, description: 'Potongan langsung Rp 5.000 untuk pembelian berikutnya di semua outlet.' },
                { id: 'RWD-2', name: 'Voucher Potongan Rp 10.000', pointsCost: 90, description: 'Potongan langsung Rp 10.000 untuk pembelian berikutnya di semua outlet.' },
                { id: 'RWD-3', name: 'Voucher Potongan Rp 25.000', pointsCost: 220, description: 'Potongan langsung Rp 25.000, cocok untuk belanja borongan mingguan.' },
                { id: 'RWD-4', name: 'Gratis 1 Cup Puding Alpukat Kurma', pointsCost: 150, description: 'Tukar poin dengan 1 cup Puding Alpukat Kurma gratis, tunjukkan kode ke Kasir saat ambil.' }
            ],
            pointsEarnRate: 1000
        };

        const PRODUCT_IMG_PLACEHOLDER_CLASS = 'bg-purple-light rounded-3 p-4 text-center mb-2 fs-1 text-brand-purple d-flex align-items-center justify-content-center';

        function showFullPosterModal(title, imgUrl) {
            if (!imgUrl) return;
            Swal.fire({
                title: title,
                imageUrl: imgUrl,
                imageAlt: title,
                showConfirmButton: true,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#6A1B9A',
                width: '600px',
                padding: '1em',
                customClass: {
                    image: 'img-fluid rounded-3 shadow-sm mb-2'
                }
            });
        }

        function productImageHtml(p) {
            if (p.image) {
                return `<div class="position-relative w-100 overflow-hidden cursor-pointer bg-light" onclick="showFullPosterModal('${escAttr(p.name)}', '${escAttr(p.image)}')">
                    <img src="${p.image}" alt="${escAttr(p.name)}" class="w-100 d-block" style="width:100%; aspect-ratio: 1 / 1; object-fit: cover; object-position: top;">
                    <div class="position-absolute bottom-0 end-0 bg-dark bg-opacity-60 text-white px-2 py-1 m-2 rounded" style="font-size:10px;">
                        <i class="fa-solid fa-magnifying-glass-plus me-1"></i> Perbesar
                    </div>
                </div>`;
            }
            return `<div class="${PRODUCT_IMG_PLACEHOLDER_CLASS} m-0" style="width:100%; aspect-ratio: 1 / 1;"><i class="fa-solid fa-bowl-food fs-1"></i></div>`;
        }
        function productThumbHtml(p, size) { const s = size || 48; if (p.image) { return `<img src="${p.image}" alt="${p.name}" class="rounded-2" style="width:${s}px; height:${s}px; object-fit:cover;">`; } return `<div class="bg-purple-light text-brand-purple rounded-2 d-flex align-items-center justify-content-center" style="width:${s}px; height:${s}px;"><i class="fa-solid fa-bowl-food"></i></div>`; }
        function escAttr(str) { return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;'); }
        function computeEarnedPoints(items) { let total = 0; (items || []).forEach(it => { const p = state.products.find(x => x.id == it.productId); if (!p) return; if (p.customPoints && p.customPoints > 0) { total += p.customPoints * it.qty; } else { total += Math.floor((p.price * it.qty) / state.pointsEarnRate); } }); return total; }
        function startLoading() { const el = document.getElementById('loading-overlay'); if (el) el.style.display = 'flex'; }
        function endLoading() { const el = document.getElementById('loading-overlay'); if (el) el.style.display = 'none'; }
        function promptKasirPinModal(outletName, onSuccess, onCancel) {
            Swal.fire({
                title: '<i class="fa-solid fa-lock text-brand-purple me-2"></i> PIN Akses Kasir',
                html: `
                    <div class="text-start fs-7 mb-3 text-secondary">
                        Masukkan PIN Akses Kasir untuk mengaktifkan cabang bertugas:<br>
                        <b class="text-brand-purple fs-6">${outletName}</b>
                    </div>
                    <div class="mb-2">
                        <input id="swal-kasir-pin-input" type="password" maxlength="6" class="form-control text-center fw-bold fs-4 border-purple-200" placeholder="• • • •" autocomplete="off">
                    </div>
                    <div class="text-muted fs-8 text-start fst-italic">
                        * PIN default: <b class="text-dark">1234</b> (Dapat diatur/diubah di Kelola Outlet oleh Owner).
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: '<i class="fa-solid fa-key me-1"></i> Verifikasi PIN',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6A1B9A',
                preConfirm: () => {
                    const pin = document.getElementById('swal-kasir-pin-input').value.trim();
                    if (!pin) {
                        Swal.showValidationMessage('Masukkan PIN Akses Kasir!');
                        return false;
                    }
                    return pin;
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    const enteredPin = result.value;
                    startLoading();
                    fetch('/api/outlets/verify-pin', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ outlet_name: outletName, pin: enteredPin })
                    }).then(async r => {
                        const data = await r.json().catch(() => ({}));
                        if (!r.ok || data.success === false) {
                            throw new Error(data.message || 'PIN Akses Kasir Salah!');
                        }
                        return data;
                    }).then(() => {
                        state.kasirActiveOutlet = outletName;
                        state.authenticatedKasirOutlet = outletName;
                        try {
                            sessionStorage.setItem('auth_kasir_outlet', outletName);
                        } catch(e) {}
                        renderAllUI();
                        Swal.fire({
                            icon: 'success',
                            title: 'PIN Diverifikasi! ✅',
                            text: `Cabang bertugas aktif: ${outletName}`,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        if (typeof onSuccess === 'function') onSuccess();
                    }).catch(err => {
                        const kasirOutletSel = document.getElementById('kasir-active-outlet');
                        if (kasirOutletSel) {
                            kasirOutletSel.value = state.kasirActiveOutlet || state.outlets[0];
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Akses Ditolak 🔒',
                            text: err.message || 'PIN Akses Kasir Salah!'
                        });
                        if (typeof onCancel === 'function') onCancel();
                    }).finally(() => {
                        endLoading();
                    });
                } else {
                    const kasirOutletSel = document.getElementById('kasir-active-outlet');
                    if (kasirOutletSel) {
                        kasirOutletSel.value = state.kasirActiveOutlet || state.outlets[0];
                    }
                    if (typeof onCancel === 'function') onCancel();
                }
            });
        }

        function changeKasirOutlet(newOutlet) {
            if (state.authenticatedKasirOutlet === newOutlet) {
                state.kasirActiveOutlet = newOutlet;
                renderAllUI();
                return;
            }
            promptKasirPinModal(newOutlet);
        }

        function selectRolePortal(roleName) {
            state.activeRole = roleName;
            const el = document.getElementById('active-role-display');
            if (el) el.innerText = roleName.toUpperCase();
            document.querySelectorAll('.role-portal-page').forEach(el => el.style.display = 'none');
            const targetPortal = document.getElementById('role-portal-' + roleName);
            if (targetPortal) targetPortal.style.display = 'block';
            renderAllUI();
            if (roleName === 'kasir') {
                if (!state.authenticatedKasirOutlet || !state.outlets.includes(state.authenticatedKasirOutlet)) {
                    promptKasirPinModal(state.kasirActiveOutlet || state.outlets[0]);
                }
            }
        }
        function switchKasirTab(tabName) { document.querySelectorAll('.kasir-tab-content').forEach(el => el.style.display = 'none'); document.querySelectorAll('#kasir-sidebar-nav .nav-link').forEach(el => el.classList.remove('active')); const target = document.getElementById('kasir-tab-' + tabName); if (target) target.style.display = 'block'; if (window.event && window.event.currentTarget) { window.event.currentTarget.classList.add('active'); } }
        function switchAdminTab(tabName) { document.querySelectorAll('.admin-tab-content').forEach(el => el.style.display = 'none'); document.querySelectorAll('#admin-sidebar-nav .nav-link').forEach(el => el.classList.remove('active')); const target = document.getElementById('admin-tab-' + tabName); if (target) target.style.display = 'block'; if (window.event && window.event.currentTarget) { window.event.currentTarget.classList.add('active'); } }
        function switchOwnerTab(tabName) { document.querySelectorAll('.owner-tab-content').forEach(el => el.style.display = 'none'); document.querySelectorAll('#owner-sidebar-nav .nav-link').forEach(el => el.classList.remove('active')); const target = document.getElementById('owner-tab-' + tabName); if (target) target.style.display = 'block'; if (window.event && window.event.currentTarget) { window.event.currentTarget.classList.add('active'); } if (tabName === 'poin') renderOwnerProductPointsTable(); }
        function switchOwnerPoinSubTab(tabName) { const memberPane = document.getElementById('owner-poin-sub-member'); const rewardPane = document.getElementById('owner-poin-sub-reward'); const ratePane = document.getElementById('owner-poin-sub-rate'); if (memberPane) memberPane.style.display = tabName === 'member' ? 'block' : 'none'; if (rewardPane) rewardPane.style.display = tabName === 'reward' ? 'block' : 'none'; if (ratePane) ratePane.style.display = tabName === 'rate' ? 'block' : 'none'; document.querySelectorAll('#owner-poin-subnav .nav-link').forEach(el => { el.classList.remove('active', 'bg-purple-light', 'text-brand-purple', 'border-purple-200'); el.classList.add('border'); }); if (window.event && window.event.currentTarget) { window.event.currentTarget.classList.add('active', 'bg-purple-light', 'text-brand-purple', 'border-purple-200'); } if (tabName === 'rate') { const rateInput = document.getElementById('owner-points-rate-input'); if (rateInput) rateInput.value = state.pointsEarnRate; updatePointsRateExample(); renderOwnerProductPointsTable(); } }
        function switchCustView(viewName) { document.querySelectorAll('.cust-view').forEach(el => el.style.display = 'none'); document.querySelectorAll('.navbar-custom .nav-link').forEach(el => el.classList.remove('active')); document.querySelectorAll('.mobile-nav-item').forEach(el => el.classList.remove('active')); const target = document.getElementById('cust-view-' + viewName); if (target) target.style.display = 'block'; const navTarget = document.getElementById('cust-nav-' + viewName); if (navTarget) navTarget.classList.add('active'); const mobileNavTarget = document.getElementById('mobile-nav-' + viewName); if (mobileNavTarget) mobileNavTarget.classList.add('active'); const mobileBottomNav = document.querySelector('.mobile-bottom-nav'); const custNavContent = document.getElementById('custNavContent'); const custToggler = document.querySelector('.navbar-toggler'); if (viewName === 'login') { if (mobileBottomNav) mobileBottomNav.style.setProperty('display', 'none', 'important'); if (custNavContent) custNavContent.style.setProperty('display', 'none', 'important'); if (custToggler) custToggler.style.setProperty('display', 'none', 'important'); } else { if (mobileBottomNav) mobileBottomNav.style.removeProperty('display'); if (custNavContent) custNavContent.style.removeProperty('display'); if (custToggler) custToggler.style.removeProperty('display'); } if (viewName === 'checkout') prefillCheckoutForm(); if (viewName === 'poin') renderCustomerPointsPage(); if (viewName === 'akun') renderCustomerProfilePage(); window.scrollTo({ top: 0, behavior: 'smooth' }); }
        function updateStoreHoursStatus() { const now = new Date(); const hour = now.getHours(); const isOpenNow = hour >= 6 && hour < 16; state.isStoreOpen = isOpenNow; const alertEl = document.getElementById('closed-hours-alert'); const labelEl = document.getElementById('store-hours-label'); const mobileLabelEl = document.getElementById('store-hours-label-mobile'); if (isOpenNow) { if (alertEl) alertEl.style.display = 'none'; if (labelEl) labelEl.innerHTML = '<span id="store-hours-dot" class="d-inline-block rounded-circle bg-success" style="width:8px;height:8px;"></span> BUKA (06.00 - 16.00)'; if (mobileLabelEl) mobileLabelEl.innerHTML = '<span id="store-hours-dot-mobile" class="d-inline-block rounded-circle bg-success" style="width:7px;height:7px;"></span> BUKA'; } else { if (alertEl) alertEl.style.display = 'block'; if (labelEl) labelEl.innerHTML = '<span id="store-hours-dot" class="d-inline-block rounded-circle bg-danger" style="width:8px;height:8px;"></span> TUTUP (16.00 - 06.00)'; if (mobileLabelEl) mobileLabelEl.innerHTML = '<span id="store-hours-dot-mobile" class="d-inline-block rounded-circle bg-danger" style="width:7px;height:7px;"></span> TUTUP'; } }
        function renderAllUI() { renderOutletDropdowns(); renderHomeProducts(); renderCatalogProducts(); renderCartUI(); renderCustomerHistory(); renderCustomerAuthArea(); renderCustomerPointsPage(); renderCustomerProfilePage(); renderKasirPreOrders(); renderKasirLeftoverTable(); renderPosProductsGrid(); renderAdminProducts('adm-products-tbody', true); renderAdminProduction(); renderAdminInventory(); renderAdminDailyMenuGrid(); renderAdminOutletReports(); renderAdminPesananPerOutlet(); renderOwnerDashboard(); renderOwnerDailyMenuGrid(); renderOwnerProducts(); renderOwnerPreOrders(); renderOwnerProduction(); renderOwnerInventory(); renderOwnerOutletReports(); renderOwnerResetPasswordTable(); renderOwnerOutletsTable(); renderOwnerMembersTable(); renderOwnerRewardsTable(); renderOwnerProductPointsTable(); }
        function getTodayProducts() { const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; const todayName = days[new Date().getDay()]; const todayConfig = state.dailyMenu.find(d => (d.day || '').toLowerCase() === todayName.toLowerCase()); if (!todayConfig || !Array.isArray(todayConfig.productIds) || todayConfig.productIds.length === 0) { return []; } const activeIds = todayConfig.productIds.map(String); return state.products.filter(p => activeIds.includes(String(p.id)) && p.status === 'Aktif'); }
        function renderHomeProducts() { const grid = document.getElementById('home-products-grid'); if (!grid) return; const todayProds = getTodayProducts(); const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; const todayName = days[new Date().getDay()]; if (todayProds.length === 0) { grid.innerHTML = `<div class="col-12 text-center py-4 bg-purple-light rounded-3 text-muted"><i class="fa-solid fa-utensils fs-3 mb-2 text-brand-purple d-block"></i><h6 class="fw-bold text-dark">Belum Ada Menu MPASI untuk Hari ${todayName}</h6><p class="fs-8 mb-0">Menu rotasi harian belum diisi oleh Admin/Owner.</p></div>`; return; } grid.innerHTML = todayProds.slice(0, 3).map(p => ` <div class="col-md-4 mb-3"><div class="card-custom h-100 p-0 overflow-hidden d-flex flex-column justify-content-between border rounded-3 shadow-sm bg-white">${productImageHtml(p)}<div class="p-3 d-flex flex-column justify-content-between flex-grow-1"><div><span class="badge bg-warning text-dark fs-8 fw-bold mb-2">${p.age}</span><h6 class="fw-bold mb-1 text-dark fs-6" style="line-height:1.3;">${p.name}</h6><div class="text-muted fs-8 mb-3" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${p.ingredients}</div></div><div><div class="fw-bold text-brand-purple fs-5 mb-2">Rp ${p.price.toLocaleString('id-ID')}</div><button class="btn btn-brand-yellow btn-sm w-100 fw-bold text-dark py-2" onclick="addToCart('${p.id}')"><i class="fa-solid fa-cart-plus me-1"></i> + Tambah Ke Keranjang</button></div></div></div></div>`).join(''); }
        function renderCatalogProducts() { const grid = document.getElementById('full-products-grid'); if (!grid) return; const todayProds = getTodayProducts(); const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; const todayName = days[new Date().getDay()]; if (todayProds.length === 0) { grid.innerHTML = `<div class="col-12 text-center py-5 bg-purple-light rounded-3 text-muted"><i class="fa-solid fa-calendar-xmark fs-1 mb-3 text-brand-purple d-block"></i><h5 class="fw-bold text-dark">Belum Ada Menu MPASI untuk Hari ${todayName}</h5><p class="fs-7 mb-0">Owner / Admin belum menambahkan varian menu rotasi harian untuk hari ${todayName}.</p></div>`; return; } grid.innerHTML = todayProds.map(p => ` <div class="col-md-4 mb-3"><div class="card-custom h-100 p-0 overflow-hidden d-flex flex-column justify-content-between border rounded-3 shadow-sm bg-white">${productImageHtml(p)}<div class="p-3 d-flex flex-column justify-content-between flex-grow-1"><div><span class="badge bg-warning text-dark fs-8 fw-bold mb-2">${p.age}</span><h6 class="fw-bold mb-1 text-dark fs-6" style="line-height:1.3;">${p.name}</h6><div class="text-muted fs-8 mb-3" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${p.ingredients}</div></div><div><div class="fw-bold text-brand-purple fs-5 mb-2">Rp ${p.price.toLocaleString('id-ID')}</div><button class="btn btn-brand-yellow btn-sm w-100 fw-bold text-dark py-2" onclick="addToCart('${p.id}')"><i class="fa-solid fa-cart-plus me-1"></i> + Tambah Ke Keranjang</button></div></div></div></div>`).join(''); }
        function addToCart(prodId) { if (!state.isStoreOpen) { Swal.fire({ icon: 'error', title: 'Pemesanan Tutup', text: 'Maaf pesanan hari ini sudah tutup, silakan pesan besok jam 06.00.' }); return; } const p = state.products.find(x => x.id == prodId); if (!p) return; const exist = state.cart.find(c => c.productId == prodId); if (exist) { exist.qty += 1; } else { state.cart.push({ productId: p.id, name: p.name, price: p.price, qty: 1 }); } renderCartUI(); Swal.fire({ icon: 'success', title: 'Masuk Keranjang', text: p.name + ' ditambahkan!', timer: 1000, showConfirmButton: false }); }
        function renderAdminDailyMenuGrid(targetGridId) {
            const grid = document.getElementById(targetGridId || 'admin-daily-menu-grid');
            if (!grid) return;
            const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            grid.innerHTML = days.map(day => {
                let menuConfig = state.dailyMenu.find(d => d.day === day);
                let pIds = menuConfig ? (menuConfig.productIds || []).map(String) : [];
                let assignedProducts = state.products.filter(p => pIds.includes(String(p.id)));
                return `
                    <div class="col-md-3 mb-3">
                        <div class="card-custom p-3 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                    <h6 class="fw-bold text-brand-purple mb-0">${day.toUpperCase()}</h6>
                                    <span class="badge bg-success fs-8">Aktif</span>
                                </div>
                                <ul class="list-unstyled fs-7 text-secondary mb-3">
                                    ${assignedProducts.length > 0 ? assignedProducts.map(ap => `
                                        <li class="mb-2 border-bottom pb-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-dark fs-8">${ap.name}</span>
                                                <span class="badge ${ap.stock > 0 ? 'bg-primary' : 'bg-danger'} fs-8">${ap.stock || 0} Cup</span>
                                            </div>
                                        </li>
                                    `).join('') : '<li class="text-muted fs-8 fst-italic py-2">Belum ada menu di hari ini</li>'}
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-outline-purple w-100 fw-bold py-2" onclick="editDailyMenuModal('${day}')">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Menu & Stok ${day}
                            </button>
                        </div>
                    </div>`;
            }).join('');
        }
        function renderOwnerDailyMenuGrid() { renderAdminDailyMenuGrid('own-daily-menu-grid'); }
        function toggleStockInputDisabled(prodId) {
            const chk = document.getElementById('chk-' + prodId);
            const input = document.getElementById('stock-input-' + prodId);
            if (chk && input) {
                input.disabled = !chk.checked;
            }
        }
        function editDailyMenuModal(dayName) {
            let menuConfig = state.dailyMenu.find(d => d.day === dayName);
            let currentIds = menuConfig ? (menuConfig.productIds || []).map(String) : [];
            let itemsHtml = state.products.map(p => {
                const isChecked = currentIds.includes(String(p.id));
                return `
                    <div class="p-2 border rounded bg-light mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check text-start mb-0">
                                <input class="form-check-input menu-chk" type="checkbox" value="${p.id}" id="chk-${p.id}" ${isChecked ? 'checked' : ''} onchange="toggleStockInputDisabled('${p.id}')">
                                <label class="form-check-label fw-bold fs-7 ms-2 cursor-pointer" for="chk-${p.id}">
                                    ${p.name} <span class="text-brand-purple fw-bold fs-8">(Rp ${p.price.toLocaleString('id-ID')})</span>
                                </label>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-2 ms-4">
                            <span class="fs-8 text-secondary fw-semibold"><i class="fa-solid fa-boxes-stacked me-1"></i> Stok Ready Harian:</span>
                            <input type="number" id="stock-input-${p.id}" class="form-control form-control-sm menu-stock-input fw-bold" value="${p.stock || 0}" min="0" style="width: 100px;" ${isChecked ? '' : 'disabled'}>
                            <span class="fs-8 text-muted">Cup</span>
                        </div>
                    </div>`;
            }).join('');

            Swal.fire({
                title: `Atur Menu & Stok Harian - ${dayName}`,
                html: `
                    <div class="text-start fs-7 text-muted mb-3">Centang varian MPASI untuk hari <b>${dayName}</b> dan atur jumlah <b>Stok Ready Harian (Cup)</b>:</div>
                    <div style="max-height:340px; overflow-y:auto;" class="px-1 text-start">${itemsHtml}</div>
                `,
                showCancelButton: true,
                confirmButtonText: '<i class="fa-solid fa-floppy-disk me-1"></i> Simpan Menu & Stok',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6A1B9A',
                preConfirm: () => {
                    const selectedCheckboxes = Array.from(document.querySelectorAll('.menu-chk:checked'));
                    const selectedIds = selectedCheckboxes.map(cb => cb.value);
                    const stockUpdates = {};
                    selectedIds.forEach(id => {
                        const stockInput = document.getElementById('stock-input-' + id);
                        stockUpdates[id] = stockInput ? (parseInt(stockInput.value) || 0) : 0;
                    });
                    return { selectedIds, stockUpdates };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    const { selectedIds, stockUpdates } = result.value;
                    startLoading();
                    fetch('/api/daily-menu', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ day: dayName, product_ids: selectedIds })
                    }).then(() => {
                        if (menuConfig) {
                            menuConfig.productIds = selectedIds;
                        } else {
                            state.dailyMenu.push({ day: dayName, productIds: selectedIds });
                        }

                        const updatePromises = Object.keys(stockUpdates).map(prodId => {
                            const newStockVal = stockUpdates[prodId];
                            const p = state.products.find(x => x.id == prodId);
                            if (p) {
                                p.stock = newStockVal;
                                p.initialStock = newStockVal;
                            }
                            return fetch('/api/products/' + prodId, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ stock: newStockVal })
                            }).catch(() => {});
                        });

                        return Promise.all(updatePromises);
                    }).then(() => {
                        endLoading();
                        renderAllUI();
                        Swal.fire({
                            icon: 'success',
                            title: 'Menu & Stok Diperbarui',
                            text: `Rotasi menu & stok ready untuk hari ${dayName} berhasil disimpan!`,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }).catch(err => {
                        endLoading();
                        Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: err.message || 'Gagal menyimpan stok.' });
                    });
                }
            });
        }
        function computeProductionNumbers(productId, outletFilter) { const relevantOrders = state.preOrders.filter(o => o.cancelStatus !== 'approved' && (outletFilter === 'ALL' || o.outlet === outletFilter)); const onlinePreorder = relevantOrders.reduce((sum, o) => { const item = (o.itemsDetail || []).find(it => it.productId == productId); return sum + (item ? item.qty : 0); }, 0); return { onlinePreorder, total: onlinePreorder }; }
        function renderProductionGeneric(cfg) { const outletFilter = document.getElementById(cfg.filterSelectId)?.value || 'ALL'; const cardsEl = document.getElementById(cfg.cardsId); if (cardsEl) { cardsEl.innerHTML = state.outlets.map(outletName => { const totalForOutlet = state.products.reduce((sum, p) => sum + computeProductionNumbers(p.id, outletName).total, 0); const isActiveFilter = outletFilter === outletName; return ` <div class="col-md-4"><div class="card-custom p-3 h-100 border-start border-4 ${isActiveFilter ? 'border-warning bg-purple-light' : 'border-primary'}"><div class="fw-bold text-brand-purple fs-7 mb-1"><i class="fa-solid fa-shop me-1"></i> ${outletName}</div><div class="fs-5 fw-bold text-primary">${totalForOutlet} Cup</div><div class="text-muted fs-8">Total porsi harus dimasak untuk cabang ini</div></div></div>`; }).join(''); } const tbody = document.getElementById(cfg.tbodyId); if (!tbody) return; let totalOnline = 0, totalAll = 0; const rows = state.products.map(p => { const { onlinePreorder, total } = computeProductionNumbers(p.id, outletFilter); totalOnline += onlinePreorder; totalAll += total; return ` <tr><td class="fw-bold text-dark">${p.name}</td><td><span class="badge bg-primary fs-8">${onlinePreorder} Cup</span></td><td class="fw-bold text-brand-purple">${total} Cup</td></tr>`; }).join(''); tbody.innerHTML = rows + `<tr class="table-light"><td class="fw-bold">TOTAL SELURUH VARIAN ${outletFilter !== 'ALL' ? `(${outletFilter})` : '(Semua Outlet)'}</td><td class="fw-bold">${totalOnline} Cup</td><td class="fw-bold text-brand-purple">${totalAll} Cup</td></tr>`; }
        function renderAdminProduction() { renderProductionGeneric({ filterSelectId: 'adm-dapur-outlet-filter', cardsId: 'adm-dapur-outlet-cards', tbodyId: 'adm-production-tbody' }); }
        function renderOwnerProduction() { renderProductionGeneric({ filterSelectId: 'own-dapur-outlet-filter', cardsId: 'own-dapur-outlet-cards', tbodyId: 'own-production-tbody' }); }
        function renderAdminInventory(targetTbodyId, isOwnerView) { const tbody = document.getElementById(targetTbodyId || 'adm-inventory-tbody'); if (!tbody) return; tbody.innerHTML = state.inventory.map((i, idx) => ` <tr><td class="fw-bold text-dark">${i.name}</td><td>${i.stock}</td><td>${i.min}</td><td>Kg</td><td><span class="badge ${i.status === 'Aman' ? 'bg-success' : 'bg-danger'}">${i.status}</span></td>${isOwnerView ? `<td class="text-center"><button class="btn btn-sm btn-outline-primary py-1 px-2 fs-8 fw-bold" onclick="editInventoryModal(${idx})"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</button><button class="btn btn-sm btn-outline-danger py-1 px-2 fs-8 fw-bold ms-1" onclick="deleteInventoryItem(${idx})"><i class="fa-solid fa-trash"></i></button></td>` : ''}</tr>`).join(''); }
        function renderOwnerInventory() { renderAdminInventory('own-inventory-tbody', true); }
        function showAddInventoryModal() { Swal.fire({ title: 'Tambah Bahan Baku Baru', html: `<input id="swal-iname" class="swal2-input" placeholder="Nama Bahan Baku"><input id="swal-istock" class="swal2-input" placeholder="Jumlah Stok (contoh: 10 Kg)"><input id="swal-imin" class="swal2-input" placeholder="Minimal Stok (contoh: 3 Kg)">`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Bahan', confirmButtonColor: '#6A1B9A', preConfirm: () => { const name = document.getElementById('swal-iname').value.trim(); const stock = document.getElementById('swal-istock').value.trim(); const min = document.getElementById('swal-imin').value.trim(); if (!name || !stock || !min) { Swal.showValidationMessage('Harap isi semua kolom!'); return false; } return { name, stock, min }; } }).then(result => { if (result.isConfirmed && result.value) { state.inventory.push({ name: result.value.name, stock: result.value.stock, min: result.value.min, status: 'Aman' }); renderAdminInventory(); renderOwnerInventory(); Swal.fire({ icon: 'success', title: 'Bahan Ditambahkan', timer: 1200, showConfirmButton: false }); } }); }
        function editInventoryModal(idx) { const i = state.inventory[idx]; if (!i) return; Swal.fire({ title: 'Edit Stok Bahan Baku', html: `<div class="text-start fs-7 fw-bold mb-2">${i.name}</div><input id="swal-iestock" class="swal2-input" placeholder="Jumlah Stok" value="${i.stock}"><input id="swal-iemin" class="swal2-input" placeholder="Minimal Stok" value="${i.min}"><select id="swal-iestatus" class="swal2-select"><option value="Aman" ${i.status === 'Aman' ? 'selected' : ''}>Aman</option><option value="Menipis" ${i.status === 'Menipis' ? 'selected' : ''}>Menipis</option></select>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan', confirmButtonColor: '#6A1B9A', preConfirm: () => { return { stock: document.getElementById('swal-iestock').value.trim(), min: document.getElementById('swal-iemin').value.trim(), status: document.getElementById('swal-iestatus').value }; } }).then(result => { if (result.isConfirmed && result.value) { i.stock = result.value.stock; i.min = result.value.min; i.status = result.value.status; renderAdminInventory(); renderOwnerInventory(); Swal.fire({ icon: 'success', title: 'Stok Bahan Diperbarui', timer: 1200, showConfirmButton: false }); } }); }
        function deleteInventoryItem(idx) { const i = state.inventory[idx]; if (!i) return; Swal.fire({ icon: 'warning', title: 'Hapus Bahan Baku?', text: `Bahan "${i.name}" akan dihapus dari data persediaan.`, showCancelButton: true, confirmButtonText: 'Hapus', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { state.inventory.splice(idx, 1); renderAdminInventory(); renderOwnerInventory(); Swal.fire({ icon: 'success', title: 'Bahan Dihapus', timer: 1000, showConfirmButton: false }); } }); }
        function renderAdminProducts(targetTbodyId, isOwnerView) { const tbody = document.getElementById(targetTbodyId || 'adm-products-tbody'); if (!tbody) return; tbody.innerHTML = state.products.map(p => { const isOutOfStock = (p.stock || 0) <= 0; return ` <tr><td>${productThumbHtml(p, 48)}</td><td class="fw-bold text-brand-purple">${p.id}</td><td class="fw-bold text-dark">${p.name}</td><td>Rp ${p.price.toLocaleString('id-ID')}</td><td>${p.category}</td><td><span class="badge bg-warning text-dark">${p.age}</span></td><td><span class="badge ${isOutOfStock ? 'bg-danger' : 'bg-primary'} fw-bold fs-8">${p.stock || 0} Cup Ready</span></td><td><span class="badge bg-success">${p.status}</span></td><td class="text-center text-nowrap"><button class="btn btn-sm btn-outline-primary py-1 px-2 fs-8 fw-bold" onclick="restockAdminProduct('${p.id}')"><i class="fa-solid fa-plus me-1"></i> Restok</button>${isOwnerView ? `<button class="btn btn-sm btn-outline-secondary py-1 px-2 fs-8 fw-bold ms-1" onclick="editProductModal('${p.id}')"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</button><button class="btn btn-sm btn-outline-danger py-1 px-2 fs-8 fw-bold ms-1" onclick="deleteProductOwner('${p.id}')"><i class="fa-solid fa-trash"></i></button>` : ''}</td></tr>`; }).join(''); }
        function renderOwnerProducts() { renderAdminProducts('own-products-tbody', true); }
        function restockAdminProduct(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; Swal.fire({ title: 'Restok Ready ' + p.name, input: 'number', inputValue: p.stock || 0, inputLabel: 'Masukkan Jumlah Stok Ready Baru (Cup)', showCancelButton: true, confirmButtonText: 'Simpan Stok', confirmButtonColor: '#6A1B9A' }).then(res => { if (res.isConfirmed && res.value !== '') { const newStockVal = parseInt(res.value) || 0; fetch('/api/products/' + prodId, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ stock: newStockVal }) }).then(() => { p.stock = newStockVal; p.initialStock = newStockVal; renderAdminProducts('adm-products-tbody', true); renderOwnerProducts(); renderPosProductsGrid(); renderKasirLeftoverTable(); renderAdminOutletReports(); renderOwnerOutletReports(); Swal.fire({ icon: 'success', title: 'Stok Diperbarui', text: `Stok ready ${p.name} menjadi ${p.stock} cup.`, timer: 1200, showConfirmButton: false }); }); } }); }
        function readImageFileAsDataUrl(fileInputEl) { return new Promise((resolve) => { const file = fileInputEl && fileInputEl.files && fileInputEl.files[0]; if (!file) { resolve(null); return; } if (!file.type.startsWith('image/')) { Swal.showValidationMessage('File harus berupa gambar (jpg/png/webp)!'); resolve(null); return; } if (file.size > 2 * 1024 * 1024) { Swal.showValidationMessage('Ukuran foto maksimal 2MB, silakan kompres dahulu!'); resolve(null); return; } const reader = new FileReader(); reader.onload = () => resolve(reader.result); reader.onerror = () => resolve(null); reader.readAsDataURL(file); }); }
        function bindImagePreview(inputId, previewImgId) { const inputEl = document.getElementById(inputId); const previewEl = document.getElementById(previewImgId); if (!inputEl || !previewEl) return; inputEl.addEventListener('change', () => { const file = inputEl.files && inputEl.files[0]; if (!file) return; const reader = new FileReader(); reader.onload = () => { previewEl.src = reader.result; previewEl.style.display = 'block'; }; reader.readAsDataURL(file); }); }
        function editProductModal(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; Swal.fire({ title: 'Edit Varian MPASI', html: `<div class="text-start mb-2"><label class="fw-bold fs-7 d-block mb-1">Foto Produk (opsional)</label><img id="swal-eimg-preview" src="${p.image || ''}" class="rounded-3 mb-2" style="width:100%; max-height:150px; object-fit:cover; ${p.image ? '' : 'display:none;'}"><input id="swal-eimage" type="file" accept="image/*" class="swal2-file"></div><input id="swal-ename" class="swal2-input" placeholder="Nama Varian MPASI" value="${p.name}"><input id="swal-eprice" class="swal2-input" type="number" placeholder="Harga / Cup (Rp)" value="${p.price}"><select id="swal-ecategory" class="swal2-select"><option value="Bubur" ${p.category === 'Bubur' ? 'selected' : ''}>Bubur</option><option value="Snack" ${p.category === 'Snack' ? 'selected' : ''}>Snack</option></select><select id="swal-eage" class="swal2-select"><option value="6+ Bulan" ${p.age === '6+ Bulan' ? 'selected' : ''}>6+ Bulan</option><option value="8+ Bulan" ${p.age === '8+ Bulan' ? 'selected' : ''}>8+ Bulan</option><option value="12+ Bulan" ${p.age === '12+ Bulan' ? 'selected' : ''}>12+ Bulan</option></select><input id="swal-eingredients" class="swal2-input" placeholder="Komposisi Bahan" value="${p.ingredients}"><select id="swal-estatus" class="swal2-select"><option value="Aktif" ${p.status === 'Aktif' ? 'selected' : ''}>Aktif</option><option value="Nonaktif" ${p.status === 'Nonaktif' ? 'selected' : ''}>Nonaktif</option></select>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Perubahan', confirmButtonColor: '#6A1B9A', didOpen: () => { bindImagePreview('swal-eimage', 'swal-eimg-preview'); }, preConfirm: async () => { const name = document.getElementById('swal-ename').value.trim(); const price = parseInt(document.getElementById('swal-eprice').value) || 0; if (!name || price <= 0) { Swal.showValidationMessage('Harap isi Nama dan Harga produk!'); return false; } const newImageDataUrl = await readImageFileAsDataUrl(document.getElementById('swal-eimage')); return { name, price, category: document.getElementById('swal-ecategory').value, age: document.getElementById('swal-eage').value, ingredients: document.getElementById('swal-eingredients').value.trim(), status: document.getElementById('swal-estatus').value, image: newImageDataUrl }; } }).then(result => { if (result.isConfirmed && result.value) { fetch('/api/products/' + prodId, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify(result.value) }).then(async res => { const data = await res.json().catch(() => ({})); if (!res.ok || data.success === false) { throw new Error(data.message || ('Gagal memperbarui data (Status ' + res.status + ')')); } return data; }).then(() => { p.name = result.value.name; p.price = result.value.price; p.category = result.value.category; p.age = result.value.age; p.ingredients = result.value.ingredients; p.status = result.value.status; if (result.value.image) p.image = result.value.image; renderAllUI(); Swal.fire({ icon: 'success', title: 'Produk Diperbarui', text: `${p.name} berhasil disimpan!`, timer: 1200, showConfirmButton: false }); }).catch(err => { Swal.fire({ icon: 'error', title: 'Gagal Memperbarui Varian', text: err.message || 'Terjadi kesalahan sistem.' }); }); } }); }
        function deleteProductOwner(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; Swal.fire({ icon: 'warning', title: 'Hapus Varian Produk?', text: `Varian "${p.name}" akan dihapus permanen dari master produk dan menu harian.`, showCancelButton: true, confirmButtonText: 'Ya, Hapus', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { fetch('/api/products/' + prodId, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }).then(() => { state.products = state.products.filter(x => x.id != prodId); state.dailyMenu.forEach(d => { d.productIds = (d.productIds || []).filter(id => id != prodId); }); state.cart = state.cart.filter(c => c.productId != prodId); state.posCart = state.posCart.filter(c => c.productId != prodId); renderAllUI(); Swal.fire({ icon: 'success', title: 'Produk Dihapus', timer: 1000, showConfirmButton: false }); }); } }); }
        function showAddProductModal() { Swal.fire({ title: 'Tambah Varian MPASI Baru', html: `<div class="text-start mb-2"><label class="fw-bold fs-7 d-block mb-1">Foto Produk (opsional, maks 2MB)</label><img id="swal-pimg-preview" class="rounded-3 mb-2" style="width:100%; max-height:150px; object-fit:cover; display:none;"><input id="swal-pimage" type="file" accept="image/*" class="swal2-file"></div><input id="swal-pname" class="swal2-input" placeholder="Nama Varian MPASI"><input id="swal-pprice" class="swal2-input" type="number" placeholder="Harga / Cup (Rp)"><input id="swal-pstock" class="swal2-input" type="number" placeholder="Stok Ready Initial (Cup)"><select id="swal-pcategory" class="swal2-select"><option value="Bubur">Bubur</option><option value="Snack">Snack</option></select><select id="swal-page" class="swal2-select"><option value="6+ Bulan">6+ Bulan</option><option value="8+ Bulan">8+ Bulan</option><option value="12+ Bulan">12+ Bulan</option></select><input id="swal-pingredients" class="swal2-input" placeholder="Komposisi Bahan"><select id="swal-pstatus" class="swal2-select"><option value="Aktif">Aktif</option><option value="Nonaktif">Nonaktif</option></select>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Varian', confirmButtonColor: '#6A1B9A', didOpen: () => { bindImagePreview('swal-pimage', 'swal-pimg-preview'); }, preConfirm: async () => { const name = document.getElementById('swal-pname').value.trim(); const price = parseInt(document.getElementById('swal-pprice').value) || 0; const stock = parseInt(document.getElementById('swal-pstock').value) || 0; const category = document.getElementById('swal-pcategory').value; const age = document.getElementById('swal-page').value; const ingredients = document.getElementById('swal-pingredients').value.trim(); const status = document.getElementById('swal-pstatus').value; if (!name || price <= 0) { Swal.showValidationMessage('Harap isi Nama dan Harga produk!'); return false; } const imageDataUrl = await readImageFileAsDataUrl(document.getElementById('swal-pimage')); return { name, price, stock, category, age, age_group: age, ingredients, status, image: imageDataUrl || '' }; } }).then((result) => { if (result.isConfirmed && result.value) { fetch('/api/products', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify(result.value) }).then(async res => { const data = await res.json().catch(() => ({})); if (!res.ok || data.success === false) { throw new Error(data.message || ('Gagal menyimpan data ke server (Status ' + res.status + ')')); } return data; }).then(data => { if (data.success && data.product) { const newP = { id: data.product.id, name: data.product.name, price: data.product.price, stock: data.product.stock, initialStock: data.product.stock, category: data.product.category || result.value.category || 'Bubur', age: data.product.age_group || result.value.age || '6+ Bulan', ingredients: data.product.ingredients || result.value.ingredients || 'Bahan segar alami', status: data.product.status || result.value.status || 'Aktif', image: data.product.image || result.value.image || '', customPoints: 0 }; state.products.push(newP); renderAllUI(); Swal.fire({ icon: 'success', title: 'Produk Ditambahkan', text: `${newP.name} berhasil disimpan!`, timer: 1200, showConfirmButton: false }); } else { Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: (data && data.message) ? data.message : 'Gagal menyimpan varian baru.' }); } }).catch(err => { Swal.fire({ icon: 'error', title: 'Gagal Menyimpan Varian', text: err.message || 'Terjadi kesalahan sistem.' }); }); } }); }
        function updateCartQty(prodId, delta) { const item = state.cart.find(x => x.productId == prodId); if (item) { item.qty += delta; if (item.qty <= 0) { state.cart = state.cart.filter(x => x.productId != prodId); } } renderCartUI(); }
        function savePreOrdersToStorage() { try { localStorage.setItem('mpasi_customer_orders', JSON.stringify(state.preOrders)); } catch(e){} }
        function renderCartUI() { const totalQty = state.cart.reduce((a, b) => a + b.qty, 0); const totalAmt = state.cart.reduce((a, b) => a + (b.price * b.qty), 0); const badge = document.getElementById('cart-badge'); if (badge) { badge.innerText = totalQty; badge.style.display = totalQty > 0 ? 'inline-block' : 'none'; } const mobileBadge = document.getElementById('mobile-cart-badge'); if (mobileBadge) { mobileBadge.innerText = totalQty; mobileBadge.style.display = totalQty > 0 ? 'inline-block' : 'none'; } const tbody = document.getElementById('cart-tbody'); if (tbody) { tbody.innerHTML = state.cart.map(c => ` <tr><td class="fw-bold text-dark">${c.name}</td><td>Rp ${c.price.toLocaleString('id-ID')}</td><td><div class="d-flex align-items-center gap-2"><button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="updateCartQty('${c.productId}', -1)">-</button><span class="fw-bold">${c.qty}</span><button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="updateCartQty('${c.productId}', 1)">+</button></div></td><td class="fw-bold text-brand-purple">Rp ${(c.price * c.qty).toLocaleString('id-ID')}</td><td><button class="btn btn-sm text-danger" onclick="updateCartQty('${c.productId}', -99)"><i class="fa-solid fa-trash"></i></button></td></tr>`).join(''); } const subtotalEl = document.getElementById('cart-summary-subtotal'); if (subtotalEl) subtotalEl.innerText = 'Rp ' + totalAmt.toLocaleString('id-ID'); const totalEl = document.getElementById('cart-summary-total'); if (totalEl) totalEl.innerText = 'Rp ' + totalAmt.toLocaleString('id-ID'); }
        function renderCustomerHistory() { const tbody = document.getElementById('riwayat-tbody'); if (!tbody) return; if (state.preOrders.length === 0) { tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted fs-7 fst-italic py-4"><i class="fa-solid fa-inbox fs-3 d-block mb-2 text-secondary"></i>Belum ada riwayat pesanan. Yuk mulai pesan MPASI dari menu hari ini!</td></tr>`; return; } tbody.innerHTML = state.preOrders.map(p => { let statusBadge; if (p.cancelStatus === 'approved') { statusBadge = '<span class="badge bg-danger fs-8">Pesanan Dibatalkan ❌</span>'; } else if (p.cancelStatus === 'pending') { statusBadge = '<span class="badge bg-secondary fs-8">Menunggu Persetujuan Batal</span>'; } else if (p.isTaken) { statusBadge = '<span class="badge bg-success fs-8">Sudah Diambil ✅</span>'; } else { statusBadge = '<span class="badge bg-warning text-dark fs-8">Menunggu Ambil</span>'; } let actionCell; if (p.cancelStatus === 'approved') { actionCell = '<span class="text-muted fs-8 fst-italic">Sudah dibatalkan</span>'; } else if (p.cancelStatus === 'pending') { actionCell = '<span class="text-muted fs-8 fst-italic">Menunggu Owner</span>'; } else if (p.isTaken) { actionCell = '<span class="text-muted fs-8 fst-italic">-</span>'; } else { actionCell = `<button class="btn btn-sm btn-outline-danger fs-8 fw-bold" onclick="requestCancelOrder('${p.id}')"><i class="fa-solid fa-ban me-1"></i> Batalkan Pesanan</button>`; if (p.cancelStatus === 'rejected') { actionCell = `<div class="text-danger fs-8 mb-1 fst-italic">Permintaan batal sebelumnya ditolak</div>` + actionCell; } } return `<tr class="${p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : ''}"><td class="fw-bold text-brand-purple">${p.id}</td><td>Besok (06.00 - 09.00)</td><td><span class="badge bg-light text-dark border">${p.payMethod}</span></td><td class="fw-bold text-dark">${p.items}</td><td>${statusBadge}</td><td class="text-center">${actionCell}</td></tr>`; }).join(''); }
        function requestCancelOrder(orderId) { const order = state.preOrders.find(o => o.id == orderId); if (!order) return; if (order.isTaken) { Swal.fire({ icon: 'info', title: 'Tidak Bisa Dibatalkan', text: 'Pesanan sudah diambil, tidak bisa dibatalkan lagi.' }); return; } Swal.fire({ title: 'Ajukan Pembatalan Pesanan?', html: `Pesanan <b>${order.id}</b> akan diajukan pembatalan dan menunggu persetujuan Owner.`, input: 'textarea', inputPlaceholder: 'Alasan pembatalan (opsional)', showCancelButton: true, confirmButtonText: 'Ajukan Pembatalan', cancelButtonText: 'Batal', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { order.cancelStatus = 'pending'; order.cancelReason = (res.value || '').trim() || '-'; savePreOrdersToStorage(); renderAllUI(); Swal.fire({ icon: 'success', title: 'Permintaan Terkirim', text: 'Menunggu persetujuan Owner untuk pembatalan pesanan ini.', timer: 1500, showConfirmButton: false }); } }); }
        function decideCancelOrder(orderId, decision) { const order = state.preOrders.find(o => o.id == orderId); if (!order) return; const isApprove = decision === 'approved'; Swal.fire({ icon: isApprove ? 'warning' : 'question', title: isApprove ? 'Setujui Pembatalan Pesanan?' : 'Tolak Permintaan Pembatalan?', html: `Pesanan <b>${order.id}</b> a.n <b>${order.customerName}</b>${order.cancelReason && order.cancelReason !== '-' ? `<br><span class="fs-8 text-muted">Alasan: ${order.cancelReason}</span>` : ''}`, showCancelButton: true, confirmButtonText: isApprove ? 'Ya, Setujui Pembatalan' : 'Ya, Tolak Pembatalan', cancelButtonText: 'Batal', confirmButtonColor: isApprove ? '#dc3545' : '#6A1B9A' }).then(res => { if (res.isConfirmed) { order.cancelStatus = decision; if (isApprove && order.pointsAwarded && order.memberIdentifier && state.members[order.memberIdentifier]) { const member = state.members[order.memberIdentifier]; member.points = Math.max(0, member.points - order.pointsAwarded); member.pointsHistory.unshift({ type: 'adjust', label: `Poin ditarik - pesanan ${order.id} dibatalkan`, points: -order.pointsAwarded, date: new Date().toLocaleString('id-ID') }); order.pointsAwarded = 0; } savePreOrdersToStorage(); renderAllUI(); Swal.fire({ icon: 'success', title: isApprove ? 'Pembatalan Disetujui' : 'Permintaan Ditolak', text: isApprove ? `Pesanan ${order.id} resmi dibatalkan.` : `Pesanan ${order.id} tetap diproses seperti biasa.`, timer: 1500, showConfirmButton: false }); } }); }
        function proceedToCheckoutPage() { if (state.cart.length === 0) { Swal.fire({ icon: 'warning', title: 'Keranjang Kosong', text: 'Pilih produk terlebih dahulu.' }); return; } switchCustView('checkout'); }
        function prefillCheckoutForm() { const list = document.getElementById('checkout-items-list'); if (list) { list.innerHTML = state.cart.map(c => `<div class="d-flex justify-content-between"><span>${c.name} (x${c.qty})</span><span class="fw-bold text-brand-purple">Rp ${(c.price * c.qty).toLocaleString('id-ID')}</span></div>`).join(''); } const totalAmt = state.cart.reduce((a, b) => a + (b.price * b.qty), 0); const totalAmtEl = document.getElementById('checkout-total-amount'); if (totalAmtEl) totalAmtEl.innerText = 'Rp ' + totalAmt.toLocaleString('id-ID'); const nameInput = document.getElementById('co-name'); const waInput = document.getElementById('co-wa'); if (state.currentUser) { if (nameInput && !nameInput.value) nameInput.value = state.currentUser.name; if (waInput && !waInput.value) waInput.value = state.currentUser.wa; } const pointsPreviewEl = document.getElementById('checkout-points-preview'); if (pointsPreviewEl) { if (state.currentUser) { const estPoints = computeEarnedPoints(state.cart.map(c => ({ productId: c.productId, qty: c.qty }))); pointsPreviewEl.innerHTML = `<i class="fa-solid fa-coins me-1"></i> Anda akan mendapat <b>${estPoints} Poin</b> dari pesanan ini`; } else { pointsPreviewEl.innerHTML = '<i class="fa-solid fa-circle-info me-1"></i> Masuk sebagai member untuk dapat poin dari belanja ini'; } } }
        function handleProcessCheckout(e) { e.preventDefault(); if (!state.isStoreOpen) { Swal.fire({ icon: 'error', title: 'Pemesanan Tutup', text: 'Maaf pesanan hari ini sudah tutup, silakan pesan besok jam 06.00.' }); return; } startLoading(); const name = document.getElementById('co-name').value; const wa = document.getElementById('co-wa').value; const outlet = document.getElementById('co-outlet').value; const payMethod = document.querySelector('input[name="paymethod"]:checked').value; const totalAmt = state.cart.reduce((a, b) => a + (b.price * b.qty), 0); const itemsDetail = state.cart.map(c => ({ productId: c.productId, qty: c.qty })); let pointsEarned = 0; let memberIdentifier = null; if (state.currentUser) { pointsEarned = computeEarnedPoints(itemsDetail); memberIdentifier = state.currentUser.identifier; } const newOrder = { id: 'ORD-' + Math.floor(100 + Math.random() * 900), customerName: name, wa: wa, outlet: outlet, items: state.cart.map(c => c.name + ' x' + c.qty).join(', '), itemsDetail: itemsDetail, totalAmount: totalAmt, isPaid: payMethod === 'Transfer', payMethod: payMethod, isTaken: false, cancelStatus: null, cancelReason: null, memberIdentifier: memberIdentifier, pointsAwarded: pointsEarned }; state.preOrders.unshift(newOrder); savePreOrdersToStorage(); fetch('/checkout', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ customer_name: name, whatsapp: wa, outlet_id: outlet, pay_method: payMethod, items: itemsDetail.map(it => ({ product_id: it.productId, qty: it.qty })), member_identifier: memberIdentifier }) }).catch(err => console.error("Database sync error:", err)); if (memberIdentifier && state.members[memberIdentifier] && pointsEarned > 0) { const member = state.members[memberIdentifier]; member.points += pointsEarned; member.pointsHistory.unshift({ type: 'earn', label: `Belanja pesanan ${newOrder.id}`, points: pointsEarned, date: new Date().toLocaleString('id-ID') }); } setTimeout(() => { state.cart = []; renderAllUI(); endLoading(); Swal.fire({ icon: 'success', title: 'Pesanan Berhasil Disimpan!', html: pointsEarned > 0 ? `Terima kasih Bunda, pesanan Anda telah diteruskan ke outlet!<br><span class="fw-bold text-success"><i class="fa-solid fa-coins me-1"></i> +${pointsEarned} Poin ditambahkan ke akun Anda.</span>` : `Terima kasih Bunda, pesanan Anda telah diteruskan ke outlet!${!state.currentUser ? '<br><span class="fs-7 text-muted">Masuk sebagai member di pesanan berikutnya supaya dapat poin ya!</span>' : ''}` }); switchCustView('riwayat'); }, 500); }
        function changeKasirOutlet(outletName) { state.kasirActiveOutlet = outletName; const badge = document.getElementById('kasir-active-outlet-badge'); if (badge) { badge.innerHTML = `<i class="fa-solid fa-location-dot me-1 text-danger"></i> ${outletName}`; } renderKasirPreOrders(); renderKasirLeftoverTable(); Swal.fire({ icon: 'info', title: 'Cabang Kasir Diperbarui', text: 'Kasir aktif bertugas di: ' + outletName, timer: 1200, showConfirmButton: false }); }
        function renderKasirPreOrders() { const tbody = document.getElementById('kasir-preorder-tbody'); if (!tbody) return; const filteredOrders = state.preOrders.filter(p => p.outlet === state.kasirActiveOutlet); if (filteredOrders.length === 0) { tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted fs-8 fst-italic py-3">Belum ada pre-order online untuk cabang ini.</td></tr>`; return; } tbody.innerHTML = filteredOrders.map(p => `<tr class="${p.isTaken ? 'bg-light opacity-75' : ''} ${p.cancelStatus === 'approved' ? 'table-danger' : ''}"><td class="text-center"><input type="checkbox" class="form-check-input fs-5 cursor-pointer" ${p.isTaken ? 'checked' : ''} ${p.cancelStatus === 'approved' ? 'disabled' : ''} onchange="togglePreOrderTaken('${p.id}')"></td><td class="fw-bold ${p.isTaken || p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${p.id} - ${p.customerName}</td><td><a href="https://wa.me/${p.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${p.wa}</a></td><td class="fs-8">${p.items}</td><td><button class="btn btn-sm ${p.isPaid ? 'btn-success' : 'btn-outline-danger'} font-bold fs-8" onclick="togglePaymentStatus('${p.id}')">${p.isPaid ? 'Lunas ✅' : 'Belum Bayar (COD)'}</button></td><td><span class="badge ${p.isTaken ? 'bg-success' : 'bg-warning text-dark'} fs-8">${p.isTaken ? 'Sudah Diambil ✅' : 'Menunggu Ambil'}</span></td><td>${cancelInfoBadge(p)}</td></tr>`).join(''); }
        function cancelInfoBadge(p) { if (p.cancelStatus === 'pending') return '<span class="badge bg-secondary fs-8"><i class="fa-solid fa-hourglass-half me-1"></i> Menunggu Persetujuan</span>'; if (p.cancelStatus === 'approved') return '<span class="badge bg-danger fs-8"><i class="fa-solid fa-ban me-1"></i> Dibatalkan</span>'; if (p.cancelStatus === 'rejected') return '<span class="badge bg-light text-dark border fs-8">Pernah Ditolak</span>'; return '<span class="text-muted fs-8">-</span>'; }
        function togglePreOrderTaken(orderId) { const item = state.preOrders.find(p => p.id == orderId); if (item) { item.isTaken = !item.isTaken; savePreOrdersToStorage(); renderKasirPreOrders(); renderOwnerPreOrders(); } }
        function togglePaymentStatus(orderId) { const item = state.preOrders.find(p => p.id == orderId); if (item) { item.isPaid = !item.isPaid; savePreOrdersToStorage(); renderKasirPreOrders(); renderOwnerPreOrders(); } }
        function renderOwnerPreOrders() { const tbody = document.getElementById('owner-preorder-tbody'); if (!tbody) return; if (state.preOrders.length === 0) { tbody.innerHTML = `<tr><td colspan="8" class="text-center text-muted fs-8 fst-italic py-3">Belum ada pre-order dari pelanggan di seluruh cabang.</td></tr>`; } else { tbody.innerHTML = state.preOrders.map(p => { let cancelActionCell = cancelInfoBadge(p); if (p.cancelStatus === 'pending') { cancelActionCell = `<div class="d-flex flex-column gap-1">${cancelInfoBadge(p)}${p.cancelReason && p.cancelReason !== '-' ? `<span class="fs-8 text-muted fst-italic">Alasan: ${p.cancelReason}</span>` : ''}<div class="d-flex gap-1 mt-1"><button class="btn btn-sm btn-danger fs-8 fw-bold py-0.5 px-2" onclick="decideCancelOrder('${p.id}', 'approved')"><i class="fa-solid fa-check me-1"></i> Setujui</button><button class="btn btn-sm btn-outline-secondary fs-8 fw-bold py-0.5 px-2" onclick="decideCancelOrder('${p.id}', 'rejected')"><i class="fa-solid fa-xmark me-1"></i> Tolak</button></div></div>`; } return `<tr class="${p.isTaken ? 'bg-light opacity-75' : ''} ${p.cancelStatus === 'approved' ? 'table-danger' : ''}"><td class="text-center"><input type="checkbox" class="form-check-input fs-5 cursor-pointer" ${p.isTaken ? 'checked' : ''} ${p.cancelStatus === 'approved' ? 'disabled' : ''} onchange="togglePreOrderTaken('${p.id}')"></td><td class="fw-bold ${p.isTaken || p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${p.id} - ${p.customerName}</td><td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8">${p.outlet}</span></td><td><a href="https://wa.me/${p.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${p.wa}</a></td><td class="fs-8">${p.items}</td><td><button class="btn btn-sm ${p.isPaid ? 'btn-success' : 'btn-outline-danger'} font-bold fs-8" onclick="togglePaymentStatus('${p.id}')">${p.isPaid ? 'Lunas ✅' : 'Belum Bayar (COD)'}</button></td><td><span class="badge ${p.isTaken ? 'bg-success' : 'bg-warning text-dark'} fs-8">${p.isTaken ? 'Sudah Diambil ✅' : 'Menunggu Ambil'}</span></td><td>${cancelActionCell}</td></tr>`; }).join(''); } const pendingCancelCount = state.preOrders.filter(p => p.cancelStatus === 'pending').length; const cancelBadgeEl = document.getElementById('owner-cancel-badge'); if (cancelBadgeEl) { cancelBadgeEl.innerText = pendingCancelCount; cancelBadgeEl.style.display = pendingCancelCount > 0 ? 'inline-block' : 'none'; } }
        function renderPosProductsGrid() {
            const grid = document.getElementById('pos-products-grid');
            if (!grid) return;
            const todayProds = getTodayProducts();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const todayName = days[new Date().getDay()];
            const headingEl = document.getElementById('pos-products-heading');
            if (headingEl) {
                headingEl.innerHTML = `<i class="fa-solid fa-calendar-day text-brand-purple me-1"></i> Pilih Produk Ready Stock Hari <b>${todayName}</b>`;
            }
            if (todayProds.length === 0) {
                grid.innerHTML = `<div class="col-12 text-center py-4 bg-purple-light rounded-3 text-muted"><i class="fa-solid fa-calendar-xmark fs-3 mb-2 text-brand-purple d-block"></i><h6 class="fw-bold text-dark">Belum Ada Menu Ready Stock untuk Hari ${todayName}</h6><p class="fs-8 mb-0">Owner / Admin belum mengatur rotasi menu harian untuk hari ${todayName}.</p></div>`;
                return;
            }
            grid.innerHTML = todayProds.map(p => {
                const isOutOfStock = (p.stock || 0) <= 0;
                return ` <div class="col-6 mb-2"><div class="card p-2 border text-center ${isOutOfStock ? 'bg-light opacity-50' : 'cursor-pointer bg-light h-100'}" ${isOutOfStock ? '' : `onclick="addPosCart('${p.id}')"`}>${productThumbHtml(p, 56)}<div class="fw-bold fs-8 mt-1 text-dark">${p.name}</div><div class="text-brand-purple fw-extrabold fs-8">Rp ${p.price.toLocaleString('id-ID')}</div><div class="mt-1">${isOutOfStock ? '<span class="badge bg-danger fs-8">STOK HABIS</span>' : `<span class="badge bg-primary fs-8"><i class="fa-solid fa-boxes-stacked me-1"></i> Stok: ${p.stock || 0} Cup</span>`}</div></div></div>`;
            }).join('');
        }
        function addPosCart(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; const currentStock = p.stock || 0; const exist = state.posCart.find(x => x.productId == prodId); const currentCartQty = exist ? exist.qty : 0; if (currentCartQty + 1 > currentStock) { Swal.fire({ icon: 'warning', title: 'Stok Tidak Cukup!', text: `Stok ready ${p.name} hanya tersisa ${currentStock} cup.` }); return; } if (exist) { exist.qty += 1; } else { state.posCart.push({ productId: p.id, name: p.name, price: p.price, qty: 1 }); } renderPosCartList(); }
        function updatePosCartQty(prodId, delta) {
            const item = state.posCart.find(x => x.productId == prodId);
            if (!item) return;
            if (delta > 0) {
                const p = state.products.find(x => x.id == prodId);
                const currentStock = p ? (p.stock || 0) : 999;
                if (item.qty + 1 > currentStock) {
                    Swal.fire({ icon: 'warning', title: 'Stok Tidak Cukup!', text: `Stok ready ${item.name} hanya tersisa ${currentStock} cup.` });
                    return;
                }
                item.qty += 1;
            } else {
                item.qty += delta;
                if (item.qty <= 0) {
                    state.posCart = state.posCart.filter(x => x.productId != prodId);
                }
            }
            renderPosCartList();
        }
        function renderPosCartList() {
            const list = document.getElementById('pos-cart-list');
            if (!list) return;
            if (state.posCart.length === 0) {
                list.innerHTML = `<div class="text-center text-muted fs-8 py-3 fst-italic"><i class="fa-solid fa-basket-shopping fs-4 d-block mb-1 text-secondary opacity-50"></i>Keranjang POS masih kosong.<br>Klik produk di sebelah kiri untuk memilih.</div>`;
                document.getElementById('pos-total-display').innerText = 'Rp 0';
                return;
            }
            list.innerHTML = state.posCart.map(c => `
                <div class="d-flex justify-content-between align-items-center p-2 border rounded bg-white shadow-sm mb-1">
                    <div style="flex: 1; min-width: 0;" class="pe-2 text-start">
                        <div class="fw-bold text-dark fs-8 text-truncate">${c.name}</div>
                        <div class="text-muted fs-8">Rp ${c.price.toLocaleString('id-ID')} / cup</div>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <button class="btn btn-sm btn-outline-secondary py-0 px-2 fw-bold" onclick="updatePosCartQty('${c.productId}', -1)">-</button>
                        <span class="fw-bold fs-7 px-1">${c.qty}</span>
                        <button class="btn btn-sm btn-outline-secondary py-0 px-2 fw-bold" onclick="updatePosCartQty('${c.productId}', 1)">+</button>
                        <button class="btn btn-sm text-danger ms-1 py-0 px-1.5" onclick="updatePosCartQty('${c.productId}', -99)" title="Hapus varian ini"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>
            `).join('');
            const total = state.posCart.reduce((a, b) => a + (b.price * b.qty), 0);
            document.getElementById('pos-total-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }
        function processPosCheckout() { if (state.posCart.length === 0) { Swal.fire({ icon: 'warning', title: 'POS Kosong', text: 'Pilih produk terlebih dahulu.' }); return; } const totalPosAmount = state.posCart.reduce((a, b) => a + (b.price * b.qty), 0); const totalPosQty = state.posCart.reduce((a, b) => a + b.qty, 0); if (!state.outletSalesRecords[state.kasirActiveOutlet]) { state.outletSalesRecords[state.kasirActiveOutlet] = {}; } state.posCart.forEach(item => { const p = state.products.find(x => x.id == item.productId); if (p) { p.stock = Math.max(0, (p.stock || 0) - item.qty); if (!state.outletSalesRecords[state.kasirActiveOutlet][item.productId]) { state.outletSalesRecords[state.kasirActiveOutlet][item.productId] = { sold: 0 }; } state.outletSalesRecords[state.kasirActiveOutlet][item.productId].sold += item.qty; } }); state.posCart = []; renderPosCartList(); renderPosProductsGrid(); renderKasirLeftoverTable(); renderAdminProducts('adm-products-tbody', true); renderOwnerProducts(); renderAdminOutletReports(); renderOwnerOutletReports(); renderOwnerDashboard(); renderAdminProduction(); renderOwnerProduction(); Swal.fire({ icon: 'success', title: 'Transaksi POS Berhasil!', text: 'Penjualan tercatat ke laporan outlet, stok dipotong, dan rekap terbarui real-time!' }); }
        function renderKasirLeftoverTable() { const tbody = document.getElementById('kasir-leftover-tbody'); if (!tbody) return; const todayProds = getTodayProducts(); const targetProducts = todayProds.length > 0 ? todayProds : state.products; const outletSales = state.outletSalesRecords[state.kasirActiveOutlet] || {}; tbody.innerHTML = targetProducts.map(p => { const prodId = p.id; const price = p.price; const allocatedQty = (p.initialStock !== undefined ? p.initialStock : p.stock) || 0; const soldQty = outletSales[prodId] ? outletSales[prodId].sold : 0; const leftoverQty = Math.max(0, allocatedQty - soldQty); const lossAmount = leftoverQty * price; return `<tr><td class="fw-bold text-dark">${p.name}</td><td>Rp ${price.toLocaleString('id-ID')}</td><td class="fw-bold text-primary">${allocatedQty} Cup</td><td class="fw-bold text-success">${soldQty} Cup Terjual</td><td class="fw-bold text-danger">${leftoverQty} Cup</td><td class="fw-bold text-danger">Rp ${lossAmount.toLocaleString('id-ID')}</td><td class="text-center"><span class="badge bg-success fs-8"><i class="fa-solid fa-circle-check me-1"></i> Siap Kirim</span></td></tr>`; }).join(''); }
        function submitAllKasirLeftovers() { renderAdminOutletReports(); Swal.fire({ icon: 'success', title: 'Rekap Sisa Dikirim!', text: 'Laporan sisa seluruh produk untuk ' + state.kasirActiveOutlet + ' telah diteruskan ke Admin & Owner secara real-time!', confirmButtonColor: '#6A1B9A' }); }
        function renderAdminOutletReports() { renderOutletReportsGeneric({ periodSelectId: 'adm-report-period-filter', outletSelectId: 'adm-report-outlet-filter', cardsId: 'adm-outlet-metric-cards', summaryTbodyId: 'adm-outlet-report-tbody', leftoverTbodyId: 'adm-leftover-report-tbody' }); }
        function renderOwnerOutletReports() { renderOutletReportsGeneric({ periodSelectId: 'own-report-period-filter', outletSelectId: 'own-report-outlet-filter', cardsId: 'own-outlet-metric-cards', summaryTbodyId: 'own-outlet-report-tbody', leftoverTbodyId: 'own-leftover-report-tbody' }); }
        function renderOutletReportsGeneric(cfg) { const selectedOutlet = document.getElementById(cfg.outletSelectId)?.value || 'ALL'; const selectedPeriod = document.getElementById(cfg.periodSelectId)?.value || 'HARIAN'; const outletsList = state.outlets; const isHarian = selectedPeriod === 'HARIAN'; const outletData = outletsList.map(outletName => { const salesRec = state.outletSalesRecords[outletName] || {}; let omset = 0; let porsi = 0; let loss = 0; state.products.forEach(p => { const prodSales = salesRec[p.id] ? salesRec[p.id].sold : 0; const allocated = (p.initialStock !== undefined ? p.initialStock : p.stock) || 0; const leftover = Math.max(0, allocated - prodSales); omset += prodSales * p.price; porsi += prodSales; loss += leftover * p.price; }); return { name: outletName, harianOmset: omset, bulananOmset: omset * 30, porsi: porsi, loss: loss }; }); const filteredList = selectedOutlet === 'ALL' ? outletData : outletData.filter(o => o.name === selectedOutlet); let totalOmset = 0; let totalLoss = 0; let totalPorsi = 0; filteredList.forEach(o => { const omset = isHarian ? o.harianOmset : o.bulananOmset; totalOmset += omset; totalLoss += (isHarian ? o.loss : o.loss * 30); totalPorsi += (isHarian ? o.porsi : o.porsi * 30); }); const totalProfit = Math.round((totalOmset * 0.4) - totalLoss); const cardContainer = document.getElementById(cfg.cardsId); if (cardContainer) { cardContainer.innerHTML = `<div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-primary"><div class="text-muted fs-8 fw-bold">TOTAL OMSET (${selectedPeriod})</div><div class="fs-5 fw-bold text-primary">Rp ${totalOmset.toLocaleString('id-ID')}</div></div></div><div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-info"><div class="text-muted fs-8 fw-bold">TOTAL PORSI TERJUAL</div><div class="fs-5 fw-bold text-info">${totalPorsi} Cup</div></div></div><div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-danger"><div class="text-muted fs-8 fw-bold">KERUGIAN PRODUK SISA</div><div class="fs-5 fw-bold text-danger">Rp ${totalLoss.toLocaleString('id-ID')}</div></div></div><div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-success"><div class="text-muted fs-8 fw-bold">ESTIMASI UNTUNG / LABA BERSIH</div><div class="fs-5 fw-bold text-success">Rp ${totalProfit.toLocaleString('id-ID')}</div></div></div>`; } const tbody = document.getElementById(cfg.summaryTbodyId); if (tbody) { tbody.innerHTML = filteredList.map(o => { const omset = isHarian ? o.harianOmset : o.bulananOmset; const loss = isHarian ? o.loss : o.loss * 30; const porsi = isHarian ? o.porsi : o.porsi * 30; const profit = Math.round((omset * 0.4) - loss); return `<tr><td class="fw-bold text-brand-purple">${o.name}</td><td class="fw-bold">Rp ${omset.toLocaleString('id-ID')}</td><td>${porsi} Cup</td><td class="text-danger fw-bold">Rp ${loss.toLocaleString('id-ID')}</td><td class="text-success fw-bold">Rp ${profit.toLocaleString('id-ID')}</td><td class="text-center"><button class="btn btn-sm btn-brand-purple fs-8 font-bold py-1 px-2.5" onclick="Swal.fire('${o.name}', 'Laporan ${selectedPeriod} untuk ${o.name}:<br>Omset: Rp ${omset.toLocaleString('id-ID')}<br>Laba Bersih: Rp ${profit.toLocaleString('id-ID')}', 'info')"><i class="fa-solid fa-eye me-1"></i> Rincian</button></td></tr>`; }).join(''); } const leftoverTbody = document.getElementById(cfg.leftoverTbodyId); if (leftoverTbody) { let allLeftoverRows = []; const outletsToProcess = selectedOutlet === 'ALL' ? outletsList : [selectedOutlet]; outletsToProcess.forEach(outName => { const salesRec = state.outletSalesRecords[outName] || {}; state.products.forEach(p => { const sold = salesRec[p.id] ? salesRec[p.id].sold : 0; const allocated = (p.initialStock !== undefined ? p.initialStock : p.stock) || 0; const leftover = Math.max(0, allocated - sold); const lossAmt = leftover * p.price; allLeftoverRows.push(`<tr><td class="fw-bold text-brand-purple">${outName}</td><td class="fw-bold text-dark">${p.name}</td><td>${allocated} Cup</td><td class="text-success fw-bold">${sold} Cup Terjual</td><td class="text-danger fw-bold">${leftover} Cup Sisa</td><td class="text-danger fw-bold">Rp ${lossAmt.toLocaleString('id-ID')}</td><td class="text-center"><span class="badge bg-success fs-8"><i class="fa-solid fa-check-double me-1"></i> Diterima Dapur</span></td></tr>`); }); }); leftoverTbody.innerHTML = allLeftoverRows.join(''); } }
        function renderAdminPesananPerOutlet() { const selectedOutlet = document.getElementById('adm-pesanan-outlet-filter')?.value || 'ALL'; const cardsEl = document.getElementById('adm-pesanan-outlet-cards'); if (cardsEl) { cardsEl.innerHTML = state.outlets.map(outletName => { const ordersInOutlet = state.preOrders.filter(p => p.outlet === outletName); const totalOrders = ordersInOutlet.length; const belumDiambil = ordersInOutlet.filter(p => !p.isTaken && p.cancelStatus !== 'approved').length; const dibatalkan = ordersInOutlet.filter(p => p.cancelStatus === 'approved').length; return `<div class="col-md-4"><div class="card-custom p-3 h-100 border-start border-4 border-primary"><div class="fw-bold text-brand-purple fs-7 mb-2"><i class="fa-solid fa-shop me-1"></i> ${outletName}</div><div class="d-flex justify-content-between fs-8 mb-1"><span class="text-muted">Total Pesanan</span><span class="fw-bold">${totalOrders}</span></div><div class="d-flex justify-content-between fs-8 mb-1"><span class="text-muted">Belum Diambil</span><span class="fw-bold text-warning">${belumDiambil}</span></div><div class="d-flex justify-content-between fs-8"><span class="text-muted">Dibatalkan</span><span class="fw-bold text-danger">${dibatalkan}</span></div></div></div>`; }).join(''); } const tbody = document.getElementById('adm-pesanan-tbody'); if (tbody) { const filteredOrders = selectedOutlet === 'ALL' ? state.preOrders : state.preOrders.filter(p => p.outlet === selectedOutlet); tbody.innerHTML = filteredOrders.length > 0 ? filteredOrders.map(p => `<tr class="${p.isTaken ? 'bg-light opacity-75' : ''} ${p.cancelStatus === 'approved' ? 'table-danger' : ''}"><td class="fw-bold ${p.isTaken || p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${p.id} - ${p.customerName}</td><td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8">${p.outlet}</span></td><td><a href="https://wa.me/${p.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${p.wa}</a></td><td class="fs-8">${p.items}</td><td><span class="badge ${p.isPaid ? 'bg-success' : 'bg-danger'} fs-8">${p.isPaid ? 'Lunas ✅' : 'Belum Bayar (COD)'}</span></td><td><span class="badge ${p.isTaken ? 'bg-success' : 'bg-warning text-dark'} fs-8">${p.isTaken ? 'Sudah Diambil ✅' : 'Menunggu Ambil'}</span></td><td>${cancelInfoBadge(p)}</td></tr>`).join('') : `<tr><td colspan="7" class="text-center text-muted fs-8 fst-italic py-3">Belum ada pesanan untuk cabang ini.</td></tr>`; } }
        function renderOutletDropdowns() { const coOutlet = document.getElementById('co-outlet'); if (coOutlet) { const currentVal = coOutlet.value; coOutlet.innerHTML = state.outlets.map(o => `<option value="${escAttr(o)}">${o}</option>`).join(''); if (state.outlets.includes(currentVal)) coOutlet.value = currentVal; } const kasirOutletSel = document.getElementById('kasir-active-outlet'); if (kasirOutletSel) { kasirOutletSel.innerHTML = state.outlets.map(o => `<option value="${escAttr(o)}" ${o === state.kasirActiveOutlet ? 'selected' : ''}>${o}</option>`).join(''); } ['adm-report-outlet-filter', 'own-report-outlet-filter', 'adm-pesanan-outlet-filter', 'adm-dapur-outlet-filter', 'own-dapur-outlet-filter'].forEach(selId => { const sel = document.getElementById(selId); if (!sel) return; const currentVal = sel.value || 'ALL'; sel.innerHTML = '<option value="ALL">KONSOLIDASI SEMUA OUTLET</option>' + state.outlets.map(o => `<option value="${escAttr(o)}">${o}</option>`).join(''); sel.value = (currentVal === 'ALL' || state.outlets.includes(currentVal)) ? currentVal : 'ALL'; }); }
        function renderOwnerOutletsTable() {
            const tbody = document.getElementById('own-outlets-tbody');
            if (!tbody) return;
            tbody.innerHTML = state.outlets.map(o => {
                const totalOrders = state.preOrders.filter(p => p.outlet === o).length;
                const pendingOrders = state.preOrders.filter(p => p.outlet === o && !p.isTaken && p.cancelStatus !== 'approved').length;
                return `<tr>
                    <td class="fw-bold text-brand-purple">${o}</td>
                    <td>${totalOrders} Pesanan</td>
                    <td>${pendingOrders > 0 ? `<span class="badge bg-warning text-dark fs-8">${pendingOrders} Belum Diambil</span>` : '<span class="text-muted fs-8">-</span>'}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-purple py-1 px-2 fs-8 fw-bold" data-outlet="${escAttr(o)}" onclick="editOutletPinModal(this.dataset.outlet)"><i class="fa-solid fa-key me-1"></i> Edit PIN</button>
                        <button class="btn btn-sm btn-outline-secondary py-1 px-2 fs-8 fw-bold ms-1" data-outlet="${escAttr(o)}" onclick="editOutletModal(this.dataset.outlet)"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</button>
                        <button class="btn btn-sm btn-outline-danger py-1 px-2 fs-8 fw-bold ms-1" data-outlet="${escAttr(o)}" onclick="deleteOutlet(this.dataset.outlet)"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>`;
            }).join('');
        }
        function editOutletPinModal(outletName) {
            Swal.fire({
                title: `Edit PIN Akses Kasir - ${outletName}`,
                input: 'password',
                inputLabel: 'PIN Akses Kasir Baru (4-6 digit angka)',
                inputPlaceholder: 'Contoh: 5678',
                showCancelButton: true,
                confirmButtonText: 'Simpan PIN Baru',
                confirmButtonColor: '#6A1B9A',
                inputValidator: (value) => {
                    const v = (value || '').trim();
                    if (!v || v.length < 4 || v.length > 6) return 'PIN wajib berisi 4 sampai 6 digit angka!';
                }
            }).then(res => {
                if (res.isConfirmed && res.value) {
                    const newPin = res.value.trim();
                    startLoading();
                    fetch('/api/outlets/' + encodeURIComponent(outletName) + '/pin', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ pin: newPin })
                    }).then(async r => {
                        const data = await r.json().catch(() => ({}));
                        if (!r.ok || data.success === false) {
                            throw new Error(data.message || 'Gagal menyimpan PIN baru');
                        }
                        return data;
                    }).then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'PIN Kasir Diperbarui!',
                            text: `PIN akses kasir untuk ${outletName} berhasil diubah.`,
                            timer: 1600,
                            showConfirmButton: false
                        });
                    }).catch(err => {
                        Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: err.message || 'Terjadi kesalahan sistem.' });
                    }).finally(() => {
                        endLoading();
                    });
                }
            });
        }
        function showAddOutletModal() {
            Swal.fire({
                title: 'Tambah Outlet Baru',
                input: 'text',
                inputLabel: 'Nama Outlet',
                inputPlaceholder: 'Contoh: Outlet Cabang 3 (Bogor Kota)',
                showCancelButton: true,
                confirmButtonText: 'Simpan Outlet',
                confirmButtonColor: '#6A1B9A',
                inputValidator: (value) => {
                    const v = (value || '').trim();
                    if (!v) return 'Nama outlet wajib diisi!';
                    if (state.outlets.includes(v)) return 'Nama outlet sudah ada!';
                }
            }).then(res => {
                if (res.isConfirmed && res.value) {
                    const name = res.value.trim();
                    startLoading();
                    fetch('/api/outlets', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name: name })
                    }).then(async r => {
                        const data = await r.json().catch(() => ({}));
                        if (!r.ok || data.success === false) {
                            throw new Error(data.message || 'Gagal menyimpan outlet');
                        }
                        return data;
                    }).then(() => {
                        if (!state.outlets.includes(name)) {
                            state.outlets.push(name);
                        }
                        state.outletSalesRecords[name] = {};
                        renderAllUI();
                        Swal.fire({
                            icon: 'success',
                            title: 'Outlet Ditambahkan',
                            text: `${name} berhasil disimpan ke database!`,
                            timer: 1400,
                            showConfirmButton: false
                        });
                    }).catch(err => {
                        Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: err.message || 'Terjadi kesalahan sistem.' });
                    }).finally(() => {
                        endLoading();
                    });
                }
            });
        }
        function editOutletModal(outletName) {
            Swal.fire({
                title: 'Edit Nama Outlet',
                input: 'text',
                inputValue: outletName,
                showCancelButton: true,
                confirmButtonText: 'Simpan Perubahan',
                confirmButtonColor: '#6A1B9A',
                inputValidator: (value) => {
                    const v = (value || '').trim();
                    if (!v) return 'Nama outlet wajib diisi!';
                    if (v !== outletName && state.outlets.includes(v)) return 'Nama outlet sudah dipakai outlet lain!';
                }
            }).then(res => {
                if (res.isConfirmed && res.value) {
                    const newName = res.value.trim();
                    if (newName === outletName) return;
                    startLoading();
                    fetch('/api/outlets/' + encodeURIComponent(outletName), {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name: newName })
                    }).then(async r => {
                        const data = await r.json().catch(() => ({}));
                        if (!r.ok || data.success === false) {
                            throw new Error(data.message || 'Gagal memperbarui outlet');
                        }
                        return data;
                    }).then(() => {
                        const idx = state.outlets.indexOf(outletName);
                        if (idx > -1) state.outlets[idx] = newName;
                        if (state.outletSalesRecords[outletName]) {
                            state.outletSalesRecords[newName] = state.outletSalesRecords[outletName];
                            delete state.outletSalesRecords[outletName];
                        } else if (!state.outletSalesRecords[newName]) {
                            state.outletSalesRecords[newName] = {};
                        }
                        state.preOrders.forEach(p => {
                            if (p.outlet === outletName) p.outlet = newName;
                        });
                        if (state.kasirActiveOutlet === outletName) state.kasirActiveOutlet = newName;
                        renderAllUI();
                        Swal.fire({
                            icon: 'success',
                            title: 'Outlet Diperbarui',
                            text: `Nama outlet berhasil diubah menjadi "${newName}".`,
                            timer: 1400,
                            showConfirmButton: false
                        });
                    }).catch(err => {
                        Swal.fire({ icon: 'error', title: 'Gagal Memperbarui', text: err.message || 'Terjadi kesalahan sistem.' });
                    }).finally(() => {
                        endLoading();
                    });
                }
            });
        }
        function deleteOutlet(outletName) {
            if (state.outlets.length <= 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Bisa Dihapus',
                    text: 'Minimal harus ada 1 outlet aktif.'
                });
                return;
            }
            const activePreOrders = state.preOrders.filter(p => p.outlet === outletName && !p.isTaken && p.cancelStatus !== 'approved').length;
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Outlet?',
                html: `Outlet <b>${outletName}</b> akan dihapus permanen.${activePreOrders > 0 ? `<br><span class="text-danger fw-bold">Perhatian: masih ada ${activePreOrders} pre-order yang belum diambil di outlet ini!</span>` : ''}`,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Outlet',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc3545'
            }).then(res => {
                if (res.isConfirmed) {
                    startLoading();
                    fetch('/api/outlets/' + encodeURIComponent(outletName), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(async r => {
                        const data = await r.json().catch(() => ({}));
                        if (!r.ok || data.success === false) {
                            throw new Error(data.message || 'Gagal menghapus outlet');
                        }
                        return data;
                    }).then(() => {
                        state.outlets = state.outlets.filter(o => o !== outletName);
                        delete state.outletSalesRecords[outletName];
                        if (state.kasirActiveOutlet === outletName) {
                            state.kasirActiveOutlet = state.outlets[0];
                        }
                        renderAllUI();
                        Swal.fire({
                            icon: 'success',
                            title: 'Outlet Dihapus',
                            timer: 1200,
                            showConfirmButton: false
                        });
                    }).catch(err => {
                        Swal.fire({ icon: 'error', title: 'Gagal Menghapus', text: err.message || 'Terjadi kesalahan sistem.' });
                    }).finally(() => {
                        endLoading();
                    });
                }
            });
        }
        function requestResetPasswordModal() { Swal.fire({ title: 'Permohonan Reset Password', text: 'Kirimkan tiket permohonan reset kata sandi ke Owner?', showCancelButton: true, confirmButtonText: 'Kirim Tiket' }).then(res => { if (res.isConfirmed) { state.resetTickets.push({ id: 'RST-' + Math.floor(100 + Math.random() * 900), name: 'Bunda Pemesan', wa: '081298765432', time: '11:00 WIB', isResolved: false }); renderOwnerResetPasswordTable(); renderOwnerDashboard(); Swal.fire({ icon: 'success', title: 'Tiket Terkirim', text: 'Owner akan memproses reset kata sandi Anda.' }); } }); }
        function renderOwnerDashboard() { const outletsList = state.outlets; let totalOmsetHariIni = 0; let totalPorsiHariIni = 0; let totalLabaHariIni = 0; const perOutletRows = []; outletsList.forEach(outletName => { const salesRec = state.outletSalesRecords[outletName] || {}; let omset = 0, porsi = 0, loss = 0; state.products.forEach(p => { const sold = salesRec[p.id] ? salesRec[p.id].sold : 0; const allocated = (p.initialStock !== undefined ? p.initialStock : p.stock) || 0; const leftover = Math.max(0, allocated - sold); omset += sold * p.price; porsi += sold; loss += leftover * p.price; }); const profit = Math.round((omset * 0.4) - loss); totalOmsetHariIni += omset; totalPorsiHariIni += porsi; totalLabaHariIni += profit; perOutletRows.push({ name: outletName, omset, porsi, profit }); }); const pendingTickets = state.resetTickets.filter(t => !t.isResolved); const pendingPreOrders = state.preOrders.filter(p => !p.isTaken).length; const cardsEl = document.getElementById('owner-dashboard-cards'); if (cardsEl) { cardsEl.innerHTML = `<div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-primary"><div class="text-muted fs-8 fw-bold">TOTAL OMSET SEMUA OUTLET (HARI INI)</div><div class="fs-5 fw-bold text-primary">Rp ${totalOmsetHariIni.toLocaleString('id-ID')}</div></div></div><div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-info"><div class="text-muted fs-8 fw-bold">TOTAL PORSI TERJUAL</div><div class="fs-5 fw-bold text-info">${totalPorsiHariIni} Cup</div></div></div><div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-success"><div class="text-muted fs-8 fw-bold">ESTIMASI LABA BERSIH HARI INI</div><div class="fs-5 fw-bold text-success">Rp ${totalLabaHariIni.toLocaleString('id-ID')}</div></div></div><div class="col-md-3"><div class="card-custom p-3 border-start border-4 border-warning"><div class="text-muted fs-8 fw-bold">PRE-ORDER MENUNGGU DIAMBIL</div><div class="fs-5 fw-bold text-warning">${pendingPreOrders} Pesanan</div></div></div>`; } const outletTbody = document.getElementById('owner-dashboard-outlet-tbody'); if (outletTbody) { outletTbody.innerHTML = perOutletRows.map(o => `<tr><td class="fw-bold text-brand-purple">${o.name}</td><td class="fw-bold">Rp ${o.omset.toLocaleString('id-ID')}</td><td>${o.porsi} Cup</td><td class="text-success fw-bold">Rp ${o.profit.toLocaleString('id-ID')}</td></tr>`).join(''); } const resetListEl = document.getElementById('owner-dashboard-resetpass-list'); if (resetListEl) { resetListEl.innerHTML = pendingTickets.length > 0 ? pendingTickets.map(t => `<div class="d-flex justify-content-between align-items-center border rounded-3 p-2 bg-light"><div><div class="fw-bold">${t.name}</div><div class="text-muted fs-8">${t.wa} • ${t.time}</div></div><button class="btn btn-sm btn-brand-purple fs-8 fw-bold" onclick="resolveResetTicket('${t.id}')"><i class="fa-solid fa-key me-1"></i> Reset</button></div>`).join('') : '<div class="text-muted fs-8 fst-italic">Tidak ada tiket menunggu diproses 🎉</div>'; } const badgeEl = document.getElementById('owner-resetpass-badge'); if (badgeEl) { badgeEl.innerText = pendingTickets.length; badgeEl.style.display = pendingTickets.length > 0 ? 'inline-block' : 'none'; } }
        function renderOwnerResetPasswordTable() { const tbody = document.getElementById('own-resetpass-tbody'); if (!tbody) return; if (state.resetTickets.length === 0) { tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted fs-8 fst-italic py-3">Belum ada permintaan reset password.</td></tr>`; } else { tbody.innerHTML = state.resetTickets.map(t => `<tr class="${t.isResolved ? 'bg-light opacity-75' : ''}"><td class="fw-bold text-brand-purple">${t.id}</td><td class="fw-bold text-dark">${t.name}</td><td><a href="https://wa.me/${t.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${t.wa}</a></td><td>${t.time}</td><td><span class="badge ${t.isResolved ? 'bg-success' : 'bg-warning text-dark'} fs-8">${t.isResolved ? 'Selesai Direset ✅' : 'Menunggu Diproses'}</span></td><td class="text-center">${t.isResolved ? '<span class="text-muted fs-8 fst-italic">-</span>' : `<button class="btn btn-sm btn-brand-purple fs-8 fw-bold" onclick="resolveResetTicket('${t.id}')"><i class="fa-solid fa-key me-1"></i> Reset Sekarang</button>`}</td></tr>`).join(''); } const pendingCount = state.resetTickets.filter(t => !t.isResolved).length; const badgeEl = document.getElementById('owner-resetpass-badge'); if (badgeEl) { badgeEl.innerText = pendingCount; badgeEl.style.display = pendingCount > 0 ? 'inline-block' : 'none'; } }
        function resolveResetTicket(ticketId) { const t = state.resetTickets.find(x => x.id == ticketId); if (!t) return; Swal.fire({ title: 'Reset Password Pelanggan', html: `<div class="text-start fs-7 mb-2">Pelanggan: <b>${t.name}</b> (${t.wa})</div><input id="swal-newpass" class="swal2-input" placeholder="Password Baru Sementara" value="mpasi${Math.floor(1000 + Math.random() * 9000)}">`, showCancelButton: true, confirmButtonText: '<i class="fa-solid fa-key me-1"></i> Kirim Password Baru', confirmButtonColor: '#6A1B9A', preConfirm: () => { const val = document.getElementById('swal-newpass').value.trim(); if (!val) { Swal.showValidationMessage('Password baru wajib diisi!'); return false; } return val; } }).then(result => { if (result.isConfirmed) { t.isResolved = true; renderOwnerResetPasswordTable(); renderOwnerDashboard(); Swal.fire({ icon: 'success', title: 'Password Berhasil Direset', text: `Password baru "${result.value}" telah dikirim ke WhatsApp ${t.wa}.`, timer: 1800, showConfirmButton: false }); } }); }
        function showManualResetPasswordModal() { Swal.fire({ title: 'Reset Password Manual', html: `<div class="text-start fs-7 text-muted mb-2">Gunakan ini jika pelanggan menghubungi langsung tanpa mengirim tiket dari website.</div><input id="swal-mname" class="swal2-input" placeholder="Nama Pelanggan"><input id="swal-mwa" class="swal2-input" placeholder="Nomor WhatsApp Pelanggan"><input id="swal-mnewpass" class="swal2-input" placeholder="Password Baru Sementara">`, focusConfirm: false, showCancelButton: true, confirmButtonText: '<i class="fa-solid fa-key me-1"></i> Reset Password', confirmButtonColor: '#6A1B9A', preConfirm: () => { const name = document.getElementById('swal-mname').value.trim(); const wa = document.getElementById('swal-mwa').value.trim(); const newpass = document.getElementById('swal-mnewpass').value.trim(); if (!name || !wa || !newpass) { Swal.showValidationMessage('Harap isi Nama, WhatsApp, dan Password Baru!'); return false; } return { name, wa, newpass }; } }).then(result => { if (result.isConfirmed && result.value) { state.resetTickets.push({ id: 'RST-' + Math.floor(100 + Math.random() * 900), name: result.value.name, wa: result.value.wa, time: 'Reset Manual Owner', isResolved: true }); renderOwnerResetPasswordTable(); renderOwnerDashboard(); Swal.fire({ icon: 'success', title: 'Password Berhasil Direset', text: `Password baru "${result.value.newpass}" telah dikirim ke WhatsApp ${result.value.wa}.`, timer: 1800, showConfirmButton: false }); } }); }
        function renderOwnerMembersTable() { const tbody = document.getElementById('own-members-tbody'); if (!tbody) return; const membersList = Object.values(state.members); if (membersList.length === 0) { tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted fs-8 fst-italic py-4"><i class="fa-solid fa-user-slash fs-3 d-block mb-2 text-secondary"></i>Belum ada pelanggan yang login sebagai member.</td></tr>`; return; } tbody.innerHTML = membersList.map(m => `<tr><td class="fw-bold text-dark">${m.name}</td><td><a href="https://wa.me/${m.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${m.wa}</a></td><td><span class="badge bg-brand-yellow text-dark fs-7 fw-bold px-2 py-2"><i class="fa-solid fa-coins me-1"></i> ${m.points} Poin</span></td><td class="text-center"><button class="btn btn-sm btn-outline-primary py-1 px-2 fs-8 fw-bold" data-mid="${escAttr(m.identifier)}" onclick="editMemberPointsModal(this.dataset.mid)"><i class="fa-solid fa-pen-to-square me-1"></i> Edit Poin</button></td></tr>`).join(''); }
        function editMemberPointsModal(identifier) { const member = state.members[identifier]; if (!member) return; Swal.fire({ title: 'Edit Poin Member', html: `<div class="text-start fs-7 mb-2">Member: <b>${member.name}</b> (${member.wa})<br>Poin saat ini: <b class="text-brand-purple">${member.points} Poin</b></div><select id="swal-poin-action" class="swal2-select"><option value="add">Tambah Poin</option><option value="subtract">Kurangi Poin</option><option value="set">Atur Ulang ke Jumlah Tertentu</option></select><input id="swal-poin-amount" type="number" min="0" class="swal2-input" placeholder="Jumlah Poin"><input id="swal-poin-reason" class="swal2-input" placeholder="Keterangan (contoh: Bonus promo ulang tahun)">`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Perubahan', confirmButtonColor: '#6A1B9A', preConfirm: () => { const action = document.getElementById('swal-poin-action').value; const amountRaw = document.getElementById('swal-poin-amount').value; const reason = document.getElementById('swal-poin-reason').value.trim(); const amount = parseInt(amountRaw); if (isNaN(amount) || amount < 0) { Swal.showValidationMessage('Masukkan jumlah poin yang valid!'); return false; } return { action, amount, reason: reason || '-' }; } }).then(result => { if (result.isConfirmed && result.value) { const { action, amount, reason } = result.value; let delta = 0; let label = ''; if (action === 'add') { member.points += amount; delta = amount; label = `Poin ditambah manual oleh Owner${reason !== '-' ? ' - ' + reason : ''}`; } else if (action === 'subtract') { const actualDeducted = Math.min(member.points, amount); member.points = Math.max(0, member.points - amount); delta = -actualDeducted; label = `Poin dikurangi manual oleh Owner${reason !== '-' ? ' - ' + reason : ''}`; } else if (action === 'set') { delta = amount - member.points; member.points = amount; label = `Poin diatur ulang manual oleh Owner ke ${amount}${reason !== '-' ? ' - ' + reason : ''}`; } member.pointsHistory.unshift({ type: 'adjust', label: label, points: delta, date: new Date().toLocaleString('id-ID') }); renderOwnerMembersTable(); renderCustomerAuthArea(); renderCustomerPointsPage(); renderOwnerDashboard(); Swal.fire({ icon: 'success', title: 'Poin Diperbarui', text: `Poin ${member.name} sekarang ${member.points} Poin.`, timer: 1500, showConfirmButton: false }); } }); }
        function renderOwnerRewardsTable() { const tbody = document.getElementById('own-rewards-tbody'); if (!tbody) return; if (state.pointRewards.length === 0) { tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted fs-8 fst-italic py-4">Belum ada reward. Tambahkan reward baru untuk pelanggan.</td></tr>`; return; } tbody.innerHTML = state.pointRewards.map(r => `<tr><td class="fw-bold text-dark">${r.name}</td><td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8 fw-bold"><i class="fa-solid fa-coins me-1"></i> ${r.pointsCost} Poin</span></td><td class="fs-8 text-muted">${r.description}</td><td class="text-center text-nowrap"><button class="btn btn-sm btn-outline-secondary py-1 px-2 fs-8 fw-bold" onclick="editRewardModal('${r.id}')"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</button><button class="btn btn-sm btn-outline-danger py-1 px-2 fs-8 fw-bold ms-1" onclick="deleteRewardOwner('${r.id}')"><i class="fa-solid fa-trash"></i></button></td></tr>`).join(''); }
        function showAddRewardModal() { Swal.fire({ title: 'Tambah Reward Baru', html: `<input id="swal-rname" class="swal2-input" placeholder="Nama Reward"><input id="swal-rcost" type="number" min="1" class="swal2-input" placeholder="Biaya Poin"><textarea id="swal-rdesc" class="swal2-textarea" placeholder="Deskripsi Reward"></textarea>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Reward', confirmButtonColor: '#6A1B9A', preConfirm: () => { const name = document.getElementById('swal-rname').value.trim(); const cost = parseInt(document.getElementById('swal-rcost').value) || 0; const desc = document.getElementById('swal-rdesc').value.trim(); if (!name || cost <= 0) { Swal.showValidationMessage('Harap isi Nama dan Biaya Poin (lebih dari 0)!'); return false; } return { name, cost, desc }; } }).then(result => { if (result.isConfirmed && result.value) { const newId = 'RWD-' + (state.pointRewards.length + 1) + '-' + Math.floor(Math.random() * 1000); state.pointRewards.push({ id: newId, name: result.value.name, pointsCost: result.value.cost, description: result.value.desc || 'Reward spesial dari MPASI Si Kecil.' }); renderOwnerRewardsTable(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Reward Ditambahkan', text: `${result.value.name} kini bisa ditukar pelanggan!`, timer: 1300, showConfirmButton: false }); } }); }
        function editRewardModal(rewardId) { const r = state.pointRewards.find(x => x.id == rewardId); if (!r) return; Swal.fire({ title: 'Edit Reward', html: `<input id="swal-rename" class="swal2-input" placeholder="Nama Reward" value="${r.name}"><input id="swal-recost" type="number" min="1" class="swal2-input" placeholder="Biaya Poin" value="${r.pointsCost}"><textarea id="swal-redesc" class="swal2-textarea" placeholder="Deskripsi Reward">${r.description}</textarea>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Perubahan', confirmButtonColor: '#6A1B9A', preConfirm: () => { const name = document.getElementById('swal-rename').value.trim(); const cost = parseInt(document.getElementById('swal-recost').value) || 0; const desc = document.getElementById('swal-redesc').value.trim(); if (!name || cost <= 0) { Swal.showValidationMessage('Harap isi Nama dan Biaya Poin (lebih dari 0)!'); return false; } return { name, cost, desc }; } }).then(result => { if (result.isConfirmed && result.value) { r.name = result.value.name; r.pointsCost = result.value.cost; r.description = result.value.desc; renderOwnerRewardsTable(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Reward Diperbarui', timer: 1200, showConfirmButton: false }); } }); }
        function deleteRewardOwner(rewardId) { const r = state.pointRewards.find(x => x.id == rewardId); if (!r) return; Swal.fire({ icon: 'warning', title: 'Hapus Reward?', text: `Reward "${r.name}" akan dihapus dari katalog dan tidak bisa ditukar pelanggan lagi.`, showCancelButton: true, confirmButtonText: 'Ya, Hapus', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { state.pointRewards = state.pointRewards.filter(x => x.id != rewardId); renderOwnerRewardsTable(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Reward Dihapus', timer: 1000, showConfirmButton: false }); } }); }
        function updatePointsRateExample() { const exEl = document.getElementById('owner-points-rate-example'); if (!exEl) return; const rateInput = document.getElementById('owner-points-rate-input'); const rate = parseInt(rateInput ? rateInput.value : state.pointsEarnRate) || state.pointsEarnRate; const examplePoints = Math.floor(15000 / rate); exEl.innerText = `Contoh: belanja Rp 15.000 akan mendapat ${examplePoints} Poin.`; }
        function saveOwnerPointsRate() { const rateInput = document.getElementById('owner-points-rate-input'); const newRate = parseInt(rateInput ? rateInput.value : NaN); if (!newRate || newRate <= 0) { Swal.fire({ icon: 'warning', title: 'Rasio Tidak Valid', text: 'Masukkan angka Rupiah melebih dari 0!' }); return; } fetch('/points/rate', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ rate: newRate }) }).then(() => { state.pointsEarnRate = newRate; updatePointsRateExample(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Rasio Poin Disimpan', html: `Sekarang setiap belanja <b>Rp ${newRate.toLocaleString('id-ID')}</b> = <b>1 Poin</b> untuk semua transaksi member (kecuali produk dengan Poin Kustom).`, timer: 1800, showConfirmButton: false }); }); }
        function renderOwnerProductPointsTable() { const tbody = document.getElementById('own-product-points-tbody'); if (!tbody) return; tbody.innerHTML = state.products.map(p => `<tr><td class="fw-bold text-dark">${p.name}</td><td>Rp ${p.price.toLocaleString('id-ID')}</td><td style="max-width:160px;"><input type="number" min="0" class="form-control form-control-sm fw-bold" id="ppoints-${p.id}" value="${p.customPoints || 0}" placeholder="0 = pakai rasio global"></td><td class="text-center"><button class="btn btn-sm btn-brand-purple py-1 px-2 fs-8 fw-bold" onclick="saveProductCustomPoints('${p.id}')"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan</button></td></tr>`).join(''); }
        function saveProductCustomPoints(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; const input = document.getElementById('ppoints-' + prodId); const val = parseInt(input ? input.value : 0) || 0; p.customPoints = Math.max(0, val); Swal.fire({ icon: 'success', title: 'Poin Kustom Disimpan', text: p.customPoints > 0 ? `${p.name} sekarang memberi ${p.customPoints} Poin tetap per cup.` : `${p.name} kembali memakai rasio poin global.`, timer: 1500, showConfirmButton: false }); }
        function handleLogin(e) { e.preventDefault(); const typedName = document.getElementById('login-name').value.trim(); const identifier = document.getElementById('login-identifier').value.trim(); if (!identifier) return; let member = state.members[identifier]; if (!member) { member = { identifier: identifier, name: typedName || ('Bunda ' + identifier), wa: identifier, points: 0, pointsHistory: [] }; state.members[identifier] = member; } else if (typedName) { member.name = typedName; } state.currentUser = member; try { localStorage.setItem('mpasi_current_user', JSON.stringify(member)); } catch(err){} renderAllUI(); Swal.fire({ icon: 'success', title: 'Login Berhasil', text: `Selamat datang, ${member.name}! Poin Anda: ${member.points}.`, timer: 1600, showConfirmButton: false }); switchCustView('beranda'); }
        function continueAsGuest() { state.currentUser = null; try { localStorage.removeItem('mpasi_current_user'); } catch(err){} renderCustomerAuthArea(); switchCustView('beranda'); }
        function logoutCustomer() { Swal.fire({ title: 'Keluar dari Akun?', text: 'Anda perlu login lagi untuk mengumpulkan/menukar poin.', showCancelButton: true, confirmButtonText: 'Ya, Keluar', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { state.currentUser = null; try { localStorage.removeItem('mpasi_current_user'); } catch(err){} renderAllUI(); switchCustView('beranda'); } }); }
        function showEditCustomerProfileModal() {
            if (!state.currentUser) {
                switchCustView('login');
                return;
            }
            const member = state.currentUser;
            const oldIdentifier = member.identifier || member.wa;

            const outletsOptionsHtml = state.outlets.map(o => 
                `<option value="${escAttr(o)}" ${(member.favoriteOutlet === o) ? 'selected' : ''}>${o}</option>`
            ).join('');

            Swal.fire({
                title: '<i class="fa-solid fa-user-pen text-brand-purple me-2"></i>Edit Profil Bunda',
                html: `
                    <div class="text-start mb-3">
                        <label class="form-label fs-7 fw-bold mb-1 text-dark">Nama Lengkap Bunda / Pemesan <span class="text-danger">*</span></label>
                        <input id="edit-cust-name" class="form-control fs-7 fw-bold" placeholder="Contoh: Bunda Siti Rahmawati" value="${escAttr(member.name || '')}">
                    </div>
                    <div class="text-start mb-3">
                        <label class="form-label fs-7 fw-bold mb-1 text-dark">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                        <input id="edit-cust-wa" type="tel" class="form-control fs-7 fw-bold" placeholder="Contoh: 081298765432" value="${escAttr(member.wa || oldIdentifier || '')}">
                    </div>
                    <div class="text-start mb-2">
                        <label class="form-label fs-7 fw-bold mb-1 text-dark">Outlet Langganan Favorit</label>
                        <select id="edit-cust-outlet" class="form-select fs-7">
                            <option value="">-- Pilih Outlet Favorit --</option>
                            ${outletsOptionsHtml}
                        </select>
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: '<i class="fa-solid fa-floppy-disk me-1"></i> Simpan Profil',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6A1B9A',
                preConfirm: () => {
                    const newName = document.getElementById('edit-cust-name').value.trim();
                    const newWa = document.getElementById('edit-cust-wa').value.trim();
                    const newOutlet = document.getElementById('edit-cust-outlet').value;

                    if (!newName) {
                        Swal.showValidationMessage('Nama lengkap Bunda wajib diisi!');
                        return false;
                    }
                    if (!newWa) {
                        Swal.showValidationMessage('Nomor WhatsApp wajib diisi!');
                        return false;
                    }
                    return { name: newName, wa: newWa, favoriteOutlet: newOutlet };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    const { name, wa, favoriteOutlet } = result.value;

                    if (wa !== oldIdentifier && state.members[oldIdentifier]) {
                        delete state.members[oldIdentifier];
                        member.identifier = wa;
                    }

                    member.name = name;
                    member.wa = wa;
                    if (favoriteOutlet) member.favoriteOutlet = favoriteOutlet;

                    state.members[member.identifier || wa] = member;
                    state.currentUser = member;

                    try {
                        localStorage.setItem('mpasi_current_user', JSON.stringify(member));
                    } catch(err) {}

                    fetch('/member/profile', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            identifier: oldIdentifier,
                            name: name,
                            whatsapp: wa,
                            favorite_outlet: favoriteOutlet
                        })
                    }).catch(() => {});

                    const coName = document.getElementById('co-name');
                    const coWa = document.getElementById('co-wa');
                    const coOutlet = document.getElementById('co-outlet');
                    if (coName) coName.value = name;
                    if (coWa) coWa.value = wa;
                    if (coOutlet && favoriteOutlet) coOutlet.value = favoriteOutlet;

                    renderAllUI();

                    Swal.fire({
                        icon: 'success',
                        title: 'Profil Diperbarui! 🎉',
                        text: `Terima kasih, profil Bunda ${name} berhasil disimpan.`,
                        timer: 1600,
                        showConfirmButton: false
                    });
                }
            });
        }
        function renderCustomerAuthArea() { const container = document.getElementById('cust-nav-auth-container'); if (container) { if (state.currentUser) { container.innerHTML = `<div class="d-flex align-items-center gap-2"><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8 fw-bold px-2.5 py-2 cursor-pointer" onclick="switchCustView('akun')" title="Profil & Akun Saya"><i class="fa-solid fa-user me-1"></i> ${state.currentUser.name}</span><span class="badge bg-brand-yellow text-dark fs-8 fw-bold px-2 py-2 cursor-pointer" onclick="switchCustView('poin')"><i class="fa-solid fa-coins me-1"></i> ${state.currentUser.points} Poin</span><button class="btn btn-outline-danger btn-sm rounded-pill px-2 fs-8 fw-bold" onclick="logoutCustomer()" title="Keluar"><i class="fa-solid fa-right-from-bracket"></i></button></div>`; } else { container.innerHTML = `<button class="btn btn-outline-brand-purple btn-sm rounded-pill px-3 fw-bold text-brand-purple" onclick="switchCustView('login')"><i class="fa-solid fa-user me-1"></i> Masuk</button>`; } } const navBadge = document.getElementById('poin-nav-badge'); if (navBadge) { if (state.currentUser) { navBadge.innerText = state.currentUser.points; navBadge.style.display = 'inline-block'; } else { navBadge.style.display = 'none'; } } const mobilePoinBadge = document.getElementById('mobile-poin-badge'); if (mobilePoinBadge) { if (state.currentUser) { mobilePoinBadge.innerText = state.currentUser.points; mobilePoinBadge.style.display = 'inline-block'; } else { mobilePoinBadge.style.display = 'none'; } } const mobileUserLabel = document.getElementById('mobile-nav-user-label'); const mobileUserIcon = document.getElementById('mobile-nav-user-icon'); if (mobileUserLabel) { if (state.currentUser) { const firstName = state.currentUser.name ? state.currentUser.name.split(' ')[0] : 'Akun'; mobileUserLabel.innerText = firstName; } else { mobileUserLabel.innerText = 'Masuk'; } } if (mobileUserIcon) { if (state.currentUser) { mobileUserIcon.className = 'fa-solid fa-circle-user nav-icon text-brand-purple'; } else { mobileUserIcon.className = 'fa-solid fa-user nav-icon'; } } }
        function renderCustomerPointsPage() { const container = document.getElementById('poin-page-content'); if (!container) return; if (!state.currentUser) { container.innerHTML = `<div class="card-custom p-4 text-center max-w-500 mx-auto"><div class="bg-purple-light text-brand-purple d-inline-flex p-3 rounded-circle mb-3 fs-2 mx-auto"><i class="fa-solid fa-lock"></i></div><h5 class="fw-bold text-dark mb-2">Masuk Dulu Yuk, Bunda!</h5><p class="text-muted fs-7 mb-3">Poin hanya berlaku untuk pelanggan yang login sebagai member. Belanja tanpa login (tamu) tidak mendapat poin. Silakan masuk atau daftar gratis untuk mulai mengumpulkan poin dari setiap belanja.</p><button class="btn btn-brand-purple fw-bold px-4" onclick="switchCustView('login')"><i class="fa-solid fa-right-to-bracket me-1"></i> Masuk / Daftar Member</button></div>`; return; } const member = state.currentUser; const rewardsHtml = state.pointRewards.map(r => { const canRedeem = member.points >= r.pointsCost; return `<div class="col-md-6 col-lg-3"><div class="card-custom p-3 h-100 d-flex flex-column justify-content-between ${canRedeem ? '' : 'opacity-75'}"><div><div class="bg-purple-light text-brand-purple rounded-3 p-3 text-center mb-2 fs-3"><i class="fa-solid fa-gift"></i></div><h6 class="fw-bold text-dark mb-1">${r.name}</h6><p class="text-muted fs-8 mb-2">${r.description}</p></div><div><div class="fw-bold text-brand-purple fs-6 mb-2"><i class="fa-solid fa-coins me-1 text-warning"></i> ${r.pointsCost} Poin</div><button class="btn btn-sm w-100 fw-bold ${canRedeem ? 'btn-brand-yellow text-dark' : 'btn-secondary'}" ${canRedeem ? '' : 'disabled'} onclick="redeemReward('${r.id}')">${canRedeem ? '<i class="fa-solid fa-right-left me-1"></i> Tukar Sekarang' : 'Poin Belum Cukup'}</button></div></div></div>`; }).join(''); const historyRows = member.pointsHistory.length > 0 ? member.pointsHistory.map(h => `<tr><td class="fs-8 text-muted">${h.date}</td><td class="fw-bold text-dark fs-7">${h.label}</td><td class="text-end fw-bold fs-7 ${h.points >= 0 ? 'text-success' : 'text-danger'}">${h.points >= 0 ? '+' : ''}${h.points} Poin</td></tr>`).join('') : `<tr><td colspan="3" class="text-center text-muted fs-8 fst-italic py-3">Belum ada riwayat poin.</td></tr>`; container.innerHTML = `<div class="hero-banner mb-4 p-4 rounded-4 shadow-sm text-white"><div class="row align-items-center g-3"><div class="col-md-7"><div class="fs-8 text-white opacity-75 fw-bold text-uppercase mb-1"><i class="fa-solid fa-star text-warning me-1"></i> Saldo Poin Belanja Member</div><div class="display-6 fw-extrabold text-white mb-2"><i class="fa-solid fa-coins text-warning me-2"></i>${member.points} Poin</div><div class="fs-7 text-white opacity-90"><i class="fa-solid fa-user-circle me-1"></i> Member: <b>${member.name}</b> (${member.wa})</div></div><div class="col-md-5"><div class="text-white fs-8 bg-white bg-opacity-15 rounded-3 p-3 border border-white border-opacity-20"><div class="fw-bold mb-1"><i class="fa-solid fa-circle-info me-1 text-warning"></i> Info Perhitungan Poin:</div>Setiap belanja online kelipatan Rp ${state.pointsEarnRate.toLocaleString('id-ID')} = 1 Poin (kecuali produk dengan Poin Kustom). Poin otomatis masuk setelah checkout berhasil.</div></div></div></div><div class="mb-4"><div class="d-flex align-items-center justify-content-between mb-3"><h5 class="fw-bold text-brand-purple mb-0"><i class="fa-solid fa-gift me-2 text-warning"></i> Tukar Poin dengan Reward</h5><span class="badge bg-purple-light text-brand-purple fs-8 border border-purple-200">${state.pointRewards.length} Reward Tersedia</span></div><div class="row g-3">${rewardsHtml}</div></div><div class="mb-3"><h5 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-clock-rotate-left me-2"></i> Riwayat Poin</h5><div class="card-custom p-3"><div class="table-responsive"><table class="table align-middle fs-7 mb-0"><thead class="bg-light"><tr><th>Waktu</th><th>Keterangan</th><th class="text-end">Poin</th></tr></thead><tbody>${historyRows}</tbody></table></div></div></div>`; }
        function renderCustomerProfilePage() { const container = document.getElementById('akun-page-content'); if (!container) return; if (!state.currentUser) { switchCustView('login'); return; } const member = state.currentUser; container.innerHTML = `<div class="max-w-600 mx-auto"><div class="card-custom p-4 bg-purple-light border border-purple-200 mb-4 shadow-sm"><div class="text-center mb-3"><div class="bg-brand-purple text-white d-inline-flex p-3 rounded-circle mb-2 fs-2 shadow-sm"><i class="fa-solid fa-circle-user"></i></div><h4 class="fw-bold text-brand-purple mb-0">${member.name}</h4><span class="badge bg-brand-yellow text-dark fs-8 fw-bold mt-1 px-3 py-1.5 rounded-pill"><i class="fa-solid fa-coins me-1"></i> ${member.points} Poin Belanja</span></div><hr class="border-purple-200"><div class="fs-7 text-dark space-y-2 mb-4"><div class="d-flex justify-content-between align-items-center py-2 border-bottom"><span class="text-muted"><i class="fa-solid fa-whatsapp text-success me-1"></i> No. WhatsApp:</span><span class="fw-bold text-dark">${member.wa}</span></div><div class="d-flex justify-content-between align-items-center py-2 border-bottom"><span class="text-muted"><i class="fa-solid fa-shop text-brand-purple me-1"></i> Outlet Favorit:</span><span class="fw-bold text-brand-purple">${member.favoriteOutlet || 'Belum Diatur'}</span></div><div class="d-flex justify-content-between align-items-center py-2"><span class="text-muted"><i class="fa-solid fa-shield-check text-primary me-1"></i> Status Akun:</span><span class="badge bg-success fs-8">Member Aktif</span></div></div><div class="d-flex flex-column gap-2 pt-2 border-top"><button class="btn btn-brand-purple w-100 fw-bold py-2.5 rounded-pill shadow-sm fs-7" onclick="showEditCustomerProfileModal()"><i class="fa-solid fa-user-pen me-2 text-warning"></i> Edit Profil Saya</button><button class="btn btn-outline-danger w-100 fw-bold py-2 rounded-pill fs-7" onclick="logoutCustomer()"><i class="fa-solid fa-right-from-bracket me-1"></i> Keluar dari Akun</button></div></div></div>`; }
        function handleSaveCustomerProfile(e) { e.preventDefault(); if (!state.currentUser) return; const member = state.currentUser; const oldIdentifier = member.identifier || member.wa; const newName = document.getElementById('prof-name').value.trim(); const newWa = document.getElementById('prof-wa').value.trim(); const newOutlet = document.getElementById('prof-outlet').value; if (!newName || !newWa) { Swal.fire({ icon: 'warning', title: 'Data Belum Lengkap', text: 'Nama dan Nomor WhatsApp wajib diisi!' }); return; } if (newWa !== oldIdentifier && state.members[oldIdentifier]) { delete state.members[oldIdentifier]; member.identifier = newWa; } member.name = newName; member.wa = newWa; if (newOutlet) member.favoriteOutlet = newOutlet; state.members[member.identifier || newWa] = member; state.currentUser = member; try { localStorage.setItem('mpasi_current_user', JSON.stringify(member)); } catch(err){} fetch('/member/profile', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ identifier: oldIdentifier, name: newName, whatsapp: newWa, favorite_outlet: newOutlet }) }).catch(() => {}); const coName = document.getElementById('co-name'); const coWa = document.getElementById('co-wa'); const coOutlet = document.getElementById('co-outlet'); if (coName) coName.value = newName; if (coWa) coWa.value = newWa; if (coOutlet && newOutlet) coOutlet.value = newOutlet; renderAllUI(); Swal.fire({ icon: 'success', title: 'Profil Diperbarui! 🎉', text: `Terima kasih, data profil Bunda ${newName} berhasil disimpan.`, timer: 1600, showConfirmButton: false }); }
        function redeemReward(rewardId) { if (!state.currentUser) return; const reward = state.pointRewards.find(r => r.id == rewardId); if (!reward) return; const member = state.currentUser; if (member.points < reward.pointsCost) { Swal.fire({ icon: 'warning', title: 'Poin Tidak Cukup', text: `Anda butuh ${reward.pointsCost} poin, saat ini baru punya ${member.points} poin.` }); return; } Swal.fire({ title: 'Tukar Poin Sekarang?', html: `Tukar <b>${reward.pointsCost} Poin</b> dengan <b>${reward.name}</b>?<br><span class="fs-8 text-muted">Sisa poin setelah ditukar: ${member.points - reward.pointsCost}</span>`, showCancelButton: true, confirmButtonText: 'Ya, Tukar Sekarang', cancelButtonText: 'Batal', confirmButtonColor: '#6A1B9A' }).then(res => { if (res.isConfirmed) { member.points -= reward.pointsCost; const redemptionCode = 'RDM-' + Math.floor(1000 + Math.random() * 9000); member.pointsHistory.unshift({ type: 'redeem', label: `Tukar reward: ${reward.name} (Kode: ${redemptionCode})`, points: -reward.pointsCost, date: new Date().toLocaleString('id-ID') }); renderAllUI(); switchCustView('poin'); Swal.fire({ icon: 'success', title: 'Penukaran Berhasil! 🎉', html: `Reward: <b>${reward.name}</b><br>Kode Penukaran: <b class="text-brand-purple fs-5">${redemptionCode}</b><br><span class="fs-8 text-muted">Tunjukkan kode ini ke Kasir saat mengambil pesanan di outlet.</span>` }); } }); }
        document.addEventListener('DOMContentLoaded', function() { try { selectRolePortal(state.activeRole); renderAllUI(); if (state.activeRole === 'pelanggan') { if (!state.currentUser) { switchCustView('login'); } else { switchCustView('beranda'); } } updateStoreHoursStatus(); setInterval(updateStoreHoursStatus, 30000); } catch (err) { console.error("Render UI Error:", err); } finally { endLoading(); } }); window.onload = function() { endLoading(); }; setTimeout(endLoading, 800);
    </script>
@endsection
