<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pesertas = Peserta::with('skema')
            ->when($search, function ($query, $search) {
                return $query->where('nama_peserta', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhereHas('skema', function ($q) use ($search) {
                                 $q->where('nama_skema', 'like', "%{$search}%");
                             });
            })
            ->oldest()
            ->get();

        return view('peserta.index', compact('pesertas'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $skemas = Skema::all();
        return view('peserta.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nama_peserta' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:pesertas,email',
            'no_hp' => 'required|numeric|digits_between:10,13',
            'skema_id' => 'required|exists:skemas,id',
        ], [
            'nama_peserta.required' => 'Nama peserta wajib diisi.',
            'nama_peserta.regex' => 'Nama lengkap hanya boleh berisi huruf.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus berupa angka antara 10 sampai 13 digit.',
            'skema_id.required' => 'Silakan pilih skema sertifikasi terlebih dahulu.',
            'skema_id.exists' => 'Skema yang dipilih tidak valid.',
        ]);

        Peserta::create($request->all());

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil ditambahkan secara lengkap!');
    }

    public function show(string $id)
    {
        try {
            $peserta = Peserta::with('skema')->findOrFail($id);
            return view('peserta.show', compact('peserta'));
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Data peserta tidak ditemukan.');
        }
    }

    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        try {
            $peserta = Peserta::findOrFail($id);
            $skemas  = Skema::all();
            return view('peserta.edit', compact('peserta', 'skemas'));
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Data peserta tidak ditemukan.');
        }
    }

    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email'        => 'required|email|unique:pesertas,email,' . $id,
            'no_hp'        => 'required|string|max:15',
            'skema_id'     => 'required|exists:skemas,id',
        ]);

        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->update($request->all());

            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->delete();

            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}