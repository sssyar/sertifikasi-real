@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-8 offset-md-2">
    <div class="card-header bg-primary text-white">
        <h5 class="m-0">Tambah Peserta Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('peserta.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Peserta</label>
                <input type="text" name="nama_peserta" class="form-control @error('nama_peserta') is-invalid @enderror" value="{{ old('nama_peserta') }}">
                @error('nama_peserta') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                @error('no_hp') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Skema Sertifikasi</label>
                <select name="skema_id" class="form-select @error('skema_id') is-invalid @enderror">
                    <option value="">-- Pilih Skema --</option>
                    @foreach($skemas as $s)
                        <option value="{{ $s->id }}" {{ old('skema_id') == $s->id ? 'selected' : '' }}>
                            - {{ $s->kode_skema }} {{ $s->nama_skema }}
                        </option>
                    @endforeach
                </select>
                @error('skema_id') 
                    <div class="invalid-feedback">{{ $message }}</div> 
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('peserta.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection