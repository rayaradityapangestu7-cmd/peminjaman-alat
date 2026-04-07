@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Proses Pengembalian Alat</h1>

    <form action="{{ route('admin.returns.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="loan_id" class="form-label">Pilih Peminjaman (Alat yang Sedang Dipinjam)</label>
            <select class="form-select @error('loan_id') is-invalid @enderror" id="loan_id" name="loan_id" required>
                <option value="">Pilih Alat</option>
                @foreach($activeLoans as $loan)
                    <option value="{{ $loan->id }}">
                        {{ $loan->tool->nama_alat }} - {{ $loan->user->name }} (Pinjam: {{ $loan->tanggal_pinjam->format('d/m/Y') }})
                    </option>
                @endforeach
            </select>
            @error('loan_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="denda" class="form-label">Denda (Opsional)</label>
            <input type="number" class="form-control @error('denda') is-invalid @enderror"
                   id="denda" name="denda" value="{{ old('denda') }}" min="0">
            @error('denda')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
            <a href="{{ route('admin.returns.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
