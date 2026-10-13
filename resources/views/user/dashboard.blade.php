@extends('layouts.app')

@section('content')
<div class="container py-3">
    <!-- Banner Sambutan -->
    <div class="alert alert-primary shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center bg-light border-0">
        <div>
            <h4 class="fw-bold text-dark">Hai, {{ Auth::user()->name ?? 'Peserta' }}! 👋</h4>
            <p class="text-muted m-0">Selamat datang di dashboard mandiri peserta LSP.</p>
        </div>
        <div>
            <a href="{{ route('user.profile.edit') }}" class="btn btn-warning text-dark fw-bold px-4">Edit Profil Saya</a>
        </div>
    </div>

    <!-- Detail Informasi Peserta -->
    <div class="card shadow-sm border-0 col-md-8 mx-auto">
        <div class="card-header bg-secondary text-white fw-bold py-3 bg-dark">
            Detail Informasi Peserta
        </div>
        <div class="card-body p-4">
            @if(isset($peserta) && $peserta)
            <table class="table table-borderless align-middle m-0">
                <tr>
                    <th width="30%" class="text-secondary">Nama Lengkap</th>
                    <td width="5%">:</td>
                    <td class="fw-semibold text-dark">{{ $peserta->nama_peserta }}</td>
                </tr>
                <tr>
                    <th class="text-secondary">Email</th>
                    <td>:</td>
                    <td class="text-muted">{{ $peserta->email }}</td>
                </tr>
                <tr>
                    <th class="text-secondary">No HP</th>
                    <td>:</td>
                    <td class="text-muted">{{ $peserta->no_hp }}</td>
                </tr>
                <tr>
                    <th class="text-secondary">Skema Sertifikasi</th>
                    <td>:</td>
                    <td>
                        <span class="badge text-white px-3 py-2 fw-semibold fs-6" style="background-color: #97B3AE;">
                            {{ $peserta->skema->nama_skema ?? 'Belum memilih skema' }}
                        </span>
                    </td>
                </tr>
            </table>
            @else
            <div class="text-center py-3">
                <p class="text-muted mb-2">Data profil peserta belum terhubung.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
