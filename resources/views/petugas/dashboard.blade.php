@extends('layouts.app')

@section('content')
<div class="dashboard-hero text-white p-4 mb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-3 text-warning">Halo, {{ auth()->user()->name }}!</h1>
            <p class="lead text-white-75">Pantau semua permintaan peminjaman dan proses pengembalian dengan cepat dari satu halaman.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('petugas.report') }}" class="btn btn-light btn-lg mb-2">Lihat Laporan</a>
            <a href="{{ url('/petugas/dashboard') }}" class="btn btn-outline-light btn-lg mb-2">Segarkan</a>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card dashboard-card p-4 h-100">
            <div class="card-header">Permintaan Baru</div>
            <div class="card-body">
                <h2 class="mb-2">{{ $loans->count() }}</h2>
                <p class="text-muted mb-0">Menunggu persetujuan</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card p-4 h-100">
            <div class="card-header">Peminjaman Aktif</div>
            <div class="card-body">
                <h2 class="mb-2">{{ $activeLoans->count() }}</h2>
                <p class="text-muted mb-0">Dalam proses pengembalian</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card p-4 h-100">
            <div class="card-header">Selesai</div>
            <div class="card-body">
                <h2 class="mb-2">{{ $sudahDikembalikan->count() }}</h2>
                <p class="text-muted mb-0">Peminjaman telah kembali</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card dashboard-card">
            <div class="card-header">Permintaan Peminjaman</div>
            <div class="card-body p-0 table-responsive-custom">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Tgl Pinjam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loans as $loan)
                        <tr>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->tool->nama_alat }}</td>
                            <td>{{ $loan->tanggal_pinjam }}</td>
                            <td>
                                <form action="{{ url('/petugas/approve/'.$loan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Setujui</button>
                                </form>
                                <button class="btn btn-outline-danger btn-sm">Tolak</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Tidak ada permintaan baru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card dashboard-card">
            <div class="card-header">Peminjaman Aktif</div>
            <div class="card-body p-0 table-responsive-custom">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeLoans as $active)
                        <tr>
                            <td>{{ $active->user->name }}</td>
                            <td>{{ $active->tool->nama_alat }}</td>
                            <td><span class="badge bg-primary status-chip">{{ ucfirst($active->status) }}</span></td>
                            <td>
                                <form action="{{ url('/petugas/return/'.$active->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary btn-sm">Proses</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Tidak ada data aktif.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card dashboard-card">
    <div class="card-header">Peminjaman Telah Kembali</div>
    <div class="card-body p-0 table-responsive-custom">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Peminjam</th>
                    <th>Alat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sudahDikembalikan as $sudah)
                <tr>
                    <td>{{ $sudah->user->name }}</td>
                    <td>{{ $sudah->tool->nama_alat }}</td>
                    <td><span class="badge bg-success status-chip">{{ ucfirst($sudah->status) }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">Belum ada data pengembalian.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
