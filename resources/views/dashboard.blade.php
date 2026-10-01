@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Peserta Registered</h6>
                    <h2 class="m-0 fw-bold">{{ $totalPeserta }}</h2>
                </div>
                <div>
                    <a href="{{ route('peserta.index') }}" class="btn btn-light btn-sm fw-bold">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total Skema Sertifikasi</h6>
                    <h2 class="m-0 fw-bold">{{ $totalSkema }}</h2>
                </div>
                <div>
                    <a href="{{ route('skema.index') }}" class="btn btn-light btn-sm fw-bold">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <h5 class="m-0">Peserta Terbaru</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>Skema</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesertaTerbaru as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $p->nama_peserta }}</td>
                    <td>{{ $p->email }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $p->skema ? $p->skema->nama_skema : '-' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data peserta.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
