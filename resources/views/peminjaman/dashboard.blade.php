@extends('layouts.app')

@section('content')
<div class="dashboard-hero text-white p-4 mb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold mb-3 text-warning">Halo, {{ auth()->user()->name }}!</h1>
            <p class="lead text-white-75">Pilih alat, atur tanggal pengembalian, dan ajukan peminjaman dalam satu halaman dengan tampilan yang lebih bersih.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ url('/peminjam/riwayat') }}" class="btn btn-light btn-lg mb-2">Riwayat Saya</a>
        </div>
    </div>
</div>

<div class="row g-4">
    @foreach($tools as $tool)
    <div class="col-lg-4 col-md-6">
        <div class="card dashboard-card h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="card-title">{{ $tool->nama_alat }}</h5>
                        <span class="badge bg-secondary">{{ $tool->category->nama_kategori }}</span>
                    </div>
                    <span class="badge bg-{{ $tool->stok > 0 ? 'success' : 'danger' }} status-chip">{{ $tool->stok > 0 ? 'Tersedia' : 'Habis' }}</span>
                </div>
                <p class="card-text text-muted">{{ $tool->deskripsi }}</p>
                <p class="fw-bold mt-auto mb-3">Sisa Stok: {{ $tool->stok }}</p>

                @if($tool->stok > 0)
                    <form action="{{ url('/peminjam/ajukan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tool_id" value="{{ $tool->id }}">
                        <div class="mb-3">
                            <label class="small">Tgl Pengembalian</label>
                            <input type="date" name="tanggal_kembali" class="form-control form-control-sm" required min="{{ date('Y-m-d') }}">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Pinjam Alat</button>
                    </form>
                @else
                    <button class="btn btn-outline-secondary w-100" disabled>Stok Habis</button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
