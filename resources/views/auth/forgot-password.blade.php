<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Dinus Career Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-[#e6ebf5]" style="font-family: 'Poppins', sans-serif;">

<div class="w-[95%] max-w-[1600px] min-h-[820px] bg-white rounded-[36px] overflow-hidden flex">

    <!-- LEFT -->
    <div class="relative hidden md:flex w-1/2 overflow-hidden bg-slate-50 p-24 flex-col justify-between">
        <div class="relative z-10">
            <h1 class="text-4xl font-bold text-slate-800 leading-[1.2] tracking-tight">
                <span class="text-blue-600">Udinus </span>Career<br>
                Center
            </h1>
            <p class="text-slate-500 mt-6 max-w-lg leading-relaxed text-base">
                Pulihkan akses akun perusahaan Anda dan lanjutkan proses rekrutmen dengan aman.
            </p>
        </div>

        <div class="relative z-10 flex justify-center perspective-distant">
            <div class="group relative w-[540px] max-w-full rounded-[36px] border border-white/70 bg-white/60 p-3 shadow-[0_30px_80px_-30px_rgba(15,23,42,0.35)] backdrop-blur-xl transition-all duration-500 transform-3d transform-[rotateX(8deg)_rotateY(-12deg)] hover:transform-[rotateX(0deg)_rotateY(0deg)_translateY(-8px)]">
                <div class="absolute -right-8 -top-8 z-20 rounded-2xl border border-white/60 bg-white/75 px-4 py-3 shadow-xl shadow-slate-950/10 backdrop-blur-md">
                    <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-slate-500">Account</p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">Password Recovery</p>
                </div>
                <div class="absolute -left-7 bottom-12 z-20 rounded-2xl border border-white/60 bg-slate-950/70 px-4 py-3 text-white shadow-xl shadow-slate-950/20 backdrop-blur-md">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.24em] text-slate-300">Secure</p>
                    <p class="mt-1 text-sm font-bold">Reset Access</p>
                </div>
                <div class="relative overflow-hidden rounded-[28px] border border-white/80 bg-slate-900 shadow-2xl">
                    <img src="/images/udinus.jpg"
                         alt="Gedung Udinus"
                         class="h-[360px] w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-linear-to-tr from-slate-950/45 via-slate-900/5 to-white/20"></div>
                    <div class="absolute -left-24 top-0 h-full w-24 rotate-12 bg-white/35 blur-xl transition-all duration-700 group-hover:left-full"></div>
                    <div class="absolute left-5 top-5 rounded-full border border-white/40 bg-white/20 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-white backdrop-blur-md">
                        Udinus
                    </div>
                </div>
                <div class="absolute -bottom-7 left-1/2 h-10 w-4/5 -translate-x-1/2 rounded-full bg-slate-950/20 blur-2xl"></div>
            </div>
        </div>

        <div></div>
    </div>

    <!-- RIGHT -->
    <div class="w-full md:w-1/2 bg-white relative flex items-center justify-center">
        <div class="w-full max-w-xl">

            @if(session('error'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     class="fixed right-6 top-6 z-50 w-[calc(100%-3rem)] max-w-sm rounded-2xl border border-red-200 bg-white p-4 shadow-2xl shadow-red-950/10"
                     role="alert">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
                            <i data-lucide="circle-alert" class="h-5 w-5"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-slate-900">Gagal mengirim email</p>
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
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     class="fixed right-6 top-6 z-50 w-[calc(100%-3rem)] max-w-sm rounded-2xl border border-emerald-200 bg-white p-4 shadow-2xl shadow-emerald-950/10"
                     role="alert">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i data-lucide="circle-check" class="h-5 w-5"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-slate-900">Email terkirim</p>
                            <p class="mt-1 text-sm leading-relaxed text-slate-500">{{ session('success') }}</p>
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

            <!-- HEADER -->
            <div class="mb-12 text-center">
                <div class="flex justify-center mb-5">
                    <div class="bg-white p-2 rounded-full">
                        <img src="/images/dcc.jpg" class="w-28 h-28 md:w-32 md:h-32 object-contain" alt="Dinus Career Center">
                    </div>
                </div>

                <h2 class="text-4xl font-semibold text-slate-800">
                    Lupa Password?
                </h2>

                <p class="text-slate-500 mt-3 text-base max-w-md mx-auto">
                    Masukkan email akun Anda. Kami akan mengirim link untuk reset password.
                </p>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <div class="relative mt-3">
                        <i data-lucide="mail"
                           class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                        <input type="email" name="email" placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            class="w-full pl-11 pr-4 py-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none shadow-sm transition text-sm"
                            required>
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full mt-2 bg-blue-600 hover:bg-blue-500 text-white py-4 rounded-xl font-semibold shadow-md transition">
                    Kirim Link Reset Password
                </button>

                <p class="text-center text-sm text-slate-500">
                    Ingat password?
                    <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 hover:underline transition">
                        Login
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
</body>
</html>
