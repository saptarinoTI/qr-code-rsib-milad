<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    // protected $table = "partisipan";
    protected $table = "copy_partisipan";
    // protected $table = "panitian_test";
    protected $fillable = [
        "nama_karyawan",
        "unit",
        "qr_code",
        "status_hadir",
        "sudah_ikut_undian",
        "waktu_absen",
    ];
}
