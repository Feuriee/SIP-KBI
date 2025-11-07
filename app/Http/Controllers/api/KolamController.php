<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kolam;

class KolamController extends Controller
{

    public function index()
    {
        $kolam = Kolam::orderBy('id', 'desc')->get();
        return response()->json($kolam);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kolam' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'luas_m2' => 'nullable|numeric',
            'kapasitas_ikan' => 'nullable|integer',
            'status' => 'required|string|in:aktif,tidak aktif',
        ]);

        $kolam = Kolam::create($validated);

        return response()->json([
            'message' => 'Kolam berhasil ditambahkan',
            'data' => $kolam
        ], 201);
    }

    public function show($id)
    {
        $kolam = Kolam::findOrFail($id);
        return response()->json($kolam);
    }

    public function update(Request $request, $id)
    {
        $kolam = Kolam::findOrFail($id);

        $validated = $request->validate([
            'nama_kolam' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'luas_m2' => 'nullable|numeric',
            'kapasitas_ikan' => 'nullable|integer',
            'status' => 'required|string|in:aktif,tidak aktif',
        ]);

        $kolam->update($validated);

        return response()->json([
            'message' => 'Kolam berhasil diperbarui',
            'data' => $kolam
        ]);
    }
    public function destroy($id)
    {
        $kolam = Kolam::findOrFail($id);
        $kolam->delete();

        return response()->json(['message' => 'Kolam berhasil dihapus']);
    }
}
