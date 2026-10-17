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

    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         // $total = (int) $request->count;

    //         $total = (int) $request->count;
    //         $rangeStart = (int) $request->range_start;
    //         $rangeEnd = (int) $request->range_end;
    //         $specialNumber = $request->specific_number;

    //         if ($total < 1) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Jumlah undian minimal 1.'
    //             ], 400);
    //         }

    //         // Hitung jumlah peserta yang hadir dan belum ikut undian
    //         $availableCount = Peserta::where('status_hadir', true)
    //             ->where('sudah_ikut_undian', false)
    //             ->count();

    //         // Cek apakah jumlah request melebihi peserta yang tersedia
    //         if ($total > $availableCount) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => "Jumlah undian ($total) melebihi jumlah peserta yang tersedia ($availableCount).",
    //             ], 400);
    //         }

    //         $participants = Peserta::where('status_hadir', true)
    //             ->where('sudah_ikut_undian', false)
    //             ->inRandomOrder()
    //             ->take($total)
    //             ->get();

    //         // // Buat daftar nomor doorprize
    //         // $noUndianList = range($rangeStart, $rangeEnd);
    //         // $noUndianList = array_slice($noUndianList, 0, $total);

    //         // // Ganti nomor terakhir jika ada nomor spesial
    //         // if ($specialNumber) {
    //         //     $noUndianList[$total - 1] = $specialNumber;
    //         // }

    //         // Buat daftar nomor doorprize (bisa naik atau turun)
    //         $noUndianList = [];

    //         if ($rangeStart <= $rangeEnd) {
    //             // Urutan naik
    //             $noUndianList = range($rangeStart, $rangeEnd);
    //         } else {
    //             // Urutan turun
    //             $noUndianList = range($rangeStart, $rangeEnd, -1);
    //         }

    //         // Ambil hanya sejumlah yang diminta
    //         $noUndianList = array_slice($noUndianList, 0, $total);

    //         // Jika ada nomor khusus, ganti nomor terakhir
    //         if (!empty($specialNumber)) {
    //             $noUndianList[$total - 1] = $specialNumber;
    //         }

    //         // Simpan ke tabel hasil undian
    //         foreach ($participants as $index => $p) {
    //             $p->update(['sudah_ikut_undian' => true]);

    //             HasilUndian::create([
    //                 'peserta_id' => $p->id,
    //                 'status' => 'hadir',
    //                 'no_undian' => $noUndianList[$index] ?? null,
    //             ]);

    //             // Tambahkan no_undian ke objek peserta untuk dikirim ke frontend
    //             $p->no_undian = $noUndianList[$index] ?? null;
    //         }

    //         $sortedParticipants = $participants->values();

    //         DB::commit();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => "Berhasil mengambil $total peserta undian.",
    //             'winners' => $sortedParticipants,
    //             'all_present_names' => Peserta::where('status_hadir', true)->pluck('nama_karyawan'),
    //         ]);
    //     } catch (\Throwable $th) {
    //         DB::rollBack();

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Terjadi kesalahan saat proses undian.',
    //             'error' => $th->getMessage()
    //         ], 500);
    //     }
    // }

    // public function store(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $total = (int) $request->count;
    //         $rangeStart = (int) $request->range_start;
    //         $rangeEnd = (int) $request->range_end;
    //         $specialNumber = trim($request->specific_number);

    //         if ($total < 1) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Jumlah undian minimal 1.'
    //             ], 400);
    //         }

    //         // Buat daftar nomor undian dari range (boleh naik atau turun)
    //         if ($rangeStart <= $rangeEnd) {
    //             $noUndianList = range($rangeStart, $rangeEnd);
    //         } else {
    //             $noUndianList = range($rangeStart, $rangeEnd, -1);
    //         }

    //         $rangeCount = count($noUndianList);

    //         // Validasi: jumlah undian tidak boleh melebihi panjang rentang
    //         if ($total > $rangeCount) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => "Jumlah undian ($total) melebihi panjang rentang nomor ($rangeCount).",
    //             ], 400);
    //         }

    //         // Potong sesuai jumlah undian
    //         $noUndianList = array_slice($noUndianList, 0, $total);

    //         // Ganti nomor terakhir jika ada nomor spesial
    //         if (!empty($specialNumber)) {
    //             $noUndianList[$total - 1] = $specialNumber;
    //         }

    //         // Ambil peserta acak
    //         $availableCount = Peserta::where('status_hadir', true)
    //             ->where('sudah_ikut_undian', false)
    //             ->count();

    //         if ($total > $availableCount) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => "Jumlah undian ($total) melebihi jumlah peserta yang tersedia ($availableCount).",
    //             ], 400);
    //         }

    //         $participants = Peserta::where('status_hadir', true)
    //             ->where('sudah_ikut_undian', false)
    //             ->inRandomOrder()
    //             ->take($total)
    //             ->get();

    //         // Simpan hasil undian
    //         foreach ($participants as $index => $p) {
    //             $no_undian = $noUndianList[$index]; // Pasti ada

    //             $p->update(['sudah_ikut_undian' => true]);

    //             HasilUndian::create([
    //                 'peserta_id' => $p->id,
    //                 'status' => 'hadir',
    //                 'no_undian' => $no_undian,
    //             ]);

    //             // tambahkan ke hasil JSON agar muncul di frontend
    //             $p->no_undian = (string) $no_undian;
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Berhasil mengambil peserta undian.',
    //             'winners' => $participants->values(),
    //             'all_present_names' => Peserta::where('status_hadir', true)->pluck('nama_karyawan'),
    //         ]);
    //     } catch (\Throwable $th) {
    //         throw $th;
    //         DB::rollBack();
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Terjadi kesalahan saat proses undian.',
    //             'error' => $th->getMessage(),
    //         ], 500);
    //     }
    // }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $total = (int) $request->count;
            $rangeStart = (int) $request->range_start;
            $rangeEnd = (int) $request->range_end;
            $specialNumber = trim($request->specific_number ?? '');

            if ($total < 1) {
                DB::rollBack();

                return response()->json([
                    'status' => 'error',
                    'message' => 'Jumlah undian minimal 1.'
                ], 400);
            }

            // Buat daftar nomor undian dari range (boleh naik atau turun)
            if ($rangeStart <= $rangeEnd) {
                $noUndianList = range($rangeStart, $rangeEnd);
            } else {
                $noUndianList = range($rangeStart, $rangeEnd, -1);
            }

            $rangeCount = count($noUndianList);

            // Validasi: jumlah undian tidak boleh melebihi panjang rentang
            if ($total > $rangeCount) {
                DB::rollBack();

                return response()->json([
                    'status' => 'error',
                    'message' => "Jumlah undian ($total) melebihi panjang rentang nomor ($rangeCount).",
                ], 400);
            }

            // Potong sesuai jumlah undian
            $noUndianList = array_slice($noUndianList, 0, $total);

            // Ganti nomor terakhir jika ada nomor spesial
            if (!empty($specialNumber)) {
                $noUndianList[$total - 1] = $specialNumber;
            }

            /*
         * Ambil peserta yang memenuhi syarat:
         * - Sudah hadir
         * - Belum pernah mendapatkan undian
         *
         * Daftar inilah yang digunakan untuk roda dan pemilihan pemenang.
         */
            $eligibleParticipants = Peserta::where('status_hadir', true)
                ->where('sudah_ikut_undian', false)
                ->inRandomOrder()
                ->lockForUpdate()
                ->get();

            $availableCount = $eligibleParticipants->count();

            if ($total > $availableCount) {
                DB::rollBack();

                return response()->json([
                    'status' => 'error',
                    'message' => "Jumlah undian ($total) melebihi jumlah peserta yang tersedia ($availableCount).",
                ], 400);
            }

            /*
         * Daftar nama untuk roda dibuat dari peserta yang belum menang.
         * Termasuk peserta yang akan menang pada undian saat ini.
         */
            $allPresentNames = $eligibleParticipants
                ->map(function ($participant) {
                    return [
                        'id' => $participant->id,
                        'nama_karyawan' => $participant->nama_karyawan,
                    ];
                })
                ->values();

            /*
         * Pemenang dipilih dari daftar eligible yang sama.
         * Peserta yang terpilih tidak akan masuk undian berikutnya.
         */
            $participants = $eligibleParticipants
                ->take($total)
                ->values();

            // Simpan hasil undian
            foreach ($participants as $index => $p) {
                $noUndian = $noUndianList[$index];

                $p->update([
                    'sudah_ikut_undian' => true
                ]);

                HasilUndian::create([
                    'peserta_id' => $p->id,
                    'status' => 'hadir',
                    'no_undian' => $noUndian,
                ]);

                // Tambahkan nomor undian agar muncul di frontend
                $p->no_undian = (string) $noUndian;
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengambil peserta undian.',
                'winners' => $participants->values(),
                'all_present_names' => $allPresentNames,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            report($th);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat proses undian.',
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
