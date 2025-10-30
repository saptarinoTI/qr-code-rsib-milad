<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HsitoryScanController extends Controller
{
    public function index()
    {
        $datas = Peserta::where('status_hadir', 1)->get();
        return view("app.history.scan", compact("datas"));
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = Peserta::findOrFail($id);
            $data->update([
                'status_hadir' => false,
                'waktu_absen' => NULL
            ]);

            $makanan = Makanan::where('peserta_id', $data->id)->first();

            if ($makanan) {
                $makanan->delete();
            }

            DB::commit();
            return to_route('history-scan.index')->with([
                'message' => 'Sukses data berhasil unverifikasi.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('history-scan.index')->with([
                'message' => 'Maaf data gagal unverifikasi.',
                'type' => 'error'
            ]);
        }
    }
}
