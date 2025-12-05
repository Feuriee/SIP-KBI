<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BiayaOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BiayaOperasionalController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = BiayaOperasional::query();

            // Search parameter (untuk bulan atau tahun)
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;

                // Ambil semua data dulu
                $allData = BiayaOperasional::all();

                // Filter di PHP
                $filteredData = $allData->filter(function($item) use ($search) {
                    $bulanDate = new \DateTime($item->bulan);
                    $tahun = $bulanDate->format('Y');
                    $bulanAngka = $bulanDate->format('m');

                    // Nama bulan dalam bahasa Indonesia
                    $namaBulan = [
                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                    ];

                    $bulanIndonesia = $namaBulan[$bulanAngka];

                    // Cek apakah search cocok dengan tahun atau nama bulan
                    return stripos($tahun, $search) !== false ||
                           stripos($bulanIndonesia, $search) !== false ||
                           stripos($item->bulan, $search) !== false;
                });

                // Convert ke array untuk sorting
                $data = $filteredData->values();

            } else {
                // Filter bulan jika ada
                if ($request->has('bulan') && !empty($request->bulan)) {
                    $bulan = $request->bulan;
                    $query->whereMonth('bulan', $bulan);
                }

                $data = $query->get();
            }

            // Sorting berdasarkan filter_biaya
            if ($request->has('filter_biaya') && !empty($request->filter_biaya)) {
                switch ($request->filter_biaya) {
                    case 'tertinggi':
                        $data = $data->sortByDesc('total_biaya')->values();
                        break;
                    case 'terendah':
                        $data = $data->sortBy('total_biaya')->values();
                        break;
                    default:
                        $data = $data->sortByDesc('bulan')->values();
                        break;
                }
            } else {
                // Default order by bulan desc
                $data = $data->sortByDesc('bulan')->values();
            }

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading biaya operasional: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'bulan' => 'required|date',
                'listrik' => 'required|numeric|min:0',
                'air' => 'required|numeric|min:0',
                'transportasi' => 'required|numeric|min:0',
                'lainnya' => 'required|numeric|min:0'
            ]);

            // Hitung total biaya otomatis
            $validated['total_biaya'] = $validated['listrik'] +
                                        $validated['air'] +
                                        $validated['transportasi'] +
                                        $validated['lainnya'];

            $biayaOperasional = BiayaOperasional::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $biayaOperasional
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing biaya operasional: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $biayaOperasional = BiayaOperasional::findOrFail($id);

            $validated = $request->validate([
                'bulan' => 'required|date',
                'listrik' => 'required|numeric|min:0',
                'air' => 'required|numeric|min:0',
                'transportasi' => 'required|numeric|min:0',
                'lainnya' => 'required|numeric|min:0'
            ]);

            // Hitung total biaya otomatis
            $validated['total_biaya'] = $validated['listrik'] +
                                        $validated['air'] +
                                        $validated['transportasi'] +
                                        $validated['lainnya'];

            $biayaOperasional->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $biayaOperasional
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
            Log::error('Error updating biaya operasional: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $biayaOperasional = BiayaOperasional::findOrFail($id);
            $biayaOperasional->delete();

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
            Log::error('Error deleting biaya operasional: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
