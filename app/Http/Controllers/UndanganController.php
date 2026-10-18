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

        DB::beginTransaction();
        try {
            $peserta = Peserta::where('qr_code', $data)->first();

            if ($peserta) {
                $peserta->update([
                    'status_hadir' => true,
                    'waktu_absen' => now()
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
