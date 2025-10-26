<?php

// app/Http/Controllers/User/KeuanganController.php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transaksi = Keuangan::where('user_id', $user->id)->latest()->get();

        $total_pendapatan = Keuangan::where('user_id', $user->id)->where('tipe', 'pendapatan')->sum('jumlah');
        $total_pengeluaran = Keuangan::where('user_id', $user->id)->where('tipe', 'pengeluaran')->sum('jumlah');
        $saldo = $total_pendapatan - $total_pengeluaran;

        return view('user.keuangan.index', compact('transaksi', 'total_pendapatan', 'total_pengeluaran', 'saldo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'tipe' => 'required|in:pendapatan,pengeluaran',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Keuangan::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'tipe' => $request->tipe,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('user.keuangan.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Keuangan $keuangan)
    {
        if ($keuangan->user_id !== Auth::id()) {
            abort(403);
        }
        return view('user.keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        if ($keuangan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'tipe' => 'required|in:pendapatan,pengeluaran',
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $keuangan->update($request->only(['tanggal', 'tipe', 'kategori', 'deskripsi', 'jumlah']));

        return redirect()->route('user.keuangan.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Keuangan $keuangan)
    {
        if ($keuangan->user_id !== Auth::id()) {
            abort(403);
        }
        $keuangan->delete();
        return redirect()->route('user.keuangan.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}