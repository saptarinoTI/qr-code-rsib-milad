<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PesertaController extends Controller
{
    public function index()
    {
        $datas = Peserta::get();
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
}
