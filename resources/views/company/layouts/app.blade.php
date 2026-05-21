<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modern Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-base-100 text-base-content antialiased">
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
</body>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</html>
