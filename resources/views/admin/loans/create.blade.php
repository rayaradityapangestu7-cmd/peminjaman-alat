@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Peminjaman Baru</h1>

    <form action="{{ route('admin.loans.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">User (Peminjam)</label>
            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tool_id" class="form-label">Alat</label>
            <select class="form-select @error('tool_id') is-invalid @enderror" id="tool_id" name="tool_id" required>
                <option value="">Pilih Alat</option>
                @foreach($tools as $tool)
                    <option value="{{ $tool->id }}" {{ old('tool_id') == $tool->id ? 'selected' : '' }}>
                        {{ $tool->nama_alat }} (Stok: {{ $tool->stok }})
                    </option>
                @endforeach
            </select>
            @error('tool_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">Tanggal Kembali Rencana</label>
            <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" 
                   id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
            @error('tanggal_kembali')
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
