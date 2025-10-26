@extends('admin.layout')

@section('title', 'Data Keuangan | SIP-KBI')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-sipkbi-green">💰 Data Keuangan</h1>
    <a href="{{ route('admin.keuangan.create') }}" class="bg-sipkbi-green text-white px-4 py-2 rounded hover:bg-green-600">+ Tambah Data</a>
</div>

<div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
    <table class="w-full border-collapse">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Jenis</th>
                <th class="px-4 py-2 text-right">Jumlah</th>
                <th class="px-4 py-2 text-left">Keterangan</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($keuangans as $k)
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-4 py-2">{{ $k->tanggal }}</td>
                <td class="px-4 py-2">{{ $k->nama ?? '-' }}</td>
                <td class="px-4 py-2">{{ ucfirst($k->jenis) }}</td>
                <td class="px-4 py-2 text-right">Rp {{ number_format($k->jumlah, 0, ',', '.') }}</td>
                <td class="px-4 py-2">{{ $k->keterangan ?? '-' }}</td>
                <td class="px-4 py-2 text-center">
                    <a href="{{ route('admin.keuangan.edit', $k->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                    <form action="{{ route('admin.keuangan.destroy', $k->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data keuangan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
