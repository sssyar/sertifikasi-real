<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard untuk Admin
    public function index()
    {
        $totalPeserta = Peserta::count();
        $totalSkema = Skema::count();

        // Mengambil peserta terlama (data pertama kali mendaftar berada di atas)
        $pesertaTerbaru = Peserta::with('skema')->oldest()->take(5)->get();

        return view('dashboard', compact('totalPeserta', 'totalSkema', 'pesertaTerbaru'));
    }

    // Dashboard mandiri untuk User/Peserta
    public function userDashboard()
    {
        $user = Auth::user();
        // Mengambil data peserta berdasarkan user yang sedang login
        $peserta = Peserta::where('email', $user->email)->first();

        return view('user.dashboard', compact('peserta'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        // Mengambil data peserta berdasarkan user yang login
        $peserta = Peserta::where('email', $user->email)->first();
        // Mengambil semua data skema untuk dropdown
        $skemas = Skema::all();

        return view('user.profile-edit', compact('user', 'peserta', 'skemas'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            // Nama hanya boleh berisi huruf dan spasi
            'nama_peserta' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Nomor HP hanya angka, minimal 10 dan maksimal 13 digit
            'no_hp' => 'required|numeric|digits_between:10,13',
            'skema_id' => 'required|exists:skemas,id',
        ], [
            'nama_peserta.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi (tidak boleh mengandung angka).',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus di antara 10 sampai 13 digit angka.',
        ]);

        // Update data pada tabel users
        \App\Models\User::where('id', $user->id)->update([
            'name' => $request->nama_peserta,
            'email' => $request->email,
        ]);

        // Update atau buat data pada tabel peserta
        Peserta::updateOrCreate(
            ['email' => $user->email],
            [
                'nama_peserta' => $request->nama_peserta,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'skema_id' => $request->skema_id,
            ]
        );

        return redirect()->route('user.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }
}
