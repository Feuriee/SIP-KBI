<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = [
        'id_panen', 'tanggal_jual', 'pembeli', 'jumlah_kg',
        'harga_per_kg', 'total_jual', 'metode_bayar'
    ];
    protected $casts = ['tanggal_jual' => 'date'];

    public function panen()
    {
        return $this->belongsTo(Panen::class, 'id_panen');
    }
}
