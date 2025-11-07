<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    protected $table = 'laporan_keuangan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = ['bulan', 'total_pendapatan', 'total_pengeluaran', 'laba_bersih', 'catatan'];
    protected $casts = ['bulan' => 'date'];
}
