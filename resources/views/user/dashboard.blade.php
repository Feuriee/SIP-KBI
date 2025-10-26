@extends('layouts.user')

@section('title', 'Dashboard Karyawan | SIP-KBI')
@section('page-title', 'Dashboard')
@section('page-description', 'Aktivitas terbaru dan ringkasan keuangan & kolam Anda')

@section('content')
    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Keuangan -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pendapatan</h3>
            <p class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Pengeluaran</h3>
            <p class="text-2xl font-bold text-red-500 mt-2">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Saldo</h3>
            <p class="text-2xl font-bold {{ $saldo >= 0 ? 'text-green-600' : 'text-red-500' }} mt-2">
                Rp {{ number_format($saldo, 0, ',', '.') }}
            </p>
        </div>

        <!-- Kolam -->
        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md">
            <h3 class="text-sm text-gray-500 dark:text-gray-400">Kolam Aktif</h3>
            <p class="text-2xl font-bold text-blue-600 mt-2">{{ $kolam_aktif }} Kolam</p>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md mb-8">
        <h3 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h3>
        <ul class="space-y-3">
            @forelse($aktivitas as $item)
                <li class="flex items-start">
                    <span class="material-symbols-outlined text-sipkbi-green mr-2">circle</span>
                    <span class="text-sm">{{ $item->deskripsi }} — {{ $item->created_at->format('d M Y H:i') }}</span>
                </li>
            @empty
                <li class="text-sm text-gray-500">Tidak ada aktivitas terbaru.</li>
            @endforelse
        </ul>
    </div>
@endsection