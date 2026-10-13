<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - LSP Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom-gray {
            background-color: #e2e2e2 !important;
            color: #000000 !important;
            border: none !important;
        }
        .btn-custom-gray:hover {
            background-color: #d0d0d0 !important;
            color: #000000 !important;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100 py-4">

<div class="card shadow col-md-5 col-11">

    <div class="card-header bg-success text-white fw-bold text-center py-3">
        Buat Akun Baru
    </div>
    <div class="card-body p-4">
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('signup.perform') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="contoh@email.com" required>
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

            <div class="mb-3">
                <label class="form-label fw-bold">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" maxlength="13" placeholder="081234567890" required>
                @error('no_hp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Skema Sertifikasi</label>
                <select name="skema_id" class="form-select" required>
                    <option value="">-- Pilih Skema --</option>
                    @foreach($skemas as $skema)
                        <option value="{{ $skema->id }}" {{ old('skema_id') == $skema->id ? 'selected' : '' }}>
                            {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                        </option>
                    @endforeach
                </select>
                @error('skema_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom-gray w-100 fw-bold py-2 mt-2">Daftar</button>

            <div class="text-center mt-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('welcome') }}" class="text-decoration-none text-secondary">Kembali ke Utama</a>
                <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun? Masuk</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
