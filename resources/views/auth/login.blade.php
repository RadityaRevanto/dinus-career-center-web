<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dinus Career Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-[#e6ebf5] font-[Poppins]">

<div class="w-[95%] max-w-[1600px] min-h-[820px]
            bg-white rounded-[36px]
            shadow-[0_40px_120px_rgba(0,0,0,0.12)]
            overflow-hidden flex">

    <!-- LEFT -->
    <div class="hidden md:flex w-1/2 bg-slate-100 p-24 flex-col justify-between">
        <div>
            <h1 class="text-4xl font-bold text-slate-800 leading-[1.2] tracking-tight">
                <span class="text-blue-600">Udinus </span>Career<br>
                Center
            </h1>
            <p class="text-slate-500 mt-6 max-w-lg leading-relaxed text-base">
                Kelola lowongan, pantau pelamar, dan rekrut lebih cepat dalam satu platform modern yang efisien.
            </p>
        </div>

        <div class="flex justify-center">
            <img src="https://cdn.dribbble.com/userupload/3870987/file/original-6b6f9c5d82d8bb2f9dbd3a8e63efb8b8.png"
                 class="w-[500px]">
        </div>

        <div class="flex items-center justify-between text-sm text-slate-500">
            <span>Belum punya akun?</span>
            <a href="/company-register" class="text-blue-600 font-medium hover:underline">
                Daftar
            </a>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="w-full md:w-1/2 bg-white relative flex items-center justify-center">

        <div class="w-full max-w-xl">

            <!-- ALERT -->
            @if(session('error'))
                <div class="mb-4 text-red-500 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 text-green-500 text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- HEADER -->
            <div class="mb-12 text-center">
                <div class="flex justify-center mb-5">
                    <div class="bg-white p-2 rounded-full shadow-[0_8px_25px_rgba(0,0,0,0.15)]">
                        <img src="/images/dcc.jpg" class="w-20 h-20 object-contain">
                    </div>
                </div>

                <h2 class="text-4xl font-semibold text-slate-800">
                    Selamat Datang
                </h2>

                <p class="text-slate-500 mt-3 text-base max-w-md mx-auto">
                    Masuk untuk melanjutkan ke dashboard
                </p>
            </div>

            <!-- FORM -->
            <form method="POST" action="/login" class="space-y-7">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <div class="relative mt-3">
                        <i data-lucide="mail"
                           class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                        <input type="email" name="email" placeholder="nama@email.com"
                            class="w-full pl-11 pr-4 py-4 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                            outline-none shadow-sm transition text-sm">
                    </div>
                </div>

                <!-- PASSWORD -->
                <div x-data="{ show: false }">
                    <label class="text-sm font-medium text-slate-700">Password</label>

                    <div class="relative mt-3">
                        <i data-lucide="lock"
                        class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                        <input :type="show ? 'text' : 'password'" name="password" placeholder="Masukkan password"
                            class="w-full pl-11 pr-11 py-4 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                            outline-none shadow-sm transition text-sm">

                        <button type="button"
                            @click="show = !show"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">
                            👁
                        </button>
                    </div>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full mt-10 bg-blue-600 hover:bg-blue-500 text-white
                    py-4 rounded-xl font-semibold shadow-md">
                    Masuk
                </button>

            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
</body>
</html>
