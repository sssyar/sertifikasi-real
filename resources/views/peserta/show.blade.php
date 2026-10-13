@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="card shadow-sm col-md-8 offset-md-2 border-0">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="m-0 fw-bold">Detail Data Peserta</h5>
            <a href="{{ route('peserta.index') }}" class="btn btn-sm btn-light fw-semibold">Kembali</a>
        </div>
        <div class="card-body p-4">
            <table class="table table-borderless align-middle m-0">
                <tr>
                    <th width="30%" class="text-secondary">Nama Peserta</th>
                    <td width="5%">:</td>
                    <td class="fw-semibold text-dark">{{ $peserta->nama_peserta }}</td>
                </tr>
                <tr>
                    <th class="text-secondary">Email</th>
                    <td>:</td>
                    <td class="text-muted">{{ $peserta->email }}</td>
                </tr>
                <tr>
                    <th class="text-secondary">No. HP</th>
                    <td>:</td>
                    <td class="text-muted">{{ $peserta->no_hp }}</td>
                </tr>
                <tr>
                    <th class="text-secondary">Skema Sertifikasi</th>
                    <td>:</td>
                    <td>
                        <!-- Badge dengan warna #05668d -->
                        <span class="badge text-white px-3 py-2 fw-semibold fs-6" style="background-color: #97B3AE;">
                            {{ $peserta->skema ? $peserta->skema->kode_skema . ' - ' . $peserta->skema->nama_skema : 'Belum memilih skema' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <!-- TOMBOL EDIT HANYA MUNCUL JIKA YANG LOGIN ADALAH ADMIN -->
        @if(Auth::check() && Auth::user()->role === 'admin')
        <div class="card-footer bg-light text-end py-3">
            <a href="{{ route('peserta.edit', ['peserta' => $peserta->id]) }}" class="btn btn-warning btn-sm fw-bold px-4">Edit Data</a>
        </div>
        @endif
    </div>
</div>
@endsection
