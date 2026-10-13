@extends('layouts.app')

@section('content')
    <div class="card shadow-sm col-md-8 offset-md-2">
        <div class="card-header bg-warning text-dark">
            <h5 class="m-0">Edit Data Peserta</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('peserta.update', ['peserta' => $peserta->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Peserta</label>
                    <input type="text" name="nama_peserta" class="form-control @error('nama_peserta') is-invalid @enderror"
                        value="{{ old('nama_peserta', $peserta->nama_peserta) }}">
                    @error('nama_peserta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $peserta->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">No HP</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="{{ old('no_hp', $peserta->no_hp ?? '') }}" maxlength="13"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);"
                        placeholder="Contoh: 081234567890" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Skema Sertifikasi</label>
                    <select name="skema_id" class="form-select @error('skema_id') is-invalid @enderror">
                        <option value="">-- Pilih Skema --</option>
                        @foreach ($skemas as $s)
                            <option value="{{ $s->id }}"
                                {{ old('skema_id', $peserta->skema_id) == $s->id ? 'selected' : '' }}>
                                {{ $s->kode_skema }} - {{ $s->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                    @error('skema_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('peserta.index') }}" class="btn btn-secondary btn-">Batal</a>
            </form>
        </div>
    </div>
@endsection
