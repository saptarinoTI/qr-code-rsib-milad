<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $datas = User::get();
        return view("app.pengguna.index", compact("datas"));
    }

    public function create()
    {
        return view("app.pengguna.create");
    }

    public function store(PenggunaRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            User::create($data);
            DB::commit();
            return to_route('pengguna.index')->with([
                'message' => 'Sukses data berhasil disimpan.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('pengguna.index')->with([
                'message' => 'Maaf data gagal disimpan.',
                'type' => 'error'
            ]);
        }
    }

    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return view('app.pengguna.edit', compact('data'));
    }

    public function update(PenggunaRequest $request, string $id)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            DB::commit();
            return to_route('pengguna.index')->with([
                'message' => 'Sukses data berhasil disimpan.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('pengguna.index')->with([
                'message' => 'Maaf data gagal disimpan.',
                'type' => 'error'
            ]);
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $data = User::findOrFail($id);
            $data->delete();
            DB::commit();
            return to_route('pengguna.index')->with([
                'message' => 'Sukses data berhasil dihapus.',
                'type' => 'success'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('pengguna.index')->with([
                'message' => 'Maaf data gagal dihapus.',
                'type' => 'error'
            ]);
        }
    }
}
