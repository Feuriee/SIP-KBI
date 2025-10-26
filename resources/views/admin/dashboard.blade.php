<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layout')

@section('title', 'Dashboard - SIP-KBI')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dashboard Admin</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Selamat datang, <strong>{{ auth()->user()->name }}</strong></p>
        </div>

        <!-- Controls: search + month filter -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <div class="flex items-center gap-2">
                <input id="searchInput" type="text" placeholder="Cari nama / keterangan / lokasi..." class="px-3 py-2 border rounded-md bg-white dark:bg-gray-800" />
                <button id="btnSearch" class="px-3 py-2 bg-sipkbi-green text-white rounded-md">Cari</button>
                <button id="btnClear" class="px-3 py-2 border rounded-md">Reset</button>
            </div>

            <div class="flex items-center gap-2">
                <label for="monthSelect" class="text-sm text-gray-600 dark:text-gray-300">Filter Bulan:</label>
                <select id="monthSelect" class="px-3 py-2 border rounded-md bg-white dark:bg-gray-800">
                    <option value="">Semua (12 bulan terakhir)</option>
                    @php
                        $now = \Carbon\Carbon::now();
                        for ($i = 0; $i < 12; $i++) {
                            $dt = $now->copy()->subMonths($i);
                            $val = $dt->format('Y-m');
                            $label = $dt->format('M Y');
                            echo "<option value=\"{$val}\">{$label}</option>";
                        }
                    @endphp
                </select>
            </div>
        </div>

        <!-- Statistik cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <p class="text-sm text-gray-500">Total Pemasukan</p>
                <p class="mt-2 text-2xl font-bold text-green-600">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <p class="text-sm text-gray-500">Total Pengeluaran</p>
                <p class="mt-2 text-2xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <p class="text-sm text-gray-500">Saldo</p>
                <p class="mt-2 text-2xl font-bold text-sipkbi-green">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Grafik Keuangan</h3>
                    <small class="text-sm text-gray-500">Pemasukan vs Pengeluaran</small>
                </div>
                <canvas id="keuanganChart" height="150"></canvas>
            </div>

            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Grafik Kolam</h3>
                    <small class="text-sm text-gray-500">Jumlah ikan (per periode)</small>
                </div>
                <canvas id="kolamChart" height="150"></canvas>
            </div>
        </div>

        <!-- Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kolam Table -->
            <section class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Data Kolam</h3>
                    <div class="text-sm text-gray-500">Jumlah kolam: <span id="jumlahKolam" class="font-semibold">{{ $jumlahKolam }}</span></div>
                </div>

                <div id="kolamTableWrap" class="overflow-x-auto">
                    <table id="kolamTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Kapasitas</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Jumlah Ikan</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody id="kolamTbody" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($kolams as $kolam)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $kolam->nama }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $kolam->lokasi }}</td>
                                    <td class="px-4 py-2 text-sm text-right">{{ number_format($kolam->kapasitas) }}</td>
                                    <td class="px-4 py-2 text-sm text-right">{{ number_format($kolam->jumlah_ikan) }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        <span class="px-2 py-1 rounded text-xs {{ $kolam->status == 'aktif' ? 'bg-green-100 text-green-800' : ($kolam->status=='kosong' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($kolam->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada data kolam.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Keuangan Table -->
            <section class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Data Keuangan</h3>
                    <div class="text-sm text-gray-500">Total ikan: <span id="jumlahIkan" class="font-semibold">{{ $jumlahIkan }}</span></div>
                </div>

                <div id="keuanganTableWrap" class="overflow-x-auto">
                    <table id="keuanganTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="keuanganTbody" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($keuangans as $k)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $k->tanggal ? $k->tanggal->format('d/m/Y') : $k->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $k->nama }}</td>
                                    <td class="px-4 py-2 text-sm">{{ ucfirst($k->jenis) }}</td>
                                    <td class="px-4 py-2 text-sm text-right">Rp {{ number_format($k->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada data keuangan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initial chart data from server (blade)
    const initialChart = {!! json_encode($chartData) !!};

    // Chart instances
    let keuanganChart = null;
    let kolamChart = null;

    function initCharts(data) {
        if (keuanganChart) keuanganChart.destroy();
        if (kolamChart) kolamChart.destroy();

        const ctxK = document.getElementById('keuanganChart').getContext('2d');
        keuanganChart = new Chart(ctxK, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: data.keuangan.pemasukan,
                        borderWidth: 2,
                        fill: false,
                        borderColor: '#16a34a',
                        tension: 0.3
                    },
                    {
                        label: 'Pengeluaran',
                        data: data.keuangan.pengeluaran,
                        borderWidth: 2,
                        fill: false,
                        borderColor: '#ef4444',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        const ctxKol = document.getElementById('kolamChart').getContext('2d');
        kolamChart = new Chart(ctxKol, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Jumlah Ikan',
                    data: data.kolam,
                    borderWidth: 0,
                    backgroundColor: '#0ea5a0'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>"'`=\/]/g, s => ({
            '&': '&amp;',
            '<': '<',
            '>': '>',
            '"': '&quot;',
            "'": '&#39;',
            '/': '&#x2F;',
            '`': '&#x60;',
            '=': '&#x3D;'
        })[s]);
    }

    function renderKeuanganRows(rows) {
        if (!Array.isArray(rows) || rows.length === 0) {
            return '<tr><td colspan="4" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada data keuangan.</td></tr>';
        }
        return rows.map(r => {
            const tanggal = r.tanggal ? new Date(r.tanggal).toLocaleDateString('id-ID') : new Date(r.created_at).toLocaleDateString('id-ID');
            const jumlah = Number(r.jumlah).toLocaleString('id-ID');
            const jenis = (r.jenis || '').charAt(0).toUpperCase() + (r.jenis || '').slice(1);
            return `<tr>
                <td class="px-4 py-2 text-sm">${tanggal}</td>
                <td class="px-4 py-2 text-sm">${escapeHtml(r.nama ?? '')}</td>
                <td class="px-4 py-2 text-sm">${jenis}</td>
                <td class="px-4 py-2 text-sm text-right">Rp ${jumlah}</td>
            </tr>`;
        }).join('');
    }

    function renderKolamRows(rows) {
        if (!Array.isArray(rows) || rows.length === 0) {
            return '<tr><td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada data kolam.</td></tr>';
        }
        return rows.map(r => {
            const kapasitas = Number(r.kapasitas ?? 0).toLocaleString('id-ID');
            const jumlahIkan = Number(r.jumlah_ikan ?? 0).toLocaleString('id-ID');
            const statusClass = r.status === 'aktif' ? 'bg-green-100 text-green-800' : (r.status === 'kosong' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
            return `<tr>
                <td class="px-4 py-2 text-sm">${escapeHtml(r.nama ?? '')}</td>
                <td class="px-4 py-2 text-sm">${escapeHtml(r.lokasi ?? '')}</td>
                <td class="px-4 py-2 text-sm text-right">${kapasitas}</td>
                <td class="px-4 py-2 text-sm text-right">${jumlahIkan}</td>
                <td class="px-4 py-2 text-sm"><span class="px-2 py-1 rounded text-xs ${statusClass}">${escapeHtml((r.status||'').charAt(0).toUpperCase() + (r.status||'').slice(1))}</span></td>
            </tr>`;
        }).join('');
    }

    async function fetchAndUpdate() {
        const q = document.getElementById('searchInput').value.trim();
        const month = document.getElementById('monthSelect').value;

        const params = new URLSearchParams();
        if (q) params.append('q', q);
        if (month) params.append('month', month);

        const url = '{{ route("admin.dashboard.data") }}' + '?' + params.toString();

        try {
            const res = await fetch(url, {
                headers: { 'Accept': 'application/json' },
                credentials: 'same-origin'
            });
            if (!res.ok) throw new Error('Network response not ok');

            const json = await res.json();

            document.getElementById('keuanganTbody').innerHTML = renderKeuanganRows(json.keuangans);
            document.getElementById('kolamTbody').innerHTML = renderKolamRows(json.kolams);

            document.getElementById('jumlahKolam').textContent = json.kolams.length;
            const totalIkan = json.kolams.reduce((s, r) => s + (Number(r.jumlah_ikan) || 0), 0);
            document.getElementById('jumlahIkan').textContent = totalIkan;

            initCharts(json.chart);
        } catch (err) {
            console.error('Fetch error', err);
            alert('Gagal memuat data. Cek console untuk detail.');
        }
    }

    document.getElementById('btnSearch').addEventListener('click', e => {
        e.preventDefault();
        fetchAndUpdate();
    });

    document.getElementById('btnClear').addEventListener('click', e => {
        e.preventDefault();
        document.getElementById('searchInput').value = '';
        document.getElementById('monthSelect').value = '';
        fetchAndUpdate();
    });

    document.getElementById('monthSelect').addEventListener('change', fetchAndUpdate);
    document.getElementById('searchInput').addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            fetchAndUpdate();
        }
    });

    // Init charts on load
    initCharts(initialChart);
</script>
@endpush