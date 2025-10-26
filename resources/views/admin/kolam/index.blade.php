@extends('admin.layout')

@section('title', 'Data Kolam | SIP-KBI')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold text-sipkbi-green">🐟 Data Kolam</h1>
    <a href="{{ route('admin.kolam.create') }}" class="bg-sipkbi-green text-white px-4 py-2 rounded hover:bg-green-600">+ Tambah Kolam</a>
</div>

<div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
    <table class="w-full border-collapse">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left">Nama Kolam</th>
                <th class="px-4 py-2 text-left">Lokasi</th>
                <th class="px-4 py-2 text-right">Kapasitas</th>
                <th class="px-4 py-2 text-right">Jumlah Ikan</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kolams as $kolam)
            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-4 py-2">{{ $kolam->nama }}</td>
                <td class="px-4 py-2">{{ $kolam->lokasi ?? '-' }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($kolam->kapasitas) }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($kolam->jumlah_ikan) }}</td>
                <td class="px-4 py-2">{{ ucfirst($kolam->status ?? 'tidak diketahui') }}</td>
                <td class="px-4 py-2 text-center">
                    <a href="{{ route('admin.kolam.edit', $kolam->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                    <form action="{{ route('admin.kolam.destroy', $kolam->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Hapus kolam ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data kolam</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
