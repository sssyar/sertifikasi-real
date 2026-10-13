@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="card shadow-sm col-md-8 mx-auto border-0">
        <div class="card-header bg-warning text-dark fw-bold py-3">
            Edit Data Diri & Skema
        </div>
        <div class="card-body p-4">

            <!-- Menampilkan Pesan Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                    <!-- Hanya mengizinkan huruf dan spasi (mencegah ketik angka via JS onkeypress) -->
                    <input type="text" name="nama_peserta" class="form-control"
                           value="{{ old('nama_peserta', $peserta->nama_peserta ?? $user->name) }}"
                           onkeypress="return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32"
                           placeholder="Contoh: Budi Santoso" required>
                    <small class="text-muted">Hanya boleh berisi huruf.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Email</label>
                    <input type="email" name="email" class="form-content form-control" value="{{ old('email', $peserta->email ?? $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Nomor HP</label>
                    <!-- Hanya mengizinkan angka dengan batasan maksimal 13 karakter -->
                    <input type="text" name="no_hp" class="form-control"
                           value="{{ old('no_hp', $peserta->no_hp ?? '') }}"
                           maxlength="13"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);"
                           placeholder="Contoh: 081234567890" required>
                    <small class="text-muted">Hanya angka, maksimal 13 digit.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Pilih Skema Sertifikasi</label>
                    <select name="skema_id" class="form-select" required>
                        <option value="">-- Pilih Skema --</option>
                        @foreach($skemas as $skema)
                            <option value="{{ $skema->id }}" {{ (old('skema_id', $peserta->skema_id ?? '') == $skema->id) ? 'selected' : '' }}>
                                {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-success fw-bold px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
