@extends('company.layouts.app')
@section('content')
<div class="space-y-6">

    <!-- Greeting -->
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Selamat Datang! 👋</h2>
        <p class="text-sm text-gray-500 mt-1">Berikut ringkasan aktivitas rekrutmen perusahaan Anda.</p>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <!-- Lowongan Aktif -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:shadow-lg hover:border-blue-200 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    12%
                </span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">8</h3>
            <p class="text-xs text-gray-500 mt-1">Lowongan Aktif</p>
        </div>
        <!-- Total Pelamar -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:shadow-lg hover:border-amber-200 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition">
                    <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    30%
                </span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">124</h3>
            <p class="text-xs text-gray-500 mt-1">Total Pelamar</p>
        </div>
        <!-- Sedang Diproses -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:shadow-lg hover:border-indigo-200 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-100 transition">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-full">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                    0%
                </span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">37</h3>
            <p class="text-xs text-gray-500 mt-1">Sedang Diproses</p>
        </div>
        <!-- Diterima -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    18%
                </span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">15</h3>
            <p class="text-xs text-gray-500 mt-1">Pelamar Diterima</p>
        </div>
    </div>

    <!-- Statistics Charts -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Tren Pelamar (Line Chart) -->
        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h5 class="text-sm font-semibold text-gray-900">Tren Pelamar</h5>
                    <p class="text-xs text-gray-400 mt-0.5">Jumlah pelamar masuk 6 bulan terakhir</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <span class="text-xs text-gray-500">Pelamar Masuk</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-xs text-gray-500">Diterima</span>
                    </div>
                </div>
            </div>
            <div class="h-56">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <!-- Status Pelamar (Doughnut Chart) -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5">
            <div class="mb-6">
                <h5 class="text-sm font-semibold text-gray-900">Status Pelamar</h5>
                <p class="text-xs text-gray-400 mt-0.5">Distribusi status seluruh pelamar</p>
            </div>
            <div class="flex items-center justify-center h-44">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="grid grid-cols-2 gap-2 mt-5">
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-amber-50/60">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <span class="text-xs text-gray-600">Review</span>
                    <span class="text-xs font-semibold text-gray-900 ml-auto">45</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-50/60">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <span class="text-xs text-gray-600">Interview</span>
                    <span class="text-xs font-semibold text-gray-900 ml-auto">37</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-50/60">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-xs text-gray-600">Diterima</span>
                    <span class="text-xs font-semibold text-gray-900 ml-auto">15</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-red-50/60">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-xs text-gray-600">Ditolak</span>
                    <span class="text-xs font-semibold text-gray-900 ml-auto">27</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-12 gap-6">

        <!-- LEFT: Lamaran Terbaru -->
        <div class="col-span-12 xl:col-span-8">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                <div class="flex items-center justify-between p-5 border-b border-gray-100">
                    <h5 class="text-sm font-semibold text-gray-900">Lamaran Terbaru</h5>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Cari pelamar..."
                            class="pl-9 pr-3 py-2 text-xs border border-gray-200 rounded-lg bg-gray-50/50 focus:bg-white focus:border-blue-300 focus:ring-2 focus:ring-blue-100 outline-none transition w-44">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50/80">
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Pelamar</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Posisi</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Tanggal</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Floyd+Miles&background=3b82f6&color=fff&size=32" class="w-8 h-8 rounded-full" />
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Floyd Miles</p>
                                            <p class="text-xs text-gray-400">floydmiles@mail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-5 text-xs text-gray-600">UI/UX Designer</td>
                                <td class="py-3.5 px-5 text-xs text-gray-500">24 Jun 2025</td>
                                <td class="py-3.5 px-5">
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Review
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Jane+Cooper&background=8b5cf6&color=fff&size=32" class="w-8 h-8 rounded-full" />
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Jane Cooper</p>
                                            <p class="text-xs text-gray-400">janecooper@mail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-5 text-xs text-gray-600">Frontend Developer</td>
                                <td class="py-3.5 px-5 text-xs text-gray-500">23 Jun 2025</td>
                                <td class="py-3.5 px-5">
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Diterima
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Emily+Johnson&background=f59e0b&color=fff&size=32" class="w-8 h-8 rounded-full" />
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Emily Johnson</p>
                                            <p class="text-xs text-gray-400">emilyjohnson@mail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-5 text-xs text-gray-600">Backend Developer</td>
                                <td class="py-3.5 px-5 text-xs text-gray-500">22 Jun 2025</td>
                                <td class="py-3.5 px-5">
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Interview
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Olivia+Carter&background=ec4899&color=fff&size=32" class="w-8 h-8 rounded-full" />
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Olivia Carter</p>
                                            <p class="text-xs text-gray-400">oliviacarter@mail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-5 text-xs text-gray-600">Data Analyst</td>
                                <td class="py-3.5 px-5 text-xs text-gray-500">20 Jun 2025</td>
                                <td class="py-3.5 px-5">
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-red-700 bg-red-50 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Ditolak
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Ethan+Miller&background=06b6d4&color=fff&size=32" class="w-8 h-8 rounded-full" />
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Ethan Miller</p>
                                            <p class="text-xs text-gray-400">ethanmiller@mail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-5 text-xs text-gray-600">DevOps Engineer</td>
                                <td class="py-3.5 px-5 text-xs text-gray-500">19 Jun 2025</td>
                                <td class="py-3.5 px-5">
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Review
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-xs text-gray-400">Menampilkan 5 dari 124 pelamar</p>
                    <a href="{{ route('applicants') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 transition">Lihat Semua →</a>
                </div>
            </div>
        </div>

        <!-- RIGHT Column -->
        <div class="col-span-12 xl:col-span-4 flex flex-col gap-6">

            <!-- Jadwal Interview -->
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-sm font-semibold text-gray-900">Jadwal Interview</h5>
                    <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2.5 py-1 rounded-lg">Hari Ini</span>
                </div>
                <div class="space-y-4">
                    <!-- Interview 1 -->
                    <div class="relative pl-4 border-l-2 border-indigo-500 py-1">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">User Interview</span>
                            <span class="text-xs text-gray-400">09:00</span>
                        </div>
                        <h6 class="text-sm font-semibold text-gray-900">UI/UX Designer</h6>
                        <p class="text-xs text-gray-500 mt-0.5">Ethan Miller • Head of Design</p>
                    </div>
                    <!-- Interview 2 -->
                    <div class="relative pl-4 border-l-2 border-amber-500 py-1">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">Technical Test</span>
                            <span class="text-xs text-gray-400">10:30</span>
                        </div>
                        <h6 class="text-sm font-semibold text-gray-900">Frontend Developer</h6>
                        <p class="text-xs text-gray-500 mt-0.5">Emily Johnson • Live Coding</p>
                    </div>
                    <!-- Interview 3 -->
                    <div class="relative pl-4 border-l-2 border-emerald-500 py-1">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">HR Interview</span>
                            <span class="text-xs text-gray-400">13:00</span>
                        </div>
                        <h6 class="text-sm font-semibold text-gray-900">Backend Developer</h6>
                        <p class="text-xs text-gray-500 mt-0.5">Olivia Carter • Human Resources</p>
                    </div>
                </div>
            </div>

            <!-- Lowongan Aktif -->
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-sm font-semibold text-gray-900">Lowongan Aktif</h5>
                    <a href="{{ route('jobs') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 transition">Kelola →</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-gray-100/80 transition group">
                        <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Frontend Developer</p>
                            <p class="text-xs text-gray-400">12 pelamar • Ditutup 30 Jun</p>
                        </div>
                        <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500"></span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-gray-100/80 transition group">
                        <div class="w-9 h-9 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">UI/UX Designer</p>
                            <p class="text-xs text-gray-400">8 pelamar • Ditutup 15 Jul</p>
                        </div>
                        <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500"></span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-gray-100/80 transition group">
                        <div class="w-9 h-9 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Data Analyst</p>
                            <p class="text-xs text-gray-400">5 pelamar • Ditutup 20 Jul</p>
                        </div>
                        <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500"></span>
                    </div>
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-gray-100/80 transition group">
                        <div class="w-9 h-9 rounded-lg bg-cyan-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">DevOps Engineer</p>
                            <p class="text-xs text-gray-400">3 pelamar • Ditutup 25 Jul</p>
                        </div>
                        <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500"></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tren Pelamar - Line Chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                {
                    label: 'Pelamar Masuk',
                    data: [18, 25, 32, 28, 42, 38],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.08)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                },
                {
                    label: 'Diterima',
                    data: [5, 8, 10, 7, 15, 12],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.06)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, family: 'Montserrat' }, color: '#9ca3af' }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: { font: { size: 11, family: 'Montserrat' }, color: '#9ca3af', stepSize: 10 }
                }
            },
            interaction: { intersect: false, mode: 'index' },
        }
    });

    // Status Pelamar - Doughnut Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Review', 'Interview', 'Diterima', 'Ditolak'],
            datasets: [{
                data: [45, 37, 15, 27],
                backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    titleFont: { family: 'Montserrat', size: 12 },
                    bodyFont: { family: 'Montserrat', size: 11 },
                    padding: 10,
                    cornerRadius: 8,
                }
            }
        }
    });
});
</script>
@endsection