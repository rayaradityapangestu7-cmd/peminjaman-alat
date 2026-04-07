@extends('layouts.app')

@section('content')
<div class="dashboard-hero text-white p-4 mb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-3">Halo, {{ auth()->user()->name }}!</h1>
            <p class="lead text-white-75">Kelola inventaris alat, pantau peminjaman, dan lihat aktivitas tim dalam satu tampilan modern.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('tools.index') }}" class="btn btn-light btn-lg mb-2">Kelola Alat</a>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-light btn-lg mb-2">Cek Peminjaman</a>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card dashboard-card p-4 h-100 text-primary">
            <div class="card-header">Pengguna</div>
            <div class="card-body">
                <h2 class="mb-2">{{ $totalUser }}</h2>
                <p class="text-muted mb-0">User terdaftar</p>
            </div>
            <div class="card-footer text-end bg-transparent p-0">
                <a href="{{ route('users.index') }}" class="small text-primary text-decoration-none">Lihat detail &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card p-4 h-100 text-success">
            <div class="card-header">Alat</div>
            <div class="card-body">
                <h2 class="mb-2">{{ $totalAlat }}</h2>
                <p class="text-muted mb-0">Stok total: {{ $totalStok }}</p>
            </div>
            <div class="card-footer text-end bg-transparent p-0">
                <a href="{{ route('tools.index') }}" class="small text-success text-decoration-none">Lihat detail &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card p-4 h-100 text-warning">
            <div class="card-header">Kategori</div>
            <div class="card-body">
                <h2 class="mb-2">{{ $totalKategori }}</h2>
                <p class="text-muted mb-0">Jenis kategori</p>
            </div>
            <div class="card-footer text-end bg-transparent p-0">
                <a href="{{ route('categories.index') }}" class="small text-warning text-decoration-none">Lihat detail &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card dashboard-card p-4 h-100 text-danger">
            <div class="card-header">Pinjaman Aktif</div>
            <div class="card-body">
                <h2 class="mb-2">{{ $sedangDipinjam }}</h2>
                <p class="text-muted mb-0">Sedang dipinjam</p>
            </div>
            <div class="card-footer text-end bg-transparent p-0">
                <a href="{{ route('admin.loans.index') }}" class="small text-danger text-decoration-none">Pantau &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card dashboard-card h-100">
            <div class="card-header">Transaksi Selesai</div>
            <div class="card-body">
                <h2 class="mb-3">{{ $sudahDikembalikan }}</h2>
                <p class="text-muted">Jumlah peminjaman yang sudah kembali.</p>
            </div>
            <div class="card-footer bg-transparent text-end p-0">
                <a href="{{ route('admin.returns.index') }}" class="small text-decoration-none">Detail pengembalian &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card dashboard-card h-100">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm">User</a>
                    <a href="{{ route('tools.index') }}" class="btn btn-outline-success btn-sm">Alat</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-warning btn-sm">Kategori</a>
                    <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-danger btn-sm">Peminjaman</a>
                    <a href="{{ route('admin.returns.index') }}" class="btn btn-outline-info btn-sm">Pengembalian</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card dashboard-card">
    <div class="card-header">Aktivitas Terbaru</div>
    <div class="card-body p-0 table-responsive-custom">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Waktu</th>
                    <th>User</th>
                    <th>Aksi</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLogs as $log)
                <tr>
                    <td class="small text-muted">{{ $log->created_at->diffForHumans() }}</td>
                    <td>
                        <span class="fw-bold">{{ $log->user->name }}</span><br>
                        <span class="badge bg-secondary status-chip">{{ ucfirst($log->user->role) }}</span>
                    </td>
                    <td>{{ $log->action }}</td>
                    <td class="text-muted small">{{ Str::limit($log->description, 60) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada aktivitas tercatat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-end bg-transparent">
        <a href="{{ url('/admin/logs') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua Log</a>
    </div>
</div>
@endsection
