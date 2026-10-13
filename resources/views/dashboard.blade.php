@extends('layouts.app')

@section('content')
<div class="container py-3">
    <!-- Row Kartu Statistik (Total Peserta & Total Skema) -->
    <div class="row g-4 mb-4">
        <!-- Card Total Peserta Registered -->
        <div class="col-md-6">
            <div class="card text-white bg-primary border-0 shadow-sm p-3 rounded-3" style="background-color: #0d6efd !important;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase fw-semibold mb-1" style="font-size: 0.9rem;">Total Peserta Registered</h6>
                        <h2 class="display-5 fw-bold mb-0">{{ $totalPeserta ?? 0 }}</h2>
                    </div>
                    <div>
                        <a href="{{ route('peserta.index') }}" class="btn btn-light btn-sm fw-bold px-3 py-2 text-dark shadow-sm">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Total Skema Sertifikasi -->
        <div class="col-md-6">
            <div class="card text-white bg-success border-0 shadow-sm p-3 rounded-3" style="background-color: #198754 !important;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-uppercase fw-semibold mb-1" style="font-size: 0.9rem;">Total Skema Sertifikasi</h6>
                        <h2 class="display-5 fw-bold mb-0">{{ $totalSkema ?? 0 }}</h2>
                    </div>
                    <div>
                        <a href="{{ route('skema.index') }}" class="btn btn-light btn-sm fw-bold px-3 py-2 text-dark shadow-sm">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Peserta Terbaru -->
    <div class="card border-0 shadow-sm">
        <!-- Header Tabel dengan Background Gelap Senada -->
        <div class="card-header text-white py-3" style="background-color: #212529;">
            <h5 class="m-0 fw-bold">Peserta Terbaru</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="py-3 ps-4 text-secondary">No</th>
                            <th class="py-3 text-secondary">Nama Peserta</th>
                            <th class="py-3 text-secondary">Email</th>
                            <th class="py-3 text-secondary pe-4">Skema</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesertaTerbaru ?? [] as $index => $peserta)
                        <tr>
                            <td class="py-3 ps-4">{{ $index + 1 }}</td>
                            <td class="py-3 fw-semibold text-dark">{{ $peserta->nama_peserta }}</td>
                            <td class="py-3 text-muted">{{ $peserta->email }}</td>
                            <td class="py-3 pe-4">
                                <span class="badge text-white px-3 py-2 fw-semibold" style="background-color: #05668d;">
                                    {{ $peserta->skema->nama_skema ?? '-' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada data peserta.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
