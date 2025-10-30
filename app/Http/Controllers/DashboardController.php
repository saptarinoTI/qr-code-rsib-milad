<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Peserta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $all = Peserta::all();
        $hadir = Peserta::where('status_hadir', 1)->get();
        $tidakHadir = Peserta::where('status_hadir', 0)->get();
        $rebusan = Makanan::where('rebusan_pagi', 1)->get();
        $snack = Makanan::where('snack', 1)->get();
        $nasi = Makanan::where('pulang_nasi', 1)->get();
        return view("app.dashboard", compact('all', 'hadir', 'tidakHadir', 'rebusan', 'snack', 'nasi'));
    }
}
