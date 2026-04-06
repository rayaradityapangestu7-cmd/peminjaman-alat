@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Daftar Pengembalian Alat</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.returns.create') }}" class="btn btn-primary">Proses Pengembalian</a>
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
                    <th>Tanggal Kembali Rencana</th>
                    <th>Tanggal Kembali Aktual</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($returns as $return)
                    <tr>
                        <td>{{ $return->id }}</td>
                        <td>{{ $return->user->name ?? '-' }}</td>
                        <td>{{ $return->tool->nama_alat ?? '-' }}</td>
                        <td>{{ $return->tanggal_kembali_rencana->format('d/m/Y') }}</td>
                        <td>{{ $return->tanggal_kembali_aktual ? $return->tanggal_kembali_aktual->format('d/m/Y H:i') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.returns.show', $return->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.returns.edit', $return->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.returns.destroy', $return->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data pengembalian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $returns->links() }}
</div>
@endsection
