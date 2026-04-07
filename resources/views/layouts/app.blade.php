<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top, rgba(13, 110, 253, 0.12), transparent 45%),
                #f8f9fa;
            min-height: 100vh;
        }
        .navbar {
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }
        .dashboard-hero {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            border-radius: 1.5rem;
            box-shadow: 0 24px 60px rgba(13, 110, 253, 0.12);
        }
        .dashboard-card {
            border: none;
            border-radius: 1.25rem;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.08);
        }
        .dashboard-card .card-header {
            background: transparent;
            border-bottom: none;
            font-weight: 700;
            letter-spacing: 0.01em;
        }
        .dashboard-card .card-footer {
            background: transparent;
            border-top: none;
        }
        .status-chip {
            border-radius: 999px;
            padding: .35rem .85rem;
            font-size: .8rem;
            letter-spacing: .02em;
        }
        .table-responsive-custom {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">SIPINJAM</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <li class="nav-item"><a class="nav-link"
href="/admin/dashboard">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('categories.index')
}}">Kelola Kategori</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.index')
}}">Kelola Alat</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.index')
}}">Kelola User</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.loans.index')
}}">Kelola Peminjaman</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{
route('admin.returns.index') }}">Kelola Pengembalian</a></li>
                        @elseif(auth()->user()->role == 'petugas')
                            <li class="nav-item"><a class="nav-link" href="/petugas/dashboard">Validasi
Peminjaman</a></li>
                            <li class="nav-item"><a class="nav-link"
href="/petugas/laporan">Laporan</a></li>
                        @elseif(auth()->user()->role == 'peminjam')
                            <li class="nav-item"><a class="nav-link" href="/peminjam/dashboard">Daftar
Alat</a></li>
                            <li class="nav-item"><a class="nav-link" href="/peminjam/riwayat">Riwayat
Saya</a></li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login')
}}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>


            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
