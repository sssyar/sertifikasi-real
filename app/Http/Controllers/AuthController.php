<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Setelah Login Berhasil
    public function login(Request $request)
    {
        // 1. Validasi wajib diisi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // 2. Cek apakah email sudah terdaftar di database (tabel users)
        $userCheck = User::where('email', $email)->first();
        if (!$userCheck) {
            // Jika belum terdaftar, dialihkan ke halaman signup dengan pesan error merah
            return redirect()->route('signup')->with('error', 'Akun belum terdaftar! Silakan lakukan pendaftaran terlebih dahulu.');
        }

        // 3. Proses autentikasi login standar
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Jika role admin, langsung ke dashboard admin
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }

            // Jika role user, langsung ke dashboard user
            return redirect()->route('user.dashboard');
        }

        // 4. Jika password salah
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Menampilkan Form Sign Up Peserta
    public function showSignUpForm()
    {
        $skemas = Skema::oldest()->get();
        return view('auth.signup', compact('skemas'));
    }

    // Proses Signup (Daftar)
    public function processSignUp(Request $request)
    {
        // Validasi input daftar sesuai form
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'no_hp' => 'required|string|max:15',
            'skema_id' => 'required|exists:skemas,id',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'skema_id.required' => 'Silakan pilih skema sertifikasi terlebih dahulu.',
        ]);

        // 1. Cek apakah email sudah terdaftar di tabel users atau peserta
        $existingUser = User::where('email', $request->email)->first();
        $existingPeserta = Peserta::where('email', $request->email)->first();

        if ($existingUser || $existingPeserta) {
            return redirect()->route('login')->with('error', 'Email ini sudah terdaftar sebelumnya. Silakan langsung masuk.');
        }

        // 2. Buat akun user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // 3. Buat juga data di tabel peserta dengan data lengkap dari form
        Peserta::create([
            'nama_peserta' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'skema_id' => $request->skema_id,
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran akun berhasil! Silakan masuk (login).');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Berhasil logout!');
    }
}