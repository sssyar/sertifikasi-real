<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Data Peserta Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <!-- Brand / Logo: Mengarahkan dinamis sesuai role -->
            <a class="navbar-brand fw-bold" href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}">
                LSP Sertifikasi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <!-- Menu Dashboard -->
                        <a class="nav-link {{ request()->is('user/dashboard') || request()->is('dashboard') ? 'active' : '' }}"
                            href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('peserta*') ? 'active' : '' }}"
                            href="{{ route('peserta.index') }}">Data Peserta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('skema*') ? 'active' : '' }}"
                            href="{{ route('skema.index') }}">Data Skema</a>
                    </li>
                </ul>

                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container">
        <!-- Notifikasi Berhasil -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Notifikasi Peringatan (Warning) -->
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
