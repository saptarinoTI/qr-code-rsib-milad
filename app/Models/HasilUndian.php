<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUndian extends Model
{
    protected $fillable = [
        "peserta_id",
        "status"
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
