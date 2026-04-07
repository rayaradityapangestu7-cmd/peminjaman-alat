@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center min-vh-75">
    <div class="col-md-5 col-lg-4">
        <div class="card dashboard-card border-0 shadow-sm">
            <div class="card-header bg-primary text-white border-0">
                <h4 class="mb-0">Masuk ke SIPINJAM</h4>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Gunakan akun Anda untuk mengelola peminjaman alat secara cepat dan aman.</p>
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>
            </div>
            <div class="card-footer text-center bg-light">
                <small class="text-muted">Belum punya akun? Hubungi admin untuk akses.</small>
            </div>
        </div>
    </div>
</div>
@endsection
