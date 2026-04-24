<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Company - JobHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<style>
.label {
    display:block;
    font-size:0.85rem;
    font-weight:500;
    color:#334155;
    margin-bottom:0.3rem;
}

.input {
    width:100%;
    border:1px solid #e2e8f0;
    border-radius:0.6rem;
    padding:0.55rem 0.7rem;
    font-size:0.85rem;
    outline:none;
    transition:0.2s;
    background:white;
}

.input:focus {
    border-color:#6366f1;
    box-shadow:0 0 0 2px rgba(99,102,241,0.15);
}

.btn {
    background:#6366f1;
    color:white;
    padding:0.6rem 1.2rem;
    border-radius:0.5rem;
    font-size:0.85rem;
    font-weight:600;
}
.btn:hover {
    background:#4f46e5;
}
</style>

<body class="bg-slate-100 min-h-screen flex" x-data="{ step:1, registered:false }">
<!-- LEFT -->
<div class="hidden lg:flex w-1/2 relative overflow-hidden bg-indigo-600 text-white p-12 flex-col justify-between">

    <!-- BACKGROUND GLOW -->
    <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-indigo-400 opacity-30 blur-3xl rounded-full"></div>

    <!-- TOP -->
    <div class="relative z-10">
        <h1 class="text-3xl font-bold tracking-tight">
            Dinus Career Center
        </h1>
        <p class="mt-3 text-indigo-100 text-sm">
            Universitas Dian Nuswantoro
        </p>
    </div>

    <!-- MIDDLE -->
    <div class="relative z-10 space-y-6">
        <h2 class="text-3xl font-semibold leading-snug">
            Hubungkan Perusahaan dengan Talenta Terbaik 🎓
        </h2>

        <p class="text-indigo-100 text-base leading-relaxed max-w-md">
            Platform resmi untuk membantu perusahaan menemukan mahasiswa dan alumni UDINUS yang siap kerja.
        </p>

        <!-- FEATURES -->
        <div class="space-y-3 text-sm text-indigo-100">
            <div class="flex items-center gap-2">
                ✅ Posting lowongan dengan mudah
            </div>
            <div class="flex items-center gap-2">
                ✅ Kelola pelamar dalam satu dashboard
            </div>
            <div class="flex items-center gap-2">
                ✅ Akses talenta berkualitas UDINUS
            </div>
        </div>
    </div>

    <!-- BOTTOM -->
    <div class="relative z-10">
        <div class="text-sm text-indigo-200 mb-2">
            Trusted by
        </div>

        <div class="flex items-center gap-4 text-xs text-indigo-100 opacity-80">
            <span>Universitas Dian Nuswantoro</span>
            <span>•</span>
            <span>Dinus Career Center</span>
        </div>
    </div>

</div>

<!-- RIGHT -->
<div class="flex w-full lg:w-1/2 items-center justify-center p-6">

<div class="w-full max-w-md" x-show="!registered" x-cloak>

    <div class="relative bg-white rounded-2xl p-8 shadow-xl overflow-hidden border border-slate-200">

        <!-- glow -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-200 blur-3xl opacity-30"></div>

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-900">Buat Akun Perusahaan</h2>
            <p class="text-sm text-slate-500">Mulai rekrut kandidat dengan mudah</p>
        </div>

        <!-- PROGRESS -->
        <div class="mb-6">
            <div class="flex justify-between text-xs text-slate-500 mb-1">
                <span>Langkah <span x-text="step"></span> dari 4</span>
                <span x-text="Math.round(step/4*100)+'%'"></span>
            </div>
            <div class="w-full bg-slate-200 h-2 rounded-full">
                <div class="bg-indigo-600 h-2 rounded-full transition-all"
                     :style="'width:'+step/4*100+'%'"></div>
            </div>
        </div>

        <form @submit.prevent="if(step===4) registered=true" class="space-y-6">

        <!-- STEP 1 -->
        <div x-show="step===1" x-transition class="space-y-4">
            <div>
                <p class="font-semibold text-slate-800">Informasi Akun</p>
                <p class="text-xs text-slate-500">Masukkan email dan kata sandi</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email Perusahaan</label>
                <input type="email"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kata Sandi</label>
                <input type="password"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>
        </div>

        <!-- STEP 2 -->
        <div x-show="step===2" x-transition class="space-y-4">
            <div>
                <p class="font-semibold text-slate-800">Profil Perusahaan</p>
                <p class="text-xs text-slate-500">Isi data perusahaan</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Perusahaan</label>
                <input type="text" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Industri</label>
                <input type="text" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Website</label>
                <input type="text" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Perusahaan</label>
                <textarea rows="3"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"></textarea>
            </div>
        </div>

        <!-- STEP 3 -->
        <div x-show="step===3" x-transition class="space-y-4">
            <div>
                <p class="font-semibold text-slate-800">Lokasi Perusahaan</p>
                <p class="text-xs text-slate-500">Alamat lengkap perusahaan</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Alamat</label>
                <textarea rows="2"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kota</label>
                <input type="text"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kode Pos</label>
                <input type="text"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>
        </div>

        <!-- STEP 4 -->
        <div x-show="step===4" x-transition class="space-y-4">
            <div>
                <p class="font-semibold text-slate-800">Kontak Penanggung Jawab</p>
                <p class="text-xs text-slate-500">Data kontak perusahaan</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Contact Person</label>
                <input type="text"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Handphone</label>
                <input type="text"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jabatan</label>
                <input type="text"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-between pt-4">

            <button type="button" x-show="step>1"
                @click="step--"
                class="text-sm text-slate-500 hover:text-slate-700">
                ← Kembali
            </button>

            <button type="button" x-show="step<4"
                @click="step++"
                class="inline-flex items-center gap-2 bg-indigo-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-indigo-500 transition">
                Selanjutnya
                <span class="transition">→</span>
            </button>

            <button type="submit" x-show="step===4"
                class="w-full bg-indigo-600 text-white text-sm font-semibold py-2 rounded-lg hover:bg-indigo-500 transition">
                Kirim Pendaftaran
            </button>

        </div>

        </form>
    </div>
</div>

<!-- SUCCESS -->
<!-- SUCCESS -->
<div x-show="registered" x-cloak class="w-full max-w-md mx-auto">

    <div class="relative bg-white rounded-2xl shadow-xl border border-slate-200 p-8 text-center overflow-hidden">

        <!-- glow -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-200 blur-3xl opacity-30"></div>

        <!-- ICON -->
        <div class="mx-auto flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 mb-4">
            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <!-- TITLE -->
        <h2 class="text-2xl font-semibold text-slate-900">
            Pendaftaran Berhasil 🎉
        </h2>

        <!-- DESC -->
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
            Akun perusahaan Anda sedang dalam proses <span class="font-medium text-amber-600">verifikasi admin</span>.  
            Anda akan menerima notifikasi setelah akun disetujui.
        </p>

        <!-- INFO BOX -->
        <div class="mt-5 bg-slate-50 border border-slate-200 rounded-lg p-3 text-xs text-slate-600">
            Proses verifikasi biasanya memerlukan waktu <span class="font-medium">1–2 hari kerja</span>.
        </div>

        <!-- BUTTON -->
        <a href="/login"
           class="mt-6 inline-flex items-center justify-center w-full bg-indigo-600 text-white text-sm font-medium py-2 rounded-lg hover:bg-indigo-500 transition">
            Kembali ke Login
        </a>

    </div>

</div>
</div>



</body>
</html>