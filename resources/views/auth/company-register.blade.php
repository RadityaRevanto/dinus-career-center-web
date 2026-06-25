<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Dinus Career Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-[#e6ebf5] px-3 py-4 sm:px-4 sm:py-6 md:py-8"
    style="font-family: 'Poppins', sans-serif;"
    x-data="{ 
        step: 1, 
        registered: {{ session('success') ? 'true' : 'false' }},
        errorMessage: '',
        validateStep() {
            let currentStepDiv = document.getElementById('step-' + this.step);
            if (!currentStepDiv) return true;
            let inputs = currentStepDiv.querySelectorAll('input[required], textarea[required]');
            for (let i = 0; i < inputs.length; i++) {
                if (!inputs[i].value.trim()) {
                    this.errorMessage = 'Mohon lengkapi semua field yang wajib diisi sebelum melanjutkan.';
                    return false;
                }
            }
            this.errorMessage = '';
            return true;
        }
    }">

    <!-- MAIN CARD -->
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
        <div class="w-full md:w-1/2 relative flex flex-col items-center justify-center px-5 py-8 sm:px-8 sm:py-10 md:px-10 md:py-12 lg:px-16">

            <!-- STEP INDICATOR -->
            <div class="w-full max-w-xl mb-4 md:mb-0 md:absolute md:top-8 lg:top-10 md:left-8 lg:left-12 flex justify-center md:justify-start gap-2" x-show="!registered" x-cloak>
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
            <div class="relative w-full max-w-xl py-4 md:py-10" x-show="!registered" x-cloak>

                <!-- Mobile branding -->
                <div class="mb-4 text-center md:hidden">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-600">Udinus Career Center</p>
                </div>

                <!-- HEADER -->
                <div class="mb-8 md:mb-10 text-center">

                    <div class="flex justify-center mb-4 md:mb-5">
                        <div class="bg-white p-1.5 md:p-2 rounded-full">
                            <img src="/images/dcc.jpg" alt="Dinus Career Center" class="w-24 h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 object-contain">
                        </div>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-semibold text-slate-800">
                        Daftar Perusahaan
                    </h2>

                    <p class="text-slate-500 mt-3 text-base max-w-md mx-auto px-2">
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

                <!-- Validation Error Message from Alpine -->
                <div x-show="errorMessage" style="display: none;" class="mb-4 p-4 bg-amber-50 rounded-xl border border-amber-200" x-transition>
                    <p class="text-amber-600 text-sm flex items-center gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <span x-text="errorMessage"></span>
                    </p>
                </div>

                <!-- FORM — hapus @submit Alpine, biarkan submit normal ke server -->
                <form method="POST" action="/register-company" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="mb-6 flex items-center gap-2">
                        <div class="h-8 w-1 rounded-full bg-blue-600"></div>
                        <span class="text-sm font-semibold text-slate-700"
                            x-text="['Data Akun','Profil Perusahaan','Alamat Perusahaan','Contact Person'][step-1]"></span>
                    </div>

                    <!-- STEP 1 -->
                    <div id="step-1" x-show="step===1" class="space-y-5">

                        <!-- EMAIL -->
                        <div class="relative group">
                            <i data-lucide="mail"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="email" name="email" placeholder="Email Perusahaan" required
                                value="{{ old('email') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- PASSWORD -->
                        <div class="relative group">
                            <i data-lucide="lock"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="password" name="password" placeholder="Kata Sandi" required
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- CONFIRM -->
                        <div class="relative group">
                            <i data-lucide="shield-check"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                    </div>

                    <!-- STEP 2 -->
                    <div id="step-2" x-show="step===2" class="space-y-5">

                        <!-- COMPANY -->
                        <div class="relative group">
                            <i data-lucide="building-2"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" required
                                value="{{ old('nama_perusahaan') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- INDUSTRY -->
                        <div class="relative group">
                            <i data-lucide="briefcase"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="jenis_penyedia" placeholder="Industri" required
                                value="{{ old('jenis_penyedia') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- WEBSITE -->
                        <div class="relative group">
                            <i data-lucide="globe"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="website_perusahaan" placeholder="Website" required
                                value="{{ old('website_perusahaan') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- LOGO PERUSAHAAN -->
                            <div class="relative group" x-data="{ fileName: '' }">
                                <i data-lucide="image"
                                    class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2 z-10 pointer-events-none"></i>
                                
                                <label class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-300 text-base bg-white cursor-pointer focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 outline-none relative flex items-center justify-between transition-all m-0">
                                    <span class="truncate" x-text="fileName || 'Upload Logo Perusahaan (Opsional)'" 
                                        :class="fileName ? 'text-slate-800 font-medium' : 'text-slate-400'"></span>
                                    <span class="bg-slate-100 text-slate-600 text-xs px-3 py-1.5 rounded-lg font-semibold hover:bg-slate-200 transition-colors ml-2 shrink-0">
                                        Pilih File
                                    </span>
                                    <input type="file" name="logo" accept="image/*" class="sr-only"
                                        @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">
                                </label>

                                {{-- Preview logo --}}
                                <div x-show="fileName" class="mt-2 text-xs text-slate-500 flex items-center gap-1">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i>
                                    <span x-text="'File dipilih: ' + fileName"></span>
                                </div>
                            </div>

                            {{-- Error validasi logo --}}
                            @error('logo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        <!-- DESCRIPTION -->
                        <div class="relative group">
                            <i data-lucide="file-text" class="w-5 h-5 text-slate-400 absolute left-4 top-5"></i>
                            <textarea name="deskripsi_perusahaan" rows="3" placeholder="Deskripsi" required
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('deskripsi_perusahaan') }}</textarea>
                        </div>

                    </div>

                    <!-- STEP 3 -->
                    <div id="step-3" x-show="step===3" class="space-y-5">

                        <!-- ADDRESS -->
                        <div class="relative group">
                            <i data-lucide="map-pin" class="w-5 h-5 text-slate-400 absolute left-4 top-5"></i>
                            <textarea name="alamat_perusahaan" rows="2" placeholder="Alamat" required
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">{{ old('alamat_perusahaan') }}</textarea>
                        </div>

                        <!-- CITY -->
                        <div class="relative group">
                            <i data-lucide="map"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="kota" placeholder="Kota" required
                                value="{{ old('kota') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- ZIP -->
                        <div class="relative group">
                            <i data-lucide="mailbox"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="kode_pos" placeholder="Kode Pos" required
                                value="{{ old('kode_pos') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- PHONE -->
                        <div class="relative group">
                            <i data-lucide="phone"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="no_handphone" placeholder="Nomor Handphone" required
                                value="{{ old('no_handphone') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                    </div>

                    <!-- STEP 4 -->
                    <div id="step-4" x-show="step===4" class="space-y-5">

                        <!-- PERSON -->
                        <div class="relative group">
                            <i data-lucide="user"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="nama_cp" placeholder="Nama Contact Person" required
                                value="{{ old('nama_cp') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- PHONE -->
                        <div class="relative group">
                            <i data-lucide="phone"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="no_telepon" placeholder="Nomor Telepon" required
                                value="{{ old('no_telepon') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- No Fax -->
                        <div class="relative group">
                            <i data-lucide="phone"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="no_fax" placeholder="Nomor Fax (Opsional)"
                                value="{{ old('no_fax') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                        <!-- ROLE -->
                        <div class="relative group">
                            <i data-lucide="badge-check"
                                class="w-5 h-5 text-slate-400 group-focus-within:text-blue-600 absolute left-4 top-1/2 -translate-y-1/2"></i>
                            <input type="text" name="jabatan" placeholder="Jabatan" required
                                value="{{ old('jabatan') }}"
                                class="w-full pl-12 pr-4 py-4 rounded-xl border border-slate-300 text-base
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-6">

                        <!-- BACK -->
                        <button type="button" x-show="step>1" @click="step--"
                            class="px-5 py-4 rounded-xl bg-slate-100 text-slate-600 text-base
                            hover:bg-slate-200 transition sm:shrink-0">
                            ← Kembali
                        </button>

                        <!-- NEXT -->
                        <button type="button" x-show="step<4" @click="if(validateStep()) step++"
                            class="flex-1 bg-blue-600 text-white py-4 rounded-xl
                            hover:bg-blue-500 active:bg-blue-700 transition font-semibold text-base">
                            Selanjutnya →
                        </button>

                        <!-- SUBMIT -->
                        <button type="button" x-show="step===4" @click="if(validateStep()) $el.closest('form').submit()"
                            class="flex-1 bg-blue-600 text-white py-4 rounded-xl
                            hover:bg-blue-500 active:bg-blue-700 transition font-semibold text-base">
                            Kirim Pendaftaran
                        </button>

                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Sudah punya akun?
                    <a href="/login" class="font-semibold text-blue-600 hover:text-blue-500 hover:underline transition">
                        Login
                    </a>
                </p>
            </div>

            <!-- SUCCESS -->
            <div x-show="registered" x-cloak x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                class="w-full max-w-lg px-5 sm:px-10 py-10 sm:py-14 text-center z-10">

                <div
                    class="mx-auto w-20 h-20 rounded-full bg-linear-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30 mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h2 class="text-2xl sm:text-3xl font-semibold text-slate-800">Pendaftaran Berhasil!</h2>
                <p class="text-slate-400 mt-3 text-sm sm:text-base leading-relaxed max-w-sm mx-auto px-2">
                    Akun perusahaan Anda sedang diverifikasi oleh admin. Kami akan menghubungi Anda melalui email.
                </p>

                <a href="/login"
                    class="mt-8 inline-flex items-center gap-2 bg-linear-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl font-semibold text-sm hover:from-blue-500 hover:to-indigo-500 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all duration-200 hover:scale-[1.02]">
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
        document.addEventListener('alpine:initialized', () => lucide.createIcons());
    </script>
</body>

</html>
