@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Peserta Sertifikasi</h3>
        <a href="{{ route('peserta.create') }}" class="btn btn-primary">Tambah Peserta</a>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('peserta.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau skema..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Skema Sertifikasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesertas as $key => $p)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $p->nama_peserta }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $p->skema ? $p->skema->nama_skema : 'Tidak ada skema' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <!-- Tombol Detail -->
                                <a href="{{ route('peserta.show', $p->id) }}"
                                    class="btn btn-sm btn-info text-white">Detail</a>

                                <a href="{{ route('peserta.edit', ['peserta' => $p->id]) }}"
                                    class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('peserta.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus data peserta ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data peserta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
