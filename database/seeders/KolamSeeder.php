<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KolamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    \App\Models\Kolam::insert([
        ['nama'=>'Kolam A','lokasi'=>'Blok 1','kapasitas'=>1000,'jumlah_ikan'=>120,'status'=>'aktif','created_at'=>now(),'updated_at'=>now()],
        ['nama'=>'Kolam B','lokasi'=>'Blok 2','kapasitas'=>800,'jumlah_ikan'=>0,'status'=>'kosong','created_at'=>now(),'updated_at'=>now()],
    ]);
}

}
