<?php

// app/Http/Controllers/User/DashboardController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use App\Models\Kolam;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Keuangan
        $total_pendapatan = Keuangan::where('user_id', $user->id)
            ->where('tipe', 'pendapatan')
            ->sum('jumlah');
        $total_pengeluaran = Keuangan::where('user_id', $user->id)
            ->where('tipe', 'pengeluaran')
            ->sum('jumlah');
        $saldo = $total_pendapatan - $total_pengeluaran;

        // Kolam
        $total_kolam = Kolam::where('user_id', $user->id)->count();
        $kolam_aktif = Kolam::where('user_id', $user->id)->where('status', 'aktif')->count();
        $siap_panen = Kolam::where('user_id', $user->id)->where('status', 'panen')->count();

        // Aktivitas dummy (opsional, bisa ganti dengan log model jika ada)
        $aktivitas = collect([
            (object)['deskripsi' => 'Menambahkan transaksi pendapatan', 'created_at' => now()],
            (object)['deskripsi' => 'Mengupdate status kolam menjadi aktif', 'created_at' => now()->subDay()],
        ]);

        return view('user.dashboard', compact(
            'total_pendapatan',
            'total_pengeluaran',
            'saldo',
            'total_kolam',
            'kolam_aktif',
            'siap_panen',
            'aktivitas'
        ));
    }
}