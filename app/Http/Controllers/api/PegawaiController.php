<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Pegawai::query();

            // Filter berdasarkan search (nama atau jabatan)
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('jabatan', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan jabatan
            if ($request->has('jabatan') && $request->jabatan != '') {
                $query->where('jabatan', 'like', "%{$request->jabatan}%");
            }

            // Filter gaji (tertinggi/terendah)
            if ($request->has('filter_gaji')) {
                if ($request->filter_gaji == 'high') {
                    $query->orderBy('gaji_pokok', 'desc');
                } elseif ($request->filter_gaji == 'low') {
                    $query->orderBy('gaji_pokok', 'asc');
                }
            } else {
                $query->orderBy('tanggal_masuk', 'desc');
            }

            $pegawai = $query->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $pegawai
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading pegawai: ' . $e->getMessage());

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
                'nama' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'tanggal_masuk' => 'required|date',
                'gaji_pokok' => 'required|numeric|min:0'
            ]);

            $pegawai = Pegawai::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $pegawai
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing pegawai: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'tanggal_masuk' => 'required|date',
                'gaji_pokok' => 'required|numeric|min:0'
            ]);

            $pegawai->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $pegawai
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
            Log::error('Error updating pegawai: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();

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
            Log::error('Error deleting pegawai: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
