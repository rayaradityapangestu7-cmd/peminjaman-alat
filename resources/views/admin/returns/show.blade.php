@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pengembalian</h1>

    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Informasi Pengembalian</h5>

            <div class="mb-3">
                <label class="form-label">User (Peminjam)</label>
                <p>{{ $loan->user->name ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Alat</label>
                <p>{{ $loan->tool->nama_alat ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <p>{{ $loan->tanggal_pinjam->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Kembali Rencana</label>
                <p>{{ $loan->tanggal_kembali_rencana->format('d/m/Y') }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Kembali Aktual</label>
                <p>{{ $loan->tanggal_kembali_aktual ? $loan->tanggal_kembali_aktual->format('d/m/Y H:i') : '-' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <p>
                    <span class="badge bg-{{ $loan->status == 'kembali' ? 'info' : 'warning' }}">
                        {{ ucfirst($loan->status) }}
                    </span>
                </p>
            </div>

            <div class="mb-3">
                <a href="{{ route('admin.returns.edit', $loan->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('admin.returns.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
