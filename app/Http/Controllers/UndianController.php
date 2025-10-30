<?php

namespace App\Http\Controllers;

use App\Models\HasilUndian;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UndianController extends Controller
{
    public function index()
    {
        return view("app.doorprize.index");
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $total = (int) $request->count;
            // Hitung jumlah peserta yang hadir dan belum ikut undian
            $availableCount = Peserta::where('status_hadir', true)
                ->where('sudah_ikut_undian', false)
                ->count();

            // Cek apakah jumlah request melebihi peserta yang tersedia
            if ($total > $availableCount) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Jumlah undian ($total) melebihi jumlah peserta yang tersedia ($availableCount).",
                ], 400);
            }

            $participants = Peserta::where('status_hadir', true)
                ->where('sudah_ikut_undian', false)
                ->inRandomOrder()
                ->take($total)
                ->get();

            // Tandai sudah diundi
            foreach ($participants as $p) {
                $p->update(['sudah_ikut_undian' => true]);

                // simpan ke history
                HasilUndian::create([
                    'peserta_id' => $p->id,
                    'status' => 'hadir',
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => "Berhasil mengambil $total peserta undian.",
                'winners' => $participants,
                'all_present_names' => Peserta::where('status_hadir', true)->pluck('nama_karyawan'),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat proses undian.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function updatee(Request $request, $id)
    {
        $status = $request->status;
        if (!in_array($status, ['hadir', 'hangus'])) {
            return response()->json(['message' => 'Status tidak valid'], 422);
        }

        DB::beginTransaction();
        try {
            // Update di history
            $history = HasilUndian::where('peserta_id', $id)
                ->latest('created_at')
                ->first();

            if ($history) {
                $history->update(['status' => $status]);
            }

            DB::commit();
            return response()->json([
                "message" => "Status berhasil di perbaharui",
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "message" => "Status gagal di perbaharui",
            ]);
        }
    }
}
