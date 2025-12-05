<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SIP-KBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <main class="flex-1 lg:ml-64 p-6">
            <h1 class="flex items-center justify-between text-2xl font-bold mb-6">
                Dashboard SIP-KBI
                <button id="theme-toggle"
                    class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    🌞
                </button>
            </h1>
            <!-- Ringkasan -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
                <div class="bg-blue-500 text-white rounded-lg p-4 shadow">
                    <h3 class="text-sm">Total Panen</h3>
                    <p class="text-2xl font-bold">{{ $totalPanen }}</p>
                </div>
                <div class="bg-green-500 text-white rounded-lg p-4 shadow">
                    <h3 class="text-sm">Total Penjualan</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-indigo-500 text-white rounded-lg p-4 shadow">
                    <h3 class="text-sm">Pendapatan</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
                <div class="bg-red-500 text-white rounded-lg p-4 shadow">
                    <h3 class="text-sm">Pengeluaran</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>
                <div class="bg-emerald-500 text-white rounded-lg p-4 shadow">
                    <h3 class="text-sm">Laba Bersih</h3>
                    <p class="text-2xl font-bold">Rp {{ number_format($labaBersih, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Filter Tahun -->
            <div class="mb-6 flex items-center gap-4">
                <label for="yearFilter" class="font-semibold text-gray-700 dark:text-gray-300">Pilih Tahun:</label>
                <select id="yearFilter"
                    class="p-2 border border-gray-300 dark:border-gray-600 rounded-md
                        focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-800
                        text-gray-900 dark:text-gray-100">
                    @for ($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>


            <!-- Grafik Keuangan -->
            <section class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-8">
                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Grafik Keuangan Bulanan</h2>
                <canvas id="keuanganChart" height="100"></canvas>
            </section>

            <!-- Grafik Panen -->
            <section class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Grafik Total Panen per Bulan
                </h2>
                <canvas id="panenChart" height="100"></canvas>
            </section>
        </main>
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const keuanganCtx = document.getElementById('keuanganChart').getContext('2d');
            const panenCtx = document.getElementById('panenChart').getContext('2d');

            let keuanganChart, panenChart;

            // Fungsi untuk mendapatkan warna berdasarkan tema
            const getChartColors = () => {
                const isDark = document.documentElement.classList.contains('dark');
                return {
                    textColor: isDark ? '#e5e7eb' : '#374151',
                    gridColor: isDark ? '#374151' : '#e5e7eb'
                };
            };

            // Fungsi untuk memformat angka ke Rupiah
            const formatRupiah = (angka) => {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
            };

            const fetchKeuangan = (year) => {
                fetch("{{ route('admin.dashboard.chart') }}?year=" + year)
                    .then(res => res.json())
                    .then(data => {
                        const colors = getChartColors();

                        // Gunakan bulan_label dari response
                        const labels = data.map(d => d.bulan_label || d.bulan);
                        const pendapatan = data.map(d => parseFloat(d.pendapatan) || 0);
                        const pengeluaran = data.map(d => parseFloat(d.pengeluaran) || 0);
                        const laba = data.map(d => parseFloat(d.laba) || 0);

                        // Destroy chart lama jika ada
                        if (keuanganChart) keuanganChart.destroy();

                        keuanganChart = new Chart(keuanganCtx, {
                            type: 'line',
                            data: {
                                labels,
                                datasets: [{
                                        label: 'Pendapatan',
                                        data: pendapatan,
                                        borderColor: '#16a34a',
                                        backgroundColor: 'rgba(22, 163, 74, 0.1)',
                                        borderWidth: 2,
                                        tension: 0.4,
                                        fill: true,
                                        pointRadius: 4,
                                        pointHoverRadius: 6
                                    },
                                    {
                                        label: 'Pengeluaran',
                                        data: pengeluaran,
                                        borderColor: '#dc2626',
                                        backgroundColor: 'rgba(220, 38, 38, 0.1)',
                                        borderWidth: 2,
                                        tension: 0.4,
                                        fill: true,
                                        pointRadius: 4,
                                        pointHoverRadius: 6
                                    },
                                    {
                                        label: 'Laba Bersih',
                                        data: laba,
                                        borderColor: '#2563eb',
                                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                                        borderWidth: 2,
                                        tension: 0.4,
                                        fill: true,
                                        pointRadius: 4,
                                        pointHoverRadius: 6
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                interaction: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: colors.textColor,
                                            padding: 15,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                        padding: 12,
                                        titleFont: {
                                            size: 14
                                        },
                                        bodyFont: {
                                            size: 13
                                        },
                                        callbacks: {
                                            label: function(context) {
                                                let label = context.dataset.label || '';
                                                if (label) {
                                                    label += ': ';
                                                }
                                                label += formatRupiah(context.parsed.y);
                                                return label;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: colors.textColor,
                                            font: {
                                                size: 11
                                            }
                                        },
                                        grid: {
                                            color: colors.gridColor,
                                            display: false
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            color: colors.textColor,
                                            font: {
                                                size: 11
                                            },
                                            callback: function(value) {
                                                return formatRupiah(value);
                                            }
                                        },
                                        grid: {
                                            color: colors.gridColor
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching keuangan data:', error);
                    });
            };

            const fetchPanen = (year) => {
                fetch("{{ route('admin.dashboard.panen') }}?year=" + year)
                    .then(res => res.json())
                    .then(data => {
                        const colors = getChartColors();

                        // Gunakan bulan_label dari response
                        const labels = data.map(d => d.bulan_label || d.bulan);
                        const panen = data.map(d => parseFloat(d.total_panen) || 0);

                        // Destroy chart lama jika ada
                        if (panenChart) panenChart.destroy();

                        panenChart = new Chart(panenCtx, {
                            type: 'bar',
                            data: {
                                labels,
                                datasets: [{
                                    label: 'Total Panen (kg)',
                                    data: panen,
                                    backgroundColor: 'rgba(245, 158, 11, 0.7)',
                                    borderColor: '#f59e0b',
                                    borderWidth: 2,
                                    borderRadius: 8,
                                    borderSkipped: false,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            color: colors.textColor,
                                            padding: 15,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                        padding: 12,
                                        titleFont: {
                                            size: 14
                                        },
                                        bodyFont: {
                                            size: 13
                                        },
                                        callbacks: {
                                            label: function(context) {
                                                return 'Total Panen: ' + context.parsed.y
                                                    .toFixed(2) + ' kg';
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: colors.textColor,
                                            font: {
                                                size: 11
                                            }
                                        },
                                        grid: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            color: colors.textColor,
                                            font: {
                                                size: 11
                                            },
                                            callback: function(value) {
                                                return value + ' kg';
                                            }
                                        },
                                        grid: {
                                            color: colors.gridColor
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching panen data:', error);
                    });
            };

            // Fungsi untuk update warna chart saat tema berubah
            window.updateChartColors = () => {
                const colors = getChartColors();

                if (keuanganChart) {
                    keuanganChart.options.plugins.legend.labels.color = colors.textColor;
                    keuanganChart.options.scales.x.ticks.color = colors.textColor;
                    keuanganChart.options.scales.x.grid.color = colors.gridColor;
                    keuanganChart.options.scales.y.ticks.color = colors.textColor;
                    keuanganChart.options.scales.y.grid.color = colors.gridColor;
                    keuanganChart.update();
                }

                if (panenChart) {
                    panenChart.options.plugins.legend.labels.color = colors.textColor;
                    panenChart.options.scales.x.ticks.color = colors.textColor;
                    panenChart.options.scales.y.ticks.color = colors.textColor;
                    panenChart.options.scales.y.grid.color = colors.gridColor;
                    panenChart.update();
                }
            };

            // Event listener untuk filter tahun
            const yearSelect = document.getElementById('yearFilter');
            const loadCharts = () => {
                const year = yearSelect.value;
                fetchKeuangan(year);
                fetchPanen(year);
            };

            yearSelect.addEventListener('change', loadCharts);

            // Load chart dengan tahun default
            loadCharts();
        });
    </script>

</body>

</html>
