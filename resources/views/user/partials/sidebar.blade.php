<aside class="w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col justify-between">
    <div>
        <div class="p-5 flex items-center space-x-3 border-b border-gray-200 dark:border-gray-700">
            <img src="{{ asset('images/logo-sipkbi.png') }}" class="w-10 h-10" alt="Logo SIP-KBI">
            <h1 class="font-bold text-lg text-sipkbi-green">SIP-KBI</h1>
        </div>

        <nav class="mt-6">
            <a href="{{ route('user.dashboard') }}" class="flex items-center px-6 py-3 text-sm font-medium {{ request()->routeIs('user.dashboard') ? 'bg-sipkbi-green text-white rounded-r-full' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                <span class="material-symbols-outlined mr-3">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('user.keuangan.index') }}" class="flex items-center px-6 py-3 text-sm font-medium {{ request()->routeIs('user.keuangan.*') ? 'bg-sipkbi-green text-white rounded-r-full' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                <span class="material-symbols-outlined mr-3">payments</span>
                Kelola Keuangan
            </a>
            <a href="{{ route('user.kolam.index') }}" class="flex items-center px-6 py-3 text-sm font-medium {{ request()->routeIs('user.kolam.*') ? 'bg-sipkbi-green text-white rounded-r-full' : 'hover:bg-sipkbi-green hover:text-white' }} transition">
                <span class="material-symbols-outlined mr-3">science</span>
                Kelola Budidaya
            </a>
        </nav>
    </div>

    <div class="p-5 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <button id="theme-toggle" class="px-3 py-2 border rounded-md text-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition">🌞</button>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:underline text-sm bg-transparent border-none cursor-pointer">
                Keluar
            </button>
        </form>
    </div>
</aside>