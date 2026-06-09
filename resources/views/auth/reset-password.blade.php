<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Dinus Career Center</title>
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
                Buat password baru untuk melanjutkan akses ke dashboard perusahaan Anda.
            </p>
        </div>

        <div class="relative z-10 flex justify-center perspective-distant">
            <div class="group relative w-[540px] max-w-full rounded-[36px] border border-white/70 bg-white/60 p-3 shadow-[0_30px_80px_-30px_rgba(15,23,42,0.35)] backdrop-blur-xl transition-all duration-500 transform-3d transform-[rotateX(8deg)_rotateY(-12deg)] hover:transform-[rotateX(0deg)_rotateY(0deg)_translateY(-8px)]">
                <div class="relative overflow-hidden rounded-[28px] border border-white/80 bg-slate-900 shadow-2xl">
                    <img src="/images/udinus.jpg" alt="Gedung Udinus" class="h-[360px] w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-linear-to-tr from-slate-950/45 via-slate-900/5 to-white/20"></div>
                </div>
            </div>
        </div>

        <div></div>
    </div>

    <!-- RIGHT -->
    <div class="w-full md:w-1/2 bg-white relative flex items-center justify-center">
        <div class="w-full max-w-xl">

            @if(session('error'))
                <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div id="invalid-link-alert" class="hidden mb-4 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-700">
                Link reset password tidak valid atau sudah kedaluwarsa. Silakan minta link baru dari halaman lupa password.
            </div>

            <div class="mb-12 text-center">
                <div class="flex justify-center mb-5">
                    <div class="bg-white p-2 rounded-full">
                        <img src="/images/dcc.jpg" class="w-28 h-28 md:w-32 md:h-32 object-contain" alt="Dinus Career Center">
                    </div>
                </div>

                <h2 class="text-4xl font-semibold text-slate-800">Password Baru</h2>
                <p class="text-slate-500 mt-3 text-base max-w-md mx-auto">
                    Masukkan password baru untuk akun Anda.
                </p>
            </div>

            <form id="reset-password-form" method="POST" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="access_token" id="access_token" value="">

                <div x-data="{ show: false }">
                    <label class="text-sm font-medium text-slate-700">Password Baru</label>
                    <div class="relative mt-3">
                        <i data-lucide="lock" class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input :type="show ? 'text' : 'password'" name="password" placeholder="Minimal 8 karakter"
                            class="w-full pl-11 pr-11 py-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none shadow-sm transition text-sm"
                            required minlength="8">
                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">👁</button>
                    </div>
                    @error('password')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div x-data="{ show: false }">
                    <label class="text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <div class="relative mt-3">
                        <i data-lucide="shield-check" class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input :type="show ? 'text' : 'password'" name="password_confirmation" placeholder="Ulangi password baru"
                            class="w-full pl-11 pr-11 py-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none shadow-sm transition text-sm"
                            required minlength="8">
                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">👁</button>
                    </div>
                </div>

                <button type="submit" id="submit-reset-password"
                    class="w-full mt-2 bg-blue-600 hover:bg-blue-500 text-white py-4 rounded-xl font-semibold shadow-md transition">
                    Simpan Password Baru
                </button>

                <p class="text-center text-sm text-slate-500">
                    <a href="{{ route('password.request') }}" class="font-semibold text-blue-600 hover:text-blue-500 hover:underline transition">
                        Minta link baru
                    </a>
                    &bull;
                    <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 hover:underline transition">
                        Kembali ke login
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    lucide.createIcons();

    const hashParams = new URLSearchParams(window.location.hash.replace(/^#/, ''));
    const queryParams = new URLSearchParams(window.location.search);
    const accessToken = hashParams.get('access_token') || queryParams.get('access_token');
    const type = hashParams.get('type') || queryParams.get('type');
    const tokenInput = document.getElementById('access_token');
    const invalidAlert = document.getElementById('invalid-link-alert');
    const form = document.getElementById('reset-password-form');
    const submitButton = document.getElementById('submit-reset-password');

    if (!accessToken || type !== 'recovery') {
        invalidAlert?.classList.remove('hidden');
        form?.classList.add('opacity-50', 'pointer-events-none');
        submitButton?.setAttribute('disabled', 'disabled');
        return;
    }

    tokenInput.value = accessToken;
});
</script>
</body>
</html>
