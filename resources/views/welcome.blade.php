<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #f8fafc 0%, #e9eff5 100%);
        }
        .hero-section {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.95), rgba(13, 110, 253, 0.7)),
                url('https://source.unsplash.com/1600x900/?laboratory,workshop');
            background-size: cover;
            background-position: center;
            color: white;
            border-radius: 2rem;
            padding: 80px 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.14);
        }
        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 35%);
        }
        .hero-section .container {
            position: relative;
            z-index: 1;
        }
        .feature-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
        }
        .feature-card .card-body {
            min-height: 180px;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(13, 110, 253, 0.12);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">SIPINJAM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#welcomeNavbar" aria-controls="welcomeNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="welcomeNavbar">
                <div class="ms-auto">
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <section class="hero-section mb-5 text-white text-center text-md-start">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="display-5 fw-bold mb-3">Kelola peminjaman alat lebih cepat dan modern.</h1>
                        <p class="lead text-white-75 mb-4">Sistem terpadu untuk sekolah dan laboratorium agar proses pinjam, setujui, dan kembalikan alat lebih mudah.</p>
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg shadow-sm">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <div class="feature-icon text-primary">✓</div>
                    <h5 class="fw-semibold">Kelola Stok dengan Mudah</h5>
                    <p class="text-muted mb-0">Lihat ketersediaan alat dan atur kategori tanpa repot.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <div class="feature-icon text-success">⚡</div>
                    <h5 class="fw-semibold">Proses Peminjaman Cepat</h5>
                    <p class="text-muted mb-0">Ajukan dan setujui pinjaman dalam satu sistem yang responsif.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card p-4">
                    <div class="feature-icon text-warning">🔄</div>
                    <h5 class="fw-semibold">Pantau Pengembalian</h5>
                    <p class="text-muted mb-0">Tracking pengembalian lebih rapi dan laporan lebih mudah.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white text-center py-4 mt-auto">
        <div class="container">
            <small class="text-muted">&copy; {{ date('Y') }} Sistem Peminjaman Alat. Dibuat dengan Laravel.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
