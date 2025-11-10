<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
    // Ambil data ringkasan untuk dashboard
    $totalPanen = DB::table('panen')->sum('berat_total_kg');
    $totalPenjualan = DB::table('penjualan')->sum('total_jual');
    $totalPendapatan = DB::table('laporan_keuangan')->sum('total_pendapatan');
    $totalPengeluaran = DB::table('laporan_keuangan')->sum('total_pengeluaran');
    $labaBersih = DB::table('laporan_keuangan')->sum('laba_bersih');

    return view('admin.dashboard', compact('totalPanen','totalPenjualan','totalPendapatan','totalPengeluaran','labaBersih'));
    }

    public function getChartData(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $data = DB::table('laporan_keuangan')
            ->selectRaw('DATE(bulan) as bulan, 
                        SUM(total_pendapatan) as pendapatan, 
                        SUM(total_pengeluaran) as pengeluaran, 
                        SUM(laba_bersih) as laba')
            ->whereYear('bulan', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return response()->json($data);
    }

    public function getPanenChart(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $data = DB::table('panen')
            ->selectRaw('DATE(tanggal_panen) as bulan, SUM(berat_total_kg) as total_panen')
            ->whereYear('tanggal_panen', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return response()->json($data);
    }
}
