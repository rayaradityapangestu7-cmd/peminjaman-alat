@extends('layouts.app') 
 
@section('content') 
<div class="d-flex justify-content-between align-items-center mb-4"> 
    <h3>Kelola Data Pengguna</h3> 
    <a href="{{ route('users.create') }}" class="btn btn-primary"> 
        + Tambah User Baru 
    </a> 
</div> 
 
<div class="mb-3"> 
    <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2" style="max-width: 
400px;"> 
        <input type="text" name="search" class="form-control" placeholder="Cari Nama atau Email..." 
value="{{ request('search') }}"> 
        <button type="submit" class="btn btn-secondary">Cari</button> 
    </form> 
</div> 
 
<div class="card"> 
    <div class="card-body"> 
        <table class="table table-bordered table-striped align-middle"> 
            <thead class="table-dark"> 
                <tr> 
                    <th width="5%">No</th> 
                    <th>Nama Lengkap</th> 
                    <th>Email</th> 
                    <th>Role</th> 
                    <th width="15%">Aksi</th> 
                </tr> 
            </thead> 
            <tbody> 
                @forelse($users as $key => $user) 
                <tr> 
                    <td>{{ $users->firstItem() + $key }}</td> 
                    <td>{{ $user->name }}</td> 
                    <td>{{ $user->email }}</td> 
                    <td> 
                        @if($user->role == 'admin') 
                            <span class="badge bg-danger">Admin</span> 
                        @elseif($user->role == 'petugas') 
                            <span class="badge bg-primary">Petugas</span> 
                        @else 
                            <span class="badge bg-secondary">Peminjam</span> 
                        @endif 
 
12 
                    </td> 
                    <td> 
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn
sm">Edit</a> 
                         
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d
inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');"> 
                            @csrf 
                            @method('DELETE') 
                            <button type="submit" class="btn btn-danger btn-sm"  
                                {{ $user->id == auth()->id() ? 'disabled' : '' }}> 
                                Hapus 
                            </button> 
                        </form> 
                    </td> 
                </tr> 
                @empty 
                <tr> 
                    <td colspan="5" class="text-center">Data user tidak ditemukan.</td> 
                </tr> 
                @endforelse 
            </tbody> 
        </table> 
 
        <div class="mt-3"> 
            {{ $users->links('pagination::bootstrap-5') }} 
        </div> 
    </div> 
</div> 
@endsection 
 
3. Buatlah file peminjaman-alat\resources\views\admin\users\create.blade.php 
@extends('layouts.app') 
 
@section('content') 
<div class="row justify-content-center"> 
    <div class="col-md-8"> 
        <div class="card"> 
            <div class="card-header fw-bold">Tambah User Baru</div> 
            <div class="card-body"> 
                <form action="{{ route('users.store') }}" method="POST"> 
                    @csrf 
                     
                    <div class="mb-3"> 
                        <label>Nama Lengkap</label> 
                        <input type="text" name="name" class="form-control @error('name') is-invalid 
@enderror" value="{{ old('name') }}" required> 
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                    </div> 
 
                    <div class="mb-3"> 
                        <label>Email Address</label> 
                        <input type="email" name="email" class="form-control @error('email') is-invalid 
@enderror" value="{{ old('email') }}" required> 
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                    </div> 
 
                    <div class="mb-3"> 
                        <label>Role (Hak Akses)</label> 
                        <select name="role" class="form-select @error('role') is-invalid @enderror" 
required> 
                            <option value="">-- Pilih Role --</option> 
                            <option value="peminjam" {{ old('role') == 'peminjam' ? 'selected' : '' 
}}>Peminjam (Siswa/Guru)</option> 
                            <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' 
}}>Petugas Lab</option> 
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' 
}}>Administrator</option> 
                        </select> 
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                    </div> 
 
                    <div class="mb-3"> 
                        <label>Password</label> 
                        <input type="password" name="password" class="form-control @error('password') is
invalid @enderror" required minlength="6"> 
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                    </div> 
 
                    <div class="d-flex justify-content-between mt-4"> 
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a> 
 
13 
                        <button type="submit" class="btn btn-primary">Simpan User</button> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection