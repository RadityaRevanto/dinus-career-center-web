<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Dinus Career Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-[#e6ebf5] font-[Poppins] x-data="{ step: 1, registered: {{ session('success') ? 'true' : 'false' }} }"
    x-data="{ step: 1, registered: {{ session('success') ? 'true' : 'false' }} }">

    <!-- MAIN CARD -->
    <div
        class="w-[95%] max-w-[1600px] min-h-[820px]
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
                <span>Sudah punya akun?</span>
                <a href="/login" class="text-blue-600 font-medium hover:underline">
                    Login
                </a>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="w-full md:w-1/2 relative flex flex-col items-center justify-center px-16">

            <!-- STEP INDICATOR (di pojok atas) -->
            <div class="absolute top-10 left-12 flex gap-2" x-show="!registered" x-cloak>
                <div class="h-1 w-8 rounded-full transition-all duration-300"
                    :class="step >= 1 ? 'bg-blue-600' : 'bg-slate-300'"></div>
                <div class="h-1 w-8 rounded-full transition-all duration-300"
                    :class="step >= 2 ? 'bg-blue-600' : 'bg-slate-300'"></div>
                <div class="h-1 w-8 rounded-full transition-all duration-300"
                    :class="step >= 3 ? 'bg-blue-600' : 'bg-slate-300'"></div>
                <div class="h-1 w-8 rounded-full transition-all duration-300"
                    :class="step >= 4 ? 'bg-blue-600' : 'bg-slate-300'"></div>
            </div>

            <!-- FORM WRAPPER -->
            <div class="relative w-full max-w-xl py-10" x-show="!registered" x-cloak>

                <!-- HEADER -->
                <div class="mb-10 text-center">

                    <div class="flex justify-center mb-5">
                        <div class="bg-white p-2 rounded-full shadow-[0_8px_25px_rgba(0,0,0,0.15)]">
                            <img src="/images/dcc.jpg" class="w-20 h-20 object-contain">
                        </div>
                    </div>

                    <h2 class="text-4xl font-semibold text-slate-800">
                        Daftar Perusahaan
                    </h2>

                    <p class="text-slate-500 mt-3 text-base max-w-md mx-auto">
                        Buat akun untuk mulai merekrut kandidat
                    </p>
                </div>

                {{-- ERROR --}}
                @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 rounded-xl border border-red-200">
                    <p class="text-red-600 text-sm">{{ session('error') }}</p>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 rounded-xl border border-red-200">
                    @foreach($errors->all() as $error)
                        <p class="text-red-600 text-sm">• {{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <!-- FORM — hapus @submit Alpine, biarkan submit normal ke server -->
                <form method="POST" action="/register-company">
                    @csrf
                    <div class="mb-6 flex items-center gap-2">
                        <div class="h-8 w-1 rounded-full bg-blue-600"></div>
                        <span class="text-sm font-semibold text-slate-700"
                            x-text="['Data Akun','Profil Perusahaan','Alamat Perusahaan','Contact Person'][step-1]"></span>
                    </div>

                    <!-- STEP 1 -->
                    <div x-show="step===1" class="space-y-5">

                        <!-- EMAIL -->
                        <div class="relative group">
                            <i data-lucide="mail"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="email" name="email" placeholder="Email Perusahaan"
                                value="{{ old('email') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- PASSWORD -->
                        <div class="relative group">
                            <i data-lucide="lock"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="password" name="password" placeholder="Kata Sandi"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- CONFIRM -->
                        <div class="relative group">
                            <i data-lucide="shield-check"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                    </div>

                    <!-- STEP 2 -->
                    <div x-show="step===2" class="space-y-5">

                        <!-- COMPANY -->
                        <div class="relative group">
                            <i data-lucide="building-2"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan"
                                value="{{ old('nama_perusahaan') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- INDUSTRY -->
                        <div class="relative group">
                            <i data-lucide="briefcase"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="jenis_penyedia" placeholder="Industri"
                                value="{{ old('jenis_penyedia') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- WEBSITE -->
                        <div class="relative group">
                            <i data-lucide="globe"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="website_perusahaan" placeholder="Website"
                                value="{{ old('website_perusahaan') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="relative group">
                            <i data-lucide="file-text" class="w-5 h-5 text-slate-400 absolute left-4 top-5"></i>
                            <textarea name="deskripsi_perusahaan" rows="3" placeholder="Deskripsi"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('deskripsi_perusahaan') }}</textarea>
                        </div>

                    </div>

                    <!-- STEP 3 -->
                    <div x-show="step===3" class="space-y-5">

                        <!-- ADDRESS -->
                        <div class="relative group">
                            <i data-lucide="map-pin" class="w-5 h-5 text-slate-400 absolute left-4 top-5"></i>
                            <textarea name="alamat_perusahaan" rows="2" placeholder="Alamat"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('alamat_perusahaan') }}</textarea>
                        </div>

                        <!-- CITY -->
                        <div class="relative group">
                            <i data-lucide="map"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="kota" placeholder="Kota"
                                value="{{ old('kota') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- ZIP -->
                        <div class="relative group">
                            <i data-lucide="mailbox"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="kode_pos" placeholder="Kode Pos"
                                value="{{ old('kode_pos') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- PHONE -->
                        <div class="relative group">
                            <i data-lucide="phone"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="no_handphone" placeholder="Nomor Handphone"
                                value="{{ old('no_handphone') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                    </div>

                    <!-- STEP 4 -->
                    <div x-show="step===4" class="space-y-5">

                        <!-- PERSON -->
                        <div class="relative group">
                            <i data-lucide="user"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="nama_cp" placeholder="Nama Contact Person"
                                value="{{ old('nama_cp') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- PHONE -->
                        <div class="relative group">
                            <i data-lucide="phone"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="no_telepon" placeholder="Nomor Telepon"
                                value="{{ old('no_telepon') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- No Fax -->
                        <div class="relative group">
                            <i data-lucide="phone"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="no_fax" placeholder="Nomor Fax"
                                value="{{ old('no_fax') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- ROLE -->
                        <div class="relative group">
                            <i data-lucide="badge-check"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="jabatan" placeholder="Jabatan"
                                value="{{ old('jabatan') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-sm
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex items-center gap-4 pt-6">

                        <!-- BACK -->
                        <button type="button" x-show="step>1" @click="step--"
                            class="px-5 py-4 rounded-xl bg-slate-100 text-slate-600 text-sm
                            hover:bg-slate-200 transition">
                            ← Kembali
                        </button>

                        <!-- NEXT -->
                        <button type="button" x-show="step<4" @click="step++"
                            class="flex-1 bg-blue-600 text-white py-4 rounded-xl
                            hover:bg-blue-500 transition font-semibold">
                            Selanjutnya →
                        </button>

                        <!-- SUBMIT -->
                        <button type="submit" x-show="step===4"
                            class="flex-1 bg-blue-600 text-white py-4 rounded-xl
                            hover:bg-blue-500 transition font-semibold">
                            Kirim Pendaftaran
                        </button>

                    </div>
                </form>
            </div>

            <!-- SUCCESS — sekarang dikontrol dari session Laravel -->
            <div x-show="registered" x-cloak x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                class="w-full max-w-lg px-10 py-14 text-center z-10">

                <div
                    class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h2 class="text-3xl font-semibold text-slate-800">Pendaftaran Berhasil!</h2>
                <p class="text-slate-400 mt-3 text-sm leading-relaxed max-w-sm mx-auto">
                    Akun perusahaan Anda sedang diverifikasi oleh admin. Kami akan menghubungi Anda melalui email.
                </p>

                <a href="/login"
                    class="mt-8 inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl font-semibold text-sm hover:from-blue-500 hover:to-indigo-500 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all duration-200 hover:scale-[1.02]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>

        </div>
    </div>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
