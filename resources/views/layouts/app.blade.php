<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --surface: rgba(255, 255, 255, 0.96);
            --surface-border: rgba(15, 23, 42, 0.08);
            --accent: #0d6efd;
            --accent-soft: rgba(13, 110, 253, 0.14);
            --shadow: rgba(15, 23, 42, 0.12);
        }
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1f2937;
            background: radial-gradient(circle at top, rgba(13, 110, 253, 0.16), transparent 38%),
                linear-gradient(180deg, #f8fbff 0%, #e9effb 100%);
            min-height: 100vh;
            margin: 0;
            opacity: 0;
            animation: pageFade 0.6s ease-out forwards;
        }
        .navbar {
            background: rgba(13, 110, 253, 0.95);
            backdrop-filter: blur(14px);
            box-shadow: 0 18px 50px rgba(13, 110, 253, 0.14);
            border-bottom: 1px solid rgba(255, 255, 255, 0.18);
            transform: translateY(-18px);
            animation: slideDown 0.6s ease-out forwards;
        }
        .navbar-brand {
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.92) !important;
            transition: color 0.2s ease, transform 0.2s ease;
        }
        .nav-link:hover,
        .nav-link.active {
            color: #fff !important;
            transform: translateY(-1px);
        }
        .container {
            max-width: 1120px;
            padding-top: 1.5rem;
            padding-bottom: 2rem;
        }
        .card {
            background: var(--surface);
            border: 1px solid var(--surface-border);
            border-radius: 24px;
            box-shadow: 0 20px 60px var(--shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            opacity: 0;
            transform: translateY(24px);
            animation: fadeInUp 0.65s ease-out forwards;
            animation-delay: 0.15s;
            color: #111827;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.14);
        }
        .card-header {
            background: transparent;
            border-bottom: none;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 0.01em;
            color: #111827;
        }
        .card-body {
            padding: 1.75rem;
            color: #475569;
        }
        .form-control,
        .form-select,
        .form-control::placeholder,
        .form-select option {
            border-radius: 16px;
            border: 1px solid rgba(15, 23, 42, 0.12);
            background: #fff;
            color: #111827;
            box-shadow: none;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }
        .form-control::placeholder {
            color: rgba(15, 23, 42, 0.45);
        }
        .form-control:focus,
        .form-select:focus {
            border-color: rgba(13, 110, 253, 0.45);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
            transform: translateY(-1px);
            color: #111827;
        }
        .form-label {
            font-weight: 600;
            color: #1f2937;
            transition: color 0.2s ease;
        }
        .form-label:hover {
            color: var(--accent);
        }
        .text-muted {
            color: #6b7280 !important;
        }
        .card-header,
        .card-body,
        .table th,
        .table td,
        .table thead th,
        .table tbody td,
        .small,
        .lead {
            color: #111827;
        }
        .table thead th {
            color: #374151;
        }
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            border: none;
            box-shadow: 0 14px 28px rgba(13, 110, 253, 0.18);
            border-radius: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
            color: #fff;
        }
        .btn-primary:hover,
        .btn-primary:focus {
            transform: translateY(-1px) scale(1.02);
            box-shadow: 0 18px 36px rgba(13, 110, 253, 0.2);
            filter: brightness(1.03);
        }
        .btn-secondary {
            border-radius: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            color: #fff;
        }
        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
        }
        .alert,
        .alert p,
        .alert li {
            color: #111827;
        }
        .alert {
            opacity: 0;
            transform: translateY(16px);
            animation: fadeInUp 0.55s ease-out forwards;
            animation-delay: 0.1s;
            border-radius: 15px;
        }
        .table,
        .table th,
        .table td {
            color: #1f2937;
        }
        .table-hover tbody tr {
            transition: transform 0.15s ease, background-color 0.15s ease, box-shadow 0.15s ease;
        }
        .table-hover tbody tr:hover {
            transform: translateX(4px);
            background-color: rgba(13, 110, 253, 0.06);
            box-shadow: inset 0 0 0 1px rgba(13, 110, 253, 0.08);
        }
        .status-chip {
            border-radius: 999px;
            padding: .35rem .85rem;
            font-size: .8rem;
            letter-spacing: .02em;
            background: rgba(13, 110, 253, 0.08);
            color: #0d6efd;
        }
        .table-responsive-custom {
            overflow-x: auto;
        }
        @media (max-width: 768px) {
            .container {
                padding-top: 1rem;
                padding-bottom: 1.25rem;
            }
            .card-body {
                padding: 1.25rem;
            }
        }
        @keyframes pageFade {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
