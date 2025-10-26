@extends('layouts.user')

@section('title', 'Kelola Kolam | SIP-KBI')
@section('page-title', 'Kelola Budidaya')
@section('page-description', 'Kelola kolam dan aktivitas budidaya Anda')

@section('content')
    <!-- Ringkasan Kolam -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Kolam</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $total_kolam }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Kolam Aktif</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $kolam_aktif }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Siap Panen</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $siap_panen }}</p>
        </div>
    </div>

    <!-- Daftar Kolam -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-semibold mb-4">Daftar Kolam</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($kolam_list as $k)
                <div class="border rounded-lg p-4 dark:border-gray-700">
                    <h4 class="font-bold text-lg">{{ $k->nama }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Jenis: {{ $k->jenis_ikan }}</p>
                    <p class="text-sm">Status: <span class="font-medium {{ $k->status == 'aktif' ? 'text-green-600' : ($k->status == 'panen' ? 'text-yellow-600' : 'text-gray-500') }}">{{ ucfirst($k->status) }}</span></p>
                    <p class="text-sm">Dibuat: {{ $k->created_at->format('d M Y') }}</p>
                    <div class="mt-3 flex space-x-2">
                        <a href="{{ route('user.kolam.show', $k->id) }}" class="text-sm text-sipkbi-green hover:underline">Detail</a>
                        <a href="{{ route('user.kolam.edit', $k->id) }}" class="text-sm text-blue-500 hover:underline">Edit</a>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">Belum ada kolam.</p>
            @endforelse
        </div>
    </div>
@endsection