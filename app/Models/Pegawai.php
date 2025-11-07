<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = ['nama', 'jabatan', 'tanggal_masuk', 'gaji_pokok'];
    protected $casts = ['tanggal_masuk' => 'date'];

    public function gajiKaryawan()
    {
        return $this->hasMany(GajiKaryawan::class, 'id_pegawai');
    }
}

