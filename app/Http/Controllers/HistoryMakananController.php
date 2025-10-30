<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryMakananController extends Controller
{
    public function index()
    {
        $datas = Makanan::with('peserta')->get();
        return view("app.history.makanan", compact("datas"));
    }

    public function edit($id)
    {
        $data = Makanan::with('peserta')->findOrFail($id);
        return view("app.history.makanan-edit", compact("data"));
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = Makanan::findOrFail($id);
            $data->update([
                'rebusan_pagi' => $request->rebusan_pagi,
                'snack' => $request->snack,
                'pulang_nasi' => $request->pulang_nasi,
            ]);

            DB::commit();
            return to_route('history-scan-makanan.index')->with([
                'message' => 'Sukses data berhasil unverifikasi.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('history-scan-makanan.index')->with([
                'message' => 'Maaf data gagal unverifikasi.',
                'type' => 'error'
            ]);
        }
    }
}
