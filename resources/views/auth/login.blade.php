<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dinus Career Center</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex bg-slate-100">
<!-- LEFT (BRANDING) -->
<div class="hidden lg:flex w-1/2 relative bg-indigo-600 text-white p-12 flex-col justify-between overflow-hidden">
    <!-- glow -->
    <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-indigo-400 opacity-30 blur-3xl rounded-full"></div>
    <div class="relative z-10">
        <h1 class="text-3xl font-bold">Dinus Career Center</h1>
        <p class="text-indigo-100 mt-2 text-sm">Universitas Dian Nuswantoro</p>
    </div>
    <div class="relative z-10 space-y-4">
        <h2 class="text-3xl font-semibold leading-snug">
            Temukan Talenta Terbaik 🎓
        </h2>
        <p class="text-indigo-100 text-sm max-w-md">
            Kelola lowongan, pantau pelamar, dan rekrut lebih cepat dalam satu platform.
        </p>
    </div>

    <div class="relative z-10 text-xs text-indigo-200">
        © 2026 Dinus Career Center
    </div>
</div>

<!-- RIGHT -->
<div class="flex w-full lg:w-1/2 items-center justify-center p-6">

<div class="w-full max-w-md">

    <!-- CARD -->
    <div class="relative bg-white rounded-2xl shadow-2xl border border-slate-200 p-8 overflow-hidden">

        <!-- glow -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-200 blur-3xl opacity-30"></div>

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-900">
                Masuk ke Sistem
            </h2>
            <p class="text-sm text-slate-500">
                Dinus Career Center
            </p>
        </div>

        <!-- FORM -->
        <form class="space-y-5">
            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Email
                </label>
                <input type="email"
                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <!-- PASSWORD -->
            <div>
                <div class="flex justify-between">
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Kata Sandi
                    </label>
                </div>
                <input type="password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div class="flex items-center justify-between text-left">
                <a href="#" class="text-xs text-indigo-600 hover:underline">
                    Lupa Kata Sandi?
                </a>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white text-sm font-semibold py-2.5 rounded-xl hover:bg-indigo-500 transition transform hover:scale-[1.02]">
                Masuk
            </button>

        </form>

        <!-- FOOTER -->
        <div class="mt-6 text-center text-sm text-slate-500">
            Belum punya akun perusahaan?
        </div>

        <a href="/company-register"
           class="mt-3 block w-full text-center border border-slate-300 py-2 rounded-xl text-sm font-medium hover:bg-slate-50 transition">
            Daftar Perusahaan
        </a>
    </div>
</div>
</div>
</body>
</html>