<?php

namespace App\Http\Controllers;

use App\Models\HasilUndian;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function downloadqrcode()
    {
        $datas = Peserta::orderBy('nama_karyawan')->get();
        return view("downloadqrcode", compact("datas"));
    }

    public function historydoorprize()
    {
        $datas = HasilUndian::with('peserta')
            ->orderByRaw('CAST(no_undian AS UNSIGNED) ASC')
            ->get();
        return view("historydoorprize", compact("datas"));
    }

    public function login()
    {
        return view("auth.login");
    }

    public function loginpost(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau kata sandi salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
