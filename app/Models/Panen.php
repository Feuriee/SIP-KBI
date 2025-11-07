<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $table = 'panen';
    protected $primaryKey = 'id_panen';
    protected $fillable = [
        'id_kolam', 'id_jenis', 'tanggal_panen', 'berat_total_kg',
        'jumlah_ikan', 'harga_per_kg', 'total_pendapatan', 'catatan'
    ];
    protected $casts = ['tanggal_panen' => 'date'];

    public function kolam()
    {
        return $this->belongsTo(Kolam::class, 'id_kolam');
    }

    public function jenisIkan()
    {
        return $this->belongsTo(JenisIkan::class, 'id_jenis');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_panen');
    }
}
