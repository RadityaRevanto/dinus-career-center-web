<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<body class="bg-base-100 text-base-content antialiased" style="font-family: 'Poppins', ui-sans-serif, system-ui, sans-serif;">
    <!-- Wrapper Utama: h-screen agar Header & Footer menempel di atas/bawah -->
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Kiri -->
        @include('admin.components.sidebar')
        
        <!-- Kontainer Kanan -->
        <div class="flex-1 flex flex-col min-w-0 bg-base-100 relative">
            
            <!-- Sticky Header -->
            @include('admin.components.header')
            
            <!-- Area Konten Utama (Bisa Scroll independen) -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 relative">
                <!-- Konten Utama Dinamis -->
                @yield('content')
            </main>
            <!-- Footer Menempel Bawah -->
            @include('admin.components.footer')
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@yield('scripts')
@stack('scripts')
</html>