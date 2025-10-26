@extends('layouts.user')

@section('title', 'Kelola Keuangan | SIP-KBI')
@section('page-title', 'Kelola Keuangan')
@section('page-description', 'Pantau pendapatan dan pengeluaran harian Anda')

@section('content')
    <!-- Kartu Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pendapatan</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pengeluaran</h3>
            <p class="text-3xl font-bold text-red-500 mt-2">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Saldo</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Form Tambah Transaksi -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md mb-8">
        <h3 class="text-lg font-semibold mb-4">Tambah Transaksi Baru</h3>
        <form action="{{ route('user.keuangan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none" required>
            </div>
            <div>
                <label class="block text-sm mb-1">Tipe</label>
                <select name="tipe" class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none" required>
                    <option value="pendapatan" {{ old('tipe') == 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                    <option value="pengeluaran" {{ old('tipe') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            <div>
                <label class="block text-sm mb-1">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori') }}" placeholder="Contoh: Penjualan Ikan, Pakan..." class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none" required>
            </div>
            <div>
                <label class="block text-sm mb-1">Jumlah (Rp)</label>
                <input type="number" step="0.01" name="jumlah" value="{{ old('jumlah') }}" placeholder="0.00" class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="2" placeholder="Tambahkan detail..." class="w-full px-3 py-2 border rounded-md bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-sipkbi-green focus:outline-none">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="md:col-span-2 flex space-x-3 mt-3">
                <button type="submit" class="bg-sipkbi-green text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Simpan</button>
                <button type="reset" class="border border-gray-400 dark:border-gray-600 px-4 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition">Batal</button>
            </div>
        </form>
    </div>

    <!-- Tabel Riwayat Transaksi -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>
        <table class="w-full text-sm border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="py-2 px-3 text-left">Tanggal</th>
                    <th class="py-2 px-3 text-left">Tipe</th>
                    <th class="py-2 px-3 text-left">Kategori</th>
                    <th class="py-2 px-3 text-left">Deskripsi</th>
                    <th class="py-2 px-3 text-right">Jumlah (Rp)</th>
                    <th class="py-2 px-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                    <tr class="border-b dark:border-gray-700">
                        <td class="py-2 px-3">{{ $t->tanggal->format('d/m/Y') }}</td>
                        <td class="py-2 px-3">{{ ucfirst($t->tipe) }}</td>
                        <td class="py-2 px-3">{{ $t->kategori }}</td>
                        <td class="py-2 px-3">{{ $t->deskripsi ?? '-' }}</td>
                        <td class="py-2 px-3 text-right {{ $t->tipe == 'pendapatan' ? 'text-green-600' : 'text-red-500' }}">
                            {{ $t->tipe == 'pendapatan' ? '+' : '-' }}Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="py-2 px-3 text-center">
                            <a href="{{ route('user.keuangan.edit', $t->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('user.keuangan.destroy', $t->id) }}" method="POST" class="inline ml-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection