<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiayaOperasional extends Model
{
    protected $table = 'biaya_operasional';
    protected $primaryKey = 'id_biaya';
    protected $fillable = ['bulan', 'listrik', 'air', 'transportasi', 'lainnya', 'total_biaya'];
    protected $casts = ['bulan' => 'date'];
}
