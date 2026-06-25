<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modern Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-size: 16px;
        }

        .text-xs {
            font-size: 0.8125rem !important;
            line-height: 1.25rem !important;
        }

        .text-sm {
            font-size: 0.9375rem !important;
            line-height: 1.5rem !important;
        }

        .text-base {
            font-size: 1.0625rem !important;
            line-height: 1.75rem !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content antialiased" style="font-family: 'Poppins', ui-sans-serif, system-ui, sans-serif;" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
    <div
        x-show="sidebarOpen"
        x-cloak
        @click="sidebarOpen = false"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm lg:hidden"
        aria-hidden="true"
    ></div>
    <div class="flex h-screen overflow-hidden">
        @include('company.components.sidebar')
        <div class="flex-1 flex flex-col min-w-0 bg-base-100 relative">
            @include('company.components.header')
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 relative">
                @yield('content')
            </main>
            @include('company.components.footer')
        </div>
    </div>
    <x-confirm-dialog />
</body>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</html>