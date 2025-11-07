<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KolamController;
use App\Http\Controllers\Api\PakanController;
use App\Http\Controllers\Api\JadwalPakanController;
use App\Http\Controllers\Api\PanenController;
use App\Http\Controllers\Api\PenjualanController;
use App\Http\Controllers\Api\PengeluaranController;
use App\Http\Controllers\Api\JenisIkanController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\GajiKaryawanController;
use App\Http\Controllers\Api\BiayaOperasionalController;
use App\Http\Controllers\Api\LaporanKeuanganController;
use App\Http\Controllers\Api\DokumenController;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('kolam', KolamController::class);
    Route::apiResource('pakan', PakanController::class);
    Route::apiResource('jadwal-pakan', JadwalPakanController::class);
    Route::apiResource('panen', PanenController::class);
    Route::apiResource('penjualan', PenjualanController::class);
    Route::apiResource('pengeluaran', PengeluaranController::class);
    Route::apiResource('jenis-ikan', JenisIkanController::class);
    Route::apiResource('pegawai', PegawaiController::class);
    Route::apiResource('gaji-karyawan', GajiKaryawanController::class);
    Route::apiResource('biaya-operasional', BiayaOperasionalController::class);
    Route::apiResource('laporan-keuangan', LaporanKeuanganController::class);
    Route::apiResource('dokumen', DokumenController::class);
});
