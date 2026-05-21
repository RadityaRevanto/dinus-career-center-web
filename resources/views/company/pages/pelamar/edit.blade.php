@extends('company.layouts.app')
@section('content')
@php
    $pelamar  = $lamaran['pelamar'];
    $berkas   = $lamaran['berkas'];
    $lowongan = $lamaran['lowongan'];
    $foto     = $pelamar['foto_profil']
        ?? 'https://ui-avatars.com/api/?name=' . urlencode($pelamar['nama_lengkap']) . '&background=e0e7ff&color=4f46e5&bold=true&size=128';

    $statusConfig = [
        'applied'   => ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500', 'Applied'],
        'reviewed'  => ['bg-sky-50 text-sky-700 border-sky-100', 'bg-sky-500', 'Reviewed'],
        'interview' => ['bg-blue-50 text-blue-700 border-blue-100', 'bg-blue-500', 'Interview'],
        'completed' => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500', 'Completed'],
    ];
    $cfg = $statusConfig[$lamaran['status_terakhir']] ?? $statusConfig['applied'];
@endphp

<div class="space-y-8">

    <!-- Back Button & Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('applicants') }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Kandidat</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap pelamar dan evaluasi lamaran.</p>
            </div>
        </div>
        <div>
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border {{ $cfg[0] }}">
                <span class="w-2 h-2 rounded-full {{ $cfg[1] }} animate-pulse"></span>
                {{ $cfg[2] }}
            </span>
        </div>
    </div>

    <!-- 2-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Left Column: Profil Pelamar -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900">Profil Pelamar</h3>
                <p class="text-xs text-gray-400 mt-0.5">Foto, nama, dan informasi umum pelamar.</p>
            </div>
            <div class="p-6 space-y-5">
                <!-- Foto & Nama -->
                <div class="flex items-center gap-4">
                    <img src="{{ $foto }}" alt="{{ $pelamar['nama_lengkap'] }}"
                        class="w-16 h-16 rounded-2xl object-cover border border-gray-200 shadow-sm" />
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">{{ $pelamar['nama_lengkap'] }}</h4>
                        <p class="text-sm text-gray-500">{{ $pelamar['email'] ?? '-' }}</p>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-4">
                    @if(!empty($pelamar['nim']))
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">NIM</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $pelamar['nim'] }}</p>
                    </div>
                    @endif
                    @if(!empty($pelamar['bidang']))
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Bidang</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $pelamar['bidang'] }}</p>
                    </div>
                    @endif
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Posisi Dilamar</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $lowongan['judul'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Tanggal Melamar</p>
                        <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($lamaran['created_at'])->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Status Saat Ini -->
                <div class="bg-gray-50/80 rounded-xl p-3.5">
                    <p class="text-xs text-gray-400 mb-1">Status Saat Ini</p>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $cfg[0] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $cfg[1] }}"></span>
                        {{ $cfg[2] }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-6">

            <!-- Dokumen Lamaran -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900">Dokumen Lamaran</h3>
                    <p class="text-xs text-gray-400 mt-0.5">CV, portofolio, dan surat lamaran.</p>
                </div>
                <div class="p-6 space-y-4">
                    @if(!empty($berkas['cv']))
                    <div class="bg-gray-50/80 rounded-xl p-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-rose-50 text-rose-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Curriculum Vitae</p>
                                <p class="text-xs text-gray-400">PDF Document</p>
                            </div>
                        </div>
                        <a href="{{ route('applicants.berkas', ['id' => $lamaran['lamaran_id'], 'tipe' => 'cv']) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-700 bg-white border border-indigo-200 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Lihat
                        </a>
                    </div>
                    @endif

                    @if(!empty($berkas['portofolio']))
                    <div class="bg-gray-50/80 rounded-xl p-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-violet-50 text-violet-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Portofolio</p>
                                <p class="text-xs text-gray-400">Dokumen Pendukung</p>
                            </div>
                        </div>
                        <a href="{{ route('applicants.berkas', ['id' => $lamaran['lamaran_id'], 'tipe' => 'portofolio']) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-700 bg-white border border-indigo-200 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Lihat
                        </a>
                    </div>
                    @endif

                    @if(!empty($berkas['surat_lamaran']))
                    <div class="bg-gray-50/80 rounded-xl p-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-sky-50 text-sky-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Surat Lamaran</p>
                                <p class="text-xs text-gray-400">Dokumen Pendukung</p>
                            </div>
                        </div>
                        <a href="{{ route('applicants.berkas', ['id' => $lamaran['lamaran_id'], 'tipe' => 'surat_lamaran']) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-700 bg-white border border-indigo-200 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Lihat
                        </a>
                    </div>
                    @endif
                    
                    @if(empty($berkas['cv']) && empty($berkas['portofolio']) && empty($berkas['surat_lamaran']))
                    <div class="text-center py-6 text-gray-400">
                        <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p class="text-sm font-medium">Tidak ada dokumen</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Catatan HR -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900">Catatan HR</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Catatan internal mengenai kandidat ini.</p>
                </div>
                <div class="p-6">
                    <textarea id="notes" name="notes" rows="4"
                        class="block w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-gray-50/50 hover:bg-white focus:bg-white resize-y placeholder-gray-400 transition-all duration-200"
                        placeholder="Tulis catatan mengenai kandidat ini..."></textarea>
                </div>
            </div>

        </div>
    </div>

    <!-- Action Bar -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-500">Ubah status evaluasi kandidat ini.</p>
        <div class="flex items-center gap-3">
            <!-- Status Select -->
            <div class="relative">
                <select id="status" name="status"
                    class="block w-48 pl-4 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer">
                    <option value="applied" {{ $lamaran['status_terakhir'] === 'applied' ? 'selected' : '' }}>Applied</option>
                    <option value="reviewed" {{ $lamaran['status_terakhir'] === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="interview" {{ $lamaran['status_terakhir'] === 'interview' ? 'selected' : '' }}>Interview</option>
                    <option value="completed" {{ $lamaran['status_terakhir'] === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <!-- Save Button -->
            <button type="button" id="btn-save-status"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                <svg id="btn-save-icon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <svg id="btn-save-spinner" class="hidden w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span id="btn-save-text">Simpan Perubahan</span>
            </button>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btn-save-status').addEventListener('click', function() {
        const btn       = this;
        const status    = document.getElementById('status').value;
        const textEl    = document.getElementById('btn-save-text');
        const iconEl    = document.getElementById('btn-save-icon');
        const spinnerEl = document.getElementById('btn-save-spinner');

        // Loading state
        btn.disabled = true;
        btn.classList.add('opacity-75', 'cursor-not-allowed');
        textEl.textContent = 'Menyimpan...';
        iconEl.classList.add('hidden');
        spinnerEl.classList.remove('hidden');

        const statusLabels = {
            applied: 'Applied',
            reviewed: 'Reviewed',
            interview: 'Interview',
            completed: 'Completed',
        };

        fetch(`/company/applicants/{{ $lamaran['lamaran_id'] }}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify({ status: status }),
        })
        .then(res => {
            if (!res.ok) throw new Error('Gagal memperbarui status');
            return res.json();
        })
        .then(data => {
            textEl.textContent = 'Tersimpan!';
            spinnerEl.classList.add('hidden');
            iconEl.classList.remove('hidden');
            btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            btn.classList.add('bg-emerald-600');

            setTimeout(() => location.reload(), 1000);
        })
        .catch(err => {
            textEl.textContent = err.message || 'Gagal menyimpan';
            spinnerEl.classList.add('hidden');
            iconEl.classList.remove('hidden');
            btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            btn.classList.add('bg-rose-600');

            setTimeout(() => {
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed', 'bg-rose-600');
                btn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                textEl.textContent = 'Simpan Perubahan';
            }, 2000);
        });
    });
</script>
@endpush