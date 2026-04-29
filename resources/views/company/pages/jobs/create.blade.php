@extends('company.layouts.app')

@section('content')
<div class="space-y-8">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Buat Lowongan Baru</h1>
            </div>
            <p class="text-sm text-gray-500 ">Isi detail lowongan pekerjaan untuk menarik kandidat terbaik.</p>
        </div>
    </div>

    <!-- Main Form Container -->
    <form action="#" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
        @csrf
        
        <!-- Section 1: Informasi Dasar -->
        <div class="lg:col-span-5 bg-white border border-gray-100 rounded-3xl overflow-hidden relative h-fit">
            <div class="absolute top-0 left-0 w-full h-1 "></div>
            <div class="p-8">
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900">Informasi Dasar</h2>
                    <p class="text-sm text-gray-500 mt-1">Detail utama mengenai posisi pekerjaan yang dibuka.</p>
                </div>
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Job Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Posisi Pekerjaan <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="Cth: Senior UI/UX Designer" 
                            class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200" 
                            required
                        >                        </div>
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Tipe Pekerjaan <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <select id="type" name="type" class="block w-full pl-12 pr-10 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer">
                                <option value="" disabled selected>Pilih tipe pekerjaan</option>
                                <option>Full-time</option>
                                <option>Part-time</option>
                                <option>Contract</option>
                                <option>Internship</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Workplace Type -->
                    <div>
                        <label for="workplace" class="block text-sm font-semibold text-gray-700 mb-2">Sistem Kerja <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <select id="workplace" name="workplace" class="block w-full pl-12 pr-10 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer">
                                <option value="" disabled selected>Pilih sistem kerja</option>
                                <option>On-site (WFO)</option>
                                <option>Hybrid</option>
                                <option>Remote (WFH)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Salary Range -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Rentang Gaji <span class="text-gray-400 font-normal ml-1">(Opsional)</span></label>
                        <div class="flex items-center gap-4">
                            <div class="relative w-full group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium group-focus-within:text-indigo-500 transition-colors">Rp</span>
                                </div>
                                <input type="text" placeholder="Min" class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200">
                            </div>
                            <span class="text-gray-300 font-bold">-</span>
                            <div class="relative w-full group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium group-focus-within:text-indigo-500 transition-colors">Rp</span>
                                </div>
                                <input type="text" placeholder="Max" class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200">
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
                    <!-- Job Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Pekerjaan <span class="text-rose-500">*</span></label>
                        <div class="border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition-all duration-200 bg-white">
                            <div class="bg-gray-50/80 border-b border-gray-200 px-3 py-2 flex items-center gap-1">
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors tooltip" title="Bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path></svg>
                                </button>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors tooltip" title="Italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </button>
                                <div class="w-px h-4 bg-gray-300 mx-1"></div>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors tooltip" title="Bullet List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>
                            </div>
                            <textarea id="description" name="description" rows="3" class="block w-full px-4 py-3 border-0 focus:ring-0 text-sm focus:outline-none bg-transparent resize-y placeholder-gray-400" placeholder="Jelaskan tanggung jawab utama dan konteks pekerjaan ini..."></textarea>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <label for="requirements" class="block text-sm font-semibold text-gray-700 mb-2">Persyaratan & Kualifikasi <span class="text-rose-500">*</span></label>
                        <div class="border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition-all duration-200 bg-white">
                            <div class="bg-gray-50/80 border-b border-gray-200 px-3 py-2 flex items-center gap-1">
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors tooltip" title="Bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"></path></svg>
                                </button>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors tooltip" title="Italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </button>
                                <div class="w-px h-4 bg-gray-300 mx-1"></div>
                                <button type="button" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded transition-colors tooltip" title="Bullet List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                </button>
                            </div>
                            <textarea id="requirements" name="requirements" rows="4" class="block w-full px-4 py-3 border-0 focus:ring-0 text-sm focus:outline-none bg-transparent resize-y placeholder-gray-400" placeholder="Sebutkan kualifikasi, keahlian, dan pengalaman yang dibutuhkan..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="lg:col-span-12 flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
            <a href="#" class="px-6 py-3 text-sm font-semibold text-gray-600 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-200">
                Batal
            </a>
            <button type="button" onclick="alert('Simulasi: Lowongan Berhasil Dipublish!')" class="group relative inline-flex items-center justify-center px-8 py-3 text-sm font-bold text-white transition-all duration-200 bg-indigo-600 border border-transparent rounded-xl shadow-md hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                <span>Publish Lowongan</span>
                <svg class="w-5 h-5 ml-2 -mr-1 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection