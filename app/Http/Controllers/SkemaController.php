<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index()
    {
        // Diubah menggunakan oldest() agar data terlama ada di nomor 1
        $skemas = Skema::oldest()->get();
        return view('skema.index', compact('skemas'));
    }

    public function create()
    {
        return view('skema.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_skema' => 'required|unique:skemas,kode_skema',
            'nama_skema' => 'required|string|max:255',
        ]);

        Skema::create($request->all());

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil ditambahkan!');
    }

    public function edit(Skema $skema)
    {
        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, Skema $skema)
    {
        $request->validate([
            'kode_skema' => 'required|unique:skemas,kode_skema,' . $skema->id,
            'nama_skema' => 'required|string|max:255',
        ]);

        $skema->update($request->all());

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil diperbarui!');
    }

    public function destroy(Skema $skema)
    {
        $skema->delete();
        return redirect()->route('skema.index')->with('success', 'Data skema berhasil dihapus!');
    }
}
