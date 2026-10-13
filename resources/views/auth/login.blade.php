<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - LSP Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom-gray {
            background-color: #e2e2e2 !important;
            color: #000000 !important;
            border: none !important;
        }
        .btn-custom-gray:hover {
            background-color: #d0d0d0 !important;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

<div class="card shadow col-md-4 col-11">
    <div class="card-header bg-success text-white fw-bold text-center py-3">
        Masuk
    </div>
    <div class="card-body p-4">
        {{-- Jika error (misal: email sudah terdaftar), warnanya MERAH (alert-danger) --}}
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Jika success (misal: pendaftaran berhasil), warnanya HIJAU (alert-success) --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.perform') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Masukkan email" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control" maxlength="6" placeholder="******" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom-gray w-100 fw-bold py-2 mt-2">Masuk</button>

            <div class="text-center mt-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('welcome') }}" class="text-decoration-none text-secondary">Kembali ke Utama</a>
                <a href="{{ route('signup') }}" class="text-decoration-none">Belum punya akun? Daftar</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>