<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisIkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JenisIkanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = JenisIkan::query();

            // Fitur search dengan grouping WHERE
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_ikan', 'like', "%{$search}%")
                      ->orWhere('keterangan', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan range berat
            if ($request->has('berat_min') && !empty($request->berat_min)) {
                $query->where('berat', '>=', $request->berat_min);
            }
            if ($request->has('berat_max') && !empty($request->berat_max)) {
                $query->where('berat', '<=', $request->berat_max);
            }

            // Filter berdasarkan range harga
            if ($request->has('harga_min') && !empty($request->harga_min)) {
                $query->where('harga_per_kg', '>=', $request->harga_min);
            }
            if ($request->has('harga_max') && !empty($request->harga_max)) {
                $query->where('harga_per_kg', '<=', $request->harga_max);
            }

            // Filter berdasarkan range masa panen
            if ($request->has('masa_panen_min') && !empty($request->masa_panen_min)) {
                $query->where('masa_panen_hari', '>=', $request->masa_panen_min);
            }
            if ($request->has('masa_panen_max') && !empty($request->masa_panen_max)) {
                $query->where('masa_panen_hari', '<=', $request->masa_panen_max);
            }

            // Sorting/ordering
            $sortBy = $request->input('sort_by', 'id'); // default: id
            $sortOrder = $request->input('sort_order', 'desc'); // default: descending

            // Validasi sort_by untuk keamanan
            $allowedSortFields = ['id', 'nama_ikan', 'berat', 'masa_panen_hari', 'harga_per_kg', 'created_at'];
            if (!in_array($sortBy, $allowedSortFields)) {
                $sortBy = 'id';
            }

            // Validasi sort_order
            $sortOrder = in_array(strtolower($sortOrder), ['asc', 'desc']) ? strtolower($sortOrder) : 'desc';

            $jenisIkan = $query->orderBy($sortBy, $sortOrder)->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $jenisIkan,
                'total' => $jenisIkan->count(),
                'filters' => [
                    'search' => $request->search,
                    'sort_by' => $sortBy,
                    'sort_order' => $sortOrder
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading jenis ikan: ' . $e->getMessage());

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
                'nama_ikan' => 'required|string|max:255',
                'berat' => 'required|numeric|min:0',
                'masa_panen_hari' => 'required|integer|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            $jenisIkan = JenisIkan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $jenisIkan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing jenis ikan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $jenisIkan = JenisIkan::findOrFail($id);

            $validated = $request->validate([
                'nama_ikan' => 'required|string|max:255',
                'berat' => 'required|numeric|min:0',
                'masa_panen_hari' => 'required|integer|min:0',
                'harga_per_kg' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string'
            ]);

            $jenisIkan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $jenisIkan
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
            Log::error('Error updating jenis ikan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jenisIkan = JenisIkan::findOrFail($id);
            $jenisIkan->delete();

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
            Log::error('Error deleting jenis ikan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
