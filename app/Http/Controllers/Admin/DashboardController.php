<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\Kolam;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total pemasukan dan pengeluaran (pakai kolom 'tipe')
        $totalPemasukan = Keuangan::where('tipe', 'pendapatan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('tipe', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Jumlah kolam & ikan
        $kolams = Kolam::orderBy('created_at', 'desc')->take(10)->get();
        $jumlahKolam = $kolams->count();
        $jumlahIkan = $kolams->sum('kapasitas_ikan');

        // Data keuangan terbaru
        $keuangans = Keuangan::orderBy('tanggal', 'desc')->take(10)->get();

        // Statistik bulanan untuk chart
        $labels = [];
        $pemasukanSeries = [];
        $pengeluaranSeries = [];

        $now = Carbon::now();
        for ($i = 11; $i >= 0; $i--) {
            $bulan = $now->copy()->subMonths($i);
            $labels[] = $bulan->format('M Y');
            $key = $bulan->format('Y-m');

            $pemasukan = Keuangan::where('tipe', 'pendapatan')
                ->whereRaw('DATE_FORMAT(tanggal, "%Y-%m") = ?', [$key])
                ->sum('jumlah');

            $pengeluaran = Keuangan::where('tipe', 'pengeluaran')
                ->whereRaw('DATE_FORMAT(tanggal, "%Y-%m") = ?', [$key])
                ->sum('jumlah');

            $pemasukanSeries[] = $pemasukan;
            $pengeluaranSeries[] = $pengeluaran;
        }

        // Data untuk Chart.js
        $chartData = [
            'labels' => $labels,
            'keuangan' => [
                'pemasukan' => $pemasukanSeries,
                'pengeluaran' => $pengeluaranSeries,
            ],
            'kolam' => $kolams->pluck('kapasitas_ikan')->toArray(),
        ];

        return view('admin.dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldoAkhir',
            'jumlahKolam',
            'jumlahIkan',
            'keuangans',
            'kolams',
            'chartData'
        ));
    }
}
