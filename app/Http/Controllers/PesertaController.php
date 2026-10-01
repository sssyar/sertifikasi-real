<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

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
        $skemas = Skema::all();
        return view('peserta.create', compact('skemas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email'        => 'required|email|unique:pesertas,email',
            'no_hp'        => 'required|string|max:15',
            'skema_id'     => 'required|exists:skemas,id',
        ]);

        try {
            Peserta::create($request->all());
            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $peserta = Peserta::with('skema')->findOrFail($id);
            return view('peserta.show', compact('peserta'));
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Data peserta tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            $skemas  = Skema::all();
            return view('peserta.edit', compact('peserta', 'skemas'));
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Data peserta tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
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

    public function destroy($id)
    {
        try {
            $peserta = Peserta::findOrFail($id);
            $peserta->delete();

            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('peserta.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
