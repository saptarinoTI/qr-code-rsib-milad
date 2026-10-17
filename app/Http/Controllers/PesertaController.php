<?php

namespace App\Http\Controllers;

use App\Jobs\SendQrCodeEmailJob;
use App\Mail\QrCodeMail;
use App\Models\Makanan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PesertaController extends Controller
{
    public function index()
    {
        $datas = Peserta::orderBy('nama_karyawan')->get();
        return view("app.peserta.index", compact("datas"));
    }

    public function create()
    {
        return view("app.peserta.create");
    }

    public function store(Request $request)
    {
        $validat = $request->validate([
            'nama_karyawan' => 'required|unique:pesertas,nama_karyawan',
            'unit' => 'required',
        ]);
        $validat['qr_code'] = Str::slug($validat['nama_karyawan'] . '-' . $validat['unit'], '-');

        DB::beginTransaction();
        try {
            Peserta::create($validat);
            DB::commit();
            return to_route('peserta.index')->with([
                'message' => 'Sukses data berhasil disimpan.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('peserta.index')->with([
                'message' => 'Maaf data gagal disimpan.',
                'type' => 'error'
            ]);
        }
    }

    public function edit(string $id)
    {
        $data = Peserta::findOrFail($id);
        return view("app.peserta.edit", compact("data"));
    }

    public function update(Request $request, string $id)
    {
        $data = Peserta::findOrFail($id);
        $validat = $request->validate([
            'nama_karyawan' => 'required|unique:pesertas,nama_karyawan,' . $data->id,
            'unit' => 'required',
        ]);

        $validat['qr_code'] = Str::slug($validat['nama_karyawan'] . $validat['unit'], '-');

        DB::beginTransaction();
        try {
            $data->update($validat);
            DB::commit();
            return to_route('peserta.index')->with([
                'message' => 'Sukses data berhasil disimpan.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('peserta.index')->with([
                'message' => 'Maaf data gagal disimpan.',
                'type' => 'error'
            ]);
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $data = Peserta::findOrFail($id);
            $data->delete();
            DB::commit();
            return to_route('peserta.index')->with([
                'message' => 'Sukses data berhasil dihapus.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('peserta.index')->with([
                'message' => 'Maaf data gagal dihapus.',
                'type' => 'error'
            ]);
        }
    }

    public function all()
    {
        $alls = Peserta::all();
        DB::beginTransaction();
        try {
            foreach ($alls as $all) {
                $all->qr_code = Str::slug($all->nama_karyawan . $all->unit, '-');
                $all->save();
            }
            DB::commit();
            return to_route('peserta.index')->with([
                'message' => 'Sukses data berhasil disimpan.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('peserta.index')->with([
                'message' => 'Maaf data gagal disimpan.',
                'type' => 'error'
            ]);
        }
    }

    public function verif($id)
    {
        DB::beginTransaction();
        try {
            $data = Peserta::findOrFail($id);
            $data->update([
                'status_hadir' => true,
                'waktu_absen' => now()
            ]);

            Makanan::firstOrCreate([
                'peserta_id' => $data->id,
            ]);

            DB::commit();
            return to_route('peserta.index')->with([
                'message' => 'Sukses Absen peserta milad berhasil.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('peserta.index')->with([
                'message' => 'Maaf Absen peserta milad gagal.',
                'type' => 'error'
            ]);
        }
    }

    public function generate($id)
    {
        $participant = Peserta::findOrFail($id);

        $fileName = $participant->qr_code . '.png';

        // dd(
        //     $participant->qr_code,
        //     bin2hex($participant->qr_code),
        //     mb_detect_encoding($participant->qr_code, ['UTF-8', 'ISO-8859-1', 'ASCII'], true)
        // );

        $qrContent = QrCode::format('png')
            ->size(1000)
            ->margin(2)
            ->style('square')
            ->errorCorrection('H')
            ->backgroundColor(255, 255, 255) // Warna putih (RGB)
            ->color(0, 0, 0) // Warna QR hitam (default)
            ->generate($participant->qr_code);

        return response($qrContent)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function sendMassEmail()
    {
        // ini_set('max_execution_time', 500); // 300 detik = 5 menit

        // $pesertas = Peserta::all();

        // foreach ($pesertas as $peserta) {
        //     if ($peserta->email) {
        //         // 1️⃣ Generate QR code untuk masing-masing peserta
        //         $fileName = $peserta->qr_code . '.png';
        //         $qrImage = QrCode::format('png')
        //             ->size(1000)
        //             ->margin(2)
        //             ->style('square')
        //             ->errorCorrection('H')
        //             ->backgroundColor(255, 255, 255) // Warna putih (RGB)
        //             ->color(0, 0, 0) // Warna QR hitam (default)
        //             ->generate($peserta->qr_code);

        //         // Simpan sementara di storage
        //         $path = 'qrcodes/' . $fileName;
        //         Storage::disk('public')->put($path, $qrImage);

        //         // 2️⃣ Kirim email menggunakan template
        //         Mail::to($peserta->email)->queue(new QrCodeMail($peserta, $path));
        //     }
        // }

        // return back()->with('success', 'Email massal berhasil dikirim ke semua peserta!');
        // ini_set('max_execution_time', 500); // 500 detik = 8 menit

        // // $pesertas = Peserta::get();
        // $pesertas = Peserta::whereIn('id', [307, 54])
        //     ->whereNotNull('email')
        //     ->get();

        // foreach ($pesertas as $peserta) {
        //     if ($peserta->email) {
        //         // Menambahkan job ke dalam queue untuk setiap peserta
        //         // SendQrCodeEmailJob::dispatch($peserta, $peserta->qr_code);
        //         dispatch(new SendQrCodeEmailJob($peserta, $peserta->qr_code));
        //     }
        // }

        // return back()->with('success', 'Email massal sedang dikirim melalui queue!');

        ini_set('max_execution_time', 500);

        $pesertas = Peserta::whereNotNull('email')
            ->where('email', '!=', '')
            ->get();

        $berhasil = 0;
        $gagal = 0;
        $detailError = [];

        foreach ($pesertas as $peserta) {
            try {
                dispatch(new SendQrCodeEmailJob(
                    $peserta,
                    $peserta->qr_code
                ));

                $berhasil++;

                Log::info('Email peserta masuk ke queue', [
                    'peserta_id' => $peserta->id,
                    'email' => $peserta->email,
                ]);
            } catch (\Throwable $e) {
                $gagal++;

                $detailError[] = "Peserta ID {$peserta->id}: {$e->getMessage()}";

                Log::error('Gagal memasukkan email peserta ke queue', [
                    'peserta_id' => $peserta->id,
                    'email' => $peserta->email,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $message = "Queue berhasil: {$berhasil}, gagal memasukkan ke queue: {$gagal}.";

        if ($detailError) {
            return back()->with('error', $message)
                ->with('detail_error', $detailError);
        }

        return back()->with('success', $message);
    }
}
