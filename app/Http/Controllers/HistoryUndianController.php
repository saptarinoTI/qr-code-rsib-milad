<?php

namespace App\Http\Controllers;

use App\Models\HasilUndian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryUndianController extends Controller
{
    public function index()
    {
        $datas = HasilUndian::with('peserta')->orderBy('created_at', 'desc')->get();
        return view("app.history.doorprize", compact("datas"));
    }

    public function update(Request $request, $id)
    {
        $status = $request->status;
        if (!in_array($status, ['hadir', 'hangus'])) {
            return response()->json(['message' => 'Status tidak valid'], 422);
        }

        DB::beginTransaction();
        try {
            // Update di history
            $history = HasilUndian::findOrFail($id);

            $history->update(['status' => $status]);

            DB::commit();
            return to_route('history-doorprize.index')->with([
                'message' => 'Sukses data berhasil disimpan.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('history-doorprize.index')->with([
                'message' => 'Maaf data gagal disimpan.',
                'type' => 'error'
            ]);
        }
    }
}
