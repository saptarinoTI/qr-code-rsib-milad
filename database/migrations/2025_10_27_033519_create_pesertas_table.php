<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
           $table->string('nama_karyawan');
            $table->string('unit');
            $table->string('qr_code');
            $table->boolean('status_hadir')->default(false);
            $table->boolean('sudah_ikut_undian')->default(false);
            $table->dateTime('waktu_absen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
