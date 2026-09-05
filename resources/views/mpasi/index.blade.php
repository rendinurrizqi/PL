@extends('layouts.app')

@section('title', 'Mamam Yuk - Mamam Yuk Harian Untuk Si Kecil')

@section('content')
    @include('mpasi.partials.data-json')

    <div id="loading-overlay">
        <div class="spinner-border text-warning" style="width: 3.5rem; height: 3.5rem;" role="status"></div>
        <div class="mt-3 fw-bold text-brand-purple">Memuat Mamam Yuk - Mamam Yuk Harian Si Kecil...</div>
    </div>

    <div id="app">

        <div id="role-portal-pelanggan" class="role-portal-page">
            <nav class="navbar navbar-expand-lg navbar-custom px-3">
                <div class="container-fluid max-w-1600">
                    <a class="navbar-brand d-flex align-items-center gap-2 text-brand-purple" href="#" onclick="switchCustView('beranda')">
                        <div class="bg-brand-yellow text-dark p-2 rounded-circle fs-5"><i class="fa-solid fa-baby"></i></div>
                        <div>
                            <span class="fs-5 fw-bold text-brand-purple">Mamam Yuk</span>
                            <div class="text-muted fs-8 fw-semibold" style="margin-top:-4px;">Mamam Yuk Harian Untuk Si Kecil</div>
                        </div>
                    </a>

                    <!-- Jam Toko Status Header Desktop -->
                    <div class="d-none d-md-flex align-items-center bg-purple-light px-3 py-1 rounded-pill border border-purple-200 ms-3">
                        <span class="fs-8 fw-bold me-2 text-brand-purple"><i class="fa-solid fa-clock me-1"></i> Jam Toko:</span>
                        <span id="store-hours-label" class="fw-bold text-dark fs-8 d-flex align-items-center gap-1">
                            <span id="store-hours-dot" class="d-inline-block rounded-circle bg-success" style="width:8px;height:8px;"></span>
                            BUKA 24 Jam
                        </span>
                    </div>

                    <!-- Jam Toko Status Header Mobile -->
                    <div class="d-flex d-md-none align-items-center bg-purple-light px-2 py-1 rounded-pill border border-purple-200 ms-auto me-1" style="font-size:0.75rem;">
                        <span id="store-hours-label-mobile" class="fw-bold text-dark d-flex align-items-center gap-1">
                            <span id="store-hours-dot-mobile" class="d-inline-block rounded-circle bg-success" style="width:7px;height:7px;"></span>
                            BUKA
                        </span>
                    </div>

                    <button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse" data-bs-target="#custNavContent">
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
                    <h3 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-utensils me-2"></i> Katalog Menu Mamam Yuk Hari Ini</h3>
                    <div id="full-products-grid" class="row g-3"></div>
                </div>

                <div id="cust-view-keranjang" class="cust-view" style="display:none;">
                    <h3 class="fw-bold text-brand-purple mb-3"><i class="fa-solid fa-cart-shopping me-2"></i> Keranjang Belanja Mamam Yuk</h3>
                    <div class="row g-3">
                        <div class="col-lg-8">
                            <div class="card-custom p-3">
                                <div class="table-responsive">
                                    <table class="table align-middle fs-7">
                                        <thead class="bg-light">
                                            <tr><th>Varian Mamam Yuk</th><th>Harga / Cup</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
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
                    <h3 class="fw-bold text-brand-purple mb-4 text-center"><i class="fa-solid fa-credit-card me-2"></i> Form Checkout Pemesanan Mamam Yuk</h3>
                    <div class="row g-4 max-w-1000 mx-auto">
                        <div class="col-md-5">
                            <div class="card-custom p-3 border-purple-200">
                                <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3">Ringkasan Belanja</h6>
                                <div id="checkout-items-list" class="d-flex flex-column gap-2 mb-3 fs-7"></div>
                                <div id="checkout-summary-container">
                                    <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2">
                                        <span>Total Tagihan:</span>
                                        <span id="checkout-total-amount" class="text-brand-purple">Rp 0</span>
                                    </div>
                                </div>
                                <div id="checkout-points-preview" class="fs-8 text-success fw-bold mt-2"></div>

                                <div class="mt-3 pt-3 border-top">
                                    <label class="form-label fs-8 fw-bold text-dark mb-1">
                                        <i class="fa-solid fa-ticket text-warning me-1"></i> Punya Kode Voucher / Poin?
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" id="co-voucher-code" class="form-control form-control-sm fw-bold text-uppercase border-purple-200" placeholder="Contoh: RDM-1234">
                                        <button type="button" class="btn btn-brand-purple fw-bold fs-8" onclick="applyCheckoutVoucher()">Gunakan</button>
                                    </div>
                                    <div id="co-voucher-status" class="fs-8 mt-1"></div>
                                </div>
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
                                                <div><div class="fw-bold fs-7">Transfer BCA / QRIS (Lunas Langsung)</div><div class="text-muted fs-8">No. Rek BCA: 8830192831 a/n Mamam Yuk</div></div>
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

                <div id="cust-view-login" class="cust-view login-bg-container" style="display:none;">
                    <div class="card-custom p-4 max-w-500 mx-auto shadow-lg login-card-glass">
                        <div class="text-center mb-4">
                            <div class="bg-brand-yellow text-dark d-inline-flex p-3 rounded-circle mb-2 fs-2 shadow-sm"><i class="fa-solid fa-baby"></i></div>
                            <h4 class="fw-bold text-brand-purple mb-1">Member Mamam Yuk Si Kecil</h4>
                            <div class="bg-warning bg-opacity-25 border border-warning rounded-3 p-3 mt-3 shadow-sm">
                                <div class="fw-extrabold fs-6 text-dark d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-solid fa-coins text-warning fs-4"></i>
                                    <span>Daftarkan Menjadi Member Karena Akan Mendapatkan Point Setiap Pembelian</span>
                                </div>
                            </div>
                        </div>
                        <form onsubmit="handleLogin(event)">
                            <div class="mb-3 text-start">
                                <label class="form-label fs-7 fw-bold text-dark"><i class="fa-solid fa-user me-1 text-brand-purple"></i> Nama Panggilan Bunda</label>
                                <input type="text" id="login-name" class="form-control fw-semibold" placeholder="Contoh: Bunda Siti">
                            </div>
                            <div class="mb-3 text-start">
                                <label class="form-label fs-7 fw-bold text-dark"><i class="fa-solid fa-phone me-1 text-brand-purple"></i> Nomor WhatsApp / Email</label>
                                <input type="text" id="login-identifier" class="form-control fw-semibold" placeholder="081298765432" required>
                            </div>
                            <button type="submit" class="btn btn-brand-purple w-100 py-2.5 fw-bold fs-6 mb-3 shadow-sm"><i class="fa-solid fa-right-to-bracket me-1"></i> MASUK MEMBER (+Poin)</button>
                        </form>
                        <button class="btn btn-outline-secondary btn-sm w-100 fw-bold py-2 mb-3" onclick="continueAsGuest()"><i class="fa-solid fa-user-slash me-1"></i> Lanjut Belanja Tanpa Akun (Tamu)</button>
                        <div class="text-center border-top pt-3">
                            <button class="btn btn-link text-danger fs-8 fw-bold text-decoration-none" onclick="requestResetPasswordModal()"><i class="fa-solid fa-key me-1"></i> Lupa Kata Sandi? Minta Reset ke Owner</button>
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
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label text-warning fs-8 fw-bold mb-0"><i class="fa-solid fa-store me-1"></i> Cabang Bertugas:</label>
                            <span class="badge bg-success fs-8 text-white"><i class="fa-solid fa-lock me-1"></i> Terkunci PIN</span>
                        </div>
                        <div class="bg-white border border-warning rounded-3 p-2 text-start mb-2">
                            <div class="fw-bold text-dark fs-8 text-truncate">
                                <i class="fa-solid fa-building-circle-check text-brand-purple me-1"></i>
                                <span id="kasir-active-outlet-name">Outlet Pusat (Jl. Pajajaran)</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-warning text-white w-100 fw-bold fs-8" onclick="openKasirSwitchOutletModal()">
                            <i class="fa-solid fa-key me-1"></i> Ganti Cabang (PIN)
                        </button>
                    </div>

                    <nav class="nav flex-column fs-7" id="kasir-sidebar-nav">
                        <a class="nav-link active" href="#" onclick="switchKasirTab('preorder')"><i class="fa-solid fa-clipboard-check"></i> Daftar Pre-Order</a>
                        <a class="nav-link" href="#" onclick="switchKasirTab('pos')"><i class="fa-solid fa-store"></i> Kasir POS Walk-In</a>
                        <a class="nav-link" href="#" onclick="switchKasirTab('leftover')"><i class="fa-solid fa-clipboard-list"></i> Rekapan Penjualan Hari Ini</a>
                    </nav>

                    <div class="mt-4 pt-3 border-top border-purple-200 px-1">
                        <form method="POST" action="{{ route('kasir.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-brand-yellow w-100 fw-bold text-dark fs-8 d-flex align-items-center justify-content-center gap-2 py-2">
                                <i class="fa-solid fa-right-from-bracket"></i> Keluar Portal
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex-grow-1 p-4 overflow-auto">
                    <!-- Lock Card for Unauthenticated Cashier -->
                    <div id="kasir-unauth-lock-card" class="card-custom p-5 text-center my-4 border-purple-200" style="display:none;">
                        <div class="mb-3 text-brand-purple">
                            <i class="fa-solid fa-store-slash fa-4x opacity-75"></i>
                        </div>
                        <h4 class="fw-bold text-brand-purple mb-2">Kasir Belum Login Cabang</h4>
                        <p class="text-muted fs-7 mb-4 mx-auto" style="max-width: 520px;">
                            Silakan pilih cabang bertugas dan masukkan <b>PIN Akses Kasir</b> terlebih dahulu untuk membuka menu Daftar Pre-Order, Kasir POS Walk-In, dan Rekapan Penjualan Hari Ini.
                        </p>
                        <div>
                            <button type="button" class="btn btn-brand-purple btn-lg px-4 py-2.5 fw-bold fs-7 shadow-sm" onclick="openKasirSwitchOutletModal()">
                                <i class="fa-solid fa-key me-2"></i> Login & Pilih Cabang Bertugas (PIN)
                            </button>
                        </div>
                    </div>

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
                                    <h6 class="fw-bold mb-3" id="pos-products-heading"><i class="fa-solid fa-calendar-day text-brand-purple me-1"></i> Pilih Produk Mamam Yuk Ready Stock</h6>
                                    <div id="pos-products-grid" class="row g-2"></div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card-custom p-3">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3">Keranjang Transaksi POS</h6>
                                    <div id="pos-cart-list" class="d-flex flex-column gap-2 mb-3 fs-7"></div>
                                    <div class="border-top pt-2">
                                        <div class="d-flex justify-content-between text-muted fs-8 mb-1">
                                            <span>Subtotal:</span>
                                            <span id="pos-subtotal-display" class="fw-bold text-dark">Rp 0</span>
                                        </div>

                                        <!-- Input Diskon Belanja -->
                                        <div class="mb-3 p-2 bg-light rounded border">
                                            <label class="form-label fs-8 fw-bold text-brand-purple mb-1 d-block">
                                                <i class="fa-solid fa-tags me-1"></i> Diskon Belanja (Opsional)
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <select id="pos-discount-type" class="form-select fs-8 fw-bold text-brand-purple" style="max-width: 85px;" onchange="updatePosDiscount()">
                                                    <option value="rp">Rp</option>
                                                    <option value="percent">%</option>
                                                </select>
                                                <input type="number" id="pos-discount-value" class="form-control fs-8 fw-bold text-dark" placeholder="Masukkan diskon..." min="0" oninput="updatePosDiscount()">
                                            </div>
                                            <div id="pos-discount-amount-display" class="fs-8 text-danger fw-bold mt-1 text-end" style="display:none;"></div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center fw-bold fs-5 mb-3">
                                            <span>Total Bayar:</span>
                                            <span id="pos-total-display" class="text-brand-purple">Rp 0</span>
                                        </div>

                                        <!-- Pilihan Cetak Belanja (Ya / Engga) -->
                                        <div class="mb-3 p-2.5 bg-purple-light rounded-3 border border-purple-200">
                                            <label class="form-label fs-8 fw-bold text-brand-purple mb-1.5 d-block"><i class="fa-solid fa-print me-1"></i> Cetak Struk Belanja?</label>
                                            <div class="d-flex gap-4 fs-7 fw-bold">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="posPrintReceipt" id="posPrintYes" value="yes" checked>
                                                    <label class="form-check-label text-dark cursor-pointer" for="posPrintYes">Ya (Cetak)</label>
                                                </div>
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="posPrintReceipt" id="posPrintNo" value="no">
                                                    <label class="form-check-label text-dark cursor-pointer" for="posPrintNo">Engga</label>
                                                </div>
                                            </div>
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
                                <h4 class="fw-bold text-danger mb-0"><i class="fa-solid fa-clipboard-list me-2"></i> Rekapan Penjualan Hari Ini</h4>
                                <div class="text-muted fs-8">Terhitung otomatis bersih dari stok alokasi dikurangi penjualan POS kasir.</div>
                            </div>
                            <button class="btn btn-danger fw-bold rounded-pill px-3" onclick="submitAllKasirLeftovers()">
                                <i class="fa-solid fa-paper-plane me-1"></i> Kirim Rekap Laporan Hari Ini
                            </button>
                        </div>
                        <div class="card-custom p-3 border-danger border-opacity-50">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Varian Produk Mamam Yuk</th>
                                            <th>Harga / Cup</th>
                                            <th>Pre-Order (Cup)</th>
                                            <th>Stok Hari Ini</th>
                                            <th>Terjual POS (Cup)</th>
                                            <th>Sisa Tidak Laku (Cup)</th>
                                            <th>Total Keuntungan</th>
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
                        <a class="nav-link" href="#" onclick="switchAdminTab('produk')"><i class="fa-solid fa-bowl-food"></i> Master Produk Mamam Yuk</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('pesanan')"><i class="fa-solid fa-cart-shopping"></i> Pesanan Per Outlet</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('dapur')"><i class="fa-solid fa-industry"></i> Rekap Dapur Masak</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('stok')"><i class="fa-solid fa-boxes-stacked"></i> Persediaan Bahan Baku</a>
                        <a class="nav-link" href="#" onclick="switchAdminTab('laporan-outlet')"><i class="fa-solid fa-file-invoice-dollar"></i> Laporan Per Outlet</a>
                    </nav>

                    <div class="mt-4 pt-3 border-top border-purple-200 px-1">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-brand-yellow w-100 fw-bold text-dark fs-8 d-flex align-items-center justify-content-center gap-2 py-2">
                                <i class="fa-solid fa-right-from-bracket"></i> Keluar Portal
                            </button>
                        </form>
                    </div>
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
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-bowl-food text-brand-purple me-2"></i> Master Data Produk Mamam Yuk</h4>
                                <p class="text-muted fs-7 mb-0">Kelola varian produk, harga, dan ketersediaan stok ready di outlet.</p>
                            </div>
                            <button class="btn btn-brand-yellow fw-bold" onclick="showAddProductModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Varian Baru</button>
                        </div>
                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr><th>Foto</th><th>ID</th><th>Varian Mamam Yuk</th><th>Harga / Cup</th><th>Kategori</th><th>Usia</th><th>Stok Ready</th><th>Status</th><th class="text-center">Aksi Admin</th></tr>
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
                                <p class="text-muted fs-7 mb-0">Pantau siapa memesan apa di cabang mana. Pesanan otomatis di-reset setiap pergantian hari.</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-brand-yellow btn-sm fw-bold px-3 py-1.5 fs-8" onclick="showAddManualOrderModal()">
                                    <i class="fa-solid fa-plus-circle me-1"></i> Tambah Pesanan Manual
                                </button>
                                <button class="btn btn-brand-purple btn-sm fw-bold px-3 py-1.5 fs-8" onclick="printAdminPesananReport()">
                                    <i class="fa-solid fa-print me-1"></i> Cetak Rekap Pesanan
                                </button>
                                <button class="btn btn-sm btn-outline-danger fs-8 fw-bold" onclick="confirmResetAllOrders()"><i class="fa-solid fa-trash-can me-1"></i> Bersihkan Pesanan Hari Ini</button>
                                <select id="adm-pesanan-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderAdminPesananPerOutlet()">
                                    <option value="ALL">SEMUA CABANG OUTLET</option>
                                </select>
                            </div>
                        </div>

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

                        <div class="card-custom p-3 mt-4 border-purple-200">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                <h6 class="fw-bold text-brand-purple mb-0">
                                    <i class="fa-solid fa-list-check me-2"></i> Rekap Total Jumlah Menu Yang Dipesan Pelanggan
                                </h6>
                                <span class="badge bg-brand-purple fs-8" id="adm-pesanan-total-badge">Total: 0 Cup</span>
                            </div>
                            <div id="adm-pesanan-summary-content"></div>
                        </div>

                        <div class="card-custom p-3 mt-4 border-purple-200">
                            <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-2 mb-3 gap-2">
                                <div>
                                    <h6 class="fw-bold text-brand-purple mb-0">
                                        <i class="fa-solid fa-boxes-packing me-2"></i> Atur Stok Produk Per Cabang Outlet / Kasir (Dikelompokkan Sesuai Hari)
                                    </h6>
                                    <div class="text-muted fs-8">Atur ketersediaan stok ready produk secara independen untuk masing-masing cabang outlet/kasir dikelompokkan berdasarkan jadwal hari.</div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label fs-8 fw-bold mb-0 text-dark">Filter Hari:</label>
                                        <select id="adm-stock-day-select" class="form-select form-select-sm fs-8 w-auto fw-bold text-brand-purple border-purple-200" onchange="renderAdminOutletStockTable()">
                                            <option value="ALL">Semua Hari (Kelompokan)</option>
                                            <option value="Senin">Hari Senin</option>
                                            <option value="Selasa">Hari Selasa</option>
                                            <option value="Rabu">Hari Rabu</option>
                                            <option value="Kamis">Hari Kamis</option>
                                            <option value="Jumat">Hari Jumat</option>
                                            <option value="Sabtu">Hari Sabtu</option>
                                            <option value="Minggu">Hari Minggu</option>
                                        </select>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label fs-8 fw-bold mb-0 text-dark">Pilih Cabang Outlet:</label>
                                        <select id="adm-stock-outlet-select" class="form-select form-select-sm fs-8 w-auto fw-bold text-brand-purple border-purple-200" onchange="renderAdminOutletStockTable()">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Varian Produk Mamam Yuk</th>
                                            <th>Kategori & Usia</th>
                                            <th>Harga / Cup</th>
                                            <th>Stok Ready Cabang (Cup)</th>
                                            <th class="text-center">Aksi / Atur Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody id="adm-outlet-stock-tbody"></tbody>
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
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-brand-yellow btn-sm fw-bold px-3 py-1.5 fs-8" onclick="showAddManualOrderModal()">
                                    <i class="fa-solid fa-plus-circle me-1"></i> Tambah Pesanan Manual
                                </button>
                                <button class="btn btn-brand-purple btn-sm fw-bold px-3 py-1.5 fs-8" onclick="printDapurMasakReport('adm-dapur-outlet-filter')">
                                    <i class="fa-solid fa-print me-1"></i> Cetak Rekap Dapur
                                </button>
                                <select id="adm-dapur-day-filter" class="form-select form-select-sm fs-8 w-auto fw-bold text-brand-purple border-purple-200" onchange="renderAdminProduction()">
                                    <option value="ALL">Semua Hari (Kelompokan)</option>
                                    <option value="Senin">Hari Senin</option>
                                    <option value="Selasa">Hari Selasa</option>
                                    <option value="Rabu">Hari Rabu</option>
                                    <option value="Kamis">Hari Kamis</option>
                                    <option value="Jumat">Hari Jumat</option>
                                    <option value="Sabtu">Hari Sabtu</option>
                                    <option value="Minggu">Hari Minggu</option>
                                </select>
                                <select id="adm-dapur-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderAdminProduction()">
                                    <option value="ALL">SEMUA OUTLET (KONSOLIDASI)</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-custom p-3 mt-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light"><tr><th>Varian Mamam Yuk</th><th>Pre-Order Online</th><th>Pre-Order Manual</th><th>Stok Produk</th><th>Total Porsi Masak</th></tr></thead>
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
                                            <th>Omset (Rp)</th>
                                            <th>Porsi Terjual</th>
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
                                            <th>Varian Produk Mamam Yuk</th>
                                            <th>Stok Alokasi</th>
                                            <th>Terjual (Cup)</th>
                                            <th>Sisa Tidak Laku (Cup)</th>
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
                        <a class="nav-link" href="#" onclick="switchOwnerTab('produk')"><i class="fa-solid fa-bowl-food"></i> Master Produk Mamam Yuk</a>
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
                        <a class="nav-link" href="#" onclick="switchOwnerTab('pengeluaran')">
                            <i class="fa-solid fa-receipt"></i> Kelola Pengeluaran
                        </a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('resetpass')">
                            <i class="fa-solid fa-key"></i> Reset Password Pelanggan
                            <span id="owner-resetpass-badge" class="badge bg-danger fs-8 ms-auto" style="display:none;">0</span>
                        </a>
                        <a class="nav-link" href="#" onclick="switchOwnerTab('background')">
                            <i class="fa-solid fa-image"></i> Ubah Latar Belakang
                        </a>
                    </nav>

                    <div class="mt-4 pt-3 border-top border-purple-200 px-1">
                        <form method="POST" action="{{ route('owner.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-brand-yellow w-100 fw-bold text-dark fs-8 d-flex align-items-center justify-content-center gap-2 py-2">
                                <i class="fa-solid fa-right-from-bracket"></i> Keluar Portal
                            </button>
                        </form>
                    </div>
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
                                            <thead class="bg-light"><tr><th>Cabang Outlet</th><th>Omset (Rp)</th><th>Porsi Terjual</th></tr></thead>
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
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-bowl-food text-brand-purple me-2"></i> Master Data Produk Mamam Yuk</h4>
                                <p class="text-muted fs-7 mb-0">Owner dapat menambah, mengedit, restok, mengubah status, maupun menghapus varian produk.</p>
                            </div>
                            <button class="btn btn-brand-yellow fw-bold" onclick="showAddProductModal()"><i class="fa-solid fa-plus me-1"></i> Tambah Varian Baru</button>
                        </div>
                        <div class="card-custom p-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr><th>Foto</th><th>ID</th><th>Varian Mamam Yuk</th><th>Harga / Cup</th><th>Kategori</th><th>Usia</th><th>Stok Ready</th><th>Status</th><th class="text-center">Aksi Owner</th></tr>
                                    </thead>
                                    <tbody id="own-products-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-praorder" class="owner-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-clipboard-check text-brand-purple me-2"></i> Monitor Pre-Order Seluruh Cabang</h4>
                                <p class="text-muted fs-7 mb-0">Owner bisa melihat dan mengubah status pembayaran/ambil, serta menyetujui/menolak pembatalan (otomatis reset per hari).</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-brand-yellow btn-sm fw-bold px-3 py-1.5 fs-8" onclick="showAddManualOrderModal()">
                                    <i class="fa-solid fa-plus-circle me-1"></i> Tambah Pesanan Manual
                                </button>
                                <button class="btn btn-sm btn-outline-danger fs-8 fw-bold" onclick="confirmResetAllOrders()"><i class="fa-solid fa-trash-can me-1"></i> Bersihkan Pesanan Hari Ini</button>
                            </div>
                        </div>
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

                        <div class="card-custom p-3 mt-4 border-purple-200">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                <h6 class="fw-bold text-brand-purple mb-0">
                                    <i class="fa-solid fa-list-check me-2"></i> Rekap Total Jumlah Menu Yang Dipesan Pelanggan
                                </h6>
                                <span class="badge bg-brand-purple fs-8" id="own-pesanan-total-badge">Total: 0 Cup</span>
                            </div>
                            <div id="own-pesanan-summary-content"></div>
                        </div>
                    </div>

                    <div id="owner-tab-dapur" class="owner-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-1 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-industry text-brand-purple me-2"></i> Rekapitulasi Dapur Masak Esok Hari</h4>
                                <p class="text-muted fs-7 mb-0">Terintegrasi dengan data Pesanan Per Outlet: Total Porsi Masak dihitung murni dari pre-order online yang masih berlaku (tanpa buffer walk-in).</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-brand-yellow btn-sm fw-bold px-3 py-1.5 fs-8" onclick="showAddManualOrderModal()">
                                    <i class="fa-solid fa-plus-circle me-1"></i> Tambah Pesanan Manual
                                </button>
                                <button class="btn btn-brand-purple btn-sm fw-bold px-3 py-1.5 fs-8" onclick="printDapurMasakReport('own-dapur-outlet-filter')">
                                    <i class="fa-solid fa-print me-1"></i> Cetak Rekap Dapur
                                </button>
                                <select id="own-dapur-day-filter" class="form-select form-select-sm fs-8 w-auto fw-bold text-brand-purple border-purple-200" onchange="renderOwnerProduction()">
                                    <option value="ALL">Semua Hari (Kelompokan)</option>
                                    <option value="Senin">Hari Senin</option>
                                    <option value="Selasa">Hari Selasa</option>
                                    <option value="Rabu">Hari Rabu</option>
                                    <option value="Kamis">Hari Kamis</option>
                                    <option value="Jumat">Hari Jumat</option>
                                    <option value="Sabtu">Hari Sabtu</option>
                                    <option value="Minggu">Hari Minggu</option>
                                </select>
                                <select id="own-dapur-outlet-filter" class="form-select form-select-sm fs-8 w-auto fw-bold" onchange="renderOwnerProduction()">
                                    <option value="ALL">SEMUA OUTLET (KONSOLIDASI)</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-custom p-3 mt-3">
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light"><tr><th>Varian Mamam Yuk</th><th>Pre-Order Online</th><th>Pre-Order Manual</th><th>Stok Produk</th><th>Total Porsi Masak</th></tr></thead>
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
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-file-invoice-dollar text-brand-purple me-2"></i> Laporan Penjualan Semua Cabang</h4>
                                <p class="text-muted fs-7 mb-0">Owner memantau omset harian & bulanan serta porsi terjual per cabang.</p>
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
                                            <th>Omset (Rp)</th>
                                            <th>Porsi Terjual</th>
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
                                            <th>Varian Produk Mamam Yuk</th>
                                            <th>Stok Alokasi</th>
                                            <th>Terjual (Cup)</th>
                                            <th>Sisa Tidak Laku (Cup)</th>
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
                                            <tr><th>Varian Mamam Yuk</th><th>Harga / Cup</th><th>Poin Kustom / Cup</th><th class="text-center">Aksi</th></tr>
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

                    <div id="owner-tab-pengeluaran" class="owner-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-receipt text-brand-purple me-2"></i> Catatan Pengeluaran Operasional</h4>
                                <p class="text-muted fs-7 mb-0">Catat dan kelola pengeluaran harian/bulanan. Anda dapat menambah, mengedit <b>nama barang yang dibeli</b>, nominal, dan kategori.</p>
                            </div>
                            <button class="btn btn-brand-purple fw-bold px-3 py-2" onclick="showAddExpenseModal()"><i class="fa-solid fa-plus-circle me-1"></i> Tambah Pengeluaran Baru</button>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="card-custom p-3 border-start border-4 border-danger">
                                    <div class="text-muted fs-8 fw-bold">TOTAL PENGELUARAN HARI INI</div>
                                    <div class="fs-4 fw-bold text-danger" id="exp-total-today">Rp 0</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-custom p-3 border-start border-4 border-warning">
                                    <div class="text-muted fs-8 fw-bold">TOTAL PENGELUARAN BULAN INI</div>
                                    <div class="fs-4 fw-bold text-warning" id="exp-total-month">Rp 0</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-custom p-3 border-start border-4 border-info">
                                    <div class="text-muted fs-8 fw-bold">TOTAL ITEM PENGELUARAN</div>
                                    <div class="fs-4 fw-bold text-info" id="exp-total-items">0 Item</div>
                                </div>
                            </div>
                        </div>

                        <div class="card-custom p-3 border-purple-200">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                <div class="fw-bold text-brand-purple fs-7"><i class="fa-solid fa-boxes-stacked me-1"></i> Daftar Barang Dibeli & Pengeluaran Operasional</div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle fs-7 mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Barang Yang Dibeli</th>
                                            <th>Kategori</th>
                                            <th>Biaya / Nominal</th>
                                            <th>Catatan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="owner-expenses-tbody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="owner-tab-background" class="owner-tab-content" style="display:none;">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h4 class="fw-bold text-dark mb-0"><i class="fa-solid fa-image text-brand-purple me-2"></i> Pengaturan Gambar Latar Belakang</h4>
                                <p class="text-muted fs-7 mb-0">Ubah gambar latar belakang (background) portal login dan tampilan pelanggan secara langsung dari Portal Owner.</p>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-lg-7">
                                <div class="card-custom p-4 border-purple-200 shadow-sm h-100">
                                    <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3">
                                        <i class="fa-solid fa-upload me-2"></i> Pilih / Unggah Gambar Latar Belakang
                                    </h6>
                                    
                                    <form id="owner-bg-form" onsubmit="saveOwnerBgImage(event)">
                                        <!-- Opsi 1: Unggah File Gambar -->
                                        <div class="mb-3">
                                            <label class="form-label fs-7 fw-bold text-dark mb-1">
                                                <i class="fa-solid fa-file-image me-1 text-brand-purple"></i> Unggah File Gambar Baru (Komputer / HP)
                                            </label>
                                            <input type="file" id="owner-bg-file-input" class="form-control form-control-sm border-purple-200" accept="image/*" onchange="handleBgFileSelect(event)">
                                            <div class="form-text fs-8 text-muted mt-1">Format didukung: JPG, PNG, WEBP (Maksimal 5MB).</div>
                                        </div>

                                        <div class="d-flex align-items-center my-3">
                                            <hr class="flex-grow-1 border-purple-200 my-0">
                                            <span class="px-3 text-muted fs-8 fw-bold text-uppercase">ATAU</span>
                                            <hr class="flex-grow-1 border-purple-200 my-0">
                                        </div>

                                        <!-- Opsi 2: URL Gambar -->
                                        <div class="mb-3">
                                            <label class="form-label fs-7 fw-bold text-dark mb-1">
                                                <i class="fa-solid fa-link me-1 text-brand-purple"></i> Masukkan Link / URL Gambar Web
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-purple-light border-purple-200 text-brand-purple"><i class="fa-solid fa-globe"></i></span>
                                                <input type="url" id="owner-bg-url-input" class="form-control border-purple-200 fs-7 fw-semibold" placeholder="https://example.com/gambar-background.jpg" oninput="handleBgUrlInput(event)">
                                            </div>
                                        </div>

                                        <!-- Opsi 3: Preset Pilihan -->
                                        <div class="mb-4">
                                            <label class="form-label fs-7 fw-bold text-dark mb-2">
                                                <i class="fa-solid fa-palette me-1 text-brand-purple"></i> Gunakan Preset Background Siap Pakai:
                                            </label>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-purple fw-bold fs-8" onclick="applyBgPreset('/images/bg-login.jpg')">
                                                    <i class="fa-solid fa-rotate-left me-1"></i> Asli (Mamam Yuk Default)
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning text-dark fw-bold fs-8" onclick="applyBgPreset('https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1600&q=80')">
                                                    <i class="fa-solid fa-carrot me-1"></i> Healthy Organic Food
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-info text-dark fw-bold fs-8" onclick="applyBgPreset('https://images.unsplash.com/photo-1555244162-803834f70033?auto=format&fit=crop&w=1600&q=80')">
                                                    <i class="fa-solid fa-utensils me-1"></i> Warm Kitchen & Bakery
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-success fw-bold fs-8" onclick="applyBgPreset('https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=1600&q=80')">
                                                    <i class="fa-solid fa-leaf me-1"></i> Fresh Veggies Pastel
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2 pt-3 border-top">
                                            <button type="submit" class="btn btn-brand-purple fw-bold py-2 px-4 shadow-sm fs-7">
                                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Gambar Latar Belakang
                                            </button>
                                            <button type="button" class="btn btn-outline-danger fw-bold py-2 px-3 fs-7" onclick="resetBgToDefault()">
                                                <i class="fa-solid fa-arrow-rotate-left me-1"></i> Reset Default
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="card-custom p-4 border-purple-200 shadow-sm h-100 bg-light">
                                    <h6 class="fw-bold text-brand-purple border-bottom pb-2 mb-3">
                                        <i class="fa-solid fa-eye me-2"></i> Live Preview Tampilan Latar Belakang
                                    </h6>
                                    
                                    <div id="owner-bg-preview-card" class="rounded-4 overflow-hidden shadow-lg p-4 d-flex flex-column align-items-center justify-content-center text-center position-relative" style="min-height: 280px; background-size: cover; background-position: center; transition: all 0.3s ease;">
                                        <div class="position-absolute inset-0 bg-dark bg-opacity-40" style="backdrop-filter: blur(2px);"></div>
                                        
                                        <div class="position-relative z-1 bg-white bg-opacity-95 p-4 rounded-4 shadow border w-100" style="max-width: 320px;">
                                            <div class="bg-brand-yellow text-dark p-2 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width:48px;height:48px;">
                                                <i class="fa-solid fa-user-shield fs-5"></i>
                                            </div>
                                            <h6 class="fw-bold text-brand-purple mb-1">Portal Mamam Yuk</h6>
                                            <p class="text-muted fs-8 mb-3">Tampilan login dengan background baru.</p>
                                            <button type="button" class="btn btn-brand-purple btn-sm w-100 fw-bold disabled" style="opacity:0.85;">Contoh Tombol Login</button>
                                        </div>
                                    </div>
                                    <div class="fs-8 text-muted text-center mt-3">
                                        <i class="fa-solid fa-circle-info me-1 text-brand-purple"></i> Preview di atas akan langsung berubah sesuai pilihan gambar Anda secara realtime.
                                    </div>
                                </div>
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
            kasirActiveOutlet: (() => { try { const saved = sessionStorage.getItem('auth_kasir_outlet'); return saved || null; } catch(e) { return null; } })(),
            authenticatedKasirOutlet: (() => { try { const saved = sessionStorage.getItem('auth_kasir_outlet'); return saved || null; } catch(e) { return null; } })(),
            isStoreOpen: true,
            currentUser: (() => { try { const saved = localStorage.getItem('mpasi_current_user'); return saved ? JSON.parse(saved) : null; } catch(e) { return null; } })(),
            outletStock: (() => { try { const saved = localStorage.getItem('mamamyuk_outlet_stock'); return saved ? JSON.parse(saved) : {}; } catch(e) { return {}; } })(),
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
            preOrders: (() => {
                try {
                    const d = new Date();
                    const todayStr = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
                    d.setDate(d.getDate() - 1);
                    const yesterdayStr = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;

                    const dbOrders = Array.isArray(window.MPASI_DATA?.preOrders) ? window.MPASI_DATA.preOrders : [];
                    const saved = localStorage.getItem('mpasi_customer_orders');
                    const localOrders = saved ? (JSON.parse(saved) || []) : [];

                    const combinedMap = {};
                    dbOrders.forEach(o => {
                        if (o && o.id) combinedMap[String(o.id)] = o;
                    });
                    localOrders.forEach(o => {
                        if (o && o.id) {
                            if (!combinedMap[String(o.id)]) {
                                combinedMap[String(o.id)] = o;
                            } else {
                                if (o.isPaid !== undefined) combinedMap[String(o.id)].isPaid = o.isPaid;
                                if (o.isTaken !== undefined) combinedMap[String(o.id)].isTaken = o.isTaken;
                                if (o.cancelStatus !== undefined) combinedMap[String(o.id)].cancelStatus = o.cancelStatus;
                                if (o.cancelReason !== undefined) combinedMap[String(o.id)].cancelReason = o.cancelReason;
                            }
                        }
                    });

                    const combinedList = Object.values(combinedMap);
                    const filtered = combinedList.map(order => {
                        if (!order.date) order.date = todayStr;
                        return order;
                    }).filter(order => order.date === todayStr || order.date === yesterdayStr);

                    localStorage.setItem('mpasi_customer_orders', JSON.stringify(filtered));
                    return filtered;
                } catch(e) { return []; }
            })(),
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
            members: (() => {
                try {
                    const saved = localStorage.getItem('mamamyuk_members');
                    if (saved) return JSON.parse(saved);
                } catch(e){}
                return {};
            })(),
            pointRewards: [
                { id: 'RWD-1', name: 'Voucher Potongan Rp 5.000', pointsCost: 50, description: 'Potongan langsung Rp 5.000 untuk pembelian berikutnya di semua outlet.' },
                { id: 'RWD-2', name: 'Voucher Potongan Rp 10.000', pointsCost: 90, description: 'Potongan langsung Rp 10.000 untuk pembelian berikutnya di semua outlet.' },
                { id: 'RWD-3', name: 'Voucher Potongan Rp 25.000', pointsCost: 220, description: 'Potongan langsung Rp 25.000, cocok untuk belanja borongan mingguan.' },
                { id: 'RWD-4', name: 'Gratis 1 Cup Puding Alpukat Kurma', pointsCost: 150, description: 'Tukar poin dengan 1 cup Puding Alpukat Kurma gratis, tunjukkan kode ke Kasir saat ambil.' }
            ],
            pointsEarnRate: 1000,
            expenses: (() => {
                try {
                    const saved = localStorage.getItem('mpasi_owner_expenses');
                    if (saved) return JSON.parse(saved);
                } catch(e){}
                const d = new Date();
                const todayStr = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
                return [
                    { id: 'EXP-101', name: 'Gas LPG 3kg (2 Tabung)', amount: 44000, category: 'Bahan Baku & Dapur', date: todayStr, note: 'Pembelian gas dapur utama' },
                    { id: 'EXP-102', name: 'Cup Kemasan Mamam Yuk (500 Pcs)', amount: 125000, category: 'Peralatan & Stiker', date: todayStr, note: 'Restok cup 100ml' },
                    { id: 'EXP-103', name: 'Plastik Packing & Sendok Bayi', amount: 35000, category: 'Peralatan & Stiker', date: todayStr, note: 'Perlengkapan kemasan' }
                ];
            })()
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
                const isAuth = !!(state.authenticatedKasirOutlet && state.outlets.includes(state.authenticatedKasirOutlet));
                if (!isAuth) {
                    const unauthCard = document.getElementById('kasir-unauth-lock-card');
                    if (unauthCard) unauthCard.style.display = 'block';
                    document.querySelectorAll('.kasir-tab-content').forEach(el => el.style.display = 'none');
                    openKasirSwitchOutletModal();
                }
            }
        }
        function switchKasirTab(tabName) {
            const isAuth = !!(state.authenticatedKasirOutlet && state.outlets.includes(state.authenticatedKasirOutlet));
            if (!isAuth) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Kasir Belum Login 🔒',
                    text: 'Silakan pilih cabang bertugas dan masukkan PIN akses kasir terlebih dahulu!',
                    confirmButtonText: '🔑 Login / Pilih Cabang (PIN)',
                    confirmButtonColor: '#6A1B9A'
                }).then(() => {
                    openKasirSwitchOutletModal();
                });
                return;
            }
            const unauthCard = document.getElementById('kasir-unauth-lock-card');
            if (unauthCard) unauthCard.style.display = 'none';
            document.querySelectorAll('.kasir-tab-content').forEach(el => el.style.display = 'none');
            document.querySelectorAll('#kasir-sidebar-nav .nav-link').forEach(el => el.classList.remove('active'));
            const target = document.getElementById('kasir-tab-' + tabName);
            if (target) target.style.display = 'block';
            if (window.event && window.event.currentTarget) {
                window.event.currentTarget.classList.add('active');
            }
        }
        function switchAdminTab(tabName) { document.querySelectorAll('.admin-tab-content').forEach(el => el.style.display = 'none'); document.querySelectorAll('#admin-sidebar-nav .nav-link').forEach(el => el.classList.remove('active')); const target = document.getElementById('admin-tab-' + tabName); if (target) target.style.display = 'block'; if (window.event && window.event.currentTarget) { window.event.currentTarget.classList.add('active'); } }
        function switchOwnerTab(tabName) { document.querySelectorAll('.owner-tab-content').forEach(el => el.style.display = 'none'); document.querySelectorAll('#owner-sidebar-nav .nav-link').forEach(el => el.classList.remove('active')); const target = document.getElementById('owner-tab-' + tabName); if (target) target.style.display = 'block'; if (window.event && window.event.currentTarget) { window.event.currentTarget.classList.add('active'); } if (tabName === 'poin') renderOwnerProductPointsTable(); if (tabName === 'pengeluaran') renderOwnerExpenses(); if (tabName === 'background') initOwnerBgTab(); }

        let ownerSelectedBgImage = '{{ $settings["bg_login_image"] ?? "/images/bg-login.jpg" }}';
        let ownerBgFileObj = null;

        function updateBgPreview(url) {
            const previewEl = document.getElementById('owner-bg-preview-card');
            if (previewEl) {
                previewEl.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.5)), url('${url}')`;
            }
        }

        function applyDynamicBgCss(url) {
            let dynamicStyle = document.getElementById('dynamic-bg-style');
            if (!dynamicStyle) {
                dynamicStyle = document.createElement('style');
                dynamicStyle.id = 'dynamic-bg-style';
                document.head.appendChild(dynamicStyle);
            }
            dynamicStyle.innerHTML = `
                .login-bg-container {
                    background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.5)), url('${url}') !important;
                }
                .login-portal-bg {
                    background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.55)), url('${url}') !important;
                }
            `;
        }

        function initOwnerBgTab() {
            const currentBg = state.settings?.bg_login_image || ownerSelectedBgImage || '/images/bg-login.jpg';
            ownerSelectedBgImage = currentBg;
            ownerBgFileObj = null;
            const fileInput = document.getElementById('owner-bg-file-input');
            const urlInput = document.getElementById('owner-bg-url-input');
            if (fileInput) fileInput.value = '';
            if (urlInput) {
                urlInput.value = (currentBg.startsWith('http') || currentBg.startsWith('/images/bg-')) ? (currentBg.startsWith('http') ? currentBg : '') : '';
            }
            updateBgPreview(currentBg);
        }

        function handleBgFileSelect(event) {
            const file = event.target.files[0];
            if (!file) return;
            ownerBgFileObj = file;
            const reader = new FileReader();
            reader.onload = function(e) {
                ownerSelectedBgImage = e.target.result;
                const urlInput = document.getElementById('owner-bg-url-input');
                if (urlInput) urlInput.value = '';
                updateBgPreview(ownerSelectedBgImage);
            };
            reader.readAsDataURL(file);
        }

        function handleBgUrlInput(event) {
            const url = event.target.value.trim();
            ownerBgFileObj = null;
            const fileInput = document.getElementById('owner-bg-file-input');
            if (fileInput) fileInput.value = '';
            if (url) {
                ownerSelectedBgImage = url;
                updateBgPreview(url);
            } else {
                ownerSelectedBgImage = '/images/bg-login.jpg';
                updateBgPreview('/images/bg-login.jpg');
            }
        }

        function applyBgPreset(url) {
            ownerBgFileObj = null;
            ownerSelectedBgImage = url;
            const fileInput = document.getElementById('owner-bg-file-input');
            const urlInput = document.getElementById('owner-bg-url-input');
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = url.startsWith('http') ? url : '';
            updateBgPreview(url);
            Swal.fire({
                icon: 'info',
                title: 'Preset Dipilih!',
                text: 'Klik "Simpan Gambar Latar Belakang" untuk menerapkan ke seluruh sistem.',
                timer: 1500,
                showConfirmButton: false
            });
        }

        function resetBgToDefault() {
            ownerBgFileObj = null;
            ownerSelectedBgImage = '/images/bg-login.jpg';
            const fileInput = document.getElementById('owner-bg-file-input');
            const urlInput = document.getElementById('owner-bg-url-input');
            if (fileInput) fileInput.value = '';
            if (urlInput) urlInput.value = '';
            updateBgPreview('/images/bg-login.jpg');
            
            Swal.fire({
                title: 'Reset ke Gambar Default?',
                text: 'Gambar latar belakang akan dikembalikan ke gambar standar Mamam Yuk.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Reset Sekarang',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6A1B9A'
            }).then(res => {
                if (res.isConfirmed) {
                    saveOwnerBgImageDirect('/images/bg-login.jpg');
                }
            });
        }

        function saveOwnerBgImage(e) {
            if (e) e.preventDefault();
            
            if (ownerBgFileObj) {
                const formData = new FormData();
                formData.append('image_file', ownerBgFileObj);
                formData.append('_token', '{{ csrf_token() }}');
                
                startLoading();
                fetch('/api/settings/bg-image', {
                    method: 'POST',
                    body: formData
                }).then(async r => {
                    const data = await r.json().catch(() => ({}));
                    if (!r.ok || data.success === false) {
                        throw new Error(data.message || 'Gagal mengunggah gambar latar belakang');
                    }
                    return data;
                }).then(data => {
                    state.settings = state.settings || {};
                    state.settings['bg_login_image'] = data.bg_image;
                    ownerSelectedBgImage = data.bg_image;
                    applyDynamicBgCss(data.bg_image);
                    updateBgPreview(data.bg_image);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Disimpan! 🎉',
                        text: 'Gambar latar belakang portal berhasil diperbarui.',
                        timer: 1600,
                        showConfirmButton: false
                    });
                }).catch(err => {
                    Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: err.message || 'Terjadi kesalahan saat mengunggah.' });
                }).finally(() => {
                    endLoading();
                });
            } else {
                saveOwnerBgImageDirect(ownerSelectedBgImage);
            }
        }

        function saveOwnerBgImageDirect(bgUrl) {
            startLoading();
            fetch('/api/settings/bg-image', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ bg_image: bgUrl })
            }).then(async r => {
                const data = await r.json().catch(() => ({}));
                if (!r.ok || data.success === false) {
                    throw new Error(data.message || 'Gagal menyimpan gambar latar belakang');
                }
                return data;
            }).then(data => {
                state.settings = state.settings || {};
                state.settings['bg_login_image'] = data.bg_image;
                ownerSelectedBgImage = data.bg_image;
                applyDynamicBgCss(data.bg_image);
                updateBgPreview(data.bg_image);
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Disimpan! 🎉',
                    text: 'Gambar latar belakang portal berhasil diperbarui.',
                    timer: 1600,
                    showConfirmButton: false
                });
            }).catch(err => {
                Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: err.message || 'Terjadi kesalahan sistem.' });
            }).finally(() => {
                endLoading();
            });
        }
        function switchOwnerPoinSubTab(tabName) { const memberPane = document.getElementById('owner-poin-sub-member'); const rewardPane = document.getElementById('owner-poin-sub-reward'); const ratePane = document.getElementById('owner-poin-sub-rate'); if (memberPane) memberPane.style.display = tabName === 'member' ? 'block' : 'none'; if (rewardPane) rewardPane.style.display = tabName === 'reward' ? 'block' : 'none'; if (ratePane) ratePane.style.display = tabName === 'rate' ? 'block' : 'none'; document.querySelectorAll('#owner-poin-subnav .nav-link').forEach(el => { el.classList.remove('active', 'bg-purple-light', 'text-brand-purple', 'border-purple-200'); el.classList.add('border'); }); if (window.event && window.event.currentTarget) { window.event.currentTarget.classList.add('active', 'bg-purple-light', 'text-brand-purple', 'border-purple-200'); } if (tabName === 'rate') { const rateInput = document.getElementById('owner-points-rate-input'); if (rateInput) rateInput.value = state.pointsEarnRate; updatePointsRateExample(); renderOwnerProductPointsTable(); } }
        function switchCustView(viewName) { document.querySelectorAll('.cust-view').forEach(el => el.style.display = 'none'); document.querySelectorAll('.navbar-custom .nav-link').forEach(el => el.classList.remove('active')); document.querySelectorAll('.mobile-nav-item').forEach(el => el.classList.remove('active')); const target = document.getElementById('cust-view-' + viewName); if (target) target.style.display = 'block'; const navTarget = document.getElementById('cust-nav-' + viewName); if (navTarget) navTarget.classList.add('active'); const mobileNavTarget = document.getElementById('mobile-nav-' + viewName); if (mobileNavTarget) mobileNavTarget.classList.add('active'); const mobileBottomNav = document.querySelector('.mobile-bottom-nav'); const custNavContent = document.getElementById('custNavContent'); const custToggler = document.querySelector('.navbar-toggler'); if (viewName === 'login') { if (mobileBottomNav) mobileBottomNav.style.setProperty('display', 'none', 'important'); if (custNavContent) custNavContent.style.setProperty('display', 'none', 'important'); if (custToggler) custToggler.style.setProperty('display', 'none', 'important'); } else { if (mobileBottomNav) mobileBottomNav.style.removeProperty('display'); if (custNavContent) custNavContent.style.removeProperty('display'); if (custToggler) custToggler.style.removeProperty('display'); } if (viewName === 'checkout') prefillCheckoutForm(); if (viewName === 'poin') renderCustomerPointsPage(); if (viewName === 'akun') renderCustomerProfilePage(); window.scrollTo({ top: 0, behavior: 'smooth' }); }
        function updateStoreHoursStatus() { state.isStoreOpen = true; const alertEl = document.getElementById('closed-hours-alert'); const labelEl = document.getElementById('store-hours-label'); const mobileLabelEl = document.getElementById('store-hours-label-mobile'); if (alertEl) alertEl.style.display = 'none'; if (labelEl) labelEl.innerHTML = '<span id="store-hours-dot" class="d-inline-block rounded-circle bg-success" style="width:8px;height:8px;"></span> BUKA 24 Jam'; if (mobileLabelEl) mobileLabelEl.innerHTML = '<span id="store-hours-dot-mobile" class="d-inline-block rounded-circle bg-success" style="width:7px;height:7px;"></span> BUKA'; }
        function getTodayDateString() { const d = new Date(); return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`; }
        function getYesterdayDateString() { const d = new Date(); d.setDate(d.getDate() - 1); return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`; }
        function purgeOldPreOrders() { const todayStr = getTodayDateString(); const yesterdayStr = getYesterdayDateString(); let changed = false; state.preOrders = (state.preOrders || []).filter(order => { if (!order.date) { order.date = todayStr; return true; } if (order.date === todayStr || order.date === yesterdayStr) { return true; } changed = true; return false; }); if (changed) savePreOrdersToStorage(); }
        function confirmResetAllOrders() { Swal.fire({ icon: 'warning', title: 'Bersihkan Semua Pesanan Hari Ini?', text: 'Seluruh pesanan per outlet hari ini akan dihapus agar data baru besok bersih.', showCancelButton: true, confirmButtonText: 'Ya, Bersihkan', cancelButtonText: 'Batal', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { state.preOrders = []; savePreOrdersToStorage(); renderAllUI(); Swal.fire({ icon: 'success', title: 'Pesanan Dibersihkan!', text: 'Seluruh pesanan hari ini berhasil dihapus.', timer: 1500, showConfirmButton: false }); } }); }
        function renderAllUI() { purgeOldPreOrders(); renderOutletDropdowns(); renderHomeProducts(); renderCatalogProducts(); renderCartUI(); renderCustomerHistory(); renderCustomerAuthArea(); renderCustomerPointsPage(); renderCustomerProfilePage(); renderKasirPreOrders(); renderKasirLeftoverTable(); renderPosProductsGrid(); renderAdminProducts('adm-products-tbody', true); renderAdminProduction(); renderAdminInventory(); renderAdminDailyMenuGrid(); renderAdminOutletReports(); renderAdminPesananPerOutlet(); renderOwnerDashboard(); renderOwnerDailyMenuGrid(); renderOwnerProducts(); renderOwnerPreOrders(); renderOwnerProduction(); renderOwnerInventory(); renderOwnerOutletReports(); renderOwnerResetPasswordTable(); renderOwnerOutletsTable(); renderOwnerMembersTable(); renderOwnerRewardsTable(); renderOwnerProductPointsTable(); renderOwnerExpenses(); renderAdminOutletStockTable(); }
        function getTodayProducts() { const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; const todayName = days[new Date().getDay()]; const todayConfig = state.dailyMenu.find(d => (d.day || '').toLowerCase() === todayName.toLowerCase()); if (!todayConfig || !Array.isArray(todayConfig.productIds) || todayConfig.productIds.length === 0) { return []; } const activeIds = todayConfig.productIds.map(String); return state.products.filter(p => activeIds.includes(String(p.id)) && p.status === 'Aktif'); }
        function renderHomeProducts() { const grid = document.getElementById('home-products-grid'); if (!grid) return; const todayProds = getTodayProducts(); const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; const todayName = days[new Date().getDay()]; if (todayProds.length === 0) { grid.innerHTML = `<div class="col-12 text-center py-4 bg-purple-light rounded-3 text-muted"><i class="fa-solid fa-utensils fs-3 mb-2 text-brand-purple d-block"></i><h6 class="fw-bold text-dark">Belum Ada Menu Mamam Yuk untuk Hari ${todayName}</h6><p class="fs-8 mb-0">Menu rotasi harian belum diisi oleh Admin/Owner.</p></div>`; return; } grid.innerHTML = todayProds.slice(0, 3).map(p => ` <div class="col-md-4 mb-3"><div class="card-custom h-100 p-0 overflow-hidden d-flex flex-column justify-content-between border rounded-3 shadow-sm bg-white">${productImageHtml(p)}<div class="p-3 d-flex flex-column justify-content-between flex-grow-1"><div><span class="badge bg-warning text-dark fs-8 fw-bold mb-2">${p.age}</span><h6 class="fw-bold mb-1 text-dark fs-6" style="line-height:1.3;">${p.name}</h6><div class="text-muted fs-8 mb-3" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${p.ingredients}</div></div><div><div class="fw-bold text-brand-purple fs-5 mb-2">Rp ${p.price.toLocaleString('id-ID')}</div><button class="btn btn-brand-yellow btn-sm w-100 fw-bold text-dark py-2" onclick="addToCart('${p.id}')"><i class="fa-solid fa-cart-plus me-1"></i> + Tambah Ke Keranjang</button></div></div></div></div>`).join(''); }
        function renderCatalogProducts() { const grid = document.getElementById('full-products-grid'); if (!grid) return; const todayProds = getTodayProducts(); const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; const todayName = days[new Date().getDay()]; if (todayProds.length === 0) { grid.innerHTML = `<div class="col-12 text-center py-5 bg-purple-light rounded-3 text-muted"><i class="fa-solid fa-calendar-xmark fs-1 mb-3 text-brand-purple d-block"></i><h5 class="fw-bold text-dark">Belum Ada Menu Mamam Yuk untuk Hari ${todayName}</h5><p class="fs-7 mb-0">Owner / Admin belum menambahkan varian menu rotasi harian untuk hari ${todayName}.</p></div>`; return; } grid.innerHTML = todayProds.map(p => ` <div class="col-md-4 mb-3"><div class="card-custom h-100 p-0 overflow-hidden d-flex flex-column justify-content-between border rounded-3 shadow-sm bg-white">${productImageHtml(p)}<div class="p-3 d-flex flex-column justify-content-between flex-grow-1"><div><span class="badge bg-warning text-dark fs-8 fw-bold mb-2">${p.age}</span><h6 class="fw-bold mb-1 text-dark fs-6" style="line-height:1.3;">${p.name}</h6><div class="text-muted fs-8 mb-3" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${p.ingredients}</div></div><div><div class="fw-bold text-brand-purple fs-5 mb-2">Rp ${p.price.toLocaleString('id-ID')}</div><button class="btn btn-brand-yellow btn-sm w-100 fw-bold text-dark py-2" onclick="addToCart('${p.id}')"><i class="fa-solid fa-cart-plus me-1"></i> + Tambah Ke Keranjang</button></div></div></div></div>`).join(''); }
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
                    <div class="text-start fs-7 text-muted mb-3">Centang varian Mamam Yuk untuk hari <b>${dayName}</b> dan atur jumlah <b>Stok Ready Harian (Cup)</b>:</div>
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
        function isOutletMatch(orderOutlet, targetFilter) {
            if (!targetFilter || targetFilter === 'ALL') return true;
            if (!orderOutlet) return false;
            if (orderOutlet === targetFilter) return true;
            const norm1 = String(orderOutlet).replace(/\s+/g, '').toLowerCase();
            const norm2 = String(targetFilter).replace(/\s+/g, '').toLowerCase();
            return norm1 === norm2 || norm1.includes(norm2) || norm2.includes(norm1);
        }

        function computeProductionNumbers(productId, outletFilter) {
            const todayStr = getTodayDateString();
            const relevantOrders = state.preOrders.filter(o => o.date === todayStr && o.cancelStatus !== 'approved' && isOutletMatch(o.outlet, outletFilter));
            const prod = state.products.find(p => p.id == productId);
            const prodName = prod ? prod.name.toLowerCase() : '';

            let onlinePreorder = 0;
            let manualPreorder = 0;

            relevantOrders.forEach(o => {
                const isManual = o.isManual === true || (o.id && String(o.id).startsWith('ORD-M-')) || (o.customerName && String(o.customerName).includes('(Manual)'));
                let orderQty = 0;
                if (o.itemsDetail && Array.isArray(o.itemsDetail) && o.itemsDetail.length > 0) {
                    const item = o.itemsDetail.find(it => it.productId == productId || String(it.productId) === String(productId));
                    if (item) {
                        orderQty = parseInt(item.qty) || 0;
                    }
                }
                if (orderQty === 0 && o.items && prodName) {
                    const parts = o.items.split(',');
                    parts.forEach(part => {
                        const trimmed = part.trim();
                        const matchX = trimmed.match(/^(.*?)\s*x(\d+)$/i);
                        const matchCup = trimmed.match(/^(.*?)\s*\((\d+)\s*Cup\)/i);
                        if (matchX) {
                            if (matchX[1].trim().toLowerCase() === prodName) {
                                orderQty += parseInt(matchX[2]) || 0;
                            }
                        } else if (matchCup) {
                            if (matchCup[1].trim().toLowerCase() === prodName) {
                                orderQty += parseInt(matchCup[2]) || 0;
                            }
                        } else if (trimmed.toLowerCase().includes(prodName)) {
                            orderQty += 1;
                        }
                    });
                }

                if (isManual) {
                    manualPreorder += orderQty;
                } else {
                    onlinePreorder += orderQty;
                }
            });

            const total = onlinePreorder + manualPreorder;
            return { onlinePreorder, manualPreorder, total };
        }
        function renderProductionGeneric(cfg) {
            const outletFilter = document.getElementById(cfg.filterSelectId)?.value || 'ALL';
            const daySelectId = cfg.filterSelectId === 'adm-dapur-outlet-filter' ? 'adm-dapur-day-filter' : 'own-dapur-day-filter';
            const dayFilter = document.getElementById(daySelectId)?.value || 'ALL';
            const cardsEl = document.getElementById(cfg.cardsId);
            if (cardsEl) cardsEl.innerHTML = '';
            const tbody = document.getElementById(cfg.tbodyId);
            if (!tbody) return;

            if (state.products.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted fs-8 fst-italic py-4">Belum ada varian produk.</td></tr>`;
                return;
            }

            const daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            const filteredDays = dayFilter === 'ALL' ? daysOrder : [dayFilter];

            let rowsHtml = '';
            let totalOnlineAll = 0, totalManualAll = 0, totalStockAll = 0, grandTotalAll = 0;
            let processedProdIds = new Set();
            let totalItemCount = 0;

            filteredDays.forEach(dayName => {
                const dayConfig = (state.dailyMenu || []).find(d => (d.day || '').toLowerCase() === dayName.toLowerCase());
                const prodIdsForDay = (dayConfig && Array.isArray(dayConfig.productIds)) ? dayConfig.productIds.map(String) : [];
                const dayProducts = state.products.filter(p => prodIdsForDay.includes(String(p.id)));

                let dayRows = '';
                let dayOnline = 0, dayManual = 0, dayStock = 0, dayTotal = 0;

                dayProducts.forEach(p => {
                    processedProdIds.add(String(p.id));
                    const { onlinePreorder, manualPreorder } = computeProductionNumbers(p.id, outletFilter);
                    let productStock = 0;
                    if (outletFilter === 'ALL') {
                        (state.outlets || []).forEach(outName => {
                            productStock += getOutletStock(outName, p);
                        });
                    } else {
                        productStock = getOutletStock(outletFilter, p);
                    }
                    const totalPorsiMasak = onlinePreorder + manualPreorder + productStock;

                    if (totalPorsiMasak > 0 || dayFilter !== 'ALL') {
                        totalItemCount++;
                        dayOnline += onlinePreorder;
                        dayManual += manualPreorder;
                        dayStock += productStock;
                        dayTotal += totalPorsiMasak;
                        dayRows += `<tr>
                            <td class="fw-bold text-dark ps-4"><i class="fa-solid fa-angle-right me-2 text-brand-purple fs-8"></i>${p.name}</td>
                            <td><span class="badge bg-primary fs-8">${onlinePreorder} Cup</span></td>
                            <td><span class="badge bg-warning text-dark fs-8">${manualPreorder} Cup</span></td>
                            <td><span class="badge bg-info text-dark fs-8">${productStock} Cup</span></td>
                            <td class="fw-bold text-brand-purple">${totalPorsiMasak} Cup</td>
                        </tr>`;
                    }
                });

                if (dayRows) {
                    totalOnlineAll += dayOnline;
                    totalManualAll += dayManual;
                    totalStockAll += dayStock;
                    grandTotalAll += dayTotal;
                    rowsHtml += `<tr class="table-primary border-top border-purple-200">
                        <td colspan="5" class="fw-extrabold text-brand-purple fs-7 py-2">
                            <i class="fa-solid fa-calendar-day me-2"></i> Menu Rotasi Harian: HARI ${dayName.toUpperCase()} (Total Masak: ${dayTotal} Cup)
                        </td>
                    </tr>` + dayRows;
                }
            });

            if (dayFilter === 'ALL') {
                const remainingProducts = state.products.filter(p => !processedProdIds.has(String(p.id)));
                let otherRows = '';
                let otherOnline = 0, otherManual = 0, otherStock = 0, otherTotal = 0;

                remainingProducts.forEach(p => {
                    const { onlinePreorder, manualPreorder } = computeProductionNumbers(p.id, outletFilter);
                    let productStock = 0;
                    if (outletFilter === 'ALL') {
                        (state.outlets || []).forEach(outName => {
                            productStock += getOutletStock(outName, p);
                        });
                    } else {
                        productStock = getOutletStock(outletFilter, p);
                    }
                    const totalPorsiMasak = onlinePreorder + manualPreorder + productStock;

                    if (totalPorsiMasak > 0) {
                        totalItemCount++;
                        otherOnline += onlinePreorder;
                        otherManual += manualPreorder;
                        otherStock += productStock;
                        otherTotal += totalPorsiMasak;
                        otherRows += `<tr>
                            <td class="fw-bold text-dark ps-4"><i class="fa-solid fa-angle-right me-2 text-secondary fs-8"></i>${p.name}</td>
                            <td><span class="badge bg-primary fs-8">${onlinePreorder} Cup</span></td>
                            <td><span class="badge bg-warning text-dark fs-8">${manualPreorder} Cup</span></td>
                            <td><span class="badge bg-info text-dark fs-8">${productStock} Cup</span></td>
                            <td class="fw-bold text-brand-purple">${totalPorsiMasak} Cup</td>
                        </tr>`;
                    }
                });

                if (otherRows) {
                    totalOnlineAll += otherOnline;
                    totalManualAll += otherManual;
                    totalStockAll += otherStock;
                    grandTotalAll += otherTotal;
                    rowsHtml += `<tr class="table-light border-top">
                        <td colspan="5" class="fw-extrabold text-secondary fs-7 py-2">
                            <i class="fa-solid fa-boxes-stacked me-2"></i> Master Produk Lainnya (Total Masak: ${otherTotal} Cup)
                        </td>
                    </tr>` + otherRows;
                }
            }

            if (totalItemCount === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted fs-8 fst-italic py-4"><i class="fa-solid fa-utensils me-2 text-secondary"></i>Belum ada varian produk yang dipesan untuk ${outletFilter !== 'ALL' ? outletFilter : 'semua outlet'}${dayFilter !== 'ALL' ? ` pada hari ${dayFilter}` : ''}.</td></tr>`;
            } else {
                tbody.innerHTML = rowsHtml + `<tr class="table-light border-top border-purple-200">
                    <td class="fw-bold fs-7 text-dark">TOTAL SELURUH VARIAN ${outletFilter !== 'ALL' ? `(${outletFilter})` : '(Semua Outlet)'}</td>
                    <td class="fw-bold text-primary fs-7">${totalOnlineAll} Cup</td>
                    <td class="fw-bold text-warning text-dark fs-7">${totalManualAll} Cup</td>
                    <td class="fw-bold text-info text-dark fs-7">${totalStockAll} Cup</td>
                    <td class="fw-bold text-brand-purple fs-6">${grandTotalAll} Cup</td>
                </tr>`;
            }
        }
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
        function editProductModal(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; Swal.fire({ title: 'Edit Varian Mamam Yuk', html: `<div class="text-start mb-2"><label class="fw-bold fs-7 d-block mb-1">Foto Produk (opsional)</label><img id="swal-eimg-preview" src="${p.image || ''}" class="rounded-3 mb-2" style="width:100%; max-height:150px; object-fit:cover; ${p.image ? '' : 'display:none;'}"><input id="swal-eimage" type="file" accept="image/*" class="swal2-file"></div><input id="swal-ename" class="swal2-input" placeholder="Nama Varian Mamam Yuk" value="${p.name}"><input id="swal-eprice" class="swal2-input" type="number" placeholder="Harga / Cup (Rp)" value="${p.price}"><select id="swal-ecategory" class="swal2-select"><option value="Bubur" ${p.category === 'Bubur' ? 'selected' : ''}>Bubur</option><option value="Snack" ${p.category === 'Snack' ? 'selected' : ''}>Snack</option></select><select id="swal-eage" class="swal2-select"><option value="6+ Bulan" ${p.age === '6+ Bulan' ? 'selected' : ''}>6+ Bulan</option><option value="8+ Bulan" ${p.age === '8+ Bulan' ? 'selected' : ''}>8+ Bulan</option><option value="12+ Bulan" ${p.age === '12+ Bulan' ? 'selected' : ''}>12+ Bulan</option></select><input id="swal-eingredients" class="swal2-input" placeholder="Komposisi Bahan" value="${p.ingredients}"><select id="swal-estatus" class="swal2-select"><option value="Aktif" ${p.status === 'Aktif' ? 'selected' : ''}>Aktif</option><option value="Nonaktif" ${p.status === 'Nonaktif' ? 'selected' : ''}>Nonaktif</option></select>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Perubahan', confirmButtonColor: '#6A1B9A', didOpen: () => { bindImagePreview('swal-eimage', 'swal-eimg-preview'); }, preConfirm: async () => { const name = document.getElementById('swal-ename').value.trim(); const price = parseInt(document.getElementById('swal-eprice').value) || 0; if (!name || price <= 0) { Swal.showValidationMessage('Harap isi Nama dan Harga produk!'); return false; } const newImageDataUrl = await readImageFileAsDataUrl(document.getElementById('swal-eimage')); return { name, price, category: document.getElementById('swal-ecategory').value, age: document.getElementById('swal-eage').value, ingredients: document.getElementById('swal-eingredients').value.trim(), status: document.getElementById('swal-estatus').value, image: newImageDataUrl }; } }).then(result => { if (result.isConfirmed && result.value) { fetch('/api/products/' + prodId, { method: 'PUT', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify(result.value) }).then(async res => { const data = await res.json().catch(() => ({})); if (!res.ok || data.success === false) { throw new Error(data.message || ('Gagal memperbarui data (Status ' + res.status + ')')); } return data; }).then(() => { p.name = result.value.name; p.price = result.value.price; p.category = result.value.category; p.age = result.value.age; p.ingredients = result.value.ingredients; p.status = result.value.status; if (result.value.image) p.image = result.value.image; renderAllUI(); Swal.fire({ icon: 'success', title: 'Produk Diperbarui', text: `${p.name} berhasil disimpan!`, timer: 1200, showConfirmButton: false }); }).catch(err => { Swal.fire({ icon: 'error', title: 'Gagal Memperbarui Varian', text: err.message || 'Terjadi kesalahan sistem.' }); }); } }); }
        function deleteProductOwner(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; Swal.fire({ icon: 'warning', title: 'Hapus Varian Produk?', text: `Varian "${p.name}" akan dihapus permanen dari master produk dan menu harian.`, showCancelButton: true, confirmButtonText: 'Ya, Hapus', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { fetch('/api/products/' + prodId, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }).then(() => { state.products = state.products.filter(x => x.id != prodId); state.dailyMenu.forEach(d => { d.productIds = (d.productIds || []).filter(id => id != prodId); }); state.cart = state.cart.filter(c => c.productId != prodId); state.posCart = state.posCart.filter(c => c.productId != prodId); renderAllUI(); Swal.fire({ icon: 'success', title: 'Produk Dihapus', timer: 1000, showConfirmButton: false }); }); } }); }
        function showAddProductModal() { Swal.fire({ title: 'Tambah Varian Mamam Yuk Baru', html: `<div class="text-start mb-2"><label class="fw-bold fs-7 d-block mb-1">Foto Produk (opsional, maks 2MB)</label><img id="swal-pimg-preview" class="rounded-3 mb-2" style="width:100%; max-height:150px; object-fit:cover; display:none;"><input id="swal-pimage" type="file" accept="image/*" class="swal2-file"></div><input id="swal-pname" class="swal2-input" placeholder="Nama Varian Mamam Yuk"><input id="swal-pprice" class="swal2-input" type="number" placeholder="Harga / Cup (Rp)"><input id="swal-pstock" class="swal2-input" type="number" placeholder="Stok Ready Initial (Cup)"><select id="swal-pcategory" class="swal2-select"><option value="Bubur">Bubur</option><option value="Snack">Snack</option></select><select id="swal-page" class="swal2-select"><option value="6+ Bulan">6+ Bulan</option><option value="8+ Bulan">8+ Bulan</option><option value="12+ Bulan">12+ Bulan</option></select><input id="swal-pingredients" class="swal2-input" placeholder="Komposisi Bahan"><select id="swal-pstatus" class="swal2-select"><option value="Aktif">Aktif</option><option value="Nonaktif">Nonaktif</option></select>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Varian', confirmButtonColor: '#6A1B9A', didOpen: () => { bindImagePreview('swal-pimage', 'swal-pimg-preview'); }, preConfirm: async () => { const name = document.getElementById('swal-pname').value.trim(); const price = parseInt(document.getElementById('swal-pprice').value) || 0; const stock = parseInt(document.getElementById('swal-pstock').value) || 0; const category = document.getElementById('swal-pcategory').value; const age = document.getElementById('swal-page').value; const ingredients = document.getElementById('swal-pingredients').value.trim(); const status = document.getElementById('swal-pstatus').value; if (!name || price <= 0) { Swal.showValidationMessage('Harap isi Nama dan Harga produk!'); return false; } const imageDataUrl = await readImageFileAsDataUrl(document.getElementById('swal-pimage')); return { name, price, stock, category, age, age_group: age, ingredients, status, image: imageDataUrl || '' }; } }).then((result) => { if (result.isConfirmed && result.value) { fetch('/api/products', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify(result.value) }).then(async res => { const data = await res.json().catch(() => ({})); if (!res.ok || data.success === false) { throw new Error(data.message || ('Gagal menyimpan data ke server (Status ' + res.status + ')')); } return data; }).then(data => { if (data.success && data.product) { const newP = { id: data.product.id, name: data.product.name, price: data.product.price, stock: data.product.stock, initialStock: data.product.stock, category: data.product.category || result.value.category || 'Bubur', age: data.product.age_group || result.value.age || '6+ Bulan', ingredients: data.product.ingredients || result.value.ingredients || 'Bahan segar alami', status: data.product.status || result.value.status || 'Aktif', image: data.product.image || result.value.image || '', customPoints: 0 }; state.products.push(newP); renderAllUI(); Swal.fire({ icon: 'success', title: 'Produk Ditambahkan', text: `${newP.name} berhasil disimpan!`, timer: 1200, showConfirmButton: false }); } else { Swal.fire({ icon: 'error', title: 'Gagal Menyimpan', text: (data && data.message) ? data.message : 'Gagal menyimpan varian baru.' }); } }).catch(err => { Swal.fire({ icon: 'error', title: 'Gagal Menyimpan Varian', text: err.message || 'Terjadi kesalahan sistem.' }); }); } }); }
        function updateCartQty(prodId, delta) { const item = state.cart.find(x => x.productId == prodId); if (item) { item.qty += delta; if (item.qty <= 0) { state.cart = state.cart.filter(x => x.productId != prodId); } } renderCartUI(); }
        function savePreOrdersToStorage() { try { localStorage.setItem('mpasi_customer_orders', JSON.stringify(state.preOrders)); } catch(e){} }
        function renderCartUI() { const totalQty = state.cart.reduce((a, b) => a + b.qty, 0); const totalAmt = state.cart.reduce((a, b) => a + (b.price * b.qty), 0); const badge = document.getElementById('cart-badge'); if (badge) { badge.innerText = totalQty; badge.style.display = totalQty > 0 ? 'inline-block' : 'none'; } const mobileBadge = document.getElementById('mobile-cart-badge'); if (mobileBadge) { mobileBadge.innerText = totalQty; mobileBadge.style.display = totalQty > 0 ? 'inline-block' : 'none'; } const tbody = document.getElementById('cart-tbody'); if (tbody) { tbody.innerHTML = state.cart.map(c => ` <tr><td class="fw-bold text-dark">${c.name}</td><td>Rp ${c.price.toLocaleString('id-ID')}</td><td><div class="d-flex align-items-center gap-2"><button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="updateCartQty('${c.productId}', -1)">-</button><span class="fw-bold">${c.qty}</span><button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="updateCartQty('${c.productId}', 1)">+</button></div></td><td class="fw-bold text-brand-purple">Rp ${(c.price * c.qty).toLocaleString('id-ID')}</td><td><button class="btn btn-sm text-danger" onclick="updateCartQty('${c.productId}', -99)"><i class="fa-solid fa-trash"></i></button></td></tr>`).join(''); } const subtotalEl = document.getElementById('cart-summary-subtotal'); if (subtotalEl) subtotalEl.innerText = 'Rp ' + totalAmt.toLocaleString('id-ID'); const totalEl = document.getElementById('cart-summary-total'); if (totalEl) totalEl.innerText = 'Rp ' + totalAmt.toLocaleString('id-ID'); }
        function renderCustomerHistory() { const tbody = document.getElementById('riwayat-tbody'); if (!tbody) return; if (state.preOrders.length === 0) { tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted fs-7 fst-italic py-4"><i class="fa-solid fa-inbox fs-3 d-block mb-2 text-secondary"></i>Belum ada riwayat pesanan. Yuk mulai pesan Mamam Yuk dari menu hari ini!</td></tr>`; return; } tbody.innerHTML = state.preOrders.map(p => { let statusBadge; if (p.cancelStatus === 'approved') { statusBadge = '<span class="badge bg-danger fs-8">Pesanan Dibatalkan ❌</span>'; } else if (p.cancelStatus === 'pending') { statusBadge = '<span class="badge bg-secondary fs-8">Menunggu Persetujuan Batal</span>'; } else if (p.isTaken) { statusBadge = '<span class="badge bg-success fs-8">Sudah Diambil ✅</span>'; } else { statusBadge = '<span class="badge bg-warning text-dark fs-8">Menunggu Ambil</span>'; } let actionCell; if (p.cancelStatus === 'approved') { actionCell = '<span class="text-muted fs-8 fst-italic">Sudah dibatalkan</span>'; } else if (p.cancelStatus === 'pending') { actionCell = '<span class="text-muted fs-8 fst-italic">Menunggu Owner</span>'; } else if (p.isTaken) { actionCell = '<span class="text-muted fs-8 fst-italic">-</span>'; } else { actionCell = `<button class="btn btn-sm btn-outline-danger fs-8 fw-bold" onclick="requestCancelOrder('${p.id}')"><i class="fa-solid fa-ban me-1"></i> Batalkan Pesanan</button>`; if (p.cancelStatus === 'rejected') { actionCell = `<div class="text-danger fs-8 mb-1 fst-italic">Permintaan batal sebelumnya ditolak</div>` + actionCell; } } return `<tr class="${p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : ''}"><td class="fw-bold text-brand-purple">${p.id}</td><td>Besok (06.00 - 09.00)</td><td><span class="badge bg-light text-dark border">${p.payMethod}</span></td><td class="fw-bold text-dark">${p.items}</td><td>${statusBadge}</td><td class="text-center">${actionCell}</td></tr>`; }).join(''); }
        function requestCancelOrder(orderId) { const order = state.preOrders.find(o => o.id == orderId); if (!order) return; if (order.isTaken) { Swal.fire({ icon: 'info', title: 'Tidak Bisa Dibatalkan', text: 'Pesanan sudah diambil, tidak bisa dibatalkan lagi.' }); return; } Swal.fire({ title: 'Ajukan Pembatalan Pesanan?', html: `Pesanan <b>${order.id}</b> akan diajukan pembatalan dan menunggu persetujuan Owner.`, input: 'textarea', inputPlaceholder: 'Alasan pembatalan (opsional)', showCancelButton: true, confirmButtonText: 'Ajukan Pembatalan', cancelButtonText: 'Batal', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { order.cancelStatus = 'pending'; order.cancelReason = (res.value || '').trim() || '-'; savePreOrdersToStorage(); renderAllUI(); Swal.fire({ icon: 'success', title: 'Permintaan Terkirim', text: 'Menunggu persetujuan Owner untuk pembatalan pesanan ini.', timer: 1500, showConfirmButton: false }); } }); }
        function decideCancelOrder(orderId, decision) { const order = state.preOrders.find(o => o.id == orderId); if (!order) return; const isApprove = decision === 'approved'; Swal.fire({ icon: isApprove ? 'warning' : 'question', title: isApprove ? 'Setujui Pembatalan Pesanan?' : 'Tolak Permintaan Pembatalan?', html: `Pesanan <b>${order.id}</b> a.n <b>${order.customerName}</b>${order.cancelReason && order.cancelReason !== '-' ? `<br><span class="fs-8 text-muted">Alasan: ${order.cancelReason}</span>` : ''}`, showCancelButton: true, confirmButtonText: isApprove ? 'Ya, Setujui Pembatalan' : 'Ya, Tolak Pembatalan', cancelButtonText: 'Batal', confirmButtonColor: isApprove ? '#dc3545' : '#6A1B9A' }).then(res => { if (res.isConfirmed) { order.cancelStatus = decision; if (isApprove && order.pointsAwarded && order.memberIdentifier && state.members[order.memberIdentifier]) { const member = state.members[order.memberIdentifier]; member.points = Math.max(0, member.points - order.pointsAwarded); member.pointsHistory.unshift({ type: 'adjust', label: `Poin ditarik - pesanan ${order.id} dibatalkan`, points: -order.pointsAwarded, date: new Date().toLocaleString('id-ID') }); order.pointsAwarded = 0; } savePreOrdersToStorage(); renderAllUI(); Swal.fire({ icon: 'success', title: isApprove ? 'Pembatalan Disetujui' : 'Permintaan Ditolak', text: isApprove ? `Pesanan ${order.id} resmi dibatalkan.` : `Pesanan ${order.id} tetap diproses seperti biasa.`, timer: 1500, showConfirmButton: false }); } }); }
        function saveMembersToStorage() {
            try {
                localStorage.setItem('mamamyuk_members', JSON.stringify(state.members));
                if (state.currentUser) {
                    const key = state.currentUser.identifier || state.currentUser.wa;
                    if (key && state.members[key]) {
                        localStorage.setItem('mpasi_current_user', JSON.stringify(state.members[key]));
                    } else {
                        localStorage.setItem('mpasi_current_user', JSON.stringify(state.currentUser));
                    }
                }
            } catch(e){}
        }

        function computeEarnedPoints(itemsDetail) {
            if (!itemsDetail || !Array.isArray(itemsDetail)) return 0;
            let totalPoints = 0;
            const rate = state.pointsEarnRate || 1000;
            itemsDetail.forEach(item => {
                const prod = state.products.find(p => p.id == item.productId || String(p.id) === String(item.productId));
                if (prod) {
                    const qty = parseInt(item.qty) || 0;
                    if (prod.customPoints && prod.customPoints > 0) {
                        totalPoints += prod.customPoints * qty;
                    } else {
                        const itemTotal = (prod.price || 0) * qty;
                        totalPoints += Math.floor(itemTotal / rate);
                    }
                }
            });
            return totalPoints;
        }

        let appliedCheckoutVoucher = null;

        function applyCheckoutVoucher() {
            const input = document.getElementById('co-voucher-code');
            const statusEl = document.getElementById('co-voucher-status');
            const code = (input ? input.value : '').trim().toUpperCase();
            if (!code) {
                if (statusEl) statusEl.innerHTML = '<span class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark me-1"></i> Masukkan kode voucher terlebih dahulu!</span>';
                return;
            }

            if (!state.currentUser) {
                if (statusEl) statusEl.innerHTML = '<span class="text-danger fw-bold"><i class="fa-solid fa-lock me-1"></i> Silakan masuk sebagai member untuk pakai voucher poin!</span>';
                return;
            }

            const member = state.currentUser;
            const historyItem = (member.pointsHistory || []).find(h =>
                h.type === 'redeem' &&
                (h.code === code || (h.label && h.label.toUpperCase().includes(code)))
            );

            if (!historyItem) {
                if (statusEl) statusEl.innerHTML = `<span class="text-danger fw-bold"><i class="fa-solid fa-triangle-exclamation me-1"></i> Kode ${code} tidak ditemukan / bukan milik akun Anda.</span>`;
                return;
            }

            if (historyItem.isUsed) {
                if (statusEl) statusEl.innerHTML = `<span class="text-danger fw-bold"><i class="fa-solid fa-ban me-1"></i> Kode ${code} sudah pernah digunakan.</span>`;
                return;
            }

            let discountVal = 0;
            const label = historyItem.rewardName || historyItem.label || '';
            if (label.includes('5.000')) discountVal = 5000;
            else if (label.includes('10.000')) discountVal = 10000;
            else if (label.includes('25.000')) discountVal = 25000;
            else if (label.includes('Gratis 1 Cup') || label.includes('Puding')) discountVal = 10000;
            else discountVal = 5000;

            appliedCheckoutVoucher = {
                code: code,
                discount: discountVal,
                historyItem: historyItem
            };

            if (statusEl) statusEl.innerHTML = `<span class="text-success fw-bold"><i class="fa-solid fa-circle-check me-1"></i> Voucher ${code} Aktif! Diskon Rp ${discountVal.toLocaleString('id-ID')}</span>`;
            
            prefillCheckoutForm();
        }

        function proceedToCheckoutPage() { if (state.cart.length === 0) { Swal.fire({ icon: 'warning', title: 'Keranjang Kosong', text: 'Pilih produk terlebih dahulu.' }); return; } switchCustView('checkout'); }
        
        function prefillCheckoutForm() {
            const list = document.getElementById('checkout-items-list');
            if (list) {
                list.innerHTML = state.cart.map(c => `<div class="d-flex justify-content-between"><span>${c.name} (x${c.qty})</span><span class="fw-bold text-brand-purple">Rp ${(c.price * c.qty).toLocaleString('id-ID')}</span></div>`).join('');
            }
            const subtotalAmt = state.cart.reduce((a, b) => a + (b.price * b.qty), 0);
            let finalAmt = subtotalAmt;
            let discountHtml = '';

            if (appliedCheckoutVoucher && appliedCheckoutVoucher.discount > 0) {
                const disc = Math.min(subtotalAmt, appliedCheckoutVoucher.discount);
                finalAmt = Math.max(0, subtotalAmt - disc);
                discountHtml = `<div class="d-flex justify-content-between text-success fs-7 fw-bold border-top pt-2">
                    <span>Diskon Voucher (${appliedCheckoutVoucher.code}):</span>
                    <span>-Rp ${disc.toLocaleString('id-ID')}</span>
                </div>`;
            }

            const summaryContainer = document.getElementById('checkout-summary-container');
            if (summaryContainer) {
                summaryContainer.innerHTML = `
                    <div class="d-flex justify-content-between text-dark fs-7 mb-1">
                        <span>Subtotal Belanja:</span>
                        <span class="fw-bold">Rp ${subtotalAmt.toLocaleString('id-ID')}</span>
                    </div>
                    ${discountHtml}
                    <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2">
                        <span>Total Bayar:</span>
                        <span id="checkout-total-amount" class="text-brand-purple">Rp ${finalAmt.toLocaleString('id-ID')}</span>
                    </div>
                `;
            } else {
                const totalAmtEl = document.getElementById('checkout-total-amount');
                if (totalAmtEl) totalAmtEl.innerText = 'Rp ' + finalAmt.toLocaleString('id-ID');
            }

            const nameInput = document.getElementById('co-name');
            const waInput = document.getElementById('co-wa');
            if (state.currentUser) {
                if (nameInput && !nameInput.value) nameInput.value = state.currentUser.name;
                if (waInput && !waInput.value) waInput.value = state.currentUser.wa;
            }
            const pointsPreviewEl = document.getElementById('checkout-points-preview');
            if (pointsPreviewEl) {
                if (state.currentUser) {
                    const estPoints = computeEarnedPoints(state.cart.map(c => ({ productId: c.productId, qty: c.qty })));
                    pointsPreviewEl.innerHTML = `<i class="fa-solid fa-coins me-1"></i> Anda akan mendapat <b>${estPoints} Poin</b> dari pesanan ini`;
                } else {
                    pointsPreviewEl.innerHTML = '<i class="fa-solid fa-circle-info me-1"></i> Masuk sebagai member untuk dapat poin dari belanja ini';
                }
            }
        }

        function handleProcessCheckout(e) {
            e.preventDefault();
            if (!state.isStoreOpen) {
                Swal.fire({ icon: 'error', title: 'Pemesanan Tutup', text: 'Maaf pesanan hari ini sudah tutup, silakan pesan besok jam 06.00.' });
                return;
            }
            startLoading();
            const name = document.getElementById('co-name').value;
            const wa = document.getElementById('co-wa').value;
            const outlet = document.getElementById('co-outlet').value;
            const payMethod = document.querySelector('input[name="paymethod"]:checked').value;
            const subtotalAmt = state.cart.reduce((a, b) => a + (b.price * b.qty), 0);
            let finalAmt = subtotalAmt;
            let appliedDiscVal = 0;
            let appliedCode = null;

            if (appliedCheckoutVoucher && appliedCheckoutVoucher.discount > 0) {
                appliedDiscVal = Math.min(subtotalAmt, appliedCheckoutVoucher.discount);
                finalAmt = Math.max(0, subtotalAmt - appliedDiscVal);
                appliedCode = appliedCheckoutVoucher.code;
                if (appliedCheckoutVoucher.historyItem) {
                    appliedCheckoutVoucher.historyItem.isUsed = true;
                    appliedCheckoutVoucher.historyItem.usedDate = new Date().toLocaleString('id-ID');
                }
            }

            const itemsDetail = state.cart.map(c => ({ productId: c.productId, qty: c.qty }));
            let pointsEarned = 0;
            let memberIdentifier = null;
            if (state.currentUser) {
                pointsEarned = computeEarnedPoints(itemsDetail);
                memberIdentifier = state.currentUser.identifier || state.currentUser.wa || wa;
            }
            const newOrder = {
                id: 'ORD-' + Math.floor(100 + Math.random() * 900),
                customerName: name,
                wa: wa,
                outlet: outlet,
                items: state.cart.map(c => c.name + ' x' + c.qty).join(', ') + (appliedCode ? ` [Voucher ${appliedCode}: -Rp ${appliedDiscVal.toLocaleString('id-ID')}]` : ''),
                itemsDetail: itemsDetail,
                totalAmount: finalAmt,
                subtotalAmount: subtotalAmt,
                voucherCode: appliedCode,
                voucherDiscount: appliedDiscVal,
                isPaid: payMethod === 'Transfer',
                payMethod: payMethod,
                isTaken: false,
                cancelStatus: null,
                cancelReason: null,
                memberIdentifier: memberIdentifier,
                pointsAwarded: pointsEarned,
                date: getTodayDateString()
            };
            state.preOrders.unshift(newOrder);
            savePreOrdersToStorage();

            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    customer_name: name,
                    whatsapp: wa,
                    outlet_id: outlet,
                    pay_method: payMethod,
                    items: itemsDetail.map(it => ({ product_id: it.productId, qty: it.qty })),
                    member_identifier: memberIdentifier
                })
            }).catch(err => console.error("Database sync error:", err));

            if (memberIdentifier && pointsEarned > 0) {
                if (!state.members[memberIdentifier]) {
                    state.members[memberIdentifier] = state.currentUser || { identifier: memberIdentifier, name: name, wa: wa, points: 0, pointsHistory: [] };
                }
                const member = state.members[memberIdentifier];
                member.points = (member.points || 0) + pointsEarned;
                if (!Array.isArray(member.pointsHistory)) member.pointsHistory = [];
                member.pointsHistory.unshift({
                    type: 'earn',
                    label: `Belanja pesanan ${newOrder.id}`,
                    points: pointsEarned,
                    date: new Date().toLocaleString('id-ID')
                });
                if (state.currentUser) {
                    state.currentUser.points = member.points;
                    state.currentUser.pointsHistory = member.pointsHistory;
                }
                saveMembersToStorage();
            }

            appliedCheckoutVoucher = null;

            setTimeout(() => {
                state.cart = [];
                renderAllUI();
                endLoading();
                Swal.fire({
                    icon: 'success',
                    title: 'Pesanan Berhasil Disimpan!',
                    html: pointsEarned > 0
                        ? `Terima kasih Bunda, pesanan Anda telah diteruskan ke outlet!<br><span class="fw-bold text-success"><i class="fa-solid fa-coins me-1"></i> +${pointsEarned} Poin ditambahkan ke akun Anda.</span>`
                        : `Terima kasih Bunda, pesanan Anda telah diteruskan ke outlet!${!state.currentUser ? '<br><span class="fs-7 text-muted">Masuk sebagai member di pesanan berikutnya supaya dapat poin ya!</span>' : ''}`
                });
                switchCustView('riwayat');
            }, 500);
        }
        function changeKasirOutlet(outletName) { state.kasirActiveOutlet = outletName; const badge = document.getElementById('kasir-active-outlet-badge'); if (badge) { badge.innerHTML = `<i class="fa-solid fa-location-dot me-1 text-danger"></i> ${outletName}`; } renderKasirPreOrders(); renderKasirLeftoverTable(); Swal.fire({ icon: 'info', title: 'Cabang Kasir Diperbarui', text: 'Kasir aktif bertugas di: ' + outletName, timer: 1200, showConfirmButton: false }); }
        function changeKasirOutlet(outletName) { state.kasirActiveOutlet = outletName; const badge = document.getElementById('kasir-active-outlet-badge'); if (badge) { badge.innerHTML = `<i class="fa-solid fa-location-dot me-1 text-danger"></i> ${outletName}`; } renderKasirPreOrders(); renderKasirLeftoverTable(); renderPosProductsGrid(); Swal.fire({ icon: 'info', title: 'Cabang Kasir Diperbarui', text: 'Kasir aktif bertugas di: ' + outletName, timer: 1200, showConfirmButton: false }); }
        function renderKasirPreOrders() { const tbody = document.getElementById('kasir-preorder-tbody'); if (!tbody) return; const yesterdayStr = getYesterdayDateString(); const filteredOrders = state.preOrders.filter(p => p.outlet === state.kasirActiveOutlet && p.date === yesterdayStr); if (filteredOrders.length === 0) { tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted fs-8 fst-italic py-3"><i class="fa-solid fa-clipboard-check me-1 opacity-50"></i> Belum ada pre-order online untuk diambil hari ini di cabang ini.</td></tr>`; return; } tbody.innerHTML = filteredOrders.map(p => `<tr class="${p.isTaken ? 'bg-light opacity-75' : ''} ${p.cancelStatus === 'approved' ? 'table-danger' : ''}"><td class="text-center"><input type="checkbox" class="form-check-input fs-5 cursor-pointer" ${p.isTaken ? 'checked' : ''} ${p.cancelStatus === 'approved' ? 'disabled' : ''} onchange="togglePreOrderTaken('${p.id}')"></td><td class="fw-bold ${p.isTaken || p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${p.id} - ${p.customerName}</td><td><a href="https://wa.me/${p.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${p.wa}</a></td><td class="fs-8">${p.items}</td><td><button class="btn btn-sm ${p.isPaid ? 'btn-success' : 'btn-outline-danger'} font-bold fs-8" onclick="togglePaymentStatus('${p.id}')">${p.isPaid ? 'Lunas ✅' : 'Belum Bayar (COD)'}</button></td><td><span class="badge ${p.isTaken ? 'bg-success' : 'bg-warning text-dark'} fs-8">${p.isTaken ? 'Sudah Diambil ✅' : 'Menunggu Ambil'}</span></td><td>${cancelInfoBadge(p)}</td></tr>`).join(''); }
        function cancelInfoBadge(p) { if (p.cancelStatus === 'pending') return '<span class="badge bg-secondary fs-8"><i class="fa-solid fa-hourglass-half me-1"></i> Menunggu Persetujuan</span>'; if (p.cancelStatus === 'approved') return '<span class="badge bg-danger fs-8"><i class="fa-solid fa-ban me-1"></i> Dibatalkan</span>'; if (p.cancelStatus === 'rejected') return '<span class="badge bg-light text-dark border fs-8">Pernah Ditolak</span>'; return '<span class="text-muted fs-8">-</span>'; }
        function togglePreOrderTaken(orderId) { const item = state.preOrders.find(p => p.id == orderId); if (item) { item.isTaken = !item.isTaken; savePreOrdersToStorage(); renderKasirPreOrders(); renderOwnerPreOrders(); } }
        function togglePaymentStatus(orderId) { const item = state.preOrders.find(p => p.id == orderId); if (item) { item.isPaid = !item.isPaid; savePreOrdersToStorage(); renderKasirPreOrders(); renderOwnerPreOrders(); } }
        function renderOrdersMenuSummary(ordersList, containerId, badgeId, outletLabel) { const summaryContainer = document.getElementById(containerId); if (!summaryContainer) return; const validOrders = (ordersList || []).filter(p => p.cancelStatus !== 'approved'); const menuSummaryMap = {}; let grandTotalCups = 0; validOrders.forEach(o => { if (o.itemsDetail && o.itemsDetail.length > 0) { o.itemsDetail.forEach((it, idx) => { const prod = state.products.find(p => p.id == it.productId || String(p.id) === String(it.productId)); let name = prod ? prod.name : null; if (!name && o.items) { const parts = o.items.split(','); if (parts[idx]) { const match = parts[idx].trim().match(/^(.*?)\s*x\d+$/i); name = match ? match[1].trim() : parts[idx].trim(); } else if (parts.length === 1) { const match = parts[0].trim().match(/^(.*?)\s*x\d+$/i); name = match ? match[1].trim() : parts[0].trim(); } } if (!name) name = 'Produk ID ' + it.productId; const qty = parseInt(it.qty) || 0; menuSummaryMap[name] = (menuSummaryMap[name] || 0) + qty; grandTotalCups += qty; }); } else if (o.items) { const parts = o.items.split(','); parts.forEach(part => { const match = part.trim().match(/^(.*?)\s*x(\d+)$/i); if (match) { const name = match[1].trim(); const qty = parseInt(match[2]) || 1; menuSummaryMap[name] = (menuSummaryMap[name] || 0) + qty; grandTotalCups += qty; } else if (part.trim()) { const name = part.trim(); menuSummaryMap[name] = (menuSummaryMap[name] || 0) + 1; grandTotalCups += 1; } }); } }); const menuEntries = Object.entries(menuSummaryMap); const badgeTotalEl = document.getElementById(badgeId); if (badgeTotalEl) badgeTotalEl.innerText = `Total: ${grandTotalCups} Cup`; if (menuEntries.length === 0) { summaryContainer.innerHTML = `<div class="text-center text-muted fs-8 fst-italic py-3"><i class="fa-solid fa-cookie-bite me-1 text-secondary opacity-50"></i> Belum ada menu yang dipesan untuk ${outletLabel}.</div>`; } else { const rowsHtml = menuEntries.map(([menuName, count]) => `<tr><td class="fw-bold text-dark"><i class="fa-solid fa-bowl-food me-2 text-brand-purple"></i>${menuName}</td><td class="text-end fw-bold text-primary fs-7">${count} Cup</td></tr>`).join(''); summaryContainer.innerHTML = `<div class="table-responsive"><table class="table table-sm align-middle fs-7 mb-0"><thead class="bg-light"><tr><th>Nama Menu Mamam Yuk</th><th class="text-end">Total Jumlah Dipesan</th></tr></thead><tbody>${rowsHtml}<tr class="table-light fw-bold"><td class="text-dark">TOTAL KESELURUHAN MENU DIPESAN (${outletLabel})</td><td class="text-end text-brand-purple fs-6">${grandTotalCups} Cup</td></tr></tbody></table></div>`; } }
        function renderOwnerPreOrders() { const tbody = document.getElementById('owner-preorder-tbody'); if (!tbody) return; const todayStr = getTodayDateString(); const todayOrders = state.preOrders.filter(p => p.date === todayStr); if (todayOrders.length === 0) { tbody.innerHTML = `<tr><td colspan="8" class="text-center text-muted fs-8 fst-italic py-3">Belum ada pre-order dari pelanggan masuk hari ini.</td></tr>`; } else { tbody.innerHTML = todayOrders.map(p => { let cancelActionCell = cancelInfoBadge(p); if (p.cancelStatus === 'pending') { cancelActionCell = `<div class="d-flex flex-column gap-1">${cancelInfoBadge(p)}${p.cancelReason && p.cancelReason !== '-' ? `<span class="fs-8 text-muted fst-italic">Alasan: ${p.cancelReason}</span>` : ''}<div class="d-flex gap-1 mt-1"><button class="btn btn-sm btn-danger fs-8 fw-bold py-0.5 px-2" onclick="decideCancelOrder('${p.id}', 'approved')"><i class="fa-solid fa-check me-1"></i> Setujui</button><button class="btn btn-sm btn-outline-secondary fs-8 fw-bold py-0.5 px-2" onclick="decideCancelOrder('${p.id}', 'rejected')"><i class="fa-solid fa-xmark me-1"></i> Tolak</button></div></div>`; } return `<tr class="${p.isTaken ? 'bg-light opacity-75' : ''} ${p.cancelStatus === 'approved' ? 'table-danger' : ''}"><td class="text-center"><input type="checkbox" class="form-check-input fs-5 cursor-pointer" ${p.isTaken ? 'checked' : ''} ${p.cancelStatus === 'approved' ? 'disabled' : ''} onchange="togglePreOrderTaken('${p.id}')"></td><td class="fw-bold ${p.isTaken || p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${p.id} - ${p.customerName}</td><td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8">${p.outlet}</span></td><td><a href="https://wa.me/${p.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${p.wa}</a></td><td class="fs-8">${p.items}</td><td><button class="btn btn-sm ${p.isPaid ? 'btn-success' : 'btn-outline-danger'} font-bold fs-8" onclick="togglePaymentStatus('${p.id}')">${p.isPaid ? 'Lunas ✅' : 'Belum Bayar (COD)'}</button></td><td><span class="badge ${p.isTaken ? 'bg-success' : 'bg-warning text-dark'} fs-8">${p.isTaken ? 'Sudah Diambil ✅' : 'Menunggu Ambil'}</span></td><td>${cancelActionCell}</td></tr>`; }).join(''); } const pendingCancelCount = todayOrders.filter(p => p.cancelStatus === 'pending').length; const cancelBadgeEl = document.getElementById('owner-cancel-badge'); if (cancelBadgeEl) { cancelBadgeEl.innerText = pendingCancelCount; cancelBadgeEl.style.display = pendingCancelCount > 0 ? 'inline-block' : 'none'; } renderOrdersMenuSummary(todayOrders, 'own-pesanan-summary-content', 'own-pesanan-total-badge', 'Semua Outlet'); }
        function renderPosProductsGrid() {
            const grid = document.getElementById('pos-products-grid');
            if (!grid) return;
            const heading = document.getElementById('pos-products-heading');
            const todayProds = getTodayProducts();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const todayName = days[new Date().getDay()];
            if (heading) {
                heading.innerHTML = `<i class="fa-solid fa-calendar-day text-brand-purple me-1"></i> Pilih Produk Mamam Yuk Ready Stock (${todayName} - ${state.kasirActiveOutlet})`;
            }
            if (todayProds.length === 0) {
                grid.innerHTML = `<div class="col-12 text-center py-4 bg-purple-light rounded-3 text-muted"><i class="fa-solid fa-calendar-xmark fs-3 mb-2 text-brand-purple d-block"></i><h6 class="fw-bold text-dark">Belum Ada Menu Ready Stock untuk Hari ${todayName}</h6><p class="fs-8 mb-0">Owner / Admin belum mengatur rotasi menu harian untuk hari ${todayName}.</p></div>`;
                return;
            }
            grid.innerHTML = todayProds.map(p => {
                const stockVal = getOutletStock(state.kasirActiveOutlet, p);
                const isOutOfStock = stockVal <= 0;
                return ` <div class="col-6 mb-2"><div class="card p-2 border text-center ${isOutOfStock ? 'bg-light opacity-50' : 'cursor-pointer bg-light h-100'}" ${isOutOfStock ? '' : `onclick="addPosCart('${p.id}')"`}>${productThumbHtml(p, 56)}<div class="fw-bold fs-8 mt-1 text-dark">${p.name}</div><div class="text-brand-purple fw-extrabold fs-8">Rp ${p.price.toLocaleString('id-ID')}</div><div class="mt-1">${isOutOfStock ? '<span class="badge bg-danger fs-8">STOK HABIS</span>' : `<span class="badge bg-primary fs-8"><i class="fa-solid fa-boxes-stacked me-1"></i> Stok: ${stockVal} Cup</span>`}</div></div></div>`;
            }).join('');
        }
        function addPosCart(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; const currentStock = getOutletStock(state.kasirActiveOutlet, p); const exist = state.posCart.find(x => x.productId == prodId); const currentCartQty = exist ? exist.qty : 0; if (currentCartQty + 1 > currentStock) { Swal.fire({ icon: 'warning', title: 'Stok Tidak Cukup!', text: `Stok ready ${p.name} untuk ${state.kasirActiveOutlet} hanya tersisa ${currentStock} cup.` }); return; } if (exist) { exist.qty += 1; } else { state.posCart.push({ productId: p.id, name: p.name, price: p.price, qty: 1 }); } renderPosCartList(); }
        function updatePosCartQty(prodId, delta) {
            const item = state.posCart.find(x => x.productId == prodId);
            if (!item) return;
            if (delta > 0) {
                const p = state.products.find(x => x.id == prodId);
                const currentStock = p ? getOutletStock(state.kasirActiveOutlet, p) : 999;
                if (item.qty + 1 > currentStock) {
                    Swal.fire({ icon: 'warning', title: 'Stok Tidak Cukup!', text: `Stok ready ${item.name} untuk ${state.kasirActiveOutlet} hanya tersisa ${currentStock} cup.` });
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
        function updatePosDiscount() {
            renderPosCartList();
        }

        function calculatePosTotals() {
            const subtotal = state.posCart.reduce((a, b) => a + (b.price * b.qty), 0);
            const discType = document.getElementById('pos-discount-type')?.value || 'rp';
            const discValInput = parseFloat(document.getElementById('pos-discount-value')?.value) || 0;

            let discountAmount = 0;
            if (discType === 'percent') {
                discountAmount = Math.min(subtotal, Math.round(subtotal * (Math.max(0, discValInput) / 100)));
            } else {
                discountAmount = Math.min(subtotal, Math.max(0, discValInput));
            }

            const finalTotal = Math.max(0, subtotal - discountAmount);
            return { subtotal, discType, discValInput, discountAmount, finalTotal };
        }

        function renderPosCartList() {
            const list = document.getElementById('pos-cart-list');
            if (!list) return;

            if (state.posCart.length === 0) {
                list.innerHTML = `<div class="text-center text-muted fs-8 py-3 fst-italic"><i class="fa-solid fa-basket-shopping fs-4 d-block mb-1 text-secondary opacity-50"></i>Keranjang POS masih kosong.<br>Klik produk di sebelah kiri untuk memilih.</div>`;
                const subEl = document.getElementById('pos-subtotal-display');
                if (subEl) subEl.innerText = 'Rp 0';
                const totEl = document.getElementById('pos-total-display');
                if (totEl) totEl.innerText = 'Rp 0';
                const discDisp = document.getElementById('pos-discount-amount-display');
                if (discDisp) discDisp.style.display = 'none';
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

            const { subtotal, discType, discValInput, discountAmount, finalTotal } = calculatePosTotals();

            const subEl = document.getElementById('pos-subtotal-display');
            if (subEl) subEl.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');

            const totEl = document.getElementById('pos-total-display');
            if (totEl) totEl.innerText = 'Rp ' + finalTotal.toLocaleString('id-ID');

            const discDisp = document.getElementById('pos-discount-amount-display');
            if (discDisp) {
                if (discountAmount > 0) {
                    discDisp.style.display = 'block';
                    discDisp.innerText = `Potongan Diskon (${discType === 'percent' ? discValInput + '%' : 'Rp'}): -Rp ${discountAmount.toLocaleString('id-ID')}`;
                } else {
                    discDisp.style.display = 'none';
                }
            }
        }

        function printPosReceipt(items, subtotal, discountAmount, finalTotal, outletName, trxId) {
            const d = new Date();
            const dateTimeStr = d.toLocaleDateString('id-ID') + ' ' + d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            const itemsHtml = items.map(item => `
                <tr>
                    <td style="padding: 4px 0; border-bottom: 1px dotted #ccc;">
                        <strong style="color:#000;">${item.name}</strong><br>
                        <span style="color:#555;">${item.qty} cup x Rp ${item.price.toLocaleString('id-ID')}</span>
                    </td>
                    <td style="text-align: right; vertical-align: top; padding: 4px 0; border-bottom: 1px dotted #ccc; font-weight: bold;">
                        Rp ${(item.qty * item.price).toLocaleString('id-ID')}
                    </td>
                </tr>
            `).join('');

            let discountRowHtml = '';
            if (discountAmount > 0) {
                discountRowHtml = `
                    <div style="display: flex; justify-content: space-between; font-size: 11px; margin-bottom: 2px;">
                        <span>Subtotal:</span>
                        <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 11px; color: #dc3545; margin-bottom: 4px;">
                        <span>Diskon:</span>
                        <span>-Rp ${discountAmount.toLocaleString('id-ID')}</span>
                    </div>
                `;
            }

            const receiptHtml = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Struk Belanja Mamam Yuk - ${trxId}</title>
                    <style>
                        @page { size: 80mm auto; margin: 0; }
                        body { font-family: 'Courier New', Courier, monospace; width: 270px; margin: 0 auto; padding: 12px; font-size: 12px; color: #000; background: #fff; }
                        .text-center { text-align: center; }
                        .fw-bold { font-weight: bold; }
                        .border-dashed { border-top: 1px dashed #000; margin: 8px 0; }
                        table { width: 100%; border-collapse: collapse; font-size: 11px; }
                    </style>
                </head>
                <body onload="window.print(); setTimeout(() => window.close(), 600);">
                    <div class="text-center">
                        <h3 style="margin: 0 0 2px 0; font-size: 16px; font-weight: bold;">MAMAM YUK</h3>
                        <div style="font-size: 11px; font-weight: bold;">${outletName || 'Outlet Kasir'}</div>
                        <div style="font-size: 10px; color: #333; margin-top: 2px;">Waktu: ${dateTimeStr}</div>
                        <div style="font-size: 10px; color: #333;">No. Trx: <b>${trxId}</b></div>
                    </div>
                    <div class="border-dashed"></div>
                    <table>
                        <tbody>
                            ${itemsHtml}
                        </tbody>
                    </table>
                    <div class="border-dashed"></div>
                    ${discountRowHtml}
                    <div style="display: flex; justify-content: space-between; font-size: 13px;" class="fw-bold">
                        <span>TOTAL BAYAR:</span>
                        <span>Rp ${finalTotal.toLocaleString('id-ID')}</span>
                    </div>
                    <div class="border-dashed"></div>
                    <div class="text-center" style="font-size: 10px; margin-top: 8px; line-height: 1.4;">
                        <b>Terima Kasih Bunda! ❤️</b><br>
                        Nutrisi Mamam Yuk Sehat & Segar Setiap Hari
                    </div>
                </body>
                </html>
            `;

            const printWindow = window.open('', '_blank', 'width=380,height=520');
            if (printWindow) {
                printWindow.document.write(receiptHtml);
                printWindow.document.close();
            }
        }

        function processPosCheckout() {
            if (state.posCart.length === 0) {
                Swal.fire({ icon: 'warning', title: 'POS Kosong', text: 'Pilih produk terlebih dahulu.' });
                return;
            }

            const printOption = document.querySelector('input[name="posPrintReceipt"]:checked')?.value || 'yes';
            const { subtotal, discountAmount, finalTotal } = calculatePosTotals();
            const totalPosQty = state.posCart.reduce((a, b) => a + b.qty, 0);
            const trxId = 'POS-' + Math.floor(1000 + Math.random() * 9000);
            const activeOutlet = state.kasirActiveOutlet || 'Outlet Kasir';
            const purchasedItems = [...state.posCart];

            if (!state.outletSalesRecords[activeOutlet]) {
                state.outletSalesRecords[activeOutlet] = {};
            }

            state.posCart.forEach(item => {
                const p = state.products.find(x => x.id == item.productId);
                if (p) {
                    const curStock = getOutletStock(activeOutlet, p);
                    const newStock = Math.max(0, curStock - item.qty);
                    setOutletStock(activeOutlet, p, newStock);
                    p.stock = newStock;
                    if (!state.outletSalesRecords[activeOutlet][item.productId]) {
                        state.outletSalesRecords[activeOutlet][item.productId] = { sold: 0 };
                    }
                    state.outletSalesRecords[activeOutlet][item.productId].sold += item.qty;
                }
            });

            state.posCart = [];
            const discValEl = document.getElementById('pos-discount-value');
            if (discValEl) discValEl.value = '';

            renderPosCartList();
            renderPosProductsGrid();
            renderKasirLeftoverTable();
            renderAdminProducts('adm-products-tbody', true);
            renderOwnerProducts();
            renderAdminOutletReports();
            renderOwnerOutletReports();
            renderOwnerDashboard();
            renderAdminProduction();
            renderOwnerProduction();

            if (printOption === 'yes') {
                printPosReceipt(purchasedItems, subtotal, discountAmount, finalTotal, activeOutlet, trxId);
                Swal.fire({
                    icon: 'success',
                    title: 'Transaksi POS Berhasil! 🧾',
                    text: discountAmount > 0 ? `Penjualan tercatat (Diskon Rp ${discountAmount.toLocaleString('id-ID')}), stok dipotong, dan struk belanja dicetak!` : 'Penjualan tercatat, stok dipotong, dan struk belanja dicetak!',
                    timer: 1800,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Transaksi POS Berhasil!',
                    text: discountAmount > 0 ? `Penjualan tercatat (Diskon Rp ${discountAmount.toLocaleString('id-ID')}) dan stok dipotong.` : 'Penjualan tercatat dan stok dipotong (tanpa cetak struk).',
                    timer: 1800,
                    showConfirmButton: false
                });
            }
        }
        function getOutletPreorderQty(outletName, product) {
            const yesterdayStr = getYesterdayDateString();
            const pIdStr = String(product.id);
            const pNameLower = (product.name || '').toLowerCase();
            const activeOrders = (state.preOrders || []).filter(o =>
                o.outlet === outletName &&
                o.date === yesterdayStr &&
                o.cancelStatus !== 'approved'
            );
            let totalQty = 0;
            activeOrders.forEach(o => {
                if (o.itemsDetail && o.itemsDetail.length > 0) {
                    o.itemsDetail.forEach(it => {
                        if (String(it.productId) === pIdStr) {
                            totalQty += parseInt(it.qty) || 0;
                        }
                    });
                } else if (o.items) {
                    const parts = o.items.split(',');
                    parts.forEach(part => {
                        const match = part.trim().match(/^(.*?)\s*x(\d+)$/i);
                        if (match) {
                            const name = match[1].trim().toLowerCase();
                            const qty = parseInt(match[2]) || 1;
                            if (pNameLower && (name.includes(pNameLower) || pNameLower.includes(name))) {
                                totalQty += qty;
                            }
                        } else if (part.trim()) {
                            const name = part.trim().toLowerCase();
                            if (pNameLower && (name.includes(pNameLower) || pNameLower.includes(name))) {
                                totalQty += 1;
                            }
                        }
                    });
                }
            });
            return totalQty;
        }
        function renderKasirLeftoverTable() {
            const tbody = document.getElementById('kasir-leftover-tbody');
            if (!tbody) return;
            const todayProds = getTodayProducts();
            const targetProducts = todayProds.length > 0 ? todayProds : state.products;
            const outletSales = state.outletSalesRecords[state.kasirActiveOutlet] || {};
            let grandTotalProfit = 0;
            const rowsHtml = targetProducts.map(p => {
                const prodId = p.id;
                const price = p.price;
                const allocatedQty = getOutletStock(state.kasirActiveOutlet, p);
                const preorderQty = getOutletPreorderQty(state.kasirActiveOutlet, p);
                const soldQty = outletSales[prodId] ? outletSales[prodId].sold : 0;
                const leftoverQty = Math.max(0, allocatedQty - soldQty);
                const totalSold = soldQty + preorderQty;
                const profit = totalSold * price;
                grandTotalProfit += profit;
                return `<tr>
                    <td class="fw-bold text-dark">${p.name}</td>
                    <td>Rp ${price.toLocaleString('id-ID')}</td>
                    <td class="fw-bold text-brand-purple">${preorderQty} Cup Dipesan</td>
                    <td class="fw-bold text-primary">${allocatedQty} Cup</td>
                    <td class="fw-bold text-success">${soldQty} Cup Terjual</td>
                    <td class="fw-bold text-danger">${leftoverQty} Cup Sisa</td>
                    <td class="fw-bold text-success">Rp ${profit.toLocaleString('id-ID')}</td>
                </tr>`;
            }).join('');
            const summaryFooter = `<tr class="table-light fw-bold">
                <td colspan="6" class="text-end text-dark">TOTAL KEUNTUNGAN HARI INI (${state.kasirActiveOutlet}):</td>
                <td class="text-success fs-7">Rp ${grandTotalProfit.toLocaleString('id-ID')}</td>
            </tr>`;
            tbody.innerHTML = rowsHtml + summaryFooter;
        }
        function submitAllKasirLeftovers() { renderAdminOutletReports(); renderOwnerOutletReports(); Swal.fire({ icon: 'success', title: 'Rekap Laporan Dikirim!', text: 'Laporan rekapan penjualan, sisa produk, dan keuntungan untuk ' + state.kasirActiveOutlet + ' telah diteruskan ke Admin & Owner secara real-time!', confirmButtonColor: '#6A1B9A' }); }
        function renderAdminOutletReports() { renderOutletReportsGeneric({ periodSelectId: 'adm-report-period-filter', outletSelectId: 'adm-report-outlet-filter', cardsId: 'adm-outlet-metric-cards', summaryTbodyId: 'adm-outlet-report-tbody', leftoverTbodyId: 'adm-leftover-report-tbody', isAdmin: true }); }
        function renderOwnerOutletReports() { renderOutletReportsGeneric({ periodSelectId: 'own-report-period-filter', outletSelectId: 'own-report-outlet-filter', cardsId: 'own-outlet-metric-cards', summaryTbodyId: 'own-outlet-report-tbody', leftoverTbodyId: 'own-leftover-report-tbody', isAdmin: false }); }
        function renderOutletReportsGeneric(cfg) {
            const selectedOutlet = document.getElementById(cfg.outletSelectId)?.value || 'ALL';
            const selectedPeriod = document.getElementById(cfg.periodSelectId)?.value || 'HARIAN';
            const outletsList = state.outlets;
            const isHarian = selectedPeriod === 'HARIAN';
            const outletData = outletsList.map(outletName => {
                const salesRec = state.outletSalesRecords[outletName] || {};
                let omset = 0;
                let porsi = 0;
                let loss = 0;
                state.products.forEach(p => {
                    const prodSales = salesRec[p.id] ? salesRec[p.id].sold : 0;
                    const allocated = getOutletStock(outletName, p);
                    const leftover = Math.max(0, allocated - prodSales);
                    omset += prodSales * p.price;
                    porsi += prodSales;
                    loss += leftover * p.price;
                });
                return { name: outletName, harianOmset: omset, bulananOmset: omset * 30, porsi: porsi, loss: loss };
            });
            const filteredList = selectedOutlet === 'ALL' ? outletData : outletData.filter(o => o.name === selectedOutlet);
            let totalOmset = 0;
            let totalLoss = 0;
            let totalPorsi = 0;
            filteredList.forEach(o => {
                const omset = isHarian ? o.harianOmset : o.bulananOmset;
                totalOmset += omset;
                totalLoss += (isHarian ? o.loss : o.loss * 30);
                totalPorsi += (isHarian ? o.porsi : o.porsi * 30);
            });
            const cardContainer = document.getElementById(cfg.cardsId);
            if (cardContainer) {
                cardContainer.innerHTML = `<div class="col-md-6"><div class="card-custom p-3 border-start border-4 border-primary"><div class="text-muted fs-8 fw-bold">TOTAL OMSET (${selectedPeriod})</div><div class="fs-5 fw-bold text-primary">Rp ${totalOmset.toLocaleString('id-ID')}</div></div></div><div class="col-md-6"><div class="card-custom p-3 border-start border-4 border-info"><div class="text-muted fs-8 fw-bold">TOTAL PORSI TERJUAL</div><div class="fs-5 fw-bold text-info">${totalPorsi} Cup</div></div></div>`;
            }
            const tbody = document.getElementById(cfg.summaryTbodyId);
            if (tbody) {
                tbody.innerHTML = filteredList.map(o => {
                    const omset = isHarian ? o.harianOmset : o.bulananOmset;
                    const porsi = isHarian ? o.porsi : o.porsi * 30;
                    return `<tr><td class="fw-bold text-brand-purple">${o.name}</td><td class="fw-bold">Rp ${omset.toLocaleString('id-ID')}</td><td>${porsi} Cup</td><td class="text-center"><button class="btn btn-sm btn-brand-purple fs-8 font-bold py-1 px-2.5" onclick="Swal.fire('${o.name}', 'Laporan ${selectedPeriod} untuk ${o.name}:<br>Omset: Rp ${omset.toLocaleString('id-ID')}<br>Porsi Terjual: ${porsi} Cup', 'info')"><i class="fa-solid fa-eye me-1"></i> Rincian</button></td></tr>`;
                }).join('');
            }
            const leftoverTbody = document.getElementById(cfg.leftoverTbodyId);
            if (leftoverTbody) {
                let allLeftoverRows = [];
                const outletsToProcess = selectedOutlet === 'ALL' ? outletsList : [selectedOutlet];
                const dayNamesMap = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const todayDayName = dayNamesMap[new Date().getDay()] || 'Senin';
                const daysOrder = [todayDayName];

                outletsToProcess.forEach(outName => {
                    const salesRec = state.outletSalesRecords[outName] || {};
                    let outletTotalAllocated = 0;
                    let outletTotalSold = 0;
                    let outletTotalLeftover = 0;
                    let outletContentRows = [];

                    daysOrder.forEach(dayName => {
                        const dayConfig = (state.dailyMenu || []).find(d => (d.day || '').toLowerCase() === dayName.toLowerCase());
                        const prodIdsForDay = (dayConfig && Array.isArray(dayConfig.productIds)) ? dayConfig.productIds.map(String) : [];
                        let dayProducts = state.products.filter(p => prodIdsForDay.includes(String(p.id)));
                        if (dayProducts.length === 0) dayProducts = state.products;

                        if (dayProducts.length > 0) {
                            let dayRows = '';
                            dayProducts.forEach(p => {
                                const sold = salesRec[p.id] ? salesRec[p.id].sold : 0;
                                const allocated = getOutletStock(outName, p);
                                const leftover = Math.max(0, allocated - sold);
                                outletTotalAllocated += allocated;
                                outletTotalSold += sold;
                                outletTotalLeftover += leftover;

                                dayRows += `<tr>
                                    <td class="fw-bold text-brand-purple ps-4"><i class="fa-solid fa-angle-right me-2 fs-8 text-secondary"></i>${outName}</td>
                                    <td class="fw-bold text-dark">${p.name}</td>
                                    <td>${allocated} Cup</td>
                                    <td class="text-success fw-bold">${sold} Cup Terjual</td>
                                    <td class="text-danger fw-bold">${leftover} Cup Sisa</td>
                                </tr>`;
                            });

                            if (dayRows) {
                                outletContentRows.push(`
                                    <tr class="table-light border-top">
                                        <td colspan="5" class="fw-bold text-brand-purple fs-8 py-1.5 ps-3">
                                            <i class="fa-solid fa-calendar-day me-2"></i> Menu Rotasi Harian: HARI ${dayName.toUpperCase()} (HARI INI)
                                        </td>
                                    </tr>
                                ` + dayRows);
                            }
                        }
                    });

                    if (outletContentRows.length > 0) {
                        allLeftoverRows.push(`
                            <tr class="table-primary border-top border-purple-200">
                                <td colspan="5" class="fw-extrabold text-brand-purple fs-7 py-2">
                                    <i class="fa-solid fa-store me-2"></i> Cabang Outlet: ${outName} (Total Alokasi: ${outletTotalAllocated} Cup | Terjual: ${outletTotalSold} Cup | Total Sisa: ${outletTotalLeftover} Cup)
                                </td>
                            </tr>
                        ` + outletContentRows.join(''));
                    }
                });

                leftoverTbody.innerHTML = allLeftoverRows.join('') || `<tr><td colspan="5" class="text-center text-muted fs-8 fst-italic py-3">Belum ada data sisa produk untuk hari ini.</td></tr>`;
            }
        }
        function renderAdminPesananPerOutlet() { const selectedOutlet = document.getElementById('adm-pesanan-outlet-filter')?.value || 'ALL'; const todayStr = getTodayDateString(); const todayOrders = state.preOrders.filter(p => p.date === todayStr); const tbody = document.getElementById('adm-pesanan-tbody'); const filteredOrders = selectedOutlet === 'ALL' ? todayOrders : todayOrders.filter(p => p.outlet === selectedOutlet); if (tbody) { tbody.innerHTML = filteredOrders.length > 0 ? filteredOrders.map(p => `<tr class="${p.isTaken ? 'bg-light opacity-75' : ''} ${p.cancelStatus === 'approved' ? 'table-danger' : ''}"><td class="fw-bold ${p.isTaken || p.cancelStatus === 'approved' ? 'text-decoration-line-through text-muted' : 'text-dark'}">${p.id} - ${p.customerName}</td><td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8">${p.outlet}</span></td><td><a href="https://wa.me/${p.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${p.wa}</a></td><td class="fs-8">${p.items}</td><td><span class="badge ${p.isPaid ? 'bg-success' : 'bg-danger'} fs-8">${p.isPaid ? 'Lunas ✅' : 'Belum Bayar (COD)'}</span></td><td><span class="badge ${p.isTaken ? 'bg-success' : 'bg-warning text-dark'} fs-8">${p.isTaken ? 'Sudah Diambil ✅' : 'Menunggu Ambil'}</span></td><td>${cancelInfoBadge(p)}</td></tr>`).join('') : `<tr><td colspan="7" class="text-center text-muted fs-8 fst-italic py-3">Belum ada pesanan masuk hari ini untuk diambil besok.</td></tr>`; } renderOrdersMenuSummary(filteredOrders, 'adm-pesanan-summary-content', 'adm-pesanan-total-badge', selectedOutlet !== 'ALL' ? selectedOutlet : 'Semua Outlet'); renderAdminOutletStockTable(); }
        function getOutletStock(outletName, product) {
            if (!state.outletStock) state.outletStock = {};
            if (!outletName) outletName = (state.outlets && state.outlets[0]) ? state.outlets[0] : 'Outlet Utama';
            if (!state.outletStock[outletName]) state.outletStock[outletName] = {};
            const pId = String(product.id);
            if (state.outletStock[outletName][pId] !== undefined) {
                return state.outletStock[outletName][pId];
            }
            return 0;
        }
        function setOutletStock(outletName, product, newStock) {
            if (!state.outletStock) state.outletStock = {};
            if (!outletName) outletName = (state.outlets && state.outlets[0]) ? state.outlets[0] : 'Outlet Utama';
            if (!state.outletStock[outletName]) state.outletStock[outletName] = {};
            const pId = String(product.id);
            state.outletStock[outletName][pId] = Number(newStock);
            try { localStorage.setItem('mamamyuk_outlet_stock', JSON.stringify(state.outletStock)); } catch(e){}
        }
        function renderAdminOutletStockTable() {
            const selEl = document.getElementById('adm-stock-outlet-select');
            if (!selEl) return;
            if (selEl.options.length === 0 && state.outlets && state.outlets.length > 0) {
                selEl.innerHTML = state.outlets.map(o => `<option value="${escAttr(o)}">${o}</option>`).join('');
            }
            const selectedOutlet = selEl.value || (state.outlets && state.outlets[0]) || '';
            const daySelectEl = document.getElementById('adm-stock-day-select');
            if (daySelectEl && !daySelectEl.dataset.autoInitialized) {
                const dayNamesMap = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const todayDayName = dayNamesMap[new Date().getDay()] || 'Senin';
                daySelectEl.value = todayDayName;
                daySelectEl.dataset.autoInitialized = 'true';
            }
            const selectedDayFilter = daySelectEl?.value || 'ALL';
            const tbody = document.getElementById('adm-outlet-stock-tbody');
            if (!tbody) return;

            if (!state.products || state.products.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted fs-8 fst-italic py-3">Belum ada produk terdaftar di Master Produk.</td></tr>`;
                return;
            }

            const daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            const filteredDays = selectedDayFilter === 'ALL' ? daysOrder : [selectedDayFilter];

            let rowsHtml = '';
            let processedProdIds = new Set();

            filteredDays.forEach(dayName => {
                const dayConfig = (state.dailyMenu || []).find(d => (d.day || '').toLowerCase() === dayName.toLowerCase());
                const prodIdsForDay = (dayConfig && Array.isArray(dayConfig.productIds)) ? dayConfig.productIds.map(String) : [];
                const dayProducts = state.products.filter(p => prodIdsForDay.includes(String(p.id)));

                if (dayProducts.length > 0) {
                    rowsHtml += `<tr class="table-primary border-top border-purple-200"><td colspan="5" class="fw-extrabold text-brand-purple fs-7 py-2"><i class="fa-solid fa-calendar-day me-2"></i> Menu Rotasi Harian: HARI ${dayName.toUpperCase()} (${dayProducts.length} Varian Produk)</td></tr>`;
                    dayProducts.forEach(p => {
                        processedProdIds.add(String(p.id));
                        const curStock = getOutletStock(selectedOutlet, p);
                        rowsHtml += `<tr>
                            <td class="fw-bold text-dark ps-4"><i class="fa-solid fa-angle-right me-2 text-brand-purple fs-8"></i>${p.name}</td>
                            <td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8">${p.category || 'Bubur'} (${p.age || '6+ Bulan'})</span></td>
                            <td class="fw-bold text-brand-purple">Rp ${p.price.toLocaleString('id-ID')}</td>
                            <td style="max-width:140px;"><input type="number" min="0" class="form-control form-control-sm fw-bold border-purple-200 text-primary" id="ostock-${dayName}-${p.id}" value="${curStock}"></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-brand-purple py-1 px-2.5 fs-8 fw-bold" onclick="saveAdminOutletStock('${escAttr(selectedOutlet)}', '${p.id}', 'ostock-${dayName}-${p.id}')">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Stok ${dayName}
                                </button>
                            </td>
                        </tr>`;
                    });
                }
            });

            const remainingProducts = state.products.filter(p => !processedProdIds.has(String(p.id)));
            if (remainingProducts.length > 0) {
                const sectionTitle = processedProdIds.size > 0 ? 'Master Produk Lainnya' : 'Daftar Seluruh Varian Produk';
                rowsHtml += `<tr class="table-light border-top"><td colspan="5" class="fw-extrabold text-secondary fs-7 py-2"><i class="fa-solid fa-boxes-stacked me-2"></i> ${sectionTitle} (${remainingProducts.length} Varian)</td></tr>`;
                remainingProducts.forEach(p => {
                    const curStock = getOutletStock(selectedOutlet, p);
                    rowsHtml += `<tr>
                        <td class="fw-bold text-dark ps-4"><i class="fa-solid fa-angle-right me-2 text-secondary fs-8"></i>${p.name}</td>
                        <td><span class="badge bg-light text-dark border fs-8">${p.category || 'Bubur'} (${p.age || '6+ Bulan'})</span></td>
                        <td class="fw-bold text-brand-purple">Rp ${p.price.toLocaleString('id-ID')}</td>
                        <td style="max-width:140px;"><input type="number" min="0" class="form-control form-control-sm fw-bold border-purple-200 text-primary" id="ostock-other-${p.id}" value="${curStock}"></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-brand-purple py-1 px-2.5 fs-8 fw-bold" onclick="saveAdminOutletStock('${escAttr(selectedOutlet)}', '${p.id}', 'ostock-other-${p.id}')">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Stok Cabang
                            </button>
                        </td>
                    </tr>`;
                });
            }

            tbody.innerHTML = rowsHtml;
        }
        function saveAdminOutletStock(outletName, prodId, inputId) {
            const p = state.products.find(x => x.id == prodId || String(x.id) === String(prodId));
            if (!p) return;
            const input = document.getElementById(inputId || ('ostock-' + prodId));
            const val = parseInt(input ? input.value : 0);
            const newStock = isNaN(val) ? 0 : Math.max(0, val);
            setOutletStock(outletName, p, newStock);
            renderAllUI();
            Swal.fire({
                icon: 'success',
                title: 'Stok Cabang Disimpan!',
                text: `Stok ready ${p.name} untuk ${outletName} berhasil diatur menjadi ${newStock} cup!`,
                timer: 1500,
                showConfirmButton: false
            });
        }
        function autoFillStockFromOrders() {
            const selEl = document.getElementById('adm-stock-outlet-select');
            if (!selEl) return;
            const selectedOutlet = selEl.value || (state.outlets && state.outlets[0] ? state.outlets[0] : '');
            if (!selectedOutlet) return;

            let totalUpdated = 0;
            state.products.forEach(p => {
                const orderedQty = computeProductionNumbers(p.id, selectedOutlet).total;
                setOutletStock(selectedOutlet, p, orderedQty);
                totalUpdated++;
            });

            renderAllUI();

            Swal.fire({
                icon: 'success',
                title: 'Stok Disamakan!',
                text: `Stok ready seluruh varian untuk ${selectedOutlet} berhasil disamakan dengan total pesanan pelanggan!`,
                timer: 1500,
                showConfirmButton: false
            });
        }
        function useOrderedQtyAsStock(outletName, prodId, orderedQty, inputId) {
            const p = state.products.find(x => x.id == prodId || String(x.id) === String(prodId));
            if (!p) return;
            const input = document.getElementById(inputId);
            if (input) input.value = orderedQty;
            setOutletStock(outletName, p, orderedQty);
            renderAllUI();
            Swal.fire({
                icon: 'success',
                title: 'Stok Diisi!',
                text: `Stok ready ${p.name} untuk ${outletName} disesuaikan menjadi ${orderedQty} cup.`,
                timer: 1200,
                showConfirmButton: false
            });
        }
        function showAddManualOrderModal() {
            if (!state.products || state.products.length === 0) {
                Swal.fire({ icon: 'warning', title: 'Belum Ada Produk', text: 'Master data produk masih kosong.' });
                return;
            }

            const outletsOptions = (state.outlets && state.outlets.length > 0)
                ? state.outlets.map(o => `<option value="${escAttr(o)}">${o}</option>`).join('')
                : '<option value="Outlet Utama">Outlet Utama</option>';

            const productsInputsHtml = state.products.map(p => `
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <div class="text-start pe-2" style="flex: 1;">
                        <div class="fw-bold fs-8 text-dark">${p.name}</div>
                        <div class="text-brand-purple fs-8 fw-bold">Rp ${p.price.toLocaleString('id-ID')} / cup</div>
                    </div>
                    <div style="width: 100px;">
                        <input type="number" min="0" value="0" id="swal-mqty-${p.id}" class="form-control form-control-sm text-center fw-bold border-purple-200">
                    </div>
                </div>
            `).join('');

            Swal.fire({
                title: '<i class="fa-solid fa-plus-circle text-brand-purple me-2"></i>Tambah Pesanan Manual (Offline / WA)',
                width: '580px',
                html: `
                    <div class="text-start fs-8 text-muted mb-3">Input pesanan untuk pelanggan yang memesan secara langsung via WhatsApp, Telepon, atau Offline Walk-in.</div>
                    <div class="text-start mb-2">
                        <label class="form-label fs-8 fw-bold mb-1 text-dark">Nama Bunda / Pelanggan *</label>
                        <input id="swal-mname" class="form-control form-control-sm border-purple-200" placeholder="Contoh: Bunda Rina (Offline / WA)">
                    </div>
                    <div class="row g-2 mb-2 text-start">
                        <div class="col-md-6">
                            <label class="form-label fs-8 fw-bold mb-1 text-dark">No. WhatsApp *</label>
                            <input id="swal-mwa" class="form-control form-control-sm border-purple-200" placeholder="Contoh: 08123456789">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-8 fw-bold mb-1 text-dark">Cabang Outlet *</label>
                            <select id="swal-moutlet" class="form-select form-select-sm border-purple-200 text-brand-purple fw-bold">
                                ${outletsOptions}
                            </select>
                        </div>
                    </div>
                    <div class="text-start mb-3">
                        <label class="form-label fs-8 fw-bold mb-1 text-dark">Status Pembayaran *</label>
                        <select id="swal-mpay" class="form-select form-select-sm border-purple-200">
                            <option value="Transfer">Lunas (Transfer / Tunai)</option>
                            <option value="COD" selected>Belum Bayar (COD / Bayar Saat Ambil)</option>
                        </select>
                    </div>
                    <div class="text-start mb-1">
                        <label class="form-label fs-8 fw-bold mb-1 text-dark"><i class="fa-solid fa-utensils me-1 text-brand-purple"></i> Pilih Varian & Jumlah Cup *</label>
                    </div>
                    <div style="max-height: 200px; overflow-y: auto;" class="border rounded p-2 bg-light">
                        ${productsInputsHtml}
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: '<i class="fa-solid fa-floppy-disk me-1"></i> Simpan Pesanan Manual',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6A1B9A',
                preConfirm: () => {
                    const name = document.getElementById('swal-mname')?.value.trim();
                    const wa = document.getElementById('swal-mwa')?.value.trim();
                    const outlet = document.getElementById('swal-moutlet')?.value;
                    const payMethod = document.getElementById('swal-mpay')?.value;

                    if (!name) {
                        Swal.showValidationMessage('Nama Bunda / Pelanggan wajib diisi!');
                        return false;
                    }
                    if (!wa) {
                        Swal.showValidationMessage('Nomor WhatsApp wajib diisi!');
                        return false;
                    }

                    const itemsDetail = [];
                    const itemsParts = [];
                    let totalAmount = 0;

                    state.products.forEach(p => {
                        const qtyInput = document.getElementById('swal-mqty-' + p.id);
                        const qty = parseInt(qtyInput ? qtyInput.value : 0);
                        if (!isNaN(qty) && qty > 0) {
                            itemsDetail.push({ productId: p.id, qty: qty });
                            itemsParts.push(`${p.name} x${qty}`);
                            totalAmount += p.price * qty;
                        }
                    });

                    if (itemsDetail.length === 0) {
                        Swal.showValidationMessage('Pilih minimal 1 varian produk dengan jumlah > 0!');
                        return false;
                    }

                    return {
                        name,
                        wa,
                        outlet,
                        payMethod,
                        itemsDetail,
                        itemsStr: itemsParts.join(', '),
                        totalAmount
                    };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    const res = result.value;
                    const newOrder = {
                        id: 'ORD-M-' + Math.floor(100 + Math.random() * 900),
                        customerName: res.name + ' (Manual)',
                        wa: res.wa,
                        outlet: res.outlet,
                        items: res.itemsStr,
                        itemsDetail: res.itemsDetail,
                        totalAmount: res.totalAmount,
                        isPaid: res.payMethod === 'Transfer',
                        payMethod: res.payMethod === 'Transfer' ? 'Transfer' : 'COD',
                        isTaken: false,
                        isManual: true,
                        cancelStatus: null,
                        cancelReason: null,
                        memberIdentifier: null,
                        pointsAwarded: 0,
                        date: getTodayDateString()
                    };

                    state.preOrders.unshift(newOrder);
                    savePreOrdersToStorage();

                    fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            customer_name: res.name + ' (Manual)',
                            whatsapp: res.wa,
                            outlet_id: res.outlet,
                            pay_method: res.payMethod === 'Transfer' ? 'Transfer' : 'COD',
                            items: res.itemsDetail.map(it => ({ product_id: it.productId, qty: it.qty }))
                        })
                    }).catch(err => console.error("Database sync error:", err));

                    renderAllUI();

                    const totalCups = res.itemsDetail.reduce((a, b) => a + b.qty, 0);
                    Swal.fire({
                        icon: 'success',
                        title: 'Pesanan Manual Berhasil!',
                        html: `Pesanan manual a.n <b>${res.name}</b> (${res.outlet}) sebanyak <b>${totalCups} Cup</b> berhasil dicatat & masuk ke rekap dapur!`,
                        confirmButtonColor: '#6A1B9A'
                    });
                }
            });
        }
        function printDapurMasakReport(filterSelectId) {
            const outletFilter = document.getElementById(filterSelectId)?.value || 'ALL';
            const daySelectId = filterSelectId === 'adm-dapur-outlet-filter' ? 'adm-dapur-day-filter' : 'own-dapur-day-filter';
            const dayFilter = document.getElementById(daySelectId)?.value || 'ALL';
            const d = new Date();
            const dateTimeStr = d.toLocaleDateString('id-ID') + ' ' + d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            const daysOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            const filteredDays = dayFilter === 'ALL' ? daysOrder : [dayFilter];

            let rowsHtml = '';
            let totalOnlineAll = 0, totalManualAll = 0, totalStockAll = 0, grandTotalAll = 0;
            let processedProdIds = new Set();
            let totalItemCount = 0;

            filteredDays.forEach(dayName => {
                const dayConfig = (state.dailyMenu || []).find(d => (d.day || '').toLowerCase() === dayName.toLowerCase());
                const prodIdsForDay = (dayConfig && Array.isArray(dayConfig.productIds)) ? dayConfig.productIds.map(String) : [];
                const dayProducts = state.products.filter(p => prodIdsForDay.includes(String(p.id)));

                let dayRows = '';
                let dayOnline = 0, dayManual = 0, dayStock = 0, dayTotal = 0;

                dayProducts.forEach(p => {
                    processedProdIds.add(String(p.id));
                    const { onlinePreorder, manualPreorder } = computeProductionNumbers(p.id, outletFilter);
                    let productStock = 0;
                    if (outletFilter === 'ALL') {
                        (state.outlets || []).forEach(outName => {
                            productStock += getOutletStock(outName, p);
                        });
                    } else {
                        productStock = getOutletStock(outletFilter, p);
                    }
                    const totalPorsiMasak = onlinePreorder + manualPreorder + productStock;

                    if (totalPorsiMasak > 0 || dayFilter !== 'ALL') {
                        totalItemCount++;
                        dayOnline += onlinePreorder;
                        dayManual += manualPreorder;
                        dayStock += productStock;
                        dayTotal += totalPorsiMasak;
                        dayRows += `
                            <tr>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; font-weight: bold;">${p.name}</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center;">${onlinePreorder} Cup</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center;">${manualPreorder} Cup</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center;">${productStock} Cup</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: #6A1B9A;">${totalPorsiMasak} Cup</td>
                            </tr>
                        `;
                    }
                });

                if (dayRows) {
                    totalOnlineAll += dayOnline;
                    totalManualAll += dayManual;
                    totalStockAll += dayStock;
                    grandTotalAll += dayTotal;
                    rowsHtml += `
                        <tr style="background-color: #f3e5f5; font-weight: bold;">
                            <td colspan="5" style="padding: 6px 8px; border: 1px solid #ddd; color: #6A1B9A;">
                                📅 Menu Rotasi Harian: HARI ${dayName.toUpperCase()} (Total Masak: ${dayTotal} Cup)
                            </td>
                        </tr>
                    ` + dayRows;
                }
            });

            if (dayFilter === 'ALL') {
                const remainingProducts = state.products.filter(p => !processedProdIds.has(String(p.id)));
                let otherRows = '';
                let otherOnline = 0, otherManual = 0, otherStock = 0, otherTotal = 0;

                remainingProducts.forEach(p => {
                    const { onlinePreorder, manualPreorder } = computeProductionNumbers(p.id, outletFilter);
                    let productStock = 0;
                    if (outletFilter === 'ALL') {
                        (state.outlets || []).forEach(outName => {
                            productStock += getOutletStock(outName, p);
                        });
                    } else {
                        productStock = getOutletStock(outletFilter, p);
                    }
                    const totalPorsiMasak = onlinePreorder + manualPreorder + productStock;

                    if (totalPorsiMasak > 0) {
                        totalItemCount++;
                        otherOnline += onlinePreorder;
                        otherManual += manualPreorder;
                        otherStock += productStock;
                        otherTotal += totalPorsiMasak;
                        otherRows += `
                            <tr>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; font-weight: bold;">${p.name}</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center;">${onlinePreorder} Cup</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center;">${manualPreorder} Cup</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center;">${productStock} Cup</td>
                                <td style="padding: 6px 8px; border: 1px solid #ddd; text-align: center; font-weight: bold; color: #6A1B9A;">${totalPorsiMasak} Cup</td>
                            </tr>
                        `;
                    }
                });

                if (otherRows) {
                    totalOnlineAll += otherOnline;
                    totalManualAll += otherManual;
                    totalStockAll += otherStock;
                    grandTotalAll += otherTotal;
                    rowsHtml += `
                        <tr style="background-color: #e9ecef; font-weight: bold;">
                            <td colspan="5" style="padding: 6px 8px; border: 1px solid #ddd; color: #495057;">
                                📦 Master Produk Lainnya (Total Masak: ${otherTotal} Cup)
                            </td>
                        </tr>
                    ` + otherRows;
                }
            }

            const summaryRowHtml = totalItemCount > 0 ? `
                <tr style="background-color: #f8f9fa; font-weight: bold;">
                    <td style="padding: 8px; border: 1px solid #ddd;">TOTAL SELURUH VARIAN (${outletFilter !== 'ALL' ? outletFilter : 'Semua Outlet'}${dayFilter !== 'ALL' ? ` - ${dayFilter}` : ''})</td>
                    <td style="padding: 8px; border: 1px solid #ddd; text-align: center; color: #0d6efd;">${totalOnlineAll} Cup</td>
                    <td style="padding: 8px; border: 1px solid #ddd; text-align: center; color: #d97706;">${totalManualAll} Cup</td>
                    <td style="padding: 8px; border: 1px solid #ddd; text-align: center; color: #0dcaf0;">${totalStockAll} Cup</td>
                    <td style="padding: 8px; border: 1px solid #ddd; text-align: center; color: #6A1B9A; font-size: 14px;">${grandTotalAll} Cup</td>
                </tr>
            ` : `<tr><td colspan="5" style="text-align:center; padding:15px; color:#666;">Belum ada pesanan untuk ${outletFilter}.</td></tr>`;

            const printHtml = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Rekapitulasi Dapur Masak - ${outletFilter}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; font-size: 13px; }
                        h2 { margin-bottom: 5px; color: #333; }
                        .meta { color: #666; font-size: 11px; margin-bottom: 15px; }
                        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                        th { background-color: #6A1B9A; color: white; padding: 8px; border: 1px solid #6A1B9A; text-align: left; }
                    </style>
                </head>
                <body onload="window.print(); setTimeout(() => window.close(), 600);">
                    <h2>MAMAM YUK - Rekapitulasi Dapur Masak Esok Hari</h2>
                    <div class="meta">Outlet: <b>${outletFilter === 'ALL' ? 'Semua Outlet (Konsolidasi)' : outletFilter}</b> | Filter Hari: <b>${dayFilter}</b> | Waktu Cetak: ${dateTimeStr}</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Varian Mamam Yuk</th>
                                <th style="text-align: center;">Pre-Order Online</th>
                                <th style="text-align: center;">Pre-Order Manual</th>
                                <th style="text-align: center;">Stok Produk</th>
                                <th style="text-align: center;">Total Porsi Masak</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${rowsHtml}
                            ${summaryRowHtml}
                        </tbody>
                    </table>
                </body>
                </html>
            `;

            const printWindow = window.open('', '_blank');
            if (printWindow) {
                printWindow.document.write(printHtml);
                printWindow.document.close();
            }
        }
        function openKasirSwitchOutletModal() {
            const currentOutlet = state.kasirActiveOutlet || state.outlets[0];
            const outletOptions = state.outlets.map(o => `<option value="${escAttr(o)}" ${o === currentOutlet ? 'selected' : ''}>${o}</option>`).join('');

            Swal.fire({
                title: '<i class="fa-solid fa-lock text-brand-purple me-2"></i> Pindah Cabang Kasir',
                html: `
                    <div class="text-start fs-7 mb-3 text-secondary">
                        Pilih cabang outlet yang ingin Anda buka dan masukkan PIN akses kasirnya:
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label fs-8 fw-bold text-dark mb-1">Pilih Cabang Outlet Tujuan:</label>
                        <select id="swal-target-outlet-select" class="form-select border-purple-200 fs-7 fw-bold text-brand-purple">
                            ${outletOptions}
                        </select>
                    </div>
                    <div class="mb-2 text-start">
                        <label class="form-label fs-8 fw-bold text-dark mb-1">PIN Akses Kasir (4-6 Digit):</label>
                        <input id="swal-kasir-pin-input" type="password" maxlength="6" class="form-control text-center fw-bold fs-4 border-purple-200" placeholder="• • • •" autocomplete="off">
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: '<i class="fa-solid fa-key me-1"></i> Verifikasi & Pindah Cabang',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6A1B9A',
                preConfirm: () => {
                    const targetOutlet = document.getElementById('swal-target-outlet-select').value;
                    const pin = document.getElementById('swal-kasir-pin-input').value.trim();
                    if (!pin) {
                        Swal.showValidationMessage('Masukkan PIN Akses Kasir!');
                        return false;
                    }
                    return { targetOutlet, pin };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    const { targetOutlet, pin } = result.value;
                    startLoading();
                    fetch('/api/outlets/verify-pin', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ outlet_name: targetOutlet, pin: pin })
                    }).then(async r => {
                        const data = await r.json().catch(() => ({}));
                        if (!r.ok || data.success === false) {
                            throw new Error(data.message || 'PIN Akses Kasir Salah!');
                        }
                        return data;
                    }).then(() => {
                        state.kasirActiveOutlet = targetOutlet;
                        state.authenticatedKasirOutlet = targetOutlet;
                        try {
                            sessionStorage.setItem('auth_kasir_outlet', targetOutlet);
                        } catch(e) {}
                        renderAllUI();
                        switchKasirTab('preorder');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Pindah Cabang! ✅',
                            text: `Cabang bertugas aktif saat ini: ${targetOutlet}`,
                            timer: 1600,
                            showConfirmButton: false
                        });
                    }).catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Akses Ditolak 🔒',
                            text: err.message || 'PIN Akses Kasir Salah!'
                        });
                    }).finally(() => {
                        endLoading();
                    });
                }
            });
        }

        function renderOutletDropdowns() {
            const coOutlet = document.getElementById('co-outlet');
            if (coOutlet) {
                const currentVal = coOutlet.value;
                coOutlet.innerHTML = state.outlets.map(o => `<option value="${escAttr(o)}">${o}</option>`).join('');
                if (state.outlets.includes(currentVal)) coOutlet.value = currentVal;
            }
            const isAuth = !!(state.authenticatedKasirOutlet && state.outlets.includes(state.authenticatedKasirOutlet));
            const activeOutletEl = document.getElementById('kasir-active-outlet-name');
            const activeOutletBadge = document.getElementById('kasir-active-outlet-badge');
            const unauthCard = document.getElementById('kasir-unauth-lock-card');

            if (activeOutletEl) {
                activeOutletEl.innerText = isAuth ? state.authenticatedKasirOutlet : 'Belum Login Cabang';
            }
            if (activeOutletBadge) {
                activeOutletBadge.innerHTML = isAuth 
                    ? `<i class="fa-solid fa-location-dot me-1 text-danger"></i> ${state.authenticatedKasirOutlet}`
                    : `<i class="fa-solid fa-lock me-1 text-warning"></i> Belum Verifikasi Cabang`;
            }

            if (unauthCard) {
                if (!isAuth && state.activeRole === 'kasir') {
                    unauthCard.style.display = 'block';
                    document.querySelectorAll('.kasir-tab-content').forEach(el => el.style.display = 'none');
                } else if (isAuth && state.activeRole === 'kasir') {
                    unauthCard.style.display = 'none';
                }
            }

            ['adm-report-outlet-filter', 'own-report-outlet-filter', 'adm-pesanan-outlet-filter', 'adm-dapur-outlet-filter', 'own-dapur-outlet-filter'].forEach(selId => {
                const sel = document.getElementById(selId);
                if (!sel) return;
                const currentVal = sel.value || 'ALL';
                sel.innerHTML = '<option value="ALL">KONSOLIDASI SEMUA OUTLET</option>' + state.outlets.map(o => `<option value="${escAttr(o)}">${o}</option>`).join('');
                sel.value = (currentVal === 'ALL' || state.outlets.includes(currentVal)) ? currentVal : 'ALL';
            });
        }
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
        function saveExpensesToStorage() {
            try {
                localStorage.setItem('mpasi_owner_expenses', JSON.stringify(state.expenses));
            } catch(e){}
        }

        function renderOwnerExpenses() {
            const tbody = document.getElementById('owner-expenses-tbody');
            if (!tbody) return;

            const todayStr = getTodayDateString();
            const currentMonthStr = todayStr.substring(0, 7);

            const filteredExpenses = state.expenses || [];

            let totalToday = 0;
            let totalMonth = 0;

            filteredExpenses.forEach(e => {
                const amt = Number(e.amount || 0);
                if (e.date === todayStr) totalToday += amt;
                if (e.date && e.date.substring(0, 7) === currentMonthStr) totalMonth += amt;
            });

            const expTodayEl = document.getElementById('exp-total-today');
            if (expTodayEl) expTodayEl.innerText = 'Rp ' + totalToday.toLocaleString('id-ID');

            const expMonthEl = document.getElementById('exp-total-month');
            if (expMonthEl) expMonthEl.innerText = 'Rp ' + totalMonth.toLocaleString('id-ID');

            const expItemsEl = document.getElementById('exp-total-items');
            if (expItemsEl) expItemsEl.innerText = filteredExpenses.length + ' Item';

            if (filteredExpenses.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted fs-8 fst-italic py-4"><i class="fa-solid fa-receipt me-2 text-secondary"></i>Belum ada catatan pengeluaran operasional. Klik "+ Tambah Pengeluaran Baru" untuk mencatat.</td></tr>`;
                return;
            }

            tbody.innerHTML = filteredExpenses.map(e => `
                <tr>
                    <td class="fw-bold text-muted fs-8">${e.date || '-'}</td>
                    <td class="fw-bold text-dark fs-7">${e.name}</td>
                    <td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8">${e.category || 'Operasional'}</span></td>
                    <td class="fw-bold text-danger fs-7">Rp ${Number(e.amount || 0).toLocaleString('id-ID')}</td>
                    <td class="text-muted fs-8">${e.note || '-'}</td>
                    <td class="text-center text-nowrap">
                        <button class="btn btn-sm btn-outline-secondary py-1 px-2 fs-8 fw-bold" onclick="editExpenseModal('${e.id}')"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</button>
                        <button class="btn btn-sm btn-outline-danger py-1 px-2 fs-8 fw-bold ms-1" onclick="deleteExpense('${e.id}')"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');
        }

        function showAddExpenseModal() {
            const todayStr = getTodayDateString();

            Swal.fire({
                title: '<i class="fa-solid fa-plus-circle text-brand-purple me-2"></i> Tambah Pengeluaran Baru',
                html: `
                    <div class="text-start fs-8 text-muted mb-2">Isi detail barang yang dibeli dan biaya pengeluaran operasional:</div>
                    <div class="mb-2 text-start">
                        <label class="form-label fs-8 fw-bold mb-1">Nama Barang yang Dibeli *</label>
                        <input id="swal-exp-name" class="swal2-input m-0 w-100" placeholder="Contoh: Gas LPG 3kg / Cup Kemasan 100ml / Stiker Label">
                    </div>
                    <div class="mb-2 text-start">
                        <label class="form-label fs-8 fw-bold mb-1">Biaya / Nominal Pengeluaran (Rp) *</label>
                        <input id="swal-exp-amount" type="number" class="swal2-input m-0 w-100" placeholder="Contoh: 50000">
                    </div>
                    <div class="mb-2 text-start">
                        <label class="form-label fs-8 fw-bold mb-1">Kategori Barang</label>
                        <select id="swal-exp-category" class="swal2-select m-0 w-100 fs-8">
                            <option value="Bahan Baku & Dapur">Bahan Baku & Dapur</option>
                            <option value="Peralatan & Stiker">Peralatan & Kemasan</option>
                            <option value="Transportasi & Bensin">Transportasi & Bensin</option>
                            <option value="Listrik & Air">Listrik, Air & Internet</option>
                            <option value="Gaji & Bonus Staff">Gaji & Bonus Staff</option>
                            <option value="Operasional Lainnya">Operasional Lainnya</option>
                        </select>
                    </div>
                    <div class="row g-2 mb-2 text-start">
                        <div class="col-6">
                            <label class="form-label fs-8 fw-bold mb-1">Tanggal Transaksi</label>
                            <input id="swal-exp-date" type="date" class="swal2-input m-0 w-100 fs-8" value="${todayStr}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-8 fw-bold mb-1">Catatan / Keterangan</label>
                            <input id="swal-exp-note" class="swal2-input m-0 w-100 fs-8" placeholder="Catatan tambahan (opsional)">
                        </div>
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Simpan Pengeluaran',
                confirmButtonColor: '#6A1B9A',
                preConfirm: () => {
                    const name = document.getElementById('swal-exp-name').value.trim();
                    const amount = parseInt(document.getElementById('swal-exp-amount').value) || 0;
                    const category = document.getElementById('swal-exp-category').value;
                    const date = document.getElementById('swal-exp-date').value || todayStr;
                    const note = document.getElementById('swal-exp-note').value.trim();

                    if (!name || amount <= 0) {
                        Swal.showValidationMessage('Harap isi Nama Barang yang Dibeli dan Nominal Biaya dengan benar!');
                        return false;
                    }
                    return { name, amount, category, date, note };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    const newExp = {
                        id: 'EXP-' + Math.floor(100 + Math.random() * 900),
                        name: result.value.name,
                        amount: result.value.amount,
                        category: result.value.category,
                        date: result.value.date,
                        note: result.value.note
                    };
                    state.expenses.unshift(newExp);
                    saveExpensesToStorage();
                    renderAllUI();
                    Swal.fire({
                        icon: 'success',
                        title: 'Pengeluaran Disimpan!',
                        text: `Catatan "${newExp.name}" senilai Rp ${newExp.amount.toLocaleString('id-ID')} berhasil ditambahkan!`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }

        function editExpenseModal(expId) {
            const exp = state.expenses.find(e => e.id == expId);
            if (!exp) return;
            const todayStr = getTodayDateString();

            const categories = [
                'Bahan Baku & Dapur',
                'Peralatan & Stiker',
                'Transportasi & Bensin',
                'Listrik & Air',
                'Gaji & Bonus Staff',
                'Operasional Lainnya'
            ];

            const categoryOptions = categories.map(c => `<option value="${c}" ${exp.category === c ? 'selected' : ''}>${c}</option>`).join('');

            Swal.fire({
                title: '<i class="fa-solid fa-pen-to-square text-brand-purple me-2"></i> Edit Pengeluaran',
                html: `
                    <div class="text-start fs-8 text-muted mb-2">Ubah nama barang yang dibeli, nominal, atau rincian pengeluaran:</div>
                    <div class="mb-2 text-start">
                        <label class="form-label fs-8 fw-bold mb-1">Nama Barang yang Dibeli *</label>
                        <input id="swal-eexp-name" class="swal2-input m-0 w-100" value="${escAttr(exp.name)}" placeholder="Nama Barang yang Dibeli">
                    </div>
                    <div class="mb-2 text-start">
                        <label class="form-label fs-8 fw-bold mb-1">Biaya / Nominal Pengeluaran (Rp) *</label>
                        <input id="swal-eexp-amount" type="number" class="swal2-input m-0 w-100" value="${exp.amount}" placeholder="Biaya / Nominal">
                    </div>
                    <div class="mb-2 text-start">
                        <label class="form-label fs-8 fw-bold mb-1">Kategori Barang</label>
                        <select id="swal-eexp-category" class="swal2-select m-0 w-100 fs-8">
                            ${categoryOptions}
                        </select>
                    </div>
                    <div class="row g-2 mb-2 text-start">
                        <div class="col-6">
                            <label class="form-label fs-8 fw-bold mb-1">Tanggal Transaksi</label>
                            <input id="swal-eexp-date" type="date" class="swal2-input m-0 w-100 fs-8" value="${exp.date || todayStr}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fs-8 fw-bold mb-1">Catatan / Keterangan</label>
                            <input id="swal-eexp-note" class="swal2-input m-0 w-100 fs-8" value="${escAttr(exp.note || '')}" placeholder="Catatan tambahan">
                        </div>
                    </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Simpan Perubahan',
                confirmButtonColor: '#6A1B9A',
                preConfirm: () => {
                    const name = document.getElementById('swal-eexp-name').value.trim();
                    const amount = parseInt(document.getElementById('swal-eexp-amount').value) || 0;
                    const category = document.getElementById('swal-eexp-category').value;
                    const date = document.getElementById('swal-eexp-date').value || todayStr;
                    const note = document.getElementById('swal-eexp-note').value.trim();

                    if (!name || amount <= 0) {
                        Swal.showValidationMessage('Harap isi Nama Barang yang Dibeli dan Nominal Biaya dengan benar!');
                        return false;
                    }
                    return { name, amount, category, date, note };
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    exp.name = result.value.name;
                    exp.amount = result.value.amount;
                    exp.category = result.value.category;
                    exp.date = result.value.date;
                    exp.note = result.value.note;

                    saveExpensesToStorage();
                    renderAllUI();
                    Swal.fire({
                        icon: 'success',
                        title: 'Pengeluaran Diperbarui!',
                        text: `Data pengeluaran "${exp.name}" berhasil diperbarui.`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }

        function deleteExpense(expId) {
            const expIndex = state.expenses.findIndex(e => e.id == expId);
            if (expIndex === -1) return;
            const exp = state.expenses[expIndex];

            Swal.fire({
                icon: 'warning',
                title: 'Hapus Catatan Pengeluaran?',
                text: `Catatan pengeluaran "${exp.name}" senilai Rp ${(exp.amount || 0).toLocaleString('id-ID')} akan dihapus.`,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                confirmButtonColor: '#dc3545'
            }).then(res => {
                if (res.isConfirmed) {
                    state.expenses.splice(expIndex, 1);
                    saveExpensesToStorage();
                    renderAllUI();
                    Swal.fire({
                        icon: 'success',
                        title: 'Pengeluaran Dihapus!',
                        timer: 1200,
                        showConfirmButton: false
                    });
                }
            });
        }

        function renderOwnerDashboard() { const outletsList = state.outlets; let totalOmsetHariIni = 0; let totalPorsiHariIni = 0; let totalLabaHariIni = 0; const perOutletRows = []; outletsList.forEach(outletName => { const salesRec = state.outletSalesRecords[outletName] || {}; let omset = 0, porsi = 0, loss = 0; state.products.forEach(p => { const sold = salesRec[p.id] ? salesRec[p.id].sold : 0; const allocated = (p.initialStock !== undefined ? p.initialStock : p.stock) || 0; const leftover = Math.max(0, allocated - sold); omset += sold * p.price; porsi += sold; loss += leftover * p.price; }); const profit = Math.round((omset * 0.4) - loss); totalOmsetHariIni += omset; totalPorsiHariIni += porsi; totalLabaHariIni += profit; perOutletRows.push({ name: outletName, omset, porsi, profit }); }); const pendingTickets = state.resetTickets.filter(t => !t.isResolved); const pendingPreOrders = state.preOrders.filter(p => !p.isTaken).length; const cardsEl = document.getElementById('owner-dashboard-cards'); if (cardsEl) { cardsEl.innerHTML = `<div class="col-md-6"><div class="card-custom p-3 border-start border-4 border-primary"><div class="text-muted fs-8 fw-bold">TOTAL OMSET SEMUA OUTLET (HARI INI)</div><div class="fs-5 fw-bold text-primary">Rp ${totalOmsetHariIni.toLocaleString('id-ID')}</div></div></div><div class="col-md-6"><div class="card-custom p-3 border-start border-4 border-info"><div class="text-muted fs-8 fw-bold">TOTAL PORSI TERJUAL</div><div class="fs-5 fw-bold text-info">${totalPorsiHariIni} Cup</div></div></div>`; } const outletTbody = document.getElementById('owner-dashboard-outlet-tbody'); if (outletTbody) { outletTbody.innerHTML = perOutletRows.map(o => `<tr><td class="fw-bold text-brand-purple">${o.name}</td><td class="fw-bold">Rp ${o.omset.toLocaleString('id-ID')}</td><td>${o.porsi} Cup</td><td class="text-success fw-bold">Rp ${o.profit.toLocaleString('id-ID')}</td></tr>`).join(''); } const resetListEl = document.getElementById('owner-dashboard-resetpass-list'); if (resetListEl) { resetListEl.innerHTML = pendingTickets.length > 0 ? pendingTickets.map(t => `<div class="d-flex justify-content-between align-items-center border rounded-3 p-2 bg-light"><div><div class="fw-bold">${t.name}</div><div class="text-muted fs-8">${t.wa} • ${t.time}</div></div><button class="btn btn-sm btn-brand-purple fs-8 fw-bold" onclick="resolveResetTicket('${t.id}')"><i class="fa-solid fa-key me-1"></i> Reset</button></div>`).join('') : '<div class="text-muted fs-8 fst-italic">Tidak ada tiket menunggu diproses 🎉</div>'; } const badgeEl = document.getElementById('owner-resetpass-badge'); if (badgeEl) { badgeEl.innerText = pendingTickets.length; badgeEl.style.display = pendingTickets.length > 0 ? 'inline-block' : 'none'; } }
        function renderOwnerResetPasswordTable() { const tbody = document.getElementById('own-resetpass-tbody'); if (!tbody) return; if (state.resetTickets.length === 0) { tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted fs-8 fst-italic py-3">Belum ada permintaan reset password.</td></tr>`; } else { tbody.innerHTML = state.resetTickets.map(t => `<tr class="${t.isResolved ? 'bg-light opacity-75' : ''}"><td class="fw-bold text-brand-purple">${t.id}</td><td class="fw-bold text-dark">${t.name}</td><td><a href="https://wa.me/${t.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${t.wa}</a></td><td>${t.time}</td><td><span class="badge ${t.isResolved ? 'bg-success' : 'bg-warning text-dark'} fs-8">${t.isResolved ? 'Selesai Direset ✅' : 'Menunggu Diproses'}</span></td><td class="text-center">${t.isResolved ? '<span class="text-muted fs-8 fst-italic">-</span>' : `<button class="btn btn-sm btn-brand-purple fs-8 fw-bold" onclick="resolveResetTicket('${t.id}')"><i class="fa-solid fa-key me-1"></i> Reset Sekarang</button>`}</td></tr>`).join(''); } const pendingCount = state.resetTickets.filter(t => !t.isResolved).length; const badgeEl = document.getElementById('owner-resetpass-badge'); if (badgeEl) { badgeEl.innerText = pendingCount; badgeEl.style.display = pendingCount > 0 ? 'inline-block' : 'none'; } }
        function resolveResetTicket(ticketId) { const t = state.resetTickets.find(x => x.id == ticketId); if (!t) return; Swal.fire({ title: 'Reset Password Pelanggan', html: `<div class="text-start fs-7 mb-2">Pelanggan: <b>${t.name}</b> (${t.wa})</div><input id="swal-newpass" class="swal2-input" placeholder="Password Baru Sementara" value="mamamyuk${Math.floor(1000 + Math.random() * 9000)}">`, showCancelButton: true, confirmButtonText: '<i class="fa-solid fa-key me-1"></i> Kirim Password Baru', confirmButtonColor: '#6A1B9A', preConfirm: () => { const val = document.getElementById('swal-newpass').value.trim(); if (!val) { Swal.showValidationMessage('Password baru wajib diisi!'); return false; } return val; } }).then(result => { if (result.isConfirmed) { t.isResolved = true; renderOwnerResetPasswordTable(); renderOwnerDashboard(); Swal.fire({ icon: 'success', title: 'Password Berhasil Direset', text: `Password baru "${result.value}" telah dikirim ke WhatsApp ${t.wa}.`, timer: 1800, showConfirmButton: false }); } }); }
        function showManualResetPasswordModal() { Swal.fire({ title: 'Reset Password Manual', html: `<div class="text-start fs-7 text-muted mb-2">Gunakan ini jika pelanggan menghubungi langsung tanpa mengirim tiket dari website.</div><input id="swal-mname" class="swal2-input" placeholder="Nama Pelanggan"><input id="swal-mwa" class="swal2-input" placeholder="Nomor WhatsApp Pelanggan"><input id="swal-mnewpass" class="swal2-input" placeholder="Password Baru Sementara">`, focusConfirm: false, showCancelButton: true, confirmButtonText: '<i class="fa-solid fa-key me-1"></i> Reset Password', confirmButtonColor: '#6A1B9A', preConfirm: () => { const name = document.getElementById('swal-mname').value.trim(); const wa = document.getElementById('swal-mwa').value.trim(); const newpass = document.getElementById('swal-mnewpass').value.trim(); if (!name || !wa || !newpass) { Swal.showValidationMessage('Harap isi Nama, WhatsApp, dan Password Baru!'); return false; } return { name, wa, newpass }; } }).then(result => { if (result.isConfirmed && result.value) { state.resetTickets.push({ id: 'RST-' + Math.floor(100 + Math.random() * 900), name: result.value.name, wa: result.value.wa, time: 'Reset Manual Owner', isResolved: true }); renderOwnerResetPasswordTable(); renderOwnerDashboard(); Swal.fire({ icon: 'success', title: 'Password Berhasil Direset', text: `Password baru "${result.value.newpass}" telah dikirim ke WhatsApp ${result.value.wa}.`, timer: 1800, showConfirmButton: false }); } }); }
        function renderOwnerMembersTable() { const tbody = document.getElementById('own-members-tbody'); if (!tbody) return; const membersList = Object.values(state.members); if (membersList.length === 0) { tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted fs-8 fst-italic py-4"><i class="fa-solid fa-user-slash fs-3 d-block mb-2 text-secondary"></i>Belum ada pelanggan yang login sebagai member.</td></tr>`; return; } tbody.innerHTML = membersList.map(m => `<tr><td class="fw-bold text-dark">${m.name}</td><td><a href="https://wa.me/${m.wa}" target="_blank" class="text-success text-decoration-none fw-bold"><i class="fa-brands fa-whatsapp me-1"></i> ${m.wa}</a></td><td><span class="badge bg-brand-yellow text-dark fs-7 fw-bold px-2 py-2"><i class="fa-solid fa-coins me-1"></i> ${m.points} Poin</span></td><td class="text-center"><button class="btn btn-sm btn-outline-primary py-1 px-2 fs-8 fw-bold" data-mid="${escAttr(m.identifier)}" onclick="editMemberPointsModal(this.dataset.mid)"><i class="fa-solid fa-pen-to-square me-1"></i> Edit Poin</button></td></tr>`).join(''); }
        function editMemberPointsModal(identifier) { const member = state.members[identifier]; if (!member) return; Swal.fire({ title: 'Edit Poin Member', html: `<div class="text-start fs-7 mb-2">Member: <b>${member.name}</b> (${member.wa})<br>Poin saat ini: <b class="text-brand-purple">${member.points} Poin</b></div><select id="swal-poin-action" class="swal2-select"><option value="add">Tambah Poin</option><option value="subtract">Kurangi Poin</option><option value="set">Atur Ulang ke Jumlah Tertentu</option></select><input id="swal-poin-amount" type="number" min="0" class="swal2-input" placeholder="Jumlah Poin"><input id="swal-poin-reason" class="swal2-input" placeholder="Keterangan (contoh: Bonus promo ulang tahun)">`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Perubahan', confirmButtonColor: '#6A1B9A', preConfirm: () => { const action = document.getElementById('swal-poin-action').value; const amountRaw = document.getElementById('swal-poin-amount').value; const reason = document.getElementById('swal-poin-reason').value.trim(); const amount = parseInt(amountRaw); if (isNaN(amount) || amount < 0) { Swal.showValidationMessage('Masukkan jumlah poin yang valid!'); return false; } return { action, amount, reason: reason || '-' }; } }).then(result => { if (result.isConfirmed && result.value) { const { action, amount, reason } = result.value; let delta = 0; let label = ''; if (action === 'add') { member.points += amount; delta = amount; label = `Poin ditambah manual oleh Owner${reason !== '-' ? ' - ' + reason : ''}`; } else if (action === 'subtract') { const actualDeducted = Math.min(member.points, amount); member.points = Math.max(0, member.points - amount); delta = -actualDeducted; label = `Poin dikurangi manual oleh Owner${reason !== '-' ? ' - ' + reason : ''}`; } else if (action === 'set') { delta = amount - member.points; member.points = amount; label = `Poin diatur ulang manual oleh Owner ke ${amount}${reason !== '-' ? ' - ' + reason : ''}`; } if (!Array.isArray(member.pointsHistory)) member.pointsHistory = []; member.pointsHistory.unshift({ type: 'adjust', label: label, points: delta, date: new Date().toLocaleString('id-ID') }); saveMembersToStorage(); renderOwnerMembersTable(); renderCustomerAuthArea(); renderCustomerPointsPage(); renderOwnerDashboard(); Swal.fire({ icon: 'success', title: 'Poin Diperbarui', text: `Poin ${member.name} sekarang ${member.points} Poin.`, timer: 1500, showConfirmButton: false }); } }); }
        function renderOwnerRewardsTable() { const tbody = document.getElementById('own-rewards-tbody'); if (!tbody) return; if (state.pointRewards.length === 0) { tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted fs-8 fst-italic py-4">Belum ada reward. Tambahkan reward baru untuk pelanggan.</td></tr>`; return; } tbody.innerHTML = state.pointRewards.map(r => `<tr><td class="fw-bold text-dark">${r.name}</td><td><span class="badge bg-purple-light text-brand-purple border border-purple-200 fs-8 fw-bold"><i class="fa-solid fa-coins me-1"></i> ${r.pointsCost} Poin</span></td><td class="fs-8 text-muted">${r.description}</td><td class="text-center text-nowrap"><button class="btn btn-sm btn-outline-secondary py-1 px-2 fs-8 fw-bold" onclick="editRewardModal('${r.id}')"><i class="fa-solid fa-pen-to-square me-1"></i> Edit</button><button class="btn btn-sm btn-outline-danger py-1 px-2 fs-8 fw-bold ms-1" onclick="deleteRewardOwner('${r.id}')"><i class="fa-solid fa-trash"></i></button></td></tr>`).join(''); }
        function showAddRewardModal() { Swal.fire({ title: 'Tambah Reward Baru', html: `<input id="swal-rname" class="swal2-input" placeholder="Nama Reward"><input id="swal-rcost" type="number" min="1" class="swal2-input" placeholder="Biaya Poin"><textarea id="swal-rdesc" class="swal2-textarea" placeholder="Deskripsi Reward"></textarea>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Reward', confirmButtonColor: '#6A1B9A', preConfirm: () => { const name = document.getElementById('swal-rname').value.trim(); const cost = parseInt(document.getElementById('swal-rcost').value) || 0; const desc = document.getElementById('swal-rdesc').value.trim(); if (!name || cost <= 0) { Swal.showValidationMessage('Harap isi Nama dan Biaya Poin (lebih dari 0)!'); return false; } return { name, cost, desc }; } }).then(result => { if (result.isConfirmed && result.value) { const newId = 'RWD-' + (state.pointRewards.length + 1) + '-' + Math.floor(Math.random() * 1000); state.pointRewards.push({ id: newId, name: result.value.name, pointsCost: result.value.cost, description: result.value.desc || 'Reward spesial dari Mamam Yuk.' }); renderOwnerRewardsTable(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Reward Ditambahkan', text: `${result.value.name} kini bisa ditukar pelanggan!`, timer: 1300, showConfirmButton: false }); } }); }
        function editRewardModal(rewardId) { const r = state.pointRewards.find(x => x.id == rewardId); if (!r) return; Swal.fire({ title: 'Edit Reward', html: `<input id="swal-rename" class="swal2-input" placeholder="Nama Reward" value="${r.name}"><input id="swal-recost" type="number" min="1" class="swal2-input" placeholder="Biaya Poin" value="${r.pointsCost}"><textarea id="swal-redesc" class="swal2-textarea" placeholder="Deskripsi Reward">${r.description}</textarea>`, focusConfirm: false, showCancelButton: true, confirmButtonText: 'Simpan Perubahan', confirmButtonColor: '#6A1B9A', preConfirm: () => { const name = document.getElementById('swal-rename').value.trim(); const cost = parseInt(document.getElementById('swal-recost').value) || 0; const desc = document.getElementById('swal-redesc').value.trim(); if (!name || cost <= 0) { Swal.showValidationMessage('Harap isi Nama dan Biaya Poin (lebih dari 0)!'); return false; } return { name, cost, desc }; } }).then(result => { if (result.isConfirmed && result.value) { r.name = result.value.name; r.pointsCost = result.value.cost; r.description = result.value.desc; renderOwnerRewardsTable(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Reward Diperbarui', timer: 1200, showConfirmButton: false }); } }); }
        function deleteRewardOwner(rewardId) { const r = state.pointRewards.find(x => x.id == rewardId); if (!r) return; Swal.fire({ icon: 'warning', title: 'Hapus Reward?', text: `Reward "${r.name}" akan dihapus dari katalog dan tidak bisa ditukar pelanggan lagi.`, showCancelButton: true, confirmButtonText: 'Ya, Hapus', confirmButtonColor: '#dc3545' }).then(res => { if (res.isConfirmed) { state.pointRewards = state.pointRewards.filter(x => x.id != rewardId); renderOwnerRewardsTable(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Reward Dihapus', timer: 1000, showConfirmButton: false }); } }); }
        function updatePointsRateExample() { const exEl = document.getElementById('owner-points-rate-example'); if (!exEl) return; const rateInput = document.getElementById('owner-points-rate-input'); const rate = parseInt(rateInput ? rateInput.value : state.pointsEarnRate) || state.pointsEarnRate; const examplePoints = Math.floor(15000 / rate); exEl.innerText = `Contoh: belanja Rp 15.000 akan mendapat ${examplePoints} Poin.`; }
        function saveOwnerPointsRate() { const rateInput = document.getElementById('owner-points-rate-input'); const newRate = parseInt(rateInput ? rateInput.value : NaN); if (!newRate || newRate <= 0) { Swal.fire({ icon: 'warning', title: 'Rasio Tidak Valid', text: 'Masukkan angka Rupiah melebih dari 0!' }); return; } fetch('/points/rate', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({ rate: newRate }) }).then(() => { state.pointsEarnRate = newRate; updatePointsRateExample(); renderCustomerPointsPage(); Swal.fire({ icon: 'success', title: 'Rasio Poin Disimpan', html: `Sekarang setiap belanja <b>Rp ${newRate.toLocaleString('id-ID')}</b> = <b>1 Poin</b> untuk semua transaksi member (kecuali produk dengan Poin Kustom).`, timer: 1800, showConfirmButton: false }); }); }
        function renderOwnerProductPointsTable() { const tbody = document.getElementById('own-product-points-tbody'); if (!tbody) return; tbody.innerHTML = state.products.map(p => `<tr><td class="fw-bold text-dark">${p.name}</td><td>Rp ${p.price.toLocaleString('id-ID')}</td><td style="max-width:160px;"><input type="number" min="0" class="form-control form-control-sm fw-bold" id="ppoints-${p.id}" value="${p.customPoints || 0}" placeholder="0 = pakai rasio global"></td><td class="text-center"><button class="btn btn-sm btn-brand-purple py-1 px-2 fs-8 fw-bold" onclick="saveProductCustomPoints('${p.id}')"><i class="fa-solid fa-floppy-disk me-1"></i> Simpan</button></td></tr>`).join(''); }
        function saveProductCustomPoints(prodId) { const p = state.products.find(x => x.id == prodId); if (!p) return; const input = document.getElementById('ppoints-' + prodId); const val = parseInt(input ? input.value : 0) || 0; p.customPoints = Math.max(0, val); Swal.fire({ icon: 'success', title: 'Poin Kustom Disimpan', text: p.customPoints > 0 ? `${p.name} sekarang memberi ${p.customPoints} Poin tetap per cup.` : `${p.name} kembali memakai rasio poin global.`, timer: 1500, showConfirmButton: false }); }
        function handleLogin(e) { e.preventDefault(); const typedName = document.getElementById('login-name').value.trim(); const identifier = document.getElementById('login-identifier').value.trim(); if (!identifier) return; let member = state.members[identifier]; if (!member) { member = { identifier: identifier, name: typedName || ('Bunda ' + identifier), wa: identifier, points: 0, pointsHistory: [] }; state.members[identifier] = member; } else if (typedName) { member.name = typedName; } if (!Array.isArray(member.pointsHistory)) member.pointsHistory = []; state.currentUser = member; saveMembersToStorage(); renderAllUI(); Swal.fire({ icon: 'success', title: 'Login Berhasil', text: `Selamat datang, ${member.name}! Poin Anda: ${member.points}.`, timer: 1600, showConfirmButton: false }); switchCustView('beranda'); }
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
        function redeemReward(rewardId) {
            if (!state.currentUser) return;
            const reward = state.pointRewards.find(r => r.id == rewardId);
            if (!reward) return;
            const member = state.currentUser;
            if (member.points < reward.pointsCost) {
                Swal.fire({ icon: 'warning', title: 'Poin Tidak Cukup', text: `Anda butuh ${reward.pointsCost} poin, saat ini baru punya ${member.points} poin.` });
                return;
            }
            Swal.fire({
                title: 'Tukar Poin Sekarang?',
                html: `Tukar <b>${reward.pointsCost} Poin</b> dengan <b>${reward.name}</b>?<br><span class="fs-8 text-muted">Sisa poin setelah ditukar: ${member.points - reward.pointsCost}</span>`,
                showCancelButton: true,
                confirmButtonText: 'Ya, Tukar Sekarang',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6A1B9A'
            }).then(res => {
                if (res.isConfirmed) {
                    member.points -= reward.pointsCost;
                    const redemptionCode = 'RDM-' + Math.floor(1000 + Math.random() * 9000);
                    if (!Array.isArray(member.pointsHistory)) member.pointsHistory = [];
                    member.pointsHistory.unshift({
                        type: 'redeem',
                        rewardId: reward.id,
                        rewardName: reward.name,
                        code: redemptionCode,
                        isUsed: false,
                        label: `Tukar reward: ${reward.name} (Kode: ${redemptionCode})`,
                        points: -reward.pointsCost,
                        date: new Date().toLocaleString('id-ID')
                    });
                    saveMembersToStorage();
                    renderAllUI();
                    switchCustView('poin');
                    Swal.fire({
                        icon: 'success',
                        title: 'Penukaran Berhasil! 🎉',
                        html: `
                            <div class="mb-2 text-start fs-7">Hadiah: <b>${reward.name}</b></div>
                            <div class="bg-purple-light text-brand-purple p-3 rounded-3 border border-purple-200 mb-3 text-center">
                                <div class="fs-8 text-muted fw-bold">KODE VOUCHER ANDA:</div>
                                <div class="fs-3 fw-extrabold text-brand-purple">${redemptionCode}</div>
                            </div>
                            <div class="text-start fs-8 text-dark bg-light p-3 rounded-3 border">
                                <b><i class="fa-solid fa-lightbulb text-warning me-1"></i> CARA MENGGUNAKAN KODE VOUCHER:</b>
                                <ol class="mb-0 ps-3 mt-1 space-y-1">
                                    <li><b>Belanja Online:</b> Masukkan kode <b class="text-brand-purple">${redemptionCode}</b> di kolom <i>"Punya Kode Voucher / Poin?"</i> pada halaman Checkout. Total belanja Anda akan otomatis terpotong!</li>
                                    <li><b>Ambil di Outlet:</b> Tunjukkan kode <b class="text-brand-purple">${redemptionCode}</b> ini kepada Kasir saat pengambilan produk.</li>
                                </ol>
                            </div>
                        `,
                        confirmButtonText: 'Tutup & Belanja Now',
                        confirmButtonColor: '#6A1B9A'
                    });
                }
            });
        }
        function printDapurMasakReport(filterSelectId) {
            const filterEl = document.getElementById(filterSelectId || 'adm-dapur-outlet-filter');
            const selectedOutlet = filterEl ? filterEl.value : 'ALL';
            const targetProducts = state.products;

            const todayStr = getTodayDateString();
            const tomorrowDate = new Date();
            tomorrowDate.setDate(tomorrowDate.getDate() + 1);
            const tomorrowStr = tomorrowDate.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });

            const outletsList = state.outlets;
            let outletBreakdownHtml = '';

            outletsList.forEach(outletName => {
                if (selectedOutlet !== 'ALL' && !isOutletMatch(outletName, selectedOutlet)) return;
                const totalOutletPorsi = state.products.reduce((sum, p) => sum + computeProductionNumbers(p.id, outletName).total, 0);

                outletBreakdownHtml += `
                    <div style="border: 1px solid #ddd; border-radius: 6px; padding: 10px; flex: 1; min-width: 130px; background: #fafafa;">
                        <div style="font-weight: bold; color: #6A1B9A; font-size: 11px; margin-bottom: 4px;">${outletName}</div>
                        <div style="font-size: 18px; font-weight: bold; color: #000;">${totalOutletPorsi} <span style="font-size: 12px; font-weight: normal;">Cup</span></div>
                        <div style="font-size: 10px; color: #666;">Pre-order online</div>
                    </div>
                `;
            });

            let totalMasakAll = 0;
            let menuIndex = 0;
            let menuRowsHtml = '';

            targetProducts.forEach(p => {
                const { onlinePreorder, total } = computeProductionNumbers(p.id, selectedOutlet);
                if (total > 0) {
                    menuIndex++;
                    totalMasakAll += total;
                    menuRowsHtml += `
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">${menuIndex}. ${p.name}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd; text-align: center; font-weight: bold; color: #1976D2;">${onlinePreorder} Cup</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd; text-align: center; font-weight: bold; color: #6A1B9A; font-size: 14px;">${total} Cup</td>
                        </tr>
                    `;
                }
            });

            if (menuIndex === 0) {
                menuRowsHtml = `<tr><td colspan="3" style="text-align: center; padding: 15px; color: #777; font-style: italic;">Belum ada varian produk yang dipesan untuk ${selectedOutlet !== 'ALL' ? selectedOutlet : 'semua outlet'}.</td></tr>`;
            }

            const titleFilterText = selectedOutlet === 'ALL' ? 'KONSOLIDASI SEMUA OUTLET' : selectedOutlet;

            const printHtml = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Rekapitulasi Dapur Masak - ${titleFilterText}</title>
                    <style>
                        @page { size: A4 portrait; margin: 12mm; }
                        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; margin: 0; padding: 10px; font-size: 13px; line-height: 1.4; }
                        .header { text-align: center; border-bottom: 3px double #6A1B9A; padding-bottom: 10px; margin-bottom: 12px; }
                        .header h2 { margin: 0 0 4px 0; color: #6A1B9A; font-size: 20px; font-weight: bold; text-transform: uppercase; }
                        .header p { margin: 0; color: #555; font-size: 12px; }
                        .meta-info { display: flex; justify-content: space-between; background: #f3e5f5; padding: 8px 12px; border-radius: 6px; margin-bottom: 12px; border: 1px solid #e1bee7; font-size: 11px; }
                        .cards-grid { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 15px; }
                        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
                        th { background: #6A1B9A; color: #fff; text-align: left; padding: 8px; font-size: 12px; }
                        th.text-center { text-align: center; }
                        .total-row td { background: #f3e5f5; font-weight: bold; font-size: 14px; border-top: 2px solid #6A1B9A; color: #6A1B9A; }
                        .footer { margin-top: 40px; display: flex; justify-content: space-between; text-align: center; }
                        .signature-box { width: 40%; border-top: 1px solid #888; padding-top: 6px; font-size: 11px; margin-top: 50px; }
                    </style>
                </head>
                <body onload="window.print(); setTimeout(() => window.close(), 600);">
                    <div class="header">
                        <h2>🍳 REKAPITULASI DAPUR MASAK ESOK HARI</h2>
                        <p><b>MAMAM YUK</b> — Laporan Produksi Dapur Masak Hari Ini</p>
                    </div>

                    <div class="meta-info">
                        <div><b>Jadwal Ambil (Besok):</b> ${tomorrowStr}</div>
                        <div><b>Filter Cabang:</b> ${titleFilterText}</div>
                        <div><b>Waktu Cetak:</b> ${new Date().toLocaleTimeString('id-ID')}</div>
                    </div>

                    <div style="font-weight: bold; margin-bottom: 6px; color: #6A1B9A; font-size: 12px;">📌 Ringkasan Porsi Per Cabang Outlet:</div>
                    <div class="cards-grid">
                        ${outletBreakdownHtml}
                    </div>

                    <div style="font-weight: bold; margin-bottom: 6px; color: #6A1B9A; font-size: 12px;">📋 Target Porsi Masak Varian Mamam Yuk:</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Varian Mamam Yuk</th>
                                <th class="text-center" style="width: 25%;">Pre-Order Online</th>
                                <th class="text-center" style="width: 25%;">Total Porsi Masak</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${menuRowsHtml}
                            <tr class="total-row">
                                <td style="padding: 8px;">TOTAL SELURUH VARIAN</td>
                                <td style="text-align: center; padding: 8px;">${totalMasakAll} Cup</td>
                                <td style="text-align: center; padding: 8px;">${totalMasakAll} Cup</td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="background: #fff8e1; border: 1px solid #ffe082; padding: 8px 12px; border-radius: 6px; font-size: 11px; margin-top: 10px;">
                        <b>⚠️ Catatan Tim Dapur:</b> Total Porsi Masak di atas dihitung murni berdasarkan Pre-Order Online pelanggan untuk jadwal ambil besok (${tomorrowStr}).
                    </div>

                    <div class="footer">
                        <div class="signature-box">
                            Penanggung Jawab Dapur
                        </div>
                        <div class="signature-box">
                            Admin Operasional
                        </div>
                    </div>
                </body>
                </html>
            `;

            const printWin = window.open('', '_blank', 'width=800,height=900');
            if (printWin) {
                printWin.document.write(printHtml);
                printWin.document.close();
            }
        }

        function printAdminPesananReport() {
            const selectedOutlet = document.getElementById('adm-pesanan-outlet-filter')?.value || 'ALL';
            const todayStr = getTodayDateString();
            const todayOrders = state.preOrders.filter(p => p.date === todayStr);
            const filteredOrders = selectedOutlet === 'ALL' ? todayOrders : todayOrders.filter(p => p.outlet === selectedOutlet);

            const titleText = selectedOutlet === 'ALL' ? 'SEMUA CABANG OUTLET' : selectedOutlet;
            const tomorrowDate = new Date();
            tomorrowDate.setDate(tomorrowDate.getDate() + 1);
            const tomorrowStr = tomorrowDate.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });

            const rowsHtml = filteredOrders.map((p, idx) => `
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 6px;">${idx + 1}</td>
                    <td style="padding: 6px; font-weight: bold;">${p.id} - ${p.customerName}</td>
                    <td style="padding: 6px;">${p.outlet}</td>
                    <td style="padding: 6px;">${p.wa}</td>
                    <td style="padding: 6px; font-weight: bold;">${p.items}</td>
                    <td style="padding: 6px;">${p.isPaid ? 'Lunas ✅' : 'Belum (COD)'}</td>
                    <td style="padding: 6px;">${p.isTaken ? 'Sudah Diambil' : 'Menunggu Ambil'}</td>
                </tr>
            `).join('');

            const printHtml = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Rekap Pesanan Pelanggan - ${titleText}</title>
                    <style>
                        @page { size: A4 landscape; margin: 10mm; }
                        body { font-family: sans-serif; color: #333; font-size: 11px; }
                        h2 { color: #6A1B9A; margin: 0 0 5px 0; }
                        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                        th { background: #6A1B9A; color: #fff; padding: 6px; text-align: left; }
                    </style>
                </head>
                <body onload="window.print(); setTimeout(() => window.close(), 600);">
                    <h2>🛒 REKAP PESANAN PELANGGAN PER OUTLET</h2>
                    <div><b>Jadwal Pengambilan (Besok):</b> ${tomorrowStr} | <b>Cabang:</b> ${titleText} | <b>Total Pesanan:</b> ${filteredOrders.length}</div>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pelanggan</th>
                                <th>Outlet</th>
                                <th>No WA</th>
                                <th>Detail Menu Dipesan</th>
                                <th>Status Bayar</th>
                                <th>Status Ambil</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${rowsHtml}
                        </tbody>
                    </table>
                </body>
                </html>
            `;

            const printWin = window.open('', '_blank', 'width=900,height=700');
            if (printWin) {
                printWin.document.write(printHtml);
                printWin.document.close();
            }
        }

        document.addEventListener('DOMContentLoaded', function() { try { selectRolePortal(state.activeRole); renderAllUI(); if (state.activeRole === 'pelanggan') { if (!state.currentUser) { switchCustView('login'); } else { switchCustView('beranda'); } } updateStoreHoursStatus(); setInterval(updateStoreHoursStatus, 30000); } catch (err) { console.error("Render UI Error:", err); } finally { endLoading(); } }); window.onload = function() { endLoading(); }; setTimeout(endLoading, 800);
    </script>
@endsection
