<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - LSP Sertifikasi</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom-gray {
            background-color: #e2e2e2 !important;
            color: #000000 !important;
            border: none !important;
        }
        .btn-custom-gray:hover, .btn-custom-gray:focus, .btn-custom-gray:active {
            background-color: #e2e2e2 !important;
            color: #000000 !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Mengunci juga tombol Mendaftar agar warnanya konsisten hijau penuh */
        .btn-success {
            background-color: #198754 !important;
            border-color: #198754 !important;
        }
        .btn-success:hover, .btn-success:focus, .btn-success:active {
            background-color: #157347 !important;
            border-color: #146c43 !important;
        }
    </style>
</head>
<body class="bg-light min-vh-100 d-flex flex-column">

    <!-- Header / Navbar dengan tombol di pojok kanan atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 px-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-dark" href="#">LSP Sertifikasi</a>

            <div class="ms-auto d-flex gap-2">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="btn btn-dark fw-bold px-4">Dashboard Admin</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-dark fw-bold px-4">Dashboard Saya</a>
                    @endif
                @else
                    <!-- Tombol Masuk: Abu-abu #e2e2e2 -->
                    <a href="{{ route('login') }}" class="btn btn-custom-gray fw-bold px-4">Masuk</a>

                    <!-- Tombol Mendaftar: Full Hijau Solid dengan Teks Putih -->
                    <a href="{{ route('signup') }}" class="btn btn-success fw-bold px-4 text-white">Mendaftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Konten Kartu Selamat Datang di Tengah Layar -->
    <div class="container d-flex align-items-center justify-content-center flex-grow-1">
        <div class="card shadow-lg text-center p-5 col-md-6 border-0 bg-white">
            <div class="card-body">
                <h2 class="fw-bold mb-3">Selamat Datang di Aplikasi Sertifikasi</h2>
                <p class="text-muted mb-0">Platform resmi uji kompetensi dan asesmen mandiri. Silakan akses akun Anda melalui tombol di pojok kanan atas untuk melanjutkan.</p>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

