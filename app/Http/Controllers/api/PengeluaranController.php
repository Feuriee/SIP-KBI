<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Pengeluaran::query();

            // Filter berdasarkan search (deskripsi atau keterangan)
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('deskripsi', 'like', "%{$search}%")
                      ->orWhere('keterangan', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan kategori
            if ($request->has('kategori') && $request->kategori != '') {
                $query->where('kategori', $request->kategori);
            }

            // Filter berdasarkan tanggal (bulan tertentu)
            if ($request->has('bulan') && $request->bulan != '') {
                $bulan = $request->bulan;
                $query->whereMonth('tanggal', $bulan);
            }

            // Filter berdasarkan tahun
            if ($request->has('tahun') && $request->tahun != '') {
                $query->whereYear('tanggal', $request->tahun);
            }

            // Filter nominal (tertinggi/terendah)
            if ($request->has('filter_nominal')) {
                if ($request->filter_nominal == 'high') {
                    $query->orderBy('jumlah', 'desc');
                } elseif ($request->filter_nominal == 'low') {
                    $query->orderBy('jumlah', 'asc');
                }
            } else {
                $query->orderBy('tanggal', 'desc');
            }

            $pengeluaran = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $pengeluaran
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading pengeluaran: ' . $e->getMessage());

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
                'tanggal' => 'required|date',
                'kategori' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
                'jumlah' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            $pengeluaran = Pengeluaran::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $pengeluaran
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing pengeluaran: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);

            $validated = $request->validate([
                'tanggal' => 'required|date',
                'kategori' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
                'jumlah' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            $pengeluaran->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $pengeluaran
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
            Log::error('Error updating pengeluaran: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);
            $pengeluaran->delete();

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
            Log::error('Error deleting pengeluaran: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
