<?php

namespace App\Http\Controllers\Dokumen;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    public function index()
    {
        $documents = Dokumen::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = Dokumen::where('user_id', auth()->id())
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('user.dokumen.index', compact('documents', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,gif,zip,rar', // 10MB
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ], [
            'title.required' => 'Judul dokumen wajib diisi',
            'file.required' => 'File wajib dipilih',
            'file.max' => 'Ukuran file maksimal 10MB',
            'file.mimes' => 'Format file tidak didukung',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('documents', $filename, 'public');

        Dokumen::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'filename' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('user.dokumen.index')
            ->with('success', 'Dokumen berhasil diunggah!');
    }

    public function download(Dokumen $dokumen)
    {
        // Cek apakah dokumen milik user yang login
        if ($dokumen->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke dokumen ini');
        }

        // Cek apakah file ada
        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            return redirect()->route('user.dokumen.index')
                ->with('error', 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($dokumen->file_path, $dokumen->filename);
    }

    public function destroy(Dokumen $dokumen)
    {
        // Cek apakah dokumen milik user yang login
        if ($dokumen->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke dokumen ini');
        }

        // Hapus file dari storage
        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        // Hapus record dari database
        $dokumen->delete();

        return redirect()->route('user.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
