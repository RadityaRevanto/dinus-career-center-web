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
    $statusFlow = ['applied', 'reviewed', 'interview', 'completed'];
    $currentStatusIndex = array_search($lamaran['status_terakhir'], $statusFlow, true);
    if ($currentStatusIndex === false) $currentStatusIndex = 0;
    $allowedStatusOptions = [
        $statusFlow[$currentStatusIndex],
        $statusFlow[$currentStatusIndex + 1] ?? null,
    ];
@endphp

<div class="space-y-8">

    <!-- Back Button & Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Kandidat</h1>
            <p class="text-sm text-gray-500 mt-2">Informasi lengkap pelamar dan evaluasi lamaran.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border {{ $cfg[0] }}">
                <span class="w-2 h-2 rounded-full {{ $cfg[1] }} animate-pulse"></span>
                {{ $cfg[2] }}
            </span>
            @if(($lamaran['status_terakhir'] ?? '') === 'completed' && !empty($hasilInterview))
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border {{ $hasilInterview === 'accepted' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-rose-50 text-rose-700 border-rose-100' }}">
                {{ $hasilInterview === 'accepted' ? 'Diterima' : 'Ditolak' }}
            </span>
            @endif
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

                <!-- Timeline Status -->
                @php
                    $statusSteps = ['applied', 'reviewed', 'interview', 'completed'];
                    $currentIndex = array_search($lamaran['status_terakhir'], $statusSteps);
                    if ($currentIndex === false) $currentIndex = 0;

                    $stepMeta = [
                        'applied'   => [
                            'label'        => 'Applied',
                            'desc'         => 'Lamaran diterima oleh sistem',
                            'bg'           => 'bg-amber-50',
                            'text'         => 'text-amber-700',
                            'border'       => 'border-amber-100',
                            'bgLight'      => 'bg-amber-50/30',
                            'borderLight'  => 'border-amber-100/60',
                            'dot'          => 'bg-amber-500',
                            'ping'         => 'bg-amber-400',
                            'ring'         => 'ring-amber-500/20',
                        ],
                        'reviewed'  => [
                            'label'        => 'Reviewed',
                            'desc'         => 'Sedang ditinjau oleh tim HRD',
                            'bg'           => 'bg-sky-50',
                            'text'         => 'text-sky-700',
                            'border'       => 'border-sky-100',
                            'bgLight'      => 'bg-sky-50/30',
                            'borderLight'  => 'border-sky-100/60',
                            'dot'          => 'bg-sky-500',
                            'ping'         => 'bg-sky-400',
                            'ring'         => 'ring-sky-500/20',
                        ],
                        'interview' => [
                            'label'        => 'Interview',
                            'desc'         => 'Tahap wawancara dengan kandidat',
                            'bg'           => 'bg-blue-50',
                            'text'         => 'text-blue-700',
                            'border'       => 'border-blue-100',
                            'bgLight'      => 'bg-blue-50/30',
                            'borderLight'  => 'border-blue-100/60',
                            'dot'          => 'bg-blue-500',
                            'ping'         => 'bg-blue-400',
                            'ring'         => 'ring-blue-500/20',
                        ],
                        'completed' => [
                            'label'        => 'Completed',
                            'desc'         => 'Seluruh rangkaian proses selesai',
                            'bg'           => 'bg-emerald-50',
                            'text'         => 'text-emerald-700',
                            'border'       => 'border-emerald-100',
                            'bgLight'      => 'bg-emerald-50/30',
                            'borderLight'  => 'border-emerald-100/60',
                            'dot'          => 'bg-emerald-500',
                            'ping'         => 'bg-emerald-400',
                            'ring'         => 'ring-emerald-500/20',
                        ],
                    ];
                @endphp
                <div class="mt-4 p-5 bg-gray-50/40 border border-gray-100/80 rounded-2xl shadow-[inset_0_1px_2px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center justify-between mb-5">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Riwayat Status</span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-indigo-50 text-indigo-600 border border-indigo-100/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                            Real-time Status
                        </span>
                    </div>

                    <div class="relative space-y-1">
                        @foreach($statusSteps as $i => $step)
                        @php
                            $meta      = $stepMeta[$step];
                            $isPast    = $i < $currentIndex;
                            $isCurrent = $i === $currentIndex;
                            $isFuture  = $i > $currentIndex;
                            $isLast    = $i === count($statusSteps) - 1;

                            // Content box dynamic styles
                            if ($isCurrent) {
                                $boxClass = $meta['bgLight'] . ' ' . $meta['borderLight'] . ' shadow-[0_4px_12px_-4px_rgba(0,0,0,0.03)] border';
                            } elseif ($isPast) {
                                $boxClass = 'bg-white border border-gray-100/70 shadow-[0_2px_6px_rgba(0,0,0,0.01)]';
                            } else {
                                $boxClass = 'bg-transparent border border-transparent opacity-60';
                            }
                        @endphp
                        <div class="flex gap-4 group transition-all duration-300 {{ !$isLast ? 'pb-6' : '' }}">
                            {{-- Dot + Line --}}
                            <div class="relative flex flex-col items-center shrink-0 w-8">
                                @if($isPast)
                                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-[0_0_12px_rgba(16,185,129,0.2)] transition-all duration-300 group-hover:scale-110 z-10 animate-fade-in">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                @elseif($isCurrent)
                                <div class="w-8 h-8 rounded-full {{ $meta['bg'] }} {{ $meta['text'] }} flex items-center justify-center shrink-0 ring-2 {{ $meta['ring'] }} ring-offset-2 z-10 transition-all duration-300 group-hover:scale-110">
                                    <span class="relative flex h-3.5 w-3.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $meta['ping'] }} opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 {{ $meta['dot'] }}"></span>
                                    </span>
                                </div>
                                @else
                                <div class="w-8 h-8 rounded-full border border-gray-200 bg-white flex items-center justify-center shrink-0 z-10 transition-all duration-300 group-hover:border-gray-400 group-hover:scale-105">
                                    <span class="w-2 h-2 rounded-full bg-gray-300 transition-colors group-hover:bg-gray-400"></span>
                                </div>
                                @endif

                                @if(!$isLast)
                                <div class="absolute top-8 bottom-[-24px] w-[2px] transition-all duration-300 {{ $isPast ? 'bg-emerald-500' : 'bg-gray-200' }}"></div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="min-w-0 flex-1 p-3.5 rounded-2xl transition-all duration-300 -mt-1 {{ $boxClass }} hover:shadow-[0_6px_16px_-4px_rgba(0,0,0,0.04)]">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
                                    <p class="text-sm font-bold tracking-wide {{ $isFuture ? 'text-gray-400' : 'text-gray-900' }} {{ $isCurrent ? $meta['text'] : '' }}">
                                        {{ $meta['label'] }}
                                    </p>
                                    
                                    @if($isCurrent || ($isPast && $i === 0))
                                    @php
                                        // Applied pakai created_at, status lain pakai updated_at (kapan status terakhir diubah)
                                        $timestampToShow = ($step === 'applied')
                                            ? $lamaran['created_at']
                                            : ($lamaran['updated_at'] ?? $lamaran['created_at']);
                                    @endphp
                                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg bg-white border border-gray-100 shadow-[0_1px_3px_rgba(0,0,0,0.02)] text-[10px] font-semibold text-gray-500 select-none">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($timestampToShow)->translatedFormat('d M Y, H:i') }}
                                    </div>
                                    @endif
                                </div>
                                
                                <p class="text-xs mt-1 leading-relaxed {{ $isFuture ? 'text-gray-400/80' : 'text-gray-500' }}">
                                    {{ $meta['desc'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-6">

            <!-- Dokumen Lamaran -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900">Dokumen Lamaran</h3>
                    <p class="text-xs text-gray-400 mt-0.5">CV, portofolio, surat lamaran, transkip nilai, dan pas foto.</p>
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

                    @if(!empty($berkas['transkip_nilai']))
                    <div class="bg-gray-50/80 rounded-xl p-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Transkip Nilai</p>
                                <p class="text-xs text-gray-400">Dokumen Akademik</p>
                            </div>
                        </div>
                        <a href="{{ route('applicants.berkas', ['id' => $lamaran['lamaran_id'], 'tipe' => 'transkip_nilai']) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-700 bg-white border border-indigo-200 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Lihat
                        </a>
                    </div>
                    @endif

                    @if(!empty($berkas['pas_foto']))
                    <div class="bg-gray-50/80 rounded-xl p-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Pas Foto</p>
                                <p class="text-xs text-gray-400">Foto Formal</p>
                            </div>
                        </div>
                        <a href="{{ route('applicants.berkas', ['id' => $lamaran['lamaran_id'], 'tipe' => 'pas_foto']) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-700 bg-white border border-indigo-200 hover:bg-indigo-50 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Lihat
                        </a>
                    </div>
                    @endif

                    @if(empty($berkas['cv']) && empty($berkas['portofolio']) && empty($berkas['surat_lamaran']) && empty($berkas['transkip_nilai']) && empty($berkas['pas_foto']))
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
    <div class="space-y-4">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-gray-700">Ubah status evaluasi kandidat ini.</p>
                <p class="text-xs text-gray-400 mt-0.5">
                    Alur status harus berurutan: <span class="font-semibold text-gray-600">Applied → Reviewed → Interview → Completed</span>.
                    Pilih <span class="font-semibold text-indigo-600">Interview</span> untuk mengirim detail jadwal ke pelamar.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Status Select -->
                <div class="relative">
                    <select id="status" name="status"
                        class="block w-48 pl-4 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer">
                        <option value="applied" {{ $lamaran['status_terakhir'] === 'applied' ? 'selected' : '' }} @disabled(!in_array('applied', $allowedStatusOptions, true))>Applied</option>
                        <option value="reviewed" {{ $lamaran['status_terakhir'] === 'reviewed' ? 'selected' : '' }} @disabled(!in_array('reviewed', $allowedStatusOptions, true))>Reviewed</option>
                        <option value="interview" {{ $lamaran['status_terakhir'] === 'interview' ? 'selected' : '' }} @disabled(!in_array('interview', $allowedStatusOptions, true))>Interview</option>
                        <option value="completed" {{ $lamaran['status_terakhir'] === 'completed' ? 'selected' : '' }} @disabled(!in_array('completed', $allowedStatusOptions, true))>Completed</option>
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

        @if($lamaran['status_terakhir'] === 'interview' && !($interviewResultEmail['sent'] ?? false))
        <!-- Interview Result Email -->
        <div id="interview-result-email-panel" class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] p-5"
            data-quota-full="{{ ($quotaInfo['quotaFull'] ?? false) ? 'true' : 'false' }}">
            <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-5">
                <div>
                    <p class="text-sm font-semibold text-gray-900">Kirim hasil interview ke pelamar</p>
                    <p class="text-xs text-gray-400 mt-1">Gunakan tombol ini untuk mengirim email diterima atau ditolak ke {{ $pelamar['email'] ?? 'email pelamar' }}.</p>
                    <p class="text-xs text-gray-500 mt-2">Kuota lowongan: <span class="font-semibold">{{ $quotaInfo['acceptedCount'] ?? 0 }} / {{ $quotaInfo['jumlahPerson'] ?? 0 }}</span> terisi</p>
                    @if($quotaInfo['quotaFull'] ?? false)
                    <p class="text-xs text-amber-600 font-medium mt-1">Kuota sudah penuh. Hanya email ditolak yang masih bisa dikirim.</p>
                    @endif
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" data-result-email="accepted"
                        @disabled($quotaInfo['quotaFull'] ?? false)
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm hover:shadow transition-all duration-200 {{ ($quotaInfo['quotaFull'] ?? false) ? 'opacity-50 cursor-not-allowed' : '' }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Email Diterima
                    </button>
                    <button type="button" data-result-email="rejected"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Email Ditolak
                    </button>
                </div>
            </div>
            <div class="mt-4">
                <label for="interview_result_message" class="block text-xs font-semibold text-gray-600 mb-1.5">
                    Pesan Tambahan <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <textarea id="interview_result_message" rows="3"
                    class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white resize-none placeholder-gray-400 transition-all duration-200"
                    placeholder="Tambahkan catatan singkat yang akan masuk ke email pelamar..."></textarea>
                <p id="interview-result-feedback" class="hidden mt-3 text-sm font-medium"></p>
            </div>
        </div>
        @elseif($lamaran['status_terakhir'] === 'interview')
        <div class="bg-emerald-50 rounded-3xl border border-emerald-100 p-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-emerald-900">Email hasil interview sudah dikirim</p>
                    <p class="text-xs text-emerald-700 mt-0.5">Panel kirim email disembunyikan agar hasil interview tidak terkirim lebih dari satu kali.</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Interview Detail Panel -->
        <div id="interview-panel"
            style="max-height:0; overflow:hidden; transition: max-height 0.4s cubic-bezier(0.4,0,0.2,1), opacity 0.3s ease; opacity:0;"
            class="bg-white rounded-3xl border border-indigo-100 shadow-[0_4px_20px_-6px_rgba(99,102,241,0.2)]">
            <div class="px-6 py-4 border-b border-indigo-50 bg-linear-to-r from-indigo-50/70 to-violet-50/40">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Detail Jadwal Interview</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Informasi ini akan dikirim sebagai notifikasi ke pelamar.</p>
                    </div>
                </div>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Tanggal & Jam -->
                <div>
                    <label for="interview_time" class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Tanggal &amp; Jam Interview <span class="text-rose-500">*</span>
                    </label>
                    <input type="datetime-local" id="interview_time" name="interview_time"
                        value="{{ $interviewDetail['interview_time'] ?? '' }}"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200 cursor-pointer" />
                </div>
                <!-- Link Meeting -->
                <div>
                    <label for="link_meet" class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Link Google Meet / Zoom <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <input type="url" id="link_meet" name="link_meet"
                            class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white transition-all duration-200"
                            value="{{ $interviewDetail['link_meet'] ?? '' }}"
                            placeholder="https://meet.google.com/..." />
                    </div>
                </div>
                <!-- Pesan Tambahan -->
                <div class="sm:col-span-2">
                    <label for="pesan_tambahan" class="block text-xs font-semibold text-gray-600 mb-1.5">
                        Pesan Tambahan <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <textarea id="pesan_tambahan" name="pesan_tambahan" rows="2"
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white resize-none placeholder-gray-400 transition-all duration-200"
                        placeholder="Misal: Mohon hadir 10 menit sebelum jadwal. Siapkan portofolio terbaru Anda.">{{ $interviewDetail['pesan_tambahan'] ?? '' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div id="completed-email-required-modal"
        data-current-status="{{ $lamaran['status_terakhir'] }}"
        data-email-sent="{{ session('interview_result_email_sent.' . $lamaran['lamaran_id'], false) ? 'true' : 'false' }}"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/40 px-4 backdrop-blur-sm">
        <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl shadow-slate-950/20">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Email hasil interview belum dikirim</h3>
                    <p class="mt-2 text-sm leading-relaxed text-gray-500">
                        Sebelum mengubah status ke <span class="font-semibold text-gray-700">Completed</span>, kirim email <span class="font-semibold text-emerald-600">Diterima</span> atau <span class="font-semibold text-rose-600">Ditolak</span> ke pelamar terlebih dahulu.
                    </p>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" id="close-completed-email-required-modal"
                    class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-800">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    <div id="interview-email-success-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/40 px-4 backdrop-blur-sm">
        <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl shadow-slate-950/20">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Email berhasil dikirim</h3>
                    <p id="interview-email-success-message" class="mt-2 text-sm leading-relaxed text-gray-500">
                        Email hasil interview berhasil dikirim ke pelamar.
                    </p>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" id="close-interview-email-success-modal"
                    class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Selesai
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const statusSelect   = document.getElementById('status');
    const interviewPanel = document.getElementById('interview-panel');
    const btn            = document.getElementById('btn-save-status');
    const textEl         = document.getElementById('btn-save-text');
    const iconEl         = document.getElementById('btn-save-icon');
    const spinnerEl      = document.getElementById('btn-save-spinner');
    const completedEmailRequiredModal = document.getElementById('completed-email-required-modal');
    const closeCompletedEmailRequiredModal = document.getElementById('close-completed-email-required-modal');
    const currentStatus  = completedEmailRequiredModal?.dataset.currentStatus || '';
    let interviewResultEmailSent = completedEmailRequiredModal?.dataset.emailSent === 'true';
    const interviewEmailSuccessModal = document.getElementById('interview-email-success-modal');
    const closeInterviewEmailSuccessModal = document.getElementById('close-interview-email-success-modal');
    const interviewEmailSuccessMessage = document.getElementById('interview-email-success-message');

    function showCompletedEmailRequiredModal() {
        completedEmailRequiredModal?.classList.remove('hidden');
        completedEmailRequiredModal?.classList.add('flex');
    }

    function hideCompletedEmailRequiredModal() {
        completedEmailRequiredModal?.classList.add('hidden');
        completedEmailRequiredModal?.classList.remove('flex');
    }

    closeCompletedEmailRequiredModal?.addEventListener('click', hideCompletedEmailRequiredModal);
    completedEmailRequiredModal?.addEventListener('click', function (event) {
        if (event.target === completedEmailRequiredModal) hideCompletedEmailRequiredModal();
    });

    function showInterviewEmailSuccessModal(message) {
        if (interviewEmailSuccessMessage && message) {
            interviewEmailSuccessMessage.textContent = message;
        }
        interviewEmailSuccessModal?.classList.remove('hidden');
        interviewEmailSuccessModal?.classList.add('flex');
    }

    function hideInterviewEmailSuccessModal() {
        interviewEmailSuccessModal?.classList.add('hidden');
        interviewEmailSuccessModal?.classList.remove('flex');
    }

    closeInterviewEmailSuccessModal?.addEventListener('click', hideInterviewEmailSuccessModal);
    interviewEmailSuccessModal?.addEventListener('click', function (event) {
        if (event.target === interviewEmailSuccessModal) hideInterviewEmailSuccessModal();
    });

    // ── Show / Hide interview panel ──────────────────────────────────────────
    function toggleInterviewPanel() {
        if (statusSelect.value === 'interview') {
            interviewPanel.style.maxHeight = '600px';
            interviewPanel.style.opacity   = '1';
        } else {
            interviewPanel.style.maxHeight = '0';
            interviewPanel.style.opacity   = '0';
        }
    }

    statusSelect.addEventListener('change', toggleInterviewPanel);
    toggleInterviewPanel(); // run on load (if status already interview)

    // ── Interview result email ───────────────────────────────────────────────
    document.querySelectorAll('[data-result-email]').forEach(function (emailButton) {
        emailButton.addEventListener('click', function () {
            if (this.disabled) return;

            const result = this.dataset.resultEmail;
            const quotaFull = document.getElementById('interview-result-email-panel')?.dataset.quotaFull === 'true';

            if (result === 'accepted' && quotaFull) {
                alert('Kuota lowongan sudah penuh. Tidak bisa menerima kandidat lagi.');
                return;
            }
            const message = document.getElementById('interview_result_message')?.value || '';
            const feedback = document.getElementById('interview-result-feedback');
            const defaultText = this.textContent.trim();
            const confirmText = result === 'accepted'
                ? 'Kirim email bahwa kandidat diterima?'
                : 'Kirim email bahwa kandidat ditolak?';

            if (!confirm(confirmText)) return;

            this.disabled = true;
            this.classList.add('opacity-75', 'cursor-not-allowed');
            this.textContent = 'Mengirim...';
            if (feedback) feedback.classList.add('hidden');

            fetch(`/company/applicants/{{ $lamaran['lamaran_id'] }}/interview-result-email`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ result, message }),
            })
            .then(res => {
                if (!res.ok) return res.json().then(d => { throw new Error(d.error || 'Gagal mengirim email'); });
                return res.json();
            })
            .then(data => {
                interviewResultEmailSent = true;
                if (feedback) feedback.classList.add('hidden');
                document.getElementById('interview-result-email-panel')?.classList.add('hidden');
                showInterviewEmailSuccessModal(data.message || 'Email hasil interview berhasil dikirim ke pelamar.');
            })
            .catch(err => {
                if (feedback) {
                    feedback.textContent = err.message || 'Gagal mengirim email.';
                    feedback.className = 'mt-3 text-sm font-medium text-rose-600';
                }
            })
            .finally(() => {
                this.disabled = false;
                this.classList.remove('opacity-75', 'cursor-not-allowed');
                this.textContent = defaultText;
            });
        });
    });

    // ── Save button ──────────────────────────────────────────────────────────
    btn.addEventListener('click', function () {
        const status = statusSelect.value;

        if (currentStatus === 'interview' && status === 'completed' && !interviewResultEmailSent) {
            showCompletedEmailRequiredModal();
            return;
        }

        // Validate interview fields
        if (status === 'interview') {
            const interviewTime = document.getElementById('interview_time').value;
            const linkMeet      = document.getElementById('link_meet').value;
            if (!interviewTime) {
                alert('Harap isi tanggal & jam interview terlebih dahulu.');
                document.getElementById('interview_time').focus();
                return;
            }
            if (!linkMeet) {
                alert('Harap isi link Google Meet / Zoom terlebih dahulu.');
                document.getElementById('link_meet').focus();
                return;
            }
        }

        // Loading state
        btn.disabled = true;
        btn.classList.add('opacity-75', 'cursor-not-allowed');
        textEl.textContent = 'Menyimpan...';
        iconEl.classList.add('hidden');
        spinnerEl.classList.remove('hidden');

        // Build payload
        const payload = { status };
        if (status === 'interview') {
            payload.interview_time  = document.getElementById('interview_time').value;
            payload.link_meet       = document.getElementById('link_meet').value;
            payload.pesan_tambahan  = document.getElementById('pesan_tambahan').value;
        }

        fetch(`/company/applicants/{{ $lamaran['lamaran_id'] }}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify(payload),
        })
        .then(res => {
            if (!res.ok) return res.json().then(d => { throw new Error(d.error || 'Gagal memperbarui status'); });
            return res.json();
        })
        .then(() => {
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
            }, 2500);
        });
    });
});
</script>
@endpush