@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pengembalian</h1>

    <form action="{{ route('admin.returns.update', $loan->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal_kembali_aktual" class="form-label">Tanggal Kembali Aktual</label>
            <input type="datetime-local" class="form-control @error('tanggal_kembali_aktual') is-invalid @enderror"
                   id="tanggal_kembali_aktual" name="tanggal_kembali_aktual"
                   value="{{ old('tanggal_kembali_aktual', $loan->tanggal_kembali_aktual ? $loan->tanggal_kembali_aktual->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" required>
            @error('tanggal_kembali_aktual')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.returns.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
