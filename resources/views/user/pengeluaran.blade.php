<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <a href="{{ route('user.dashboard') }}"
                        class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.dashboard') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Keuangan
                        </p>
                        <a href="{{ route('user.keuangan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.keuangan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('user.biaya') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.biaya') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            Biaya Operasional
                        </a>
                        <a href="{{ route('user.pengeluaran') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.pengeluaran') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Pengeluaran
                        </a>
                        <a href="{{ route('user.penjualan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.penjualan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Penjualan
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase px-4 mb-2">Budidaya
                        </p>
                        <a href="{{ route('user.kolam') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.kolam') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            Kolam
                        </a>
                        <a href="{{ route('user.ikan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.ikan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                </path>
                            </svg>
                            Jenis Ikan
                        </a>
                        <a href="{{ route('user.pakan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Pakan
                        </a>
                        <a href="{{ route('user.jadwal-pakan') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.jadwal-pakan') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Jadwal Pakan
                        </a>
                        <a href="{{ route('user.panen') }}"
                            class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-lg mb-1 {{ request()->routeIs('user.panen') ? 'bg-sipkbi-green text-white' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            Panen
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
            <!-- Top Bar -->
            <div class="bg-white dark:bg-gray-800 shadow-sm p-4 flex items-center justify-between sticky top-0 z-30">
                <button id="open-sidebar" class="lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-xl font-bold">Data Pengeluaran</h1>
                <div class="flex items-center space-x-3">
                    <button id="theme-toggle"
                        class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        🌞
                    </button>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6">

                <!-- Header Controls (Tambah + Search + Filter) -->
                <div class="flex justify-between flex-wrap items-center gap-4">

                    <!-- Button Tambah -->
                    <button onclick="openModal('add')"
                        class="bg-sipkbi-green hover:bg-sipkbi-dark text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span>Tambah Pengeluaran</span>
                    </button>

                    <!-- Search & Filter Controls -->
                    <div class="flex flex-wrap items-center gap-3">

                        <!-- Search Input -->
                        <input type="text" id="search-input" placeholder="Cari deskripsi atau keterangan..."
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10 w-64
                                bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sipkbi-green">

                        <!-- Filter Kategori -->
                        <select id="filter-kategori"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10
                                bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sipkbi-green">
                            <option value="">Semua Kategori</option>
                            <option value="pakan">Pakan</option>
                            <option value="perawatan">Perawatan</option>
                            <option value="operasional">Operasional</option>
                            <option value="gaji">Gaji</option>
                            <option value="lainnya">Lainnya</option>
                        </select>

                        <!-- Filter Nominal -->
                        <select id="filter-nominal"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 h-10
                                bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-sipkbi-green">
                            <option value="">Semua Nominal</option>
                            <option value="high">Tertinggi</option>
                            <option value="low">Terendah</option>
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

            <!-- Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden mr-6 ml-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-sipkbi-green text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Keterangan</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Data akan dimuat di sini -->
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Controls -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <!-- Info halaman -->
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            Menampilkan <span id="showing-start" class="font-semibold">0</span> sampai 
                            <span id="showing-end" class="font-semibold">0</span> dari 
                            <span id="total-data" class="font-semibold">0</span> data
                        </div>

                        <!-- Pagination buttons -->
                        <div class="flex space-x-2" id="pagination-controls">
                            <!-- Buttons akan di-generate di sini -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>

    <!-- Modal Form -->
    <div id="modal-root" class="fixed inset-0 z-50 hidden">
        <div id="modal-overlay" class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div id="modal" class="modal-transition modal-hidden fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 id="modal-title" class="text-2xl font-bold">Tambah Pengeluaran</h2>
                        <button id="modal-close-btn"
                            class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="pengeluaran-form" class="space-y-4">
                        <input type="hidden" id="id">

                        <div>
                            <label class="block text-sm font-medium mb-2">Tanggal</label>
                            <input type="date" id="tanggal" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Kategori</label>
                                <select id="kategori" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Pakan">Pakan</option>
                                    <option value="Perawatan">Perawatan</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Gaji">Gaji</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Jumlah (Rp)</label>
                                <input type="number" step="0.01" id="jumlah" required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Deskripsi</label>
                            <input type="text" id="deskripsi" required
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Keterangan</label>
                            <textarea id="keterangan" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:ring-2 focus:ring-sipkbi-green focus:border-transparent"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" id="modal-cancel-btn"
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-sipkbi-green hover:bg-sipkbi-dark text-white rounded-lg transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Dark Mode Toggle
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

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

            // Update charts when theme changes
            updateChartColors();
        });

        // Mobile Sidebar Toggle
        const openSidebar = document.getElementById('open-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        openSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        const modalRoot = document.getElementById('modal-root');
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modal-title');
        const modalCloseBtn = document.getElementById('modal-close-btn');
        const modalCancelBtn = document.getElementById('modal-cancel-btn');
        const modalOverlay = document.getElementById('modal-overlay');
        const pengeluaranForm = document.getElementById('pengeluaran-form');

        let isEditMode = false;

        function openModal(mode, data = null) {
            isEditMode = mode === 'edit';
            modalTitle.textContent = isEditMode ? 'Edit Pengeluaran' : 'Tambah Pengeluaran';

            if (isEditMode && data) {
                document.getElementById('id').value = data.id;
                document.getElementById('tanggal').value = data.tanggal;
                document.getElementById('kategori').value = data.kategori;
                document.getElementById('deskripsi').value = data.deskripsi;
                document.getElementById('jumlah').value = data.jumlah;
                document.getElementById('keterangan').value = data.keterangan || '';
            } else {
                pengeluaranForm.reset();
                document.getElementById('id').value = '';
            }

            modalRoot.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('modal-hidden');
                modal.classList.add('modal-visible');
            }, 10);
        }

        function closeModal() {
            modal.classList.remove('modal-visible');
            modal.classList.add('modal-hidden');
            setTimeout(() => {
                modalRoot.classList.add('hidden');
                pengeluaranForm.reset();
            }, 180);
        }

        modalCloseBtn.addEventListener('click', closeModal);
        modalCancelBtn.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', closeModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modalRoot.classList.contains('hidden')) {
                closeModal();
            }
        });

        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        }

        // Pagination State
        let currentPage = 1;
        let itemsPerPage = 10;
        let totalItems = 0;
        let allData = [];

        async function loadPengeluaran(search = '', kategori = '', nominal = '') {
            try {
                const params = new URLSearchParams();

                // Search parameter
                if (search) params.append('search', search);

                // Filter kategori
                if (kategori) params.append('kategori', kategori);

                // Filter nominal (high/low)
                if (nominal) params.append('filter_nominal', nominal);

                const queryString = params.toString();
                const url = `/api/pengeluaran${queryString ? '?' + queryString : ''}`;

                console.log('Loading data from:', url);
                const response = await fetch(url);

                if (!response.ok) throw new Error('Gagal memuat data');

                const result = await response.json();
                console.log('API Response:', result);

                allData = result.data || [];
                totalItems = allData.length;
                currentPage = 1; // Reset ke halaman 1
                
                renderPaginatedData();
            } catch (error) {
                console.error('Error:', error);
                showAlert('Gagal memuat data pengeluaran', 'error');
            }
        }

        
        // Render data dengan pagination
        function renderPaginatedData() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedData = allData.slice(startIndex, endIndex);
            
            renderTable(paginatedData, startIndex);
            updatePaginationInfo();
            renderPaginationControls();
        }

        // Update info pagination
        function updatePaginationInfo() {
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, totalItems);
            
            document.getElementById('showing-start').textContent = totalItems > 0 ? startIndex : 0;
            document.getElementById('showing-end').textContent = endIndex;
            document.getElementById('total-data').textContent = totalItems;
        }

        // Render pagination controls
        function renderPaginationControls() {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const paginationControls = document.getElementById('pagination-controls');
            
            if (totalPages <= 1) {
                paginationControls.innerHTML = '';
                return;
            }
            
            let html = '';
            
            // Previous button
            html += `
                <button onclick="changePage(${currentPage - 1})" 
                    ${currentPage === 1 ? 'disabled' : ''}
                    class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    ‹ Prev
                </button>
            `;
            
            // Page numbers
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }
            
            // First page
            if (startPage > 1) {
                html += `
                    <button onclick="changePage(1)" 
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                        1
                    </button>
                `;
                if (startPage > 2) {
                    html += `<span class="px-2 py-1 text-sm">...</span>`;
                }
            }
            
            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                html += `
                    <button onclick="changePage(${i})" 
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700 ${
                            i === currentPage ? 'bg-sipkbi-green text-white hover:bg-sipkbi-dark' : ''
                        }">
                        ${i}
                    </button>
                `;
            }
            
            // Last page
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    html += `<span class="px-2 py-1 text-sm">...</span>`;
                }
                html += `
                    <button onclick="changePage(${totalPages})" 
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                        ${totalPages}
                    </button>
                `;
            }
            
            // Next button
            html += `
                <button onclick="changePage(${currentPage + 1})" 
                    ${currentPage === totalPages ? 'disabled' : ''}
                    class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    Next ›
                </button>
            `;
            
            paginationControls.innerHTML = html;
        }

        // Change page
        function changePage(page) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            if (page < 1 || page > totalPages) return;
            
            currentPage = page;
            renderPaginatedData();
            
            // Scroll to top of table
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Render data dengan pagination
        function renderPaginatedData() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedData = allData.slice(startIndex, endIndex);
            
            renderTable(paginatedData, startIndex);
            updatePaginationInfo();
            renderPaginationControls();
        }

        // Update info pagination
        function updatePaginationInfo() {
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, totalItems);
            
            document.getElementById('showing-start').textContent = totalItems > 0 ? startIndex : 0;
            document.getElementById('showing-end').textContent = endIndex;
            document.getElementById('total-data').textContent = totalItems;
        }

        // Render pagination controls
        function renderPaginationControls() {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const paginationControls = document.getElementById('pagination-controls');
            
            if (totalPages <= 1) {
                paginationControls.innerHTML = '';
                return;
            }
            
            let html = '';
            
            // Previous button
            html += `
                <button onclick="changePage(${currentPage - 1})" 
                    ${currentPage === 1 ? 'disabled' : ''}
                    class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    ‹ Prev
                </button>
            `;
            
            // Page numbers
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }
            
            // First page
            if (startPage > 1) {
                html += `
                    <button onclick="changePage(1)" 
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                        1
                    </button>
                `;
                if (startPage > 2) {
                    html += `<span class="px-2 py-1 text-sm">...</span>`;
                }
            }
            
            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                html += `
                    <button onclick="changePage(${i})" 
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700 ${
                            i === currentPage ? 'bg-sipkbi-green text-white hover:bg-sipkbi-dark' : ''
                        }">
                        ${i}
                    </button>
                `;
            }
            
            // Last page
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    html += `<span class="px-2 py-1 text-sm">...</span>`;
                }
                html += `
                    <button onclick="changePage(${totalPages})" 
                        class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700">
                        ${totalPages}
                    </button>
                `;
            }
            
            // Next button
            html += `
                <button onclick="changePage(${currentPage + 1})" 
                    ${currentPage === totalPages ? 'disabled' : ''}
                    class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-sm hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    Next ›
                </button>
            `;
            
            paginationControls.innerHTML = html;
        }

        // Change page
        function changePage(page) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            if (page < 1 || page > totalPages) return;
            
            currentPage = page;
            renderPaginatedData();
            
            // Scroll to top of table
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Apply filters (triggered by Cari button)
        function applyFilters() {
            const search = document.getElementById('search-input').value.trim();
            const kategori = document.getElementById('filter-kategori').value;
            const nominal = document.getElementById('filter-nominal').value;

            loadPengeluaran(search, kategori, nominal);
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('filter-kategori').value = '';
            document.getElementById('filter-nominal').value = '';
            loadPengeluaran();
        }

        // Auto filter ketika dropdown berubah
        function onFilterChange() {
            const search = document.getElementById('search-input').value.trim();
            const kategori = document.getElementById('filter-kategori').value;
            const nominal = document.getElementById('filter-nominal').value;

            loadPengeluaran(search, kategori, nominal);
        }

        // Event listener untuk Enter key pada search input
        document.getElementById('search-input').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        // Event listeners untuk filter dropdown (auto filter)
        document.getElementById('filter-kategori').addEventListener('change', onFilterChange);
        document.getElementById('filter-nominal').addEventListener('change', onFilterChange);

        function renderTable(data, startIndex = 0) {
            const tbody = document.getElementById('table-body');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data pengeluaran
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map((item, index) => `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 text-sm">${startIndex + index + 1}</td>
                    <td class="px-6 py-4 text-sm">${new Date(item.tanggal).toLocaleDateString('id-ID')}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800 dark:bg-orange-800 dark:text-orange-100">
                            ${item.kategori}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">${item.deskripsi}</td>
                    <td class="px-6 py-4 text-sm font-semibold text-red-600">Rp ${parseFloat(item.jumlah).toLocaleString('id-ID')}</td>
                    <td class="px-6 py-4 text-sm">${item.keterangan || '-'}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <button onclick='editPengeluaran(${JSON.stringify(item)})' class="text-blue-600 hover:text-blue-800" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deletePengeluaran(${item.id})" class="text-red-600 hover:text-red-800" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        pengeluaranForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = {
                tanggal: document.getElementById('tanggal').value,
                kategori: document.getElementById('kategori').value,
                deskripsi: document.getElementById('deskripsi').value,
                jumlah: document.getElementById('jumlah').value,
                keterangan: document.getElementById('keterangan').value
            };

            try {
                let url = '/api/pengeluaran';
                let method = 'POST';

                if (isEditMode) {
                    const id = document.getElementById('id').value;
                    url = `/api/pengeluaran/${id}`;
                    method = 'PUT';
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menyimpan data');
                }

                showAlert(result.message || 'Data berhasil disimpan', 'success');
                closeModal();
                loadPengeluaran();
            } catch (error) {
                console.error('Error:', error);
                showAlert(error.message || 'Gagal menyimpan data', 'error');
            }
        });

        function editPengeluaran(data) {
            openModal('edit', data);
        }

        async function deletePengeluaran(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus data pengeluaran ini?')) {
                return;
            }

            try {
                const response = await fetch(`/api/pengeluaran/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken()
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menghapus data');
                }

                showAlert(result.message || 'Data berhasil dihapus', 'success');
                loadPengeluaran();
            } catch (error) {
                console.error('Error:', error);
                showAlert(error.message || 'Gagal menghapus data', 'error');
            }
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
            loadPengeluaran();
        });
    </script>
</body>

</html>