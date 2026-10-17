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
            'vira-fatmawati-amdkep-instalasi-rawat-inap---vip',
            'miftahul-riski-a-mdkeb-instalasi-rawat-inap---vip',
            'aidha-strkep-instalasi-high-care',
            'arinda-sri-wahyuni-amdkep-instalasi-high-care',
            'ita-wahyuni-oemardi-skepns-instalasi-rawat-inap-3---jabal',
            'indah-lestari-amdkep-instalasi-rawat-inap-3---jabal',
            'perawat-baru--hersanti-instalasi-rawat-inap-3---jabal',
            'bdn-jumiati-l-skeb-instalasi-mother-and-baby-care',
            'anggita-oktaviana-amdkeb-instalasi-mother-and-baby-care',
            'imaniar-juniati-amd-keb-instalasi-mother-and-baby-care',
            'lilik-nur-safitri-amdkep-instalasi-rawat-inap-2---raodah',
            'viola-larasati-sukma-amdkep-instalasi-rawat-inap-2---raodah',
            'mirza-wati-amd-kep-instalasi-rawat-inap-1---multazam',
            'nurzakia-firdaus-amdkep-instalasi-rawat-inap-1---multazam',
            'tri-purwaning-tyas-cssd',
            'rezky-amalia-amdkeb-instalasi-rawat-inap---vvip-&-grand-vvip',
            'nuraeniamdkep-instalasi-rawat-inap---vvip-&-grand-vvip',
            'dr-fina-sulistiawati-instalasi-rawat-inap',
            'dr-bacharuddin-jusuf-amiruddin-instalasi-gawat-darurat',
            'firda-dwi-lestari-amdkep-instalasi-gawat-darurat',
            'renaldi-wahyu-aprian-amdkep-instalasi-gawat-darurat',
            'ns-kamila-skep-instalasi-gawat-darurat',
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
