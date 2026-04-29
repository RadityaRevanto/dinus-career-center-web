<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-base-100 text-base-content antialiased">
    <!-- Wrapper Utama: h-screen agar Header & Footer menempel di atas/bawah -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Kiri -->
        @include('company.components.sidebar')
        <!-- Kontainer Kanan -->
        <div class="flex-1 flex flex-col min-w-0 bg-base-100 relative">
            <!-- Sticky Header -->
            @include('company.components.header')
            <!-- Area Konten Utama (Bisa Scroll independen) -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 relative">
                <!-- Konten Utama Dinamis -->
                @yield('content')
            </main>
            <!-- Footer Menempel Bawah -->
            @include('company.components.footer')
        </div>
    </div>
</body>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>
