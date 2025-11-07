<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisIkan extends Model
{
    protected $table = 'jenis_ikan';
    protected $primaryKey = 'id_jenis';
    protected $fillable = ['nama_ikan', 'masa_panen_hari', 'harga_per_kg', 'keterangan'];

    public function panen()
    {
        return $this->hasMany(Panen::class, 'id_jenis');
    }
}
