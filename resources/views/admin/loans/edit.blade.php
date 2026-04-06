@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Peminjaman</h1>

    <form action="{{ route('admin.loans.update', $loan->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal_kembali_rencana" class="form-label">Tanggal Kembali Rencana</label>
            <input type="date" class="form-control @error('tanggal_kembali_rencana') is-invalid @enderror" 
                   id="tanggal_kembali_rencana" name="tanggal_kembali_rencana" 
                   value="{{ old('tanggal_kembali_rencana', $loan->tanggal_kembali_rencana->format('Y-m-d')) }}" required>
            @error('tanggal_kembali_rencana')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="pending" {{ old('status', $loan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ old('status', $loan->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="kembali" {{ old('status', $loan->status) == 'kembali' ? 'selected' : '' }}>Kembali</option>
                <option value="ditolak" {{ old('status', $loan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
