<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Peserta;
use App\Models\Undangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UndanganController extends Controller
{
    public function index()
    {
        return view("app.undangan.index");
    }
    public function store(Request $request)
    {
        $data = $request->input('qr_code');

        $batasWaktu = \Carbon\Carbon::parse('2026-10-18 08:30:00');

        if (now()->greaterThan($batasWaktu)) {
            return to_route('peserta.index')->with([
                'message' => 'Waktu absensi telah berakhir. Absensi hanya dapat dilakukan sampai 18 Oktober 2026 pukul 03:00 WITA.',
                'type' => 'error'
            ]);
        }

        DB::beginTransaction();
        try {
            $peserta = Peserta::where('qr_code', $data)->first();

            if ($peserta) {
                $peserta->update([
                    'status_hadir' => true,
                    'waktu_absen' => now()
                ]);


                Makanan::firstOrCreate([
                    'peserta_id' => $peserta->id,
                ]);

                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Absen peserta milad berhasil.',
                    'data' => $data,
                    'peserta' => $peserta,
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Absen peserta milad gagal. QR code tidak valid.',
                'data' => $data,
                'peserta' => $peserta,
            ]);
        }
    }
}
