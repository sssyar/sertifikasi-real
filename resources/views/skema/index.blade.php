@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Skema Sertifikasi</h3>
    <a href="{{ route('skema.create') }}" class="btn btn-primary">Tambah Skema</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Skema</th>
                    <th>Nama Skema</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skemas as $key => $s)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><span class="badge bg-secondary">{{ $s->kode_skema }}</span></td>
                    <td>{{ $s->nama_skema }}</td>
                    <td class="text-center">
                        <a href="{{ route('skema.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('skema.destroy', $s->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus skema ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data skema.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
