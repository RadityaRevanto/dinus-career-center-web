@extends('company.layouts.app')

@section('content')
<div class="space-y-8">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Buat Lowongan Baru</h1>
            </div>
            <p class="text-sm text-gray-500">Isi detail lowongan pekerjaan untuk menarik kandidat terbaik.</p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">{{ session('error') }}</div>
    @endif

    <!-- Main Form Container -->
    <form action="{{ route('jobs.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
        @csrf
        
        <!-- Section 1: Informasi Dasar -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden relative h-fit">
                <div class="p-8">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900">Informasi Dasar</h2>
                        <p class="text-sm text-gray-500 mt-1">Detail utama mengenai posisi pekerjaan yang dibuka.</p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Lowongan <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Cth: Senior UI/UX Designer" class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200" required>
                            </div>
                            @error('judul')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan_id" class="block text-sm font-semibold text-gray-700 mb-2">Jabatan <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <select id="jabatan_id" name="jabatan_id" class="block w-full pl-12 pr-10 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer" required>
                                    <option value="" disabled selected>Pilih jabatan</option>
                                    @foreach($jabatan as $j)
                                    <option value="{{ $j['jabatan_id'] }}" {{ old('jabatan_id') == $j['jabatan_id'] ? 'selected' : '' }}>{{ $j['nama'] }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('jabatan_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Tipe Pekerjaan -->
                        <div>
                            <label for="tipe_pekerjaan_id" class="block text-sm font-semibold text-gray-700 mb-2">Tipe Pekerjaan <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <select id="tipe_pekerjaan_id" name="tipe_pekerjaan_id" class="block w-full pl-12 pr-10 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer" required>
                                    <option value="" disabled selected>Pilih tipe pekerjaan</option>
                                    @foreach($tipePekerjaan as $tp)
                                    <option value="{{ $tp['tipe_pekerjaan_id'] }}" {{ old('tipe_pekerjaan_id') == $tp['tipe_pekerjaan_id'] ? 'selected' : '' }}>{{ $tp['nama'] }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('tipe_pekerjaan_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Jurusan -->
                        <div>
                            <label for="jurusan_id" class="block text-sm font-semibold text-gray-700 mb-2">Jurusan <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                </div>
                                <select id="jurusan_id" name="jurusan_id" class="block w-full pl-12 pr-10 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer" required>
                                    <option value="" disabled selected>Pilih jurusan</option>
                                    @foreach($jurusan as $jr)
                                    <option value="{{ $jr['jurusan_id'] }}" {{ old('jurusan_id') == $jr['jurusan_id'] ? 'selected' : '' }}>{{ $jr['nama'] }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('jurusan_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Sektor -->
                        <div>
                            <label for="sektor_id" class="block text-sm font-semibold text-gray-700 mb-2">Sektor Industri <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <select id="sektor_id" name="sektor_id" class="block w-full pl-12 pr-10 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer" required>
                                    <option value="" disabled selected>Pilih sektor industri</option>
                                    @foreach($sektor as $s)
                                    <option value="{{ $s['sektor_id'] }}" {{ old('sektor_id') == $s['sektor_id'] ? 'selected' : '' }}>{{ $s['nama'] }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('sektor_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Tambahan -->
            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden relative h-fit">
                <div class="p-8">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900">Informasi Tambahan</h2>
                        <p class="text-sm text-gray-500 mt-1">Detail kuota, gaji, dan batas waktu pendaftaran.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Jumlah Person -->
                        <div>
                            <label for="jumlah_person" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Posisi <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <input type="number" id="jumlah_person" name="jumlah_person" value="{{ old('jumlah_person', 1) }}" min="1" placeholder="Cth: 3" class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200" required>
                            </div>
                            @error('jumlah_person')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Batas Akhir -->
                        <div>
                            <label for="batas_akhir" class="block text-sm font-semibold text-gray-700 mb-2">Batas Akhir Pendaftaran <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="date" id="batas_akhir" name="batas_akhir" value="{{ old('batas_akhir') }}" class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200" required>
                            </div>
                            @error('batas_akhir')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Salary Range -->
                        <div>
                            <label for="range_gaji" class="block text-sm font-semibold text-gray-700 mb-2">Rentang Gaji <span class="text-gray-400 font-normal ml-1">(Opsional)</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium group-focus-within:text-indigo-500 transition-colors text-sm">Rp</span>
                                </div>
                                <input type="text" id="range_gaji" name="range_gaji" value="{{ old('range_gaji') }}" placeholder="Cth: 5.000.000 - 8.000.000" class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Detail Pekerjaan -->
        <div class="lg:col-span-7 bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden h-fit">
            <div class="p-8">
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900">Detail Pekerjaan</h2>
                    <p class="text-sm text-gray-500 mt-1">Deskripsikan peran dan persyaratan dengan jelas.</p>
                </div>

                <div class="space-y-6">
                    <!-- Detail Lowongan -->
                    <div>
                        <label for="detail_lowongan" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Pekerjaan <span class="text-rose-500">*</span></label>
                        <div class="border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition-all duration-200 bg-white">
                            <div class="bg-gray-50/80 border-b border-gray-200 px-3 py-2 flex items-center gap-1">
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path></svg>
                                </button>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </button>
                                <div class="w-px h-4 bg-gray-300 mx-1"></div>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Bullet List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>
                            </div>
                            <textarea id="detail_lowongan" name="detail_lowongan" rows="6" class="block w-full px-4 py-3 border-0 focus:ring-0 text-sm focus:outline-none bg-transparent resize-y placeholder-gray-400" placeholder="Jelaskan tanggung jawab utama dan konteks pekerjaan ini...">{{ old('detail_lowongan') }}</textarea>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <label for="requirements" class="block text-sm font-semibold text-gray-700 mb-2">Persyaratan & Kualifikasi <span class="text-rose-500">*</span></label>
                        <div class="border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition-all duration-200 bg-white">
                            <div class="bg-gray-50/80 border-b border-gray-200 px-3 py-2 flex items-center gap-1">
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path></svg>
                                </button>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </button>
                                <div class="w-px h-4 bg-gray-300 mx-1"></div>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors" title="Bullet List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>
                            </div>
                            <textarea id="requirements" name="requirements" rows="6" class="block w-full px-4 py-3 border-0 focus:ring-0 text-sm focus:outline-none bg-transparent resize-y placeholder-gray-400" placeholder="Sebutkan kualifikasi, keahlian, dan pengalaman yang dibutuhkan...">{{ old('requirements') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="lg:col-span-12 flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
            <a href="{{ route('jobs') }}" class="px-6 py-3 text-sm font-semibold text-gray-600 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-200">
                Batal
            </a>
            <button type="submit" class="group relative inline-flex items-center justify-center px-8 py-3 text-sm font-bold text-white transition-all duration-200 bg-indigo-600 border border-transparent rounded-xl shadow-md hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                <span>Publish Lowongan</span>
                <svg class="w-5 h-5 ml-2 -mr-1 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection