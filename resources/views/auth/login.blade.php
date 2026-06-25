<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dinus Career Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-[#e6ebf5] px-3 py-4 sm:px-4 sm:py-6 md:py-8" style="font-family: 'Poppins', sans-serif;">

<div class="w-full max-w-[1600px] min-h-0 md:min-h-[820px]
            bg-white rounded-2xl sm:rounded-3xl lg:rounded-[36px]
            overflow-hidden flex flex-col md:flex-row shadow-sm md:shadow-none">

    <!-- LEFT -->
    <div class="relative hidden md:flex md:w-1/2 overflow-hidden bg-slate-50 p-10 lg:p-16 xl:p-24 flex-col justify-between">

        <div class="relative z-10">
            <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 leading-[1.2] tracking-tight">
                <span class="text-blue-600">Udinus </span>Career<br>
                Center
            </h1>
            <p class="text-slate-500 mt-4 lg:mt-6 max-w-lg leading-relaxed text-sm lg:text-base">
                Kelola lowongan, pantau pelamar, dan rekrut lebih cepat dalam satu platform modern yang efisien.
            </p>
        </div>

        <div class="relative z-10 flex justify-center perspective-distant my-8 lg:my-0">
            <div class="group relative w-full max-w-[540px] rounded-[28px] lg:rounded-[36px] border border-white/70 bg-white/60 p-2.5 lg:p-3 shadow-[0_30px_80px_-30px_rgba(15,23,42,0.35)] backdrop-blur-xl transition-all duration-500 transform-3d lg:transform-[rotateX(8deg)_rotateY(-12deg)] lg:hover:transform-[rotateX(0deg)_rotateY(0deg)_translateY(-8px)]">
                <div class="absolute -right-4 lg:-right-8 -top-4 lg:-top-8 z-20 rounded-2xl border border-white/60 bg-white/75 px-3 py-2 lg:px-4 lg:py-3 shadow-xl shadow-slate-950/10 backdrop-blur-md">
                    <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-slate-500">Campus</p>
                    <p class="mt-1 text-xs lg:text-sm font-semibold text-slate-800">Dinus Career Hub</p>
                </div>
                <div class="absolute -left-4 lg:-left-7 bottom-8 lg:bottom-12 z-20 rounded-2xl border border-white/60 bg-slate-950/70 px-3 py-2 lg:px-4 lg:py-3 text-white shadow-xl shadow-slate-950/20 backdrop-blur-md">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.24em] text-slate-300">Recruitment</p>
                    <p class="mt-1 text-xs lg:text-sm font-bold">Modern Platform</p>
                </div>
                <div class="relative overflow-hidden rounded-[22px] lg:rounded-[28px] border border-white/80 bg-slate-900 shadow-2xl">
                    <img src="/images/udinus.jpg"
                         alt="Gedung Udinus"
                         class="h-[240px] lg:h-[320px] xl:h-[360px] w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-linear-to-tr from-slate-950/45 via-slate-900/5 to-white/20"></div>
                    <div class="absolute -left-24 top-0 h-full w-24 rotate-12 bg-white/35 blur-xl transition-all duration-700 group-hover:left-full"></div>
                    <div class="absolute left-4 top-4 lg:left-5 lg:top-5 rounded-full border border-white/40 bg-white/20 px-3 py-1 lg:px-4 lg:py-1.5 text-[10px] lg:text-xs font-semibold uppercase tracking-[0.25em] text-white backdrop-blur-md">
                        Udinus
                    </div>
                </div>
                <div class="absolute -bottom-5 lg:-bottom-7 left-1/2 h-8 lg:h-10 w-4/5 -translate-x-1/2 rounded-full bg-slate-950/20 blur-2xl"></div>
            </div>
        </div>

        <div></div>
    </div>

    <!-- RIGHT -->
    <div class="w-full md:w-1/2 bg-white relative flex items-center justify-center px-5 py-8 sm:px-8 sm:py-10 md:px-10 md:py-12 lg:px-16">

        <div class="w-full max-w-xl">

            <!-- ALERT -->
            @if(session('error'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     class="fixed left-4 right-4 top-4 z-50 sm:left-auto sm:right-6 sm:w-full sm:max-w-sm rounded-2xl border border-red-200 bg-white p-4 shadow-2xl shadow-red-950/10"
                     role="alert">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <i data-lucide="circle-alert" class="h-5 w-5"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-slate-900">Login gagal</p>
                            <p class="mt-1 text-sm leading-relaxed text-slate-500">{{ session('error') }}</p>
                        </div>
                        <button type="button"
                                @click="show = false"
                                class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                                aria-label="Tutup notifikasi">
                            <i data-lucide="x" class="h-4 w-4"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mobile branding -->
            <div class="mb-6 text-center md:hidden">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-600">Udinus Career Center</p>
            </div>

            <!-- HEADER -->
            <div class="mb-8 sm:mb-10 md:mb-12 text-center">
                <div class="flex justify-center mb-4 sm:mb-5">
                    <div class="bg-white p-1.5 sm:p-2 rounded-full">
                        <img src="/images/dcc.jpg" alt="Dinus Career Center" class="w-24 h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 object-contain">
                    </div>
                </div>

                <h2 class="text-3xl md:text-4xl font-semibold text-slate-800">
                    Selamat Datang
                </h2>

                <p class="text-slate-500 mt-3 text-base max-w-md mx-auto px-2">
                    Masuk untuk melanjutkan ke dashboard
                </p>
            </div>

            <!-- FORM -->
            <form method="POST" action="/login" class="space-y-5">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- EMAIL -->
                <div>
                    <label for="email" class="text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <div class="relative mt-3">
                        <i data-lucide="mail"
                           class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>

                        <input id="email" type="email" name="email" placeholder="nama@email.com" required
                            class="w-full pl-11 pr-4 py-4 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                            outline-none shadow-sm transition text-base">
                    </div>
                </div>

                <!-- PASSWORD -->
                <div x-data="{ show: false }">
                    <label for="password" class="text-sm font-medium text-slate-700">Password</label>

                    <div class="relative mt-3">
                        <i data-lucide="lock"
                            class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>

                        <input id="password" :type="show ? 'text' : 'password'" name="password" placeholder="Masukkan password" required
                            class="w-full pl-11 pr-11 py-4 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                            outline-none shadow-sm transition text-base">

                        <button type="button"
                            @click="show = !show; $nextTick(() => lucide.createIcons())"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1"
                            :aria-label="show ? 'Sembunyikan password' : 'Tampilkan password'">
                            <i x-show="!show" data-lucide="eye" class="h-5 w-5"></i>
                            <i x-show="show" x-cloak data-lucide="eye-off" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="mt-3 text-right">
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 hover:underline transition">
                            Lupa Password?
                        </a>
                    </div>
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full mt-2 bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white
                    py-4 rounded-xl font-semibold shadow-md text-base transition">
                    Masuk
                </button>

                <p class="text-center text-sm text-slate-500 pt-1">
                    Belum punya akun?
                    <a href="/company-register" class="font-semibold text-blue-600 hover:text-blue-500 hover:underline transition">
                        Daftar
                    </a>
                </p>

            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
    document.addEventListener('alpine:initialized', () => lucide.createIcons());
</script>
</body>
</html>
