<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPakan extends Model
{
    protected $table = 'jadwal_pakan';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = ['id_kolam', 'id_pakan', 'tanggal', 'jumlah_kg', 'catatan'];
    protected $casts = ['tanggal' => 'date'];

    public function kolam()
    {
        return $this->belongsTo(Kolam::class, 'id_kolam');
    }

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'id_pakan');
    }
}
