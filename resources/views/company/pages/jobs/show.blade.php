@extends('company.layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Hero Header -->
    <div class="bg-white rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] border border-gray-100 p-8 md:p-10 relative overflow-hidden">
        <!-- Decorative bg -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 "></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-start justify-between gap-6">
            <div class="flex gap-6">
                <div class="hidden sm:flex flex-shrink-0 h-20 w-20 items-center justify-center rounded-2xl border border-gray-100 bg-white shadow-sm">
                    <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Frontend Developer</h1>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Aktif
                        </span>
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-sm font-medium text-gray-500 mt-4">
                        <span class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Full-time
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Jakarta, Indonesia
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Rp 8jt - Rp 12jt
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex flex-shrink-0 items-center gap-3 mt-2 md:mt-0">
                <a href="{{ route('jobs.edit', 1) ?? '#' }}" class="group px-5 py-2.5 text-sm font-bold text-gray-700 bg-white border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Lowongan
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat 1 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pelamar</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">32</p>
                </div>
            </div>
        </div>
        <!-- Stat 2 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Review</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">15</p>
                </div>
            </div>
        </div>
        <!-- Stat 3 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-sky-50 text-sky-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Tahap Wawancara</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">10</p>
                </div>
            </div>
        </div>
        <!-- Stat 4 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Diterima (Hired)</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">4</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout Container -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Applicant Table -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
                <!-- Table Header & Toolbar -->
                <div class="p-6 sm:px-8 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Daftar Pelamar</h2>
                        <p class="text-sm text-gray-500 mt-1">Kelola dan tinjau kandidat yang melamar.</p>
                    </div>
                    <div class="relative w-full sm:max-w-xs">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 bg-gray-50/50 hover:bg-gray-100/50 rounded-xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" placeholder="Cari nama pelamar...">
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/80">
                            <tr>
                                <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Profil Pelamar
                                </th>
                                <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Dokumen / Match
                                </th>
                                <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 sm:px-8 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <!-- Applicant 1 -->
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <img class="h-11 w-11 rounded-full object-cover border border-gray-200 shadow-sm" src="https://ui-avatars.com/api/?name=John+Doe&background=e0e7ff&color=4f46e5&bold=true" alt="">
                                        <div>
                                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">John Doe</div>
                                            <div class="text-xs text-gray-500 mt-1">john.doe@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <div class="flex flex-col gap-2">
                                        <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg text-xs font-semibold transition-colors w-fit border border-gray-200 hover:border-indigo-200">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            Resume.pdf
                                        </button>
                                        <div class="flex items-center gap-2 mt-1">
                                            <div class="w-24 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="bg-emerald-500 h-full w-[92%]"></div>
                                            </div>
                                            <span class="text-xs font-bold text-emerald-600">92% Match</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Pending Review
                                    </span>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap text-right">
                                    <div class="relative inline-block text-left">
                                        <button type="button" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors border border-indigo-100 focus:outline-none">
                                            Tindakan
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Applicant 2 -->
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <img class="h-11 w-11 rounded-full object-cover border border-gray-200 shadow-sm" src="https://ui-avatars.com/api/?name=Jane+Smith&background=fce7f3&color=db2777&bold=true" alt="">
                                        <div>
                                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Jane Smith</div>
                                            <div class="text-xs text-gray-500 mt-1">jane.smith@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <div class="flex flex-col gap-2">
                                        <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg text-xs font-semibold transition-colors w-fit border border-gray-200 hover:border-indigo-200">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            Portfolio.pdf
                                        </button>
                                        <div class="flex items-center gap-2 mt-1">
                                            <div class="w-24 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="bg-indigo-500 h-full w-[85%]"></div>
                                            </div>
                                            <span class="text-xs font-bold text-indigo-600">85% Match</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-100 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                        Tahap Wawancara
                                    </span>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap text-right">
                                    <div class="relative inline-block text-left">
                                        <button type="button" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors border border-indigo-100 focus:outline-none">
                                            Tindakan
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Applicant 3 -->
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <img class="h-11 w-11 rounded-full object-cover border border-gray-200 shadow-sm" src="https://ui-avatars.com/api/?name=Alex+Johnson&background=dcfce3&color=166534&bold=true" alt="">
                                        <div>
                                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Alex Johnson</div>
                                            <div class="text-xs text-gray-500 mt-1">alex.j@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <div class="flex flex-col gap-2">
                                        <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg text-xs font-semibold transition-colors w-fit border border-gray-200 hover:border-indigo-200">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            CV_Alex.pdf
                                        </button>
                                        <div class="flex items-center gap-2 mt-1">
                                            <div class="w-24 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="bg-emerald-500 h-full w-[98%]"></div>
                                            </div>
                                            <span class="text-xs font-bold text-emerald-600">98% Match</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Diterima (Hired)
                                    </span>
                                </td>
                                <td class="px-6 sm:px-8 py-5 whitespace-nowrap text-right">
                                    <div class="relative inline-block text-left">
                                        <button type="button" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-colors border border-indigo-100 focus:outline-none">
                                            Tindakan
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Job Description Summary -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] p-6 sm:p-8 sticky top-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Posisi</h3>
                
                <div class="space-y-6">
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 mb-2">Deskripsi Pekerjaan</h4>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Kami mencari Frontend Developer berpengalaman untuk bergabung dengan tim dinamis kami. Anda akan bertanggung jawab untuk membangun antarmuka pengguna yang interaktif dan responsif.
                        </p>
                    </div>
                    
                    <div class="border-t border-gray-100 pt-6">
                        <h4 class="text-sm font-bold text-gray-900 mb-3">Kualifikasi Utama</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-2.5 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Minimal 2 tahun pengalaman dengan React atau Vue.js
                            </li>
                            <li class="flex items-start gap-2.5 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Pemahaman kuat HTML5, CSS3, dan JS (ES6+)
                            </li>
                            <li class="flex items-start gap-2.5 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Terbiasa dengan integrasi API & Git
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div>
@endsection