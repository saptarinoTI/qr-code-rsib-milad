<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryMakananController;
use App\Http\Controllers\HistoryUndianController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HsitoryScanController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\UndanganController;
use App\Http\Controllers\UndianController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('login');
    Route::post('/', [HomeController::class, 'login'])->name('login.post');
});


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Data Peserta */
    Route::get('peserta/qrgenerate/{id}', [PesertaController::class, 'generate'])->name('peserta.qrgenerate');
    Route::put('peserta/verif/{id}', [PesertaController::class, 'verif'])->name('peserta.verif');
    Route::post('peserta/sendmass', [PesertaController::class, 'sendMassEmail'])->name('peserta.sendmass');
    Route::resource('peserta', PesertaController::class)->except('show');
    /* Scan Kehadiran */
    Route::resource('undangan', UndanganController::class)->except('show', 'create', 'edit', 'update', 'destory');
    /* Scan Makanan */
    Route::resource('makanan', MakananController::class)->except('show', 'create', 'edit', 'update', 'destory');
    /* Doorprize */
    Route::post('doorprize/updatee/{id}', [UndianController::class, 'updatee']);
    Route::resource('doorprize', UndianController::class)->except('show', 'update', 'create', 'edit', 'destory');
    /* History Scan  */
    Route::resource('history-scan', HsitoryScanController::class)->except('show', 'create', 'store', 'edit', 'destory');
    /* History Scan Makanan  */
    Route::get('history-scan-makanan', [HistoryMakananController::class, 'index'])->name('history-scan-makanan.index');
    Route::get('history-scan-makanan/{id}', [HistoryMakananController::class, 'edit'])->name('history-scan-makanan.edit');
    Route::put('history-scan-makanan/{id}', [HistoryMakananController::class, 'update'])->name('history-scan-makanan.put');
    /* History Doorprize  */
    Route::resource('history-doorprize', HistoryUndianController::class)->except('show', 'update', 'create', 'store', 'edit', 'destory');
    /* Data Pengguna */
    Route::resource('pengguna', PenggunaController::class)->except('show');

    Route::post('logout', [HomeController::class, 'logout'])->name('logout');
});
