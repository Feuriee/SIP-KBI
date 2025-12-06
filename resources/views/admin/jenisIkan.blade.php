<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jenis Ikan | SIP-KBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'sipkbi-green': '#16a34a',
                        'sipkbi-dark': '#064e3b',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col justify-between fixed h-full z-50 transform transition-transform duration-300 lg:translate-x-0 -translate-x-full">
            <div class="overflow-y-auto">
                <div class="p-5 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-sipkbi-green rounded-lg flex items-center justify-center text-white font-bold">
                            KBI
                        </div>
                        <h1 class="font-bold text-lg text-sipkbi-green">SIP-KBI</h1>
                    </div>
                    <button id="close-sidebar" class="lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <nav class="mt-6 px-3">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.dashboard') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Manajemen
                            Keuangan</p>
                        <a href="{{ route('admin.keuangan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.keuangan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('admin.biaya') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.biaya') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            Biaya Operasional
                        </a>
                        <a href="{{ route('admin.pengeluaran') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.penjualan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Pengeluaran
                        </a>
                        <a href="{{ route('admin.penjualan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.penjualan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Penjualan
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Manajemen
                            Budidaya</p>
                        <a href="{{ route('admin.kolam') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.kolam') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            Kolam
                        </a>
                        <a href="{{ route('admin.ikan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.ikan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                </path>
                            </svg>
                            Jenis Ikan
                        </a>
                        <a href="{{ route('admin.pakan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Pakan
                        </a>
                        <a href="{{ route('admin.jadwal-pakan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.jadwal-pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Jadwal Pakan
                        </a>
                        <a href="{{ route('admin.panen') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.panen') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            Panen
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">SDM</p>
                        <a href="{{ route('admin.pegawai') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.pegawai') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            Pegawai
                        </a>
                        <a href="{{ route('admin.gaji') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.gaji') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Gaji Karyawan
                        </a>
                        <a href="{{ route('admin.users') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('admin.users') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Kelola User
                        </a>
                    </div>
                </nav>
            </div>

            <div class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <span class="text-sm">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12" />
                        </svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay untuk mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <div class="bg-white dark:bg-gray-800 shadow-sm p-4 flex items-center justify-between sticky top-0 z-30">
                <button id="open-sidebar" class="lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl font-bold">Data Jenis Ikan</h1>
                <div class="flex items-center space-x-3">
                    <button id="theme-toggle"
                        class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        🌞
                    </button>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">

                <!-- Top Row: Filters -->
                <div class="flex flex-wrap items-center justify-end gap-4">

                    <!-- Filter Controls (Right Group) -->
                    <div class="flex flex-wrap items-center gap-3">

                        <!-- Search Input -->
                        <input type="text" id="search-input" placeholder="Cari nama ikan atau masa panen..."
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10 w-80 focus:outline-none focus:ring-2 focus:ring-sipkbi-green bg-white dark:bg-gray-700">

                        <!-- Filter Harga -->
                        <select id="filter-harga"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10 focus:outline-none focus:ring-2 focus:ring-sipkbi-green bg-white dark:bg-gray-700">
                            <option value="">Semua Harga</option>
                            <option value="termahal">Termahal</option>
                            <option value="termurah">Termurah</option>
                        </select>

                        <!-- Filter Berat -->
                        <select id="filter-berat"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10 focus:outline-none focus:ring-2 focus:ring-sipkbi-green bg-white dark:bg-gray-700">
                            <option value="">Semua Berat</option>
                            <option value="terbesar">Terbesar</option>
                            <option value="terkecil">Terkecil</option>
                        </select>

                        <!-- Search Button -->
                        <button onclick="applyFilters()"
                            class="bg-sipkbi-green text-white px-4 h-10 rounded-lg hover:bg-sipkbi-dark transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>

                        <!-- Reset Button -->
                        <button onclick="resetFilters()"
                            class="bg-gray-500 text-white px-4 h-10 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset
                        </button>

                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden ml-6 mr-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-sipkbi-green text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Nama Ikan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Berat (kg)</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Masa Panen (Hari)</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Harga per Kg</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="divide-y divide-gray-200 dark:divide-gray-700">
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </main>
    </div>

    <script>
        // Dark Mode & Sidebar (sama seperti kolam)
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        if (toggle) {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                html.classList.add('dark');
                toggle.textContent = '🌙';
            } else {
                html.classList.remove('dark');
                toggle.textContent = '🌞';
            }

            toggle.addEventListener('click', () => {
                html.classList.toggle('dark');
                const isDark = html.classList.contains('dark');
                toggle.textContent = isDark ? '🌙' : '🌞';
                localStorage.theme = isDark ? 'dark' : 'light';
            });
        }

        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        }

        // Load Data
        async function loadJenisIkan(search = '', hargaFilter = '', beratFilter = '') {
            try {
                const params = new URLSearchParams();

                // Search parameter (untuk nama ikan atau masa panen)
                if (search) params.append('search', search);

                // Filter dan sort berdasarkan harga
                if (hargaFilter === 'termahal') {
                    params.append('sort_by', 'harga_per_kg');
                    params.append('sort_order', 'desc');
                } else if (hargaFilter === 'termurah') {
                    params.append('sort_by', 'harga_per_kg');
                    params.append('sort_order', 'asc');
                }

                // Filter dan sort berdasarkan berat
                if (beratFilter === 'terbesar') {
                    params.append('sort_by', 'berat');
                    params.append('sort_order', 'desc');
                } else if (beratFilter === 'terkecil') {
                    params.append('sort_by', 'berat');
                    params.append('sort_order', 'asc');
                }

                const queryString = params.toString();
                const url = `/api/jenis-ikan${queryString ? '?' + queryString : ''}`;

                console.log('Loading data from:', url);
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal memuat data');

                const result = await response.json();
                console.log('API Response:', result);

                const data = result.data || [];
                renderTable(data);

            } catch (error) {
                console.error('Error:', error);
                showAlert('Gagal memuat data jenis ikan', 'error');
            }
        }

        // Apply filters (triggered by Cari button)
        function applyFilters() {
            const search = document.getElementById('search-input').value.trim();
            const hargaFilter = document.getElementById('filter-harga').value;
            const beratFilter = document.getElementById('filter-berat').value;

            loadJenisIkan(search, hargaFilter, beratFilter);
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('filter-harga').value = '';
            document.getElementById('filter-berat').value = '';
            loadJenisIkan();
        }

        // Handle filter change (auto filter untuk dropdown)
        function onFilterChange() {
            const search = document.getElementById('search-input').value.trim();
            const hargaFilter = document.getElementById('filter-harga').value;
            const beratFilter = document.getElementById('filter-berat').value;

            loadJenisIkan(search, hargaFilter, beratFilter);
        }

        // Handle Harga filter change dengan reset berat filter
        function onHargaFilterChange() {
            const hargaFilter = document.getElementById('filter-harga').value;

            // Reset filter berat ke default jika filter harga dipilih
            if (hargaFilter) {
                document.getElementById('filter-berat').value = '';
            }

            // Apply filter langsung
            onFilterChange();
        }

        // Handle Berat filter change dengan reset harga filter
        function onBeratFilterChange() {
            const beratFilter = document.getElementById('filter-berat').value;

            // Reset filter harga ke default jika filter berat dipilih
            if (beratFilter) {
                document.getElementById('filter-harga').value = '';
            }

            // Apply filter langsung
            onFilterChange();
        }

        // Event listener untuk Enter key pada search input
        document.getElementById('search-input').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        // Event listeners untuk filter dropdown (auto filter)
        document.getElementById('filter-harga').addEventListener('change', onHargaFilterChange);
        document.getElementById('filter-berat').addEventListener('change', onBeratFilterChange);


        function renderTable(data) {
            const tbody = document.getElementById('table-body');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data jenis ikan
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map((item, index) => {
                const berat = item.berat ? parseFloat(item.berat).toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                }) : '0';
                const hargaPerKg = item.harga_per_kg ? parseFloat(item.harga_per_kg).toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }) : '0';

                return `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 text-sm">${index + 1}</td>
                    <td class="px-6 py-4 text-sm font-medium">${item.nama_ikan || '-'}</td>
                    <td class="px-6 py-4 text-sm">${berat} kg</td>
                    <td class="px-6 py-4 text-sm">${item.masa_panen_hari || '0'} hari</td>
                    <td class="px-6 py-4 text-sm">Rp ${hargaPerKg}</td>
                    <td class="px-6 py-4 text-sm">${item.keterangan || '-'}</td>
                </tr>
                `;
            }).join('');
        }

         function showAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';

            alertDiv.className =
                `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300`;
            alertDiv.textContent = message;

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.style.opacity = '0';
                setTimeout(() => alertDiv.remove(), 300);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadJenisIkan();
        });
    </script>
</body>

</html>
