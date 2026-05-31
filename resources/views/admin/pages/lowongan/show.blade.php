@extends('admin.layouts.app')
@section('content')
<div class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Lowongan</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap lowongan dan daftar pelamar yang mendaftar.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('lowongan.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white hover:bg-gray-50 border border-gray-200 rounded-xl transition-all duration-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>
            @if(($data['status_loker'] ?? '') === 'aktif')
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
            </span>
            @else
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                <span class="w-2 h-2 rounded-full bg-gray-400"></span> Ditutup
            </span>
            @endif
        </div>
    </div>

    @php
        $perusahaan = $data['perusahaan'] ?? [];
        $namaPerusahaan = $perusahaan['nama_perusahaan'] ?? '-';
        $batasAkhir = $data['batas_akhir'] ?? null;
        $isExpired = $batasAkhir && \Carbon\Carbon::parse($batasAkhir)->isPast();
    @endphp

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
            <p class="text-sm font-medium text-gray-500">Total Pelamar</p>
            <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $totalPelamar }}</p>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
            <p class="text-sm font-medium text-gray-500">Applied</p>
            <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $statusPelamar['applied'] ?? 0 }}</p>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
            <p class="text-sm font-medium text-gray-500">Diproses</p>
            <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ ($statusPelamar['reviewed'] ?? 0) + ($statusPelamar['interview'] ?? 0) }}</p>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
            <p class="text-sm font-medium text-gray-500">Diterima</p>
            <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $statusPelamar['completed'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Detail Lowongan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900">Informasi Lowongan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Posisi, kategori, dan ketentuan utama.</p>
            </div>
            <div class="p-6 space-y-5">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 border border-indigo-100">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">{{ $data['judul'] ?? '-' }}</h4>
                        <p class="text-sm text-gray-500">{{ $data['jabatan']['nama'] ?? '-' }} &bull; {{ $data['jurusan']['nama'] ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Tipe Pekerjaan</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['tipe_pekerjaan']['nama'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Sektor</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['sektor']['nama'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Kuota</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['jumlah_person'] ?? 0 }} orang</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Gaji</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['range_gaji'] ?? '-' }}</p>
                    </div>
                </div>

                <div class="bg-gray-50/80 rounded-xl p-3.5">
                    <p class="text-xs text-gray-400 mb-1">Batas Akhir</p>
                    <p class="text-sm font-semibold {{ $isExpired ? 'text-rose-600' : 'text-gray-900' }}">
                        {{ $batasAkhir ? \Carbon\Carbon::parse($batasAkhir)->format('d M Y') : '-' }}
                        @if($isExpired)
                        <span class="ml-2 text-xs font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full">Kadaluarsa</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900">Informasi Perusahaan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Perusahaan pemilik lowongan.</p>
            </div>
            <div class="p-6 space-y-5">
                <div class="flex items-center gap-4">
                    @if(!empty($perusahaan['logo']))
                    <img src="{{ $perusahaan['logo'] }}" class="w-16 h-16 rounded-2xl object-cover border border-gray-200 shadow-sm" />
                    @else
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xl border border-indigo-100">
                        {{ strtoupper(substr($namaPerusahaan, 0, 2)) }}
                    </div>
                    @endif
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">{{ $namaPerusahaan }}</h4>
                        <p class="text-sm text-gray-500">{{ $perusahaan['email_perusahaan'] ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Lokasi</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $perusahaan['kota'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Diposting</p>
                        <p class="text-sm font-semibold text-gray-900">{{ !empty($data['created_at']) ? \Carbon\Carbon::parse($data['created_at'])->format('d M Y') : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Pekerjaan -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-900">Deskripsi & Persyaratan</h3>
            <p class="text-xs text-gray-400 mt-0.5">Detail pekerjaan dan kualifikasi kandidat.</p>
        </div>
        <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-gray-50/80 rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-2">Deskripsi Pekerjaan</p>
                <p class="text-sm font-medium text-gray-700 leading-relaxed whitespace-pre-line">{{ $data['detail_lowongan'] ?? 'Tidak ada deskripsi.' }}</p>
            </div>
            <div class="bg-gray-50/80 rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-2">Persyaratan</p>
                <p class="text-sm font-medium text-gray-700 leading-relaxed whitespace-pre-line">{{ $data['requirements'] ?? 'Tidak ada persyaratan.' }}</p>
            </div>
        </div>
    </div>

    @php
        $statusConfig = [
            'applied'   => ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500', 'Applied'],
            'reviewed'  => ['bg-sky-50 text-sky-700 border-sky-100', 'bg-sky-500', 'Reviewed'],
            'interview' => ['bg-blue-50 text-blue-700 border-blue-100', 'bg-blue-500', 'Interview'],
            'completed' => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500', 'Completed'],
        ];
    @endphp

    <!-- Daftar Pelamar -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Daftar Pelamar</h2>
                <p class="text-sm text-gray-500 mt-0.5"><span class="font-semibold text-indigo-600">{{ $totalPelamar }}</span> pelamar untuk lowongan ini</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelamar</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">NIM / Bidang</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Melamar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($lamaran as $item)
                    @php
                        $pelamar = $item['pelamar'] ?? [];
                        $status = $item['status_terakhir'] ?? 'applied';
                        $cfg = $statusConfig[$status] ?? $statusConfig['applied'];
                        $foto = $pelamar['foto_profil']
                            ?? 'https://ui-avatars.com/api/?name=' . urlencode($pelamar['nama_lengkap'] ?? 'P') . '&background=e0e7ff&color=4f46e5&bold=true&size=80';
                    @endphp
                    <tr class="hover:bg-indigo-50/20 transition-colors group">
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <img src="{{ $foto }}" alt="{{ $pelamar['nama_lengkap'] ?? '' }}" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm shrink-0" />
                                <div>
                                    <p class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $pelamar['nama_lengkap'] ?? '-' }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $pelamar['email'] ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <p class="text-sm font-semibold text-gray-900">{{ $pelamar['nim'] ?? '-' }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $pelamar['bidang'] ?? '-' }}</p>
                        </td>
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $cfg[0] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $cfg[1] }}"></span>
                                {{ $cfg[2] }}
                            </span>
                        </td>
                        <td class="px-6 sm:px-8 py-4 whitespace-nowrap">
                            <p class="text-sm text-gray-600">{{ !empty($item['created_at']) ? \Carbon\Carbon::parse($item['created_at'])->format('d M Y') : '-' }}</p>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <p class="text-gray-900 font-semibold text-lg">Belum ada pelamar</p>
                                <p class="text-gray-400 text-sm mt-1">Belum ada kandidat yang melamar untuk lowongan ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($totalPelamar > 0)
        @include('company.components.table-pagination', [
            'id' => 'admin-lowongan-applicants',
            'paginator' => $lamaran,
            'rowsPerPageOptions' => $pelamarPerPageOptions ?? [10, 25, 50, 100],
            'label' => 'Applicants table pagination',
        ])
        @endif
    </div>
</div>
@endsection