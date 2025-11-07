<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    protected $table = 'kolam';
    protected $primaryKey = 'id_kolam';
    protected $fillable = ['nama_kolam', 'lokasi', 'luas_m2', 'kapasitas_ikan', 'status'];

    public function jadwalPakan()
    {
        return $this->hasMany(JadwalPakan::class, 'id_kolam', 'id_kolam');
    }

    public function panen()
    {
        return $this->hasMany(Panen::class, 'id_kolam', 'id_kolam');
    }
}
