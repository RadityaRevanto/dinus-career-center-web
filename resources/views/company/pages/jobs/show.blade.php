@extends('company.layouts.app')

@section('content')
<div class="space-y-8">

    {{-- ── Header ──────────────────────────────────────────────────────────── --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Lowongan</h1>
                <p class="text-sm text-gray-500 mt-2">Informasi lengkap mengenai lowongan ini.</p>
            </div>
        <div class="flex items-center gap-3">
            @php $status = $lowonganStatus ?? \App\Support\LamaranHelper::resolveLowonganStatus($lowongan); @endphp
            @if($status['tone'] === 'active')
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>{{ $status['label'] }}
            </span>
            @elseif($status['tone'] === 'expired')
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-100">
                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>{{ $status['label'] }}
            </span>
            @elseif($status['tone'] === 'quota')
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>{{ $status['label'] }}
            </span>
            @else
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>{{ $status['label'] }}
            </span>
            @endif
        </div>
    </div>

    <!-- Grid Layout: Informasi Dasar & Informasi Tambahan berjejeran -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Informasi Dasar --}}
            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden h-fit">
                <div class="p-8">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900">Informasi Dasar</h2>
                        <p class="text-sm text-gray-500 mt-1">Detail utama posisi pekerjaan.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-6">

                        {{-- Judul --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Lowongan</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    {{ $lowongan['judul'] ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    {{ $lowongan['jabatan']['nama'] ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Tipe Pekerjaan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Pekerjaan</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    {{ $lowongan['tipe_pekerjaan']['nama'] ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Jurusan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jurusan</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    {{ $lowongan['jurusan']['nama'] ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Sektor --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sektor Industri</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    {{ $lowongan['sektor']['nama'] ?? '-' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Informasi Tambahan --}}
            <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden h-fit">
                <div class="p-8">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900">Informasi Tambahan</h2>
                        <p class="text-sm text-gray-500 mt-1">Kuota, gaji, deadline, dan status.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-6">

                        {{-- Jumlah Posisi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Posisi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    {{ $lowongan['jumlah_person'] ?? '-' }} orang
                                </div>
                            </div>
                        </div>

                        {{-- Batas Akhir --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Batas Akhir</label>
                            @php
                                $batasAkhir = $lowongan['batas_akhir'] ?? null;
                                $isExpired  = \App\Support\LamaranHelper::isLowonganExpired($batasAkhir);
                            @endphp
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 {{ $isExpired ? 'text-rose-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm font-medium {{ $isExpired ? 'text-rose-600' : 'text-gray-900' }}">
                                    {{ $batasAkhir ? \Carbon\Carbon::parse($batasAkhir)->translatedFormat('d M Y') : '-' }}
                                    @if($isExpired)
                                    <span class="ml-2 text-xs font-semibold text-rose-500 bg-rose-50 px-2 py-0.5 rounded-full">Kadaluarsa</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Range Gaji --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Rentang Gaji</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm font-medium">Rp</span>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    {{ $lowongan['range_gaji'] ?? 'Tidak dicantumkan' }}
                                </div>
                            </div>
                        </div>

                        {{-- Status Lowongan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Lowongan</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 font-medium">
                                    <span class="inline-flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full {{ $status['tone'] === 'active' ? 'bg-emerald-500 animate-pulse' : ($status['tone'] === 'expired' ? 'bg-rose-500' : ($status['tone'] === 'quota' ? 'bg-amber-500' : 'bg-gray-400')) }}"></span>
                                        {{ $status['label'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>

    <!-- Detail Pekerjaan (Full Width) -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden h-fit">
            <div class="p-8">
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900">Detail Pekerjaan</h2>
                    <p class="text-sm text-gray-500 mt-1">Deskripsi peran dan persyaratan.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- Deskripsi Pekerjaan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Pekerjaan</label>
                        <div class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-700 leading-relaxed min-h-[9rem] whitespace-pre-line">
                            {{ $lowongan['detail_lowongan'] ?? 'Tidak ada deskripsi.' }}
                        </div>
                    </div>

                    {{-- Persyaratan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Persyaratan & Kualifikasi</label>
                        <div class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-700 leading-relaxed min-h-[9rem] whitespace-pre-line">
                            {{ $lowongan['requirements'] ?? 'Tidak ada persyaratan.' }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    {{-- ── Daftar Pelamar ──────────────────────────────────────────────────── --}}
    @php
        $statusConfig = [
            'applied'   => ['bg-amber-50 text-amber-700 border-amber-100',  'bg-amber-500',  'Applied'],
            'reviewed'  => ['bg-sky-50 text-sky-700 border-sky-100',        'bg-sky-500',    'Reviewed'],
            'interview' => ['bg-blue-50 text-blue-700 border-blue-100',     'bg-blue-500',   'Interview'],
            'accepted' => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500', 'Diterima'],
            'rejected' => ['bg-rose-50 text-rose-700 border-rose-100', 'bg-rose-500', 'Ditolak'],
        ];
    @endphp

    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
        {{-- Header --}}
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Daftar Pelamar</h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    <span class="font-semibold text-indigo-600">{{ count($lamaran) }}</span> pelamar untuk lowongan ini
                </p>
            </div>
            <a href="{{ route('applicants') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-100 rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Semua Pelamar
            </a>
        </div>

        @if(count($lamaran) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelamar</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lowongan</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Melamar</th>
                        <th class="px-6 sm:px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($lamaran as $item)
                    @php
                        $pelamar = $item['pelamar'] ?? [];
                        $status  = $item['status_terakhir'] ?? 'applied';
                        $cfg     = $statusConfig[$status] ?? $statusConfig['applied'];
                        $foto    = $pelamar['foto_profil']
                            ?? 'https://ui-avatars.com/api/?name=' . urlencode($pelamar['nama_lengkap'] ?? 'P') . '&background=e0e7ff&color=4f46e5&bold=true&size=80';
                    @endphp
                    <tr class="hover:bg-indigo-50/20 transition-colors group">
                        {{-- Pelamar --}}
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <img src="{{ $foto }}" alt="{{ $pelamar['nama_lengkap'] ?? '' }}"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm flex-shrink-0" />
                                <div>
                                    <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $pelamar['nama_lengkap'] ?? '-' }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $pelamar['email'] ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        {{-- Lowongan --}}
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <p class="text-sm font-semibold text-gray-900">{{ $lowongan['judul'] ?? '-' }}</p>
                        </td>
                        {{-- Status --}}
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $cfg[0] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $cfg[1] }}"></span>
                                {{ $cfg[2] }}
                            </span>
                        </td>
                        {{-- Tanggal --}}
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d M Y') }}</p>
                        </td>
                        {{-- Aksi --}}
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap text-right">
                            <a href="{{ route('applicants.edit', $item['lamaran_id']) }}"
                                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-100 rounded-xl transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        {{-- Empty State --}}
        <div class="py-16 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <p class="text-gray-700 font-semibold text-base">Belum ada pelamar</p>
            <p class="text-gray-400 text-sm mt-1">Belum ada kandidat yang melamar untuk lowongan ini.</p>
        </div>
        @endif
    </div>

</div>
@endsection