<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPakan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pakan';

    protected $fillable = [
        'kolam_id',
        'pakan_id',
        'tanggal',
        'jumlah_kg',
        'catatan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_kg' => 'decimal:2'
    ];
    public function kolam()
    {
        return $this->belongsTo(Kolam::class, 'kolam_id');
    }

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'pakan_id');
    }

    public function getNamaKolamAttribute()
    {
        return $this->kolam ? $this->kolam->nama_kolam : null;
    }

    public function getNamaPakanAttribute()
    {
        return $this->pakan ? $this->pakan->nama_pakan : null;
    }
}
