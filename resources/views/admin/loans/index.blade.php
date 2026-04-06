@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Daftar Peminjaman</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.loans.create') }}" class="btn btn-primary">Tambah Peminjaman</a>
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif

    @if($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Alat</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->user->name ?? '-' }}</td>
                        <td>{{ $loan->tool->nama_alat ?? '-' }}</td>
                        <td>{{ $loan->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td>{{ $loan->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $loan->status == 'disetujui' ? 'success' : ($loan->status == 'kembali' ? 'info' : 'warning') }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.loans.show', $loan->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.loans.edit', $loan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $loans->links() }}
</div>
@endsection
