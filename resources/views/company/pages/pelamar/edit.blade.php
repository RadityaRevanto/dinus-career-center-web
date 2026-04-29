
<div class="max-w-screen-2xl mx-auto p-6 sm:p-10 space-y-8">
    
    <!-- Navigation / Breadcrumb -->
    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('applicants') }}" class="p-2 -ml-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div class="flex items-center text-sm text-gray-500 font-medium">
                <a href="{{ route('applicants') }}" class="hover:text-indigo-600 transition-colors">Pelamar</a>
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-gray-900">Detail Kandidat</span>
            </div>
        </div>
        
        <!-- Status Indicator -->
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-semibold bg-sky-50 text-sky-700 border border-sky-100 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
            Tahap Wawancara
        </span>
    </div>

    <!-- Candidate Header Card -->
    <div class="bg-white rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] border border-gray-100 p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-sky-500/10 to-indigo-500/10 rounded-full blur-3xl pointer-events-none -mt-20 -mr-20"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <img class="h-24 w-24 rounded-2xl object-cover border-4 border-white shadow-lg" src="https://ui-avatars.com/api/?name=Jane+Smith&background=fce7f3&color=db2777&bold=true&size=128" alt="">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Jane Smith</h1>
                    <p class="text-lg font-medium text-indigo-600 mt-1">UI/UX Designer</p>
                    
                    <div class="flex flex-wrap items-center gap-4 text-sm font-medium text-gray-500 mt-4">
                        <span class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            jane.smith@example.com
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            +62 812 3456 7890
                        </span>
                        <span class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-lg border border-gray-100">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Dilamar 3 hari yang lalu
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col gap-2 bg-gray-50 p-4 rounded-2xl border border-gray-100 min-w-[200px]">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Skor Kecocokan</p>
                <div class="flex items-end gap-3 mt-1">
                    <span class="text-4xl font-black text-indigo-600">85<span class="text-2xl text-indigo-400">%</span></span>
                    <div class="w-full h-2.5 bg-gray-200 rounded-full mb-1.5 overflow-hidden">
                        <div class="bg-indigo-600 h-full rounded-full" style="width: 85%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Layout Grid -->
    <form action="#" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf
        @method('PUT')
        
        <!-- Left Column: Document & Analysis -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- Document Preview -->
            <div class="bg-white rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] border border-gray-100 overflow-hidden flex flex-col h-[600px]">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-rose-50 text-rose-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Portfolio_JaneSmith_2023.pdf</h3>
                            <p class="text-xs text-gray-500">PDF Document • 2.4 MB</p>
                        </div>
                    </div>
                    <button type="button" class="px-4 py-2 text-sm font-semibold text-indigo-700 bg-white border border-indigo-200 hover:bg-indigo-50 rounded-xl transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Unduh
                    </button>
                </div>
                
                <!-- Mock PDF Viewer -->
                <div class="flex-1 bg-gray-100 p-8 overflow-y-auto flex justify-center">
                    <div class="bg-white w-full max-w-2xl h-[800px] shadow-sm border border-gray-200 p-12">
                        <!-- Placeholder Content for Resume -->
                        <div class="w-1/2 h-8 bg-gray-200 rounded mb-4"></div>
                        <div class="w-1/3 h-4 bg-gray-200 rounded mb-12"></div>
                        
                        <div class="w-1/4 h-6 bg-gray-200 rounded mb-4"></div>
                        <div class="w-full h-3 bg-gray-100 rounded mb-2"></div>
                        <div class="w-full h-3 bg-gray-100 rounded mb-2"></div>
                        <div class="w-5/6 h-3 bg-gray-100 rounded mb-8"></div>
                        
                        <div class="w-1/4 h-6 bg-gray-200 rounded mb-4"></div>
                        <div class="w-full h-3 bg-gray-100 rounded mb-2"></div>
                        <div class="w-full h-3 bg-gray-100 rounded mb-2"></div>
                        <div class="w-4/5 h-3 bg-gray-100 rounded mb-8"></div>
                    </div>
                </div>
            </div>
            
            <!-- Match Analysis -->
            <div class="bg-white rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Analisis Kecocokan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Keahlian (Skills) yang Cocok</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg text-sm font-medium flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Figma</span>
                            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg text-sm font-medium flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Prototyping</span>
                            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg text-sm font-medium flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> User Research</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Kekurangan / Perlu Ditanyakan</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-100 rounded-lg text-sm font-medium flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg> Pengalaman HTML/CSS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Status & Notes -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Update Status Card -->
            <div class="bg-white rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] border border-gray-100 p-8 sticky top-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Tindakan Evaluasi</h3>
                
                <div class="space-y-6">
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Ubah Status Kandidat</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <select id="status" name="status" class="block w-full pl-12 pr-10 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer">
                                <option value="pending">Pending Review</option>
                                <option value="interview" selected>Wawancara</option>
                                <option value="hired">Diterima (Hired)</option>
                                <option value="rejected">Ditolak (Rejected)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Catatan HR (Internal)</label>
                        <div class="border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition-all duration-200 bg-white">
                            <textarea id="notes" name="notes" rows="4" class="block w-full px-4 py-3 border-0 focus:ring-0 text-sm focus:outline-none bg-gray-50/50 hover:bg-white focus:bg-white resize-y placeholder-gray-400 transition-colors" placeholder="Tulis catatan mengenai kandidat ini..."></textarea>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <button type="button" onclick="alert('Simulasi: Perubahan Berhasil Disimpan!')" class="w-full group relative inline-flex items-center justify-center px-8 py-3 text-sm font-bold text-white transition-all duration-200 bg-indigo-600 border border-transparent rounded-xl shadow-md hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                            <span>Simpan Perubahan</span>
                            <svg class="w-5 h-5 ml-2 -mr-1 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Timeline / Activity -->
                <div class="mt-8 pt-8 border-t border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h4>
                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="w-2 h-2 rounded-full bg-sky-500 mt-1.5"></div>
                                <div class="w-0.5 h-full bg-gray-100 mt-1"></div>
                            </div>
                            <div class="pb-1">
                                <p class="text-sm font-medium text-gray-900">Diundang Wawancara</p>
                                <p class="text-xs text-gray-500 mt-0.5">Oleh HR Manager • Hari ini, 10:30</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="w-2 h-2 rounded-full bg-gray-300 mt-1.5"></div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Melamar Posisi</p>
                                <p class="text-xs text-gray-500 mt-0.5">3 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
</div>