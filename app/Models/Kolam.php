<?php

// app/Models/Kolam.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kolam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'jenis_ikan',
        'status',
        'deskripsi',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}