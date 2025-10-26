<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    \App\Models\Keuangan::insert([
        ['jenis'=>'pemasukan','nama'=>'Penjualan ikan','jumlah'=>1500000,'tanggal'=>'2025-07-01','created_at'=>now(),'updated_at'=>now()],
        ['jenis'=>'pengeluaran','nama'=>'Pakan ikan','jumlah'=>250000,'tanggal'=>'2025-07-02','created_at'=>now(),'updated_at'=>now()],
    ]);
}

}
