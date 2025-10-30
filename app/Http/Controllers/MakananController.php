<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Peserta;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index()
    {
        return view("app.makanan.index");
    }
    public function store(Request $request)
    {
        $qrCode = $request->input('qr_code');
        $type = $request->input('pilihan_radio');

        $peserta = Peserta::where('qr_code', $qrCode)->first();
        if (!$peserta || !$peserta->status_hadir) {
            return response()->json([
                'status' => 'error',
                'message' => 'Peserta tidak hadir atau tidak terdaftar .',
                'data' => $qrCode,
                'peserta' => $peserta,
            ]);
        }

        $makanan = Makanan::where('peserta_id', $peserta->id)->first();

        if ($makanan->$type) {
            return response()->json([
                'status' => 'error',
                'message' => 'Peserta sudah mengambil makanan ' . $type,
                'data' => $qrCode,
                'peserta' => $peserta,
            ]);
        }
        $makanan->update([
            $type => true
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Ambil makanan ' . $type . ' berhasil untuk ' . $peserta->nama_karyawan,
            'data' => $qrCode,
            'peserta' => $peserta,
        ]);
    }
}
