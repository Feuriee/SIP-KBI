<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = LaporanKeuangan::query();

            // Filter berdasarkan bulan (exact match atau partial)
            if ($request->has('bulan') && !empty($request->bulan)) {
                $bulanFilter = $request->bulan;

                // Jika format bulan adalah MM (2 digit), cari semua tahun dengan bulan tersebut
                if (strlen($bulanFilter) === 2) {
                    $query->whereRaw('MONTH(bulan) = ?', [$bulanFilter]);
                }
                // Jika format YYYY-MM, cari exact match
                else {
                    $query->whereRaw('DATE_FORMAT(bulan, "%Y-%m") = ?', [$bulanFilter]);
                }
            }

            // Search berdasarkan bulan atau tahun (text search)
            if ($request->has('search') && !empty($request->search)) {
                $searchTerm = $request->search;

                // Array nama bulan dalam bahasa Indonesia
                $bulanIndo = [
                    'januari' => '01', 'februari' => '02', 'maret' => '03',
                    'april' => '04', 'mei' => '05', 'juni' => '06',
                    'juli' => '07', 'agustus' => '08', 'september' => '09',
                    'oktober' => '10', 'november' => '11', 'desember' => '12'
                ];

                // Cek apakah search adalah nama bulan
                $searchLower = strtolower($searchTerm);
                $bulanNumber = null;

                foreach ($bulanIndo as $namaBulan => $nomorBulan) {
                    if (strpos($namaBulan, $searchLower) === 0) {
                        $bulanNumber = $nomorBulan;
                        break;
                    }
                }

                if ($bulanNumber) {
                    // Jika search adalah nama bulan, cari berdasarkan bulan
                    $query->whereRaw('MONTH(bulan) = ?', [$bulanNumber]);
                } elseif (is_numeric($searchTerm) && strlen($searchTerm) === 4) {
                    // Jika search adalah tahun (4 digit)
                    $query->whereRaw('YEAR(bulan) = ?', [$searchTerm]);
                } elseif (is_numeric($searchTerm) && strlen($searchTerm) <= 2) {
                    // Jika search adalah bulan (1-2 digit)
                    $query->whereRaw('MONTH(bulan) = ?', [$searchTerm]);
                } else {
                    // Search di catatan jika bukan bulan/tahun
                    $query->where('catatan', 'like', '%' . $searchTerm . '%');
                }
            }

            // Variable untuk track apakah ada sorting
            $hasSorting = false;

            // Filter berdasarkan laba (untung/rugi/tertinggi/terendah)
            if ($request->has('filter_laba') && !empty($request->filter_laba)) {
                $filterLaba = $request->filter_laba;

                switch ($filterLaba) {
                    case 'tertinggi':
                        $query->orderBy('laba_bersih', 'desc');
                        $hasSorting = true;
                        break;

                    case 'terendah':
                        $query->orderBy('laba_bersih', 'asc');
                        $hasSorting = true;
                        break;

                    case 'untung':
                        $query->where('laba_bersih', '>=', 0);
                        break;

                    case 'rugi':
                        $query->where('laba_bersih', '<', 0);
                        break;
                }
            }

            // Jika tidak ada sorting khusus, urutkan berdasarkan bulan terbaru
            if (!$hasSorting) {
                $query->orderBy('bulan', 'desc');
            }

            $laporanKeuangan = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $laporanKeuangan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'bulan' => 'required|date',
                'total_pendapatan' => 'required|numeric|min:0',
                'total_pengeluaran' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            // Hitung laba bersih otomatis
            $validated['laba_bersih'] = $validated['total_pendapatan'] - $validated['total_pengeluaran'];

            $laporanKeuangan = LaporanKeuangan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $laporanKeuangan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $laporanKeuangan = LaporanKeuangan::findOrFail($id);

            $validated = $request->validate([
                'bulan' => 'required|date',
                'total_pendapatan' => 'required|numeric|min:0',
                'total_pengeluaran' => 'required|numeric|min:0',
                'catatan' => 'nullable|string'
            ]);

            // Hitung laba bersih otomatis
            $validated['laba_bersih'] = $validated['total_pendapatan'] - $validated['total_pengeluaran'];

            $laporanKeuangan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $laporanKeuangan
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error updating laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $laporanKeuangan = LaporanKeuangan::findOrFail($id);
            $laporanKeuangan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error deleting laporan keuangan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
