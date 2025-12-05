<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PakanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Pakan::query();

            // Fitur search berdasarkan nama pakan, jenis pakan, atau supplier
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_pakan', 'like', "%{$search}%")
                      ->orWhere('jenis_pakan', 'like', "%{$search}%")
                      ->orWhere('supplier', 'like', "%{$search}%");
                });
            }

            // Filter berdasarkan jenis pakan
            if ($request->has('jenis_pakan') && !empty($request->jenis_pakan)) {
                $query->where('jenis_pakan', $request->jenis_pakan);
            }

            // Filter berdasarkan supplier
            if ($request->has('supplier') && !empty($request->supplier)) {
                $query->where('supplier', $request->supplier);
            }

            // Filter berdasarkan range harga
            if ($request->has('harga_min') && !empty($request->harga_min)) {
                $query->where('harga_per_kg', '>=', $request->harga_min);
            }
            if ($request->has('harga_max') && !empty($request->harga_max)) {
                $query->where('harga_per_kg', '<=', $request->harga_max);
            }

            // Filter berdasarkan stok
            if ($request->has('stok_min') && !empty($request->stok_min)) {
                $query->where('stok_kg', '>=', $request->stok_min);
            }

            // Sorting/ordering
            $sortBy = $request->input('sort_by', 'id'); // default: id
            $sortOrder = $request->input('sort_order', 'desc'); // default: descending

            // Validasi sort_by untuk keamanan
            $allowedSortFields = ['id', 'nama_pakan', 'harga_per_kg', 'stok_kg', 'created_at'];
            if (!in_array($sortBy, $allowedSortFields)) {
                $sortBy = 'id';
            }

            // Validasi sort_order
            $sortOrder = in_array(strtolower($sortOrder), ['asc', 'desc']) ? strtolower($sortOrder) : 'desc';

            $pakan = $query->orderBy($sortBy, $sortOrder)->get();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dimuat',
                'data' => $pakan,
                'total' => $pakan->count(),
                'filters' => [
                    'search' => $request->search,
                    'jenis_pakan' => $request->jenis_pakan,
                    'supplier' => $request->supplier,
                    'sort_by' => $sortBy,
                    'sort_order' => $sortOrder
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading pakan: ' . $e->getMessage());

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
                'nama_pakan' => 'required|string|max:255',
                'jenis_pakan' => 'required|string|max:255',
                'harga_per_kg' => 'required|numeric|min:0',
                'stok_kg' => 'required|numeric|min:0',
                'supplier' => 'required|string|max:255'
            ]);

            $pakan = Pakan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $pakan
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error storing pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pakan = Pakan::findOrFail($id);

            $validated = $request->validate([
                'nama_pakan' => 'required|string|max:255',
                'jenis_pakan' => 'required|string|max:255',
                'harga_per_kg' => 'required|numeric|min:0',
                'stok_kg' => 'required|numeric|min:0',
                'supplier' => 'required|string|max:255'
            ]);

            $pakan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'data' => $pakan
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
            Log::error('Error updating pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pakan = Pakan::findOrFail($id);
            $pakan->delete();

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
            Log::error('Error deleting pakan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}
