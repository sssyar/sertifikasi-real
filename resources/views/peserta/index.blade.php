@extends('layouts.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Data Peserta Sertifikasi</h2>

        <!-- Tombol Tambah Peserta HANYA MUNCUL untuk Admin -->
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('peserta.create') }}" class="btn btn-primary fw-bold">Tambah Peserta</a>
        @endif
    </div>

    <!-- FORM PENCARIAN -->
    <form action="{{ route('peserta.index') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau skema..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
            @if(request('search'))
                <a href="{{ route('peserta.index') }}" class="btn btn-outline-danger">Reset</a>
            @endif
        </div>
    </form>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover m-0 align-middle">
                    <thead>
                        <tr>
                            <th class="py-3 text-secondary">No</th>
                            <th class="py-3 text-secondary">Nama Peserta</th>
                            <th class="py-3 text-secondary">Email</th>
                            <th class="py-3 text-secondary">No HP</th>
                            <th class="py-3 text-secondary">Skema</th>
                            <!-- Kolom Aksi hanya muncul jika admin -->
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <th class="py-3 text-secondary text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertas as $index => $peserta)
                        <tr>
                            <td class="py-3">{{ $index + 1 }}</td>
                            <td class="py-3 fw-semibold text-dark">{{ $peserta->nama_peserta }}</td>
                            <td class="py-3 text-muted">{{ $peserta->email }}</td>
                            <td class="py-3 text-muted">{{ $peserta->no_hp }}</td>

                            <!-- Kolom Skema -->
                            <td class="py-3">
                                <span class="badge bg-info text-white px-3 py-2 fw-semibold">
                                    {{ $peserta->skema->nama_skema ?? '-' }}
                                </span>
                            </td>

                            <!-- Tombol Aksi Detail, Edit, & Hapus khusus untuk Admin -->
                            @if(auth()->check() && auth()->user()->role === 'admin')
                            <td class="py-3 text-center">
                                <a href="{{ route('peserta.show', $peserta->id) }}" class="btn btn-info btn-sm text-white px-3 fw-semibold">Detail</a>
                                <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-warning btn-sm text-dark px-3 fw-semibold">Edit</a>
                                <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-3 fw-semibold" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data peserta yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection