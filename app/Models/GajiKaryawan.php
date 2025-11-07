<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    protected $table = 'gaji_karyawan';
    protected $primaryKey = 'id_gaji';

    protected $fillable = [
        'id_pegawai', 'bulan', 'jumlah_gaji', 'bonus',
        'potongan', 'total_diterima', 'status_bayar'
    ];
    protected $casts = ['bulan' => 'date'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
