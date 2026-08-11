@extends('layouts.app')

@section('title', 'Reward Owner')

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
                <a class="nav-link" href="{{ route('owner.dashboard') }}"><i class="fa-solid fa-gauge"></i> Dashboard Owner</a>
                <a class="nav-link" href="{{ route('owner.outlets') }}"><i class="fa-solid fa-store"></i> Outlet</a>
                <a class="nav-link active" href="{{ route('owner.rewards') }}"><i class="fa-solid fa-coins"></i> Reward</a>
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
                        <h2 class="fw-bold text-brand-purple mb-1">Reward & Hadiah</h2>
                        <p class="text-muted mb-0">Poin loyalitas dan program member.</p>
                    </div>
                </div>

                <div class="card-custom p-3">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Reward</th>
                                    <th>Biaya Poin</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rewards as $reward)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-semibold">{{ $reward->name }}</td>
                                        <td>{{ $reward->points_cost }} poin</td>
                                        <td>{{ $reward->description ?: '-' }}</td>
                                        <td>
                                            @if($reward->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada reward.</td>
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
