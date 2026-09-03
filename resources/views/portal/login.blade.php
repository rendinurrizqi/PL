@extends('layouts.app')

@section('title', 'Portal Mamam Yuk - Login')

@section('content')
    <div class="login-portal-bg min-vh-100 d-flex align-items-center justify-content-center py-5 px-3">
        <div class="container max-w-500">
            <div class="card-custom p-4 shadow-lg login-card-glass">
                <div class="text-center mb-4">
                    <div class="bg-brand-yellow text-dark p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width:64px;height:64px;">
                        <i class="fa-solid fa-user-shield fa-xl"></i>
                    </div>
                    <h3 class="fw-bold text-brand-purple mb-1">Portal Mamam Yuk</h3>
                    <p class="text-muted mb-0 fs-7">Masuk ke area kerja Mamam Yuk.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('portal.login.submit') }}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="email" class="form-label fw-semibold text-dark">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control fw-semibold" placeholder="nama@mamamyuk.com" required autofocus>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password" class="form-label fw-semibold text-dark">Password</label>
                        <input id="password" name="password" type="password" class="form-control fw-semibold" placeholder="Masukkan password" required>
                    </div>
                    <button type="submit" class="btn btn-brand-purple w-100 fw-bold py-2.5 shadow-sm mb-2">Masuk ke Portal Mamam Yuk</button>
                </form>

                <div class="mt-4 text-center small text-muted border-top pt-3">
                    <a href="{{ route('mpasi.index') }}" class="text-brand-purple text-decoration-none fw-semibold">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke portal pelanggan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
