@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-8 offset-md-2">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h5 class="m-0">Detail Data Peserta</h5>
        <a href="{{ route('peserta.index') }}" class="btn btn-sm btn-light">Kembali</a>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="30%">Nama Peserta</th>
                <td width="5%">:</td>
                <td>{{ $peserta->nama_peserta }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td>{{ $peserta->email }}</td>
            </tr>
            <tr>
                <th>No. HP</th>
                <td>:</td>
                <td>{{ $peserta->no_hp }}</td>
            </tr>
            <tr>
                <th>Skema Sertifikasi</th>
                <td>:</td>
                <td>
                    <span class="badge bg-primary fs-6">
                        {{ $peserta->skema ? $peserta->skema->kode_skema . ' - ' . $peserta->skema->nama_skema : 'Belum memilih skema' }}
                    </span>
                </td>
            </tr>
        </table>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('peserta.edit', ['peserta' => $peserta->id]) }}" class="btn btn-warning btn-sm">Edit Data</a>
    </div>
</div>
@endsection
