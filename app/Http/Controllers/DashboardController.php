<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeserta = Peserta::count();
        $totalSkema = Skema::count();
        $pesertaTerbaru = Peserta::with('skema')->latest()->take(5)->get();

        return view('dashboard', compact('totalPeserta', 'totalSkema', 'pesertaTerbaru'));
    }
}
