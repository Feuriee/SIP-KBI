<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'user_id', 'title', 'filename', 'file_path',
        'file_type', 'file_size', 'category', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileSizeFormattedAttribute()
    {
        $size = $this->file_size;
        if ($size < 1024) return $size . ' B';
        if ($size < 1048576) return round($size / 1024, 2) . ' KB';
        return round($size / 1048576, 2) . ' MB';
    }
}
