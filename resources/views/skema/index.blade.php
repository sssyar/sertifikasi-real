@extends('layouts.app')

@section('content')
<div class="container py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Data Skema Sertifikasi</h2>

        <!-- TOMBOL TAMBAH SKEMA HANYA MUNCUL JIKA ADMIN -->
        @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('skema.create') }}" class="btn btn-primary fw-bold">Tambah Skema</a>
        @endif
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover m-0 align-middle">
                    <thead>
                        <tr>
                            <th class="py-3 text-secondary">No</th>
                            <th class="py-3 text-secondary">Kode Skema</th>
                            <th class="py-3 text-secondary">Nama Skema</th>
                            <th class="py-3 text-secondary text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skemas as $key => $s)
                        <tr>
                            <td class="py-3">{{ $key + 1 }}</td>
                            <td class="py-3"><span class="badge bg-secondary">{{ $s->kode_skema }}</span></td>
                            <td class="py-3 fw-semibold text-dark">{{ $s->nama_skema }}</td>
                            <td class="py-3 text-center">
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <a href="{{ route('skema.edit', $s->id) }}" class="btn btn-sm btn-warning text-dark px-3 fw-semibold">Edit</a>
                                    <form action="{{ route('skema.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus skema ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger px-3 fw-semibold">Hapus</button>
                                    </form>
                                @else
                                    <span class="badge bg-info text-white px-3 py-2 fw-semibold">Hanya Lihat</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data skema.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
