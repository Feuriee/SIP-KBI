<!-- resources/views/admin/layout.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@yield('title','Admin | SIP-KBI')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: { 'sipkbi-green':'#16a34a','sipkbi-dark':'#064e3b' }
        }
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white-800 text-black min-h-screen relative flex flex-col">
      <div class="p-4 border-b dark:border-gray-700 flex items-center gap-2">
        <img src="{{ asset('img/logo.png') }}" class="w-8 h-8" alt="logo">
        <div class="text-lg font-bold text-sipkbi-green">SIP-KBI Admin</div>
      </div>

      <nav class="p-4">
        <ul class="space-y-1">
          <li>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.keuangan.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.keuangan.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
              <span>Data Keuangan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.kolam.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.kolam.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
              <span>Data Kolam</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.employees.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('admin.employees.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
              <span>Manage Karyawan</span>
            </a>
          </li>
        </ul>
        <!-- Profil & Logout - Bottom Sidebar -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t bg-white-800">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-9 h-9 rounded-full bg-sipkbi-green flex items-center justify-center text-black text-sm font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-black">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-sm text-red-400 hover:text-red-300 hover:bg-gray-700 px-2 py-1.5 rounded transition">
                    🚪 Logout
                </button>
            </form>
        </div>
      </nav>
    </aside>

    <!-- Main (mobile: topbar + content) -->
    <div class="flex-1 min-w-0">
      <!-- Topbar for mobile -->
      <header class="bg-white dark:bg-gray-800 shadow md:hidden">
        <div class="flex items-center justify-between p-4">
          <div class="flex items-center gap-2">
            <img src="{{ asset('img/logo.png') }}" class="w-8 h-8" alt="logo">
            <div class="font-bold text-sipkbi-green">SIP-KBI</div>
          </div>
          <div class="flex items-center gap-3">
            <span class="text-sm">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-red-600">Logout</button></form>
          </div>
        </div>
      </header>

      <!-- Page content -->
      <main class="p-4">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Optional script area -->
  @stack('scripts')
</body>
</html>
