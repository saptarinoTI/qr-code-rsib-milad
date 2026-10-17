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

        $slugBatasJam10 = [
            'vira-fatmawati-amdkepinstalasi-rawat-inap-vip',
            'miftahul-riski-a-mdkebinstalasi-rawat-inap-vip',
            'aidha-strkepinstalasi-high-care',
            'arinda-sri-wahyuni-amdkepinstalasi-high-care',
            'ita-wahyuni-oemardi-skepnsinstalasi-rawat-inap-3-jabal',
            'indah-lestari-amdkepinstalasi-rawat-inap-3-jabal',
            'perawat-baru-hersantiinstalasi-rawat-inap-3-jabal',
            'bdn-jumiati-l-skebinstalasi-mother-and-baby-care',
            'anggita-oktaviana-amdkebinstalasi-mother-and-baby-care',
            'imaniar-juniati-amd-kebinstalasi-mother-and-baby-care',
            'lilik-nur-safitri-amdkepinstalasi-rawat-inap-2-raodah',
            'viola-larasati-sukma-amdkepinstalasi-rawat-inap-2-raodah',
            'mirza-wati-amd-kepinstalasi-rawat-inap-1-multazam',
            'nurzakia-firdaus-amdkepinstalasi-rawat-inap-1-multazam',
            'tri-purwaning-tyascssd',
            'rezky-amalia-amdkebinstalasi-rawat-inap-vvip-grand-vvip',
            'nuraeniamdkepinstalasi-rawat-inap-vvip-grand-vvip',
            'dr-fina-sulistiawatiinstalasi-rawat-inap',
            'dr-bacharuddin-jusuf-amiruddininstalasi-gawat-darurat',
            'firda-dwi-lestari-amdkepinstalasi-gawat-darurat',
            'renaldi-wahyu-aprian-amdkepinstalasi-gawat-darurat',
            'ns-kamila-skepinstalasi-gawat-darurat',
        ];

        // Tentukan batas waktu berdasarkan slug peserta.
        $jamBatas = in_array($data, $slugBatasJam10, true)
            ? '10:00:00'
            : '08:30:00';

        $batasWaktu = \Carbon\Carbon::parse(
            '2026-10-18 ' . $jamBatas,
            'Asia/Makassar'
        );

        if (now()->greaterThan($batasWaktu)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf!, Waktu absensi telah berakhir...',
                'data' => $data,
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
