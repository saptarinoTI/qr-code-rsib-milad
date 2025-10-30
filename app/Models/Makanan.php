<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $fillable = [
        "peserta_id",
        "rebusan_pagi",
        "snack",
        "pulang_nasi",
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
