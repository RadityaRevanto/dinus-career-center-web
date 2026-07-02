@extends('company.layouts.app')
@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Profil Perusahaan</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi perusahaan Anda yang tampil di halaman lowongan.</p>
    </div>


    @if(session('error'))
        <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @if(($data['status_verifikasi'] ?? session('company_status')) === 'rejected')
        <div class="p-5 bg-rose-50 border border-rose-200 rounded-2xl">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 shrink-0 text-rose-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                <div>
                    <h3 class="text-sm font-semibold text-rose-800">Akun perusahaan ditolak</h3>
                    <p class="text-sm text-rose-700 mt-1">Anda hanya dapat mengakses halaman profil. Silakan perbaiki data sesuai alasan penolakan yang dikirim melalui email, lalu klik <strong>Simpan Perubahan</strong> untuk mengajukan review ulang.</p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        <!-- Grid Layout: 2 columns -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Col 1: Identitas Perusahaan -->
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900">Identitas Perusahaan</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Logo dan nama perusahaan.</p>
                </div>
                <div class="p-6 flex-1 flex flex-col gap-4">
                    <!-- Logo -->
                    <div x-data="{ preview: '{{ $data['logo'] ?? '' }}' }" class="flex justify-center">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 flex items-center justify-center overflow-hidden group-hover:border-blue-400 transition">
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover rounded-2xl" />
                                </template>
                                <template x-if="!preview">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                    </svg>
                                </template>
                            </div>
                            <label class="absolute inset-0 cursor-pointer">
                                <input type="file" name="logo" accept="image/*" class="hidden"
                                    @change="preview = URL.createObjectURL($event.target.files[0])">
                            </label>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 text-center -mt-2">Klik logo untuk ubah</p>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $data['nama_perusahaan'] ?? '') }}" required
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Deskripsi Perusahaan</label>
                        <textarea name="deskripsi_perusahaan" rows="4"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition resize-none">{{ old('deskripsi_perusahaan', $data['deskripsi_perusahaan'] ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Jenis Penyedia</label>
                        <select name="jenis_penyedia"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                            <option value="">— Pilih Jenis —</option>
                            <option value="Swasta" {{ old('jenis_penyedia', $data['jenis_penyedia'] ?? '') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                            <option value="BUMN" {{ old('jenis_penyedia', $data['jenis_penyedia'] ?? '') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                            <option value="Pemerintahan" {{ old('jenis_penyedia', $data['jenis_penyedia'] ?? '') == 'Pemerintahan' ? 'selected' : '' }}>Pemerintahan</option>
                            <option value="Startup" {{ old('jenis_penyedia', $data['jenis_penyedia'] ?? '') == 'Startup' ? 'selected' : '' }}>Startup</option>
                            <option value="NGO" {{ old('jenis_penyedia', $data['jenis_penyedia'] ?? '') == 'NGO' ? 'selected' : '' }}>NGO</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">Website Perusahaan</label>
                        <input type="url" name="website_perusahaan" value="{{ old('website_perusahaan', $data['website_perusahaan'] ?? '') }}" placeholder="https://"
                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Col 2: Kontak & Alamat -->
            <div class="flex flex-col gap-6">

                <!-- Informasi Kontak -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">Informasi Kontak</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Detail kontak dan narahubung.</p>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Nama Contact Person <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_cp" value="{{ old('nama_cp', $data['nama_cp'] ?? '') }}" required
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" name="jabatan" value="{{ old('jabatan', $data['jabatan'] ?? '') }}" required
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Email Perusahaan</label>
                            <input type="email" value="{{ $data['email_perusahaan'] ?? '' }}" disabled
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-100 text-gray-500 cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">No. Handphone <span class="text-red-500">*</span></label>
                            <input type="text" name="no_handphone" value="{{ old('no_handphone', $data['no_handphone'] ?? '') }}" required
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">No. Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $data['no_telepon'] ?? '') }}"
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">No. Fax</label>
                            <input type="text" name="no_fax" value="{{ old('no_fax', $data['no_fax'] ?? '') }}"
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- Alamat & Lokasi -->
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">Alamat & Lokasi</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Alamat lengkap kantor perusahaan.</p>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Alamat Perusahaan <span class="text-red-500">*</span></label>
                            <textarea name="alamat_perusahaan" rows="3" required
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition resize-none">{{ old('alamat_perusahaan', $data['alamat_perusahaan'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Kota <span class="text-red-500">*</span></label>
                            <input type="text" name="kota" value="{{ old('kota', $data['kota'] ?? '') }}" required
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">Kode Pos <span class="text-red-500">*</span></label>
                            <input type="text" name="kode_pos" value="{{ old('kode_pos', $data['kode_pos'] ?? '') }}" required
                                class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Validation Errors -->
        @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Submit -->
        <div class="flex items-center justify-end gap-3 pb-4">
            @if(($data['status_verifikasi'] ?? session('company_status')) !== 'rejected')
            <a href="{{ route('overview') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                Batal
            </a>
            @endif
            <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-sm hover:shadow transition">
                {{ ($data['status_verifikasi'] ?? session('company_status')) === 'rejected' ? 'Simpan & Ajukan Review Ulang' : 'Simpan Perubahan' }}
            </button>
        </div>
    </form>
</div>
@endsection
