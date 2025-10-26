<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Karyawan | SIP-KBI')</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition duration-500">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('user.partials.sidebar')

        <!-- Konten Utama -->
        <main class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4">@yield('page-title')</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">@yield('page-description')</p>
            @yield('content')
        </main>
    </div>

    @include('user.partials.footer-scripts')
</body>
</html>