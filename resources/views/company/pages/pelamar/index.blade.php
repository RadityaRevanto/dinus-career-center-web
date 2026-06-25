@extends('company.layouts.app')

@section('content')
<div class=" space-y-8">

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('error') }}
    </div>
    @endif
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Manajemen Pelamar</h1>
            <p class="text-sm text-gray-500 mt-2">Kelola semua kandidat yang melamar ke berbagai posisi di perusahaan Anda.</p>
        </div>
        <!-- <div class="flex items-center gap-3">
          
        </div> -->
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat 1 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100  hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pelamar</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <p class="text-2xl font-extrabold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stat 2 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100  hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Review</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $stats['applied'] }}</p>
                </div>
            </div>
        </div>
        <!-- Stat 3 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100  hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-sky-50 text-sky-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Tahap Wawancara</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $stats['interview'] }}</p>
                </div>
            </div>
        </div>
        <!-- Stat 4 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Diterima</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <p class="text-2xl font-extrabold text-gray-900">{{ $stats['accepted'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden">
        
        <!-- Toolbar (Search & Filters) -->
        <div class="p-6 sm:px-8 border-b border-gray-100 flex flex-col lg:flex-row gap-4 justify-between items-stretch lg:items-center bg-gray-50/30">
            <!-- Search -->
            <div class="relative w-full lg:max-w-md">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="applicants-search"
                    class="block w-full pl-11 pr-4 py-2.5 border border-gray-200 bg-white hover:bg-gray-50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 shadow-sm"
                    placeholder="Cari nama pelamar atau email...">
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                <p id="applicants-search-count" class="hidden text-xs font-medium text-gray-500 whitespace-nowrap"></p>
                <div class="relative w-full sm:w-44">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </div>
                    <select id="applicants-status"
                        class="block w-full pl-9 pr-8 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none shadow-sm cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="applied">Applied</option>
                        <option value="reviewed">Reviewed</option>
                        <option value="interview">Interview</option>
                        <option value="accepted">Diterima</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                
                <a href="{{ route('applicants.export') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Ekspor Data
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table id="applicants-table" class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Profil Pelamar
                        </th>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Melamar Posisi
                        </th>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Dokumen
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
                    @forelse($lamaran as $l)
                    @php
                        $pelamar = $l['pelamar'];
                        $berkas  = $l['berkas'];
                        $foto    = $pelamar['foto_profil'] 
                            ?? 'https://ui-avatars.com/api/?name=' . urlencode($pelamar['nama_lengkap']) . '&background=e0e7ff&color=4f46e5&bold=true';
                    @endphp
                    <tr class="hover:bg-blue-50/30 transition-colors group">

                        {{-- PROFIL PELAMAR --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <img class="h-11 w-11 rounded-full object-cover border border-gray-200 shadow-sm"
                                    src="{{ $foto }}" alt="{{ $pelamar['nama_lengkap'] }}">
                                <div>
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ $pelamar['nama_lengkap'] ?? '-' }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $pelamar['email'] ?? '-' }}</div>
                                    <!-- @if($pelamar['nim'])
                                    <div class="text-xs text-gray-400">NIM: {{ $pelamar['nim'] }}</div>
                                    @endif -->
                                </div>
                            </div>
                        </td>

                        {{-- MELAMAR POSISI --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ $l['lowongan']['judul'] ?? '-' }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($l['created_at'])->diffForHumans() }}
                            </div>
                        </td>

                        {{-- DOKUMEN --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            @php
                                $docTypes = [
                                    ['key' => 'cv', 'label' => 'CV'],
                                    ['key' => 'portofolio', 'label' => 'Portofolio'],
                                    ['key' => 'surat_lamaran', 'label' => 'Surat'],
                                    ['key' => 'transkip_nilai', 'label' => 'Transkip'],
                                    ['key' => 'pas_foto', 'label' => 'Foto'],
                                ];
                                $availableDocs = array_values(array_filter($docTypes, fn ($d) => ! empty($berkas[$d['key']])));
                                $primaryDoc = $availableDocs[0] ?? null;
                                $extraDocs = array_slice($availableDocs, 1);
                            @endphp
                            <div class="flex items-center gap-1.5">
                                @if (! $primaryDoc)
                                <span class="text-xs text-gray-400">Tidak ada dokumen</span>
                                @else
                                <a href="{{ route('applicants.berkas', ['id' => $l['lamaran_id'], 'tipe' => $primaryDoc['key']]) }}" target="_blank"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg text-xs font-semibold transition-colors w-fit border border-gray-200 hover:border-blue-200">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    {{ $primaryDoc['label'] }}
                                </a>
                                @if (count($extraDocs) > 0)
                                <div class="relative" data-docs-menu>
                                    <button type="button" data-docs-more-btn
                                        class="inline-flex items-center justify-center min-w-7 h-7 px-1.5 bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-lg text-xs font-bold border border-gray-200 hover:border-blue-200 transition-colors"
                                        title="{{ count($extraDocs) }} dokumen lainnya">+{{ count($extraDocs) }}</button>
                                    <div data-docs-menu-panel class="hidden fixed z-50 min-w-36 py-1 bg-white border border-gray-200 rounded-xl shadow-lg">
                                        @foreach ($extraDocs as $doc)
                                        <a href="{{ route('applicants.berkas', ['id' => $l['lamaran_id'], 'tipe' => $doc['key']]) }}" target="_blank"
                                            class="block px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                            {{ $doc['label'] }}
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            @php
                                $statusConfig = [
                                    'applied'   => ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500', 'Applied'],
                                    'reviewed'  => ['bg-sky-50 text-sky-700 border-sky-100', 'bg-sky-500', 'Reviewed'],
                                    'interview' => ['bg-blue-50 text-blue-700 border-blue-100', 'bg-blue-500', 'Interview'],
                                    'accepted'  => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500', 'Diterima'],
                                    'rejected'  => ['bg-rose-50 text-rose-700 border-rose-100', 'bg-rose-500', 'Ditolak'],
                                ];
                                $cfg = $statusConfig[$l['status_terakhir']] ?? $statusConfig['applied'];
                            @endphp
                            <div class="flex flex-col gap-1.5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border shadow-sm {{ $cfg[0] }} w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $cfg[1] }}"></span>
                                    {{ $cfg[2] }}
                                </span>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('applicants.edit', $l['lamaran_id']) }}" class="p-2.5 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all duration-200" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('applicants.destroy', $l['lamaran_id']) }}" method="POST"
                                    class="inline-block"
                                    data-confirm="{{ e('Yakin ingin menghapus lamaran ' . ($pelamar['nama_lengkap'] ?? 'pelamar ini') . ' untuk posisi ' . ($l['lowongan']['judul'] ?? 'lowongan') . '? Tindakan ini tidak dapat dibatalkan.') }}"
                                    data-confirm-title="Hapus Lamaran"
                                    data-confirm-label="Ya, hapus"
                                    data-confirm-tone="danger">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="p-2.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all duration-200" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-16 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Belum ada pelamar yang masuk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($lamaran->total() > 0)
        @include('company.components.table-pagination', [
            'id' => 'applicants',
            'paginator' => $lamaran,
            'rowsPerPageOptions' => $perPageOptions ?? [10, 25, 50, 100],
            'label' => 'Applicants table pagination',
        ])
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script type="application/json" id="applicants-data">{!! json_encode($allLamaran ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
<script type="application/json" id="applicants-config">{!! json_encode([
    'editUrlBase' => url('/company/applicants'),
    'berkasUrlBase' => url('/company/applicants'),
    'deleteUrlBase' => url('/company/applicants'),
    'csrfToken' => csrf_token(),
], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const allApplicants = JSON.parse(document.getElementById('applicants-data')?.textContent || '[]');
    const { editUrlBase, berkasUrlBase, deleteUrlBase, csrfToken } = JSON.parse(document.getElementById('applicants-config')?.textContent || '{}');
    const tbody = document.querySelector('#applicants-table tbody');
    const searchInput = document.getElementById('applicants-search');
    const statusFilter = document.getElementById('applicants-status');
    const searchCount = document.getElementById('applicants-search-count');
    const paginationNav = document.querySelector('nav[aria-label="Applicants table pagination"]');
    const rowsPerPageSelect = document.getElementById('rows-per-page-applicants');
    const currentPageInput = document.getElementById('current-page-applicants');
    const rowsInfoSpan = paginationNav?.querySelector(':scope > div:first-child > span:last-child');
    const totalPagesSpan = paginationNav?.querySelector(':scope > div:last-child > span.whitespace-nowrap');
    const initialTbodyHtml = tbody ? tbody.innerHTML : '';
    const initialRowsInfo = rowsInfoSpan?.textContent ?? '';
    const initialCurrentPage = currentPageInput?.value ?? '1';
    const initialTotalPages = totalPagesSpan?.textContent ?? '';
    let clientPage = 1;
    let clientModeActive = false;

    if (!tbody || !searchInput) return;

    const statusConfig = {
        applied: ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500', 'Applied'],
        reviewed: ['bg-sky-50 text-sky-700 border-sky-100', 'bg-sky-500', 'Reviewed'],
        interview: ['bg-blue-50 text-blue-700 border-blue-100', 'bg-blue-500', 'Interview'],
        accepted: ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500', 'Diterima'],
        rejected: ['bg-rose-50 text-rose-700 border-rose-100', 'bg-rose-500', 'Ditolak'],
    };

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatRelativeDate(value) {
        if (!value) return '-';
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) return '-';

        const diffMs = Date.now() - date.getTime();
        const minutes = Math.floor(diffMs / 60000);
        if (minutes < 1) return 'baru saja';
        if (minutes < 60) return `${minutes} menit yang lalu`;
        const hours = Math.floor(minutes / 60);
        if (hours < 24) return `${hours} jam yang lalu`;
        const days = Math.floor(hours / 24);
        if (days < 30) return `${days} hari yang lalu`;
        const months = Math.floor(days / 30);
        if (months < 12) return `${months} bulan yang lalu`;
        return `${Math.floor(months / 12)} tahun yang lalu`;
    }

    function avatarUrl(pelamar) {
        if (pelamar?.foto_profil) return pelamar.foto_profil;
        const name = encodeURIComponent(pelamar?.nama_lengkap ?? 'User');
        return `https://ui-avatars.com/api/?name=${name}&background=e0e7ff&color=4f46e5&bold=true`;
    }

    const DOC_TYPES = [
        { key: 'cv', label: 'CV' },
        { key: 'portofolio', label: 'Portofolio' },
        { key: 'surat_lamaran', label: 'Surat' },
        { key: 'transkip_nilai', label: 'Transkip' },
        { key: 'pas_foto', label: 'Foto' },
    ];

    const docLinkClass = 'inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg text-xs font-semibold transition-colors w-fit border border-gray-200 hover:border-blue-200';

    function getAvailableDocs(berkas) {
        return DOC_TYPES.filter(function (doc) {
            return berkas?.[doc.key];
        });
    }

    function renderBerkasLinks(item) {
        const available = getAvailableDocs(item.berkas);
        if (!available.length) {
            return '<span class="text-xs text-gray-400">Tidak ada dokumen</span>';
        }

        const lamaranId = encodeURIComponent(item.lamaran_id ?? '');
        const primary = available[0];
        const extra = available.slice(1);

        let html = `<div class="flex items-center gap-1.5">`;
        html += `
            <a href="${escapeHtml(berkasUrlBase)}/${lamaranId}/berkas/${primary.key}" target="_blank"
                class="${docLinkClass}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                ${escapeHtml(primary.label)}
            </a>
        `;

        if (extra.length > 0) {
            html += `
                <div class="relative" data-docs-menu>
                    <button type="button" data-docs-more-btn
                        class="inline-flex items-center justify-center min-w-7 h-7 px-1.5 bg-gray-100 text-gray-600 hover:bg-blue-50 hover:text-blue-700 rounded-lg text-xs font-bold border border-gray-200 hover:border-blue-200 transition-colors"
                        title="${extra.length} dokumen lainnya">+${extra.length}</button>
                    <div data-docs-menu-panel class="hidden fixed z-50 min-w-36 py-1 bg-white border border-gray-200 rounded-xl shadow-lg">
                        ${extra.map(function (doc) {
                            return `<a href="${escapeHtml(berkasUrlBase)}/${lamaranId}/berkas/${doc.key}" target="_blank"
                                class="block px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                ${escapeHtml(doc.label)}
                            </a>`;
                        }).join('')}
                    </div>
                </div>
            `;
        }

        html += '</div>';
        return html;
    }

    function renderDeleteForm(item) {
        const lamaranId = item.lamaran_id ?? '';
        const nama = item.pelamar?.nama_lengkap ?? 'pelamar ini';
        const posisi = item.lowongan?.judul ?? 'lowongan';
        const confirmMessage = `Yakin ingin menghapus lamaran ${nama} untuk posisi ${posisi}? Tindakan ini tidak dapat dibatalkan.`;

        return `
            <form action="${deleteUrlBase}/${encodeURIComponent(lamaranId)}" method="POST"
                class="inline-block"
                data-confirm="${escapeHtml(confirmMessage)}"
                data-confirm-title="Hapus Lamaran"
                data-confirm-label="Ya, hapus"
                data-confirm-tone="danger">
                <input type="hidden" name="_token" value="${escapeHtml(csrfToken)}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="p-2.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all duration-200" title="Hapus">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </form>
        `;
    }

    function renderRow(item) {
        const pelamar = item.pelamar ?? {};
        const status = item.status_terakhir ?? 'applied';
        const cfg = statusConfig[status] ?? statusConfig.applied;
        const foto = avatarUrl(pelamar);
        const nama = pelamar.nama_lengkap ?? '-';
        const email = pelamar.email ?? '-';
        const posisi = item.lowongan?.judul ?? '-';
        const lamaranId = encodeURIComponent(item.lamaran_id ?? '');

        return `
            <tr class="hover:bg-blue-50/30 transition-colors group">
                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                    <div class="flex items-center gap-4">
                        <img class="h-11 w-11 rounded-full object-cover border border-gray-200 shadow-sm"
                            src="${escapeHtml(foto)}" alt="${escapeHtml(nama)}">
                        <div>
                            <div class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">${escapeHtml(nama)}</div>
                            <div class="text-xs text-gray-500 mt-1">${escapeHtml(email)}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">${escapeHtml(posisi)}</div>
                    <div class="text-xs text-gray-500 mt-1">${escapeHtml(formatRelativeDate(item.created_at))}</div>
                </td>
                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                    <div class="flex flex-col gap-1">${renderBerkasLinks(item)}</div>
                </td>
                <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                    <div class="flex flex-col gap-1.5">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border shadow-sm ${cfg[0]} w-fit">
                            <span class="w-1.5 h-1.5 rounded-full ${cfg[1]}"></span>
                            ${escapeHtml(cfg[2])}
                        </span>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end items-center gap-2">
                        <a href="${escapeHtml(editUrlBase)}/${lamaranId}/edit" class="p-2.5 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all duration-200" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        ${renderDeleteForm(item)}
                    </div>
                </td>
            </tr>
        `;
    }

    function renderEmptyFiltered() {
        return `
            <tr>
                <td colspan="5" class="px-8 py-16 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Tidak ada pelamar yang cocok dengan filter.
                </td>
            </tr>
        `;
    }

    function isClientMode() {
        const query = searchInput.value.toLowerCase().trim();
        const status = statusFilter?.value ?? '';
        return query !== '' || status !== '';
    }

    function getClientPerPage() {
        const value = parseInt(rowsPerPageSelect?.value || '25', 10);
        return Number.isNaN(value) ? 25 : value;
    }

    function getFilteredItems() {
        const query = searchInput.value.toLowerCase().trim();
        const status = statusFilter?.value ?? '';

        return allApplicants.filter(function (item) {
            const nama = (item.pelamar?.nama_lengkap ?? '').toLowerCase();
            const email = (item.pelamar?.email ?? '').toLowerCase();
            const posisi = (item.lowongan?.judul ?? '').toLowerCase();
            const matchesQuery = !query || nama.includes(query) || email.includes(query) || posisi.includes(query);
            const matchesStatus = !status || (item.status_terakhir ?? '') === status;

            return matchesQuery && matchesStatus;
        });
    }

    function restoreServerPaginationUI() {
        if (rowsInfoSpan) rowsInfoSpan.textContent = initialRowsInfo;
        if (currentPageInput) currentPageInput.value = initialCurrentPage;
        if (totalPagesSpan) totalPagesSpan.textContent = initialTotalPages;

        paginationNav?.querySelectorAll('a').forEach(function (link) {
            link.style.pointerEvents = '';
            link.style.opacity = '';
        });
    }

    function updateClientPaginationUI(total, page, perPage) {
        if (!paginationNav) return;

        const totalPages = Math.max(1, Math.ceil(total / perPage) || 1);
        const safePage = Math.min(Math.max(page, 1), totalPages);
        const firstRow = total > 0 ? (safePage - 1) * perPage + 1 : 0;
        const lastRow = Math.min(safePage * perPage, total);

        if (rowsInfoSpan) {
            rowsInfoSpan.textContent = `${firstRow}–${lastRow} of ${total} rows`;
        }
        if (currentPageInput) {
            currentPageInput.value = safePage;
        }
        if (totalPagesSpan) {
            totalPagesSpan.textContent = `of ${totalPages}`;
        }

        paginationNav.querySelectorAll('button, a').forEach(function (control) {
            const label = control.getAttribute('aria-label') || '';
            let disabled = false;

            if (label === 'First page' || label === 'Previous page') {
                disabled = safePage <= 1;
            }
            if (label === 'Next page' || label === 'Last page') {
                disabled = safePage >= totalPages;
            }

            if (control.tagName === 'BUTTON') {
                control.disabled = disabled;
            } else if (control.tagName === 'A') {
                control.style.pointerEvents = disabled ? 'none' : '';
                control.style.opacity = disabled ? '0.45' : '';
            }
        });

        clientPage = safePage;
    }

    function renderClientTable(resetPage) {
        if (resetPage) clientPage = 1;

        if (!isClientMode()) {
            clientModeActive = false;
            tbody.innerHTML = initialTbodyHtml;
            paginationNav?.classList.remove('hidden');
            restoreServerPaginationUI();
            if (searchCount) searchCount.classList.add('hidden');
            return;
        }

        clientModeActive = true;
        const filtered = getFilteredItems();
        const perPage = getClientPerPage();
        const totalPages = Math.max(1, Math.ceil(filtered.length / perPage) || 1);

        if (clientPage > totalPages) clientPage = totalPages;
        if (clientPage < 1) clientPage = 1;

        const start = (clientPage - 1) * perPage;
        const pageItems = filtered.slice(start, start + perPage);

        tbody.innerHTML = pageItems.length
            ? pageItems.map(renderRow).join('')
            : renderEmptyFiltered();

        paginationNav?.classList.remove('hidden');
        updateClientPaginationUI(filtered.length, clientPage, perPage);

        if (searchCount) {
            searchCount.textContent = `${filtered.length} hasil`;
            searchCount.classList.remove('hidden');
        }
    }

    function applyFilters() {
        renderClientTable(true);
    }

    let debounceTimer;
    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(applyFilters, 200);
    });

    statusFilter?.addEventListener('change', applyFilters);

    rowsPerPageSelect?.form?.addEventListener('submit', function (e) {
        if (clientModeActive) e.preventDefault();
    });

    rowsPerPageSelect?.addEventListener('change', function () {
        if (!clientModeActive) return;
        renderClientTable(true);
    });

    paginationNav?.addEventListener('click', function (e) {
        if (!clientModeActive) return;

        const control = e.target.closest('a, button');
        if (!control || control.disabled) return;

        const label = control.getAttribute('aria-label');
        if (!label) return;

        e.preventDefault();

        const filtered = getFilteredItems();
        const perPage = getClientPerPage();
        const totalPages = Math.max(1, Math.ceil(filtered.length / perPage));

        if (label === 'First page') clientPage = 1;
        else if (label === 'Previous page') clientPage = Math.max(1, clientPage - 1);
        else if (label === 'Next page') clientPage = Math.min(totalPages, clientPage + 1);
        else if (label === 'Last page') clientPage = totalPages;
        else return;

        renderClientTable(false);
    });

    function closeAllDocsPanels() {
        document.querySelectorAll('[data-docs-menu-panel]').forEach(function (el) {
            el.classList.add('hidden');
            el.style.top = '';
            el.style.left = '';
        });
    }

    function positionDocsPanel(btn, panel) {
        panel.classList.remove('hidden');
        panel.style.visibility = 'hidden';

        const rect = btn.getBoundingClientRect();
        const panelHeight = panel.offsetHeight;
        const panelWidth = panel.offsetWidth;
        let top = rect.bottom + 4;
        let left = rect.left;

        if (top + panelHeight > window.innerHeight - 8) {
            top = rect.top - panelHeight - 4;
        }
        if (left + panelWidth > window.innerWidth - 8) {
            left = Math.max(8, window.innerWidth - panelWidth - 8);
        }

        panel.style.top = `${top}px`;
        panel.style.left = `${left}px`;
        panel.style.visibility = '';
    }

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-docs-more-btn]');
        if (btn) {
            e.stopPropagation();
            const panel = btn.closest('[data-docs-menu]')?.querySelector('[data-docs-menu-panel]');
            const isOpen = panel && !panel.classList.contains('hidden');
            closeAllDocsPanels();
            if (panel && !isOpen) {
                positionDocsPanel(btn, panel);
            }
            return;
        }

        if (!e.target.closest('[data-docs-menu]') && !e.target.closest('[data-docs-menu-panel]')) {
            closeAllDocsPanels();
        }
    });

    window.addEventListener('scroll', closeAllDocsPanels, true);
    window.addEventListener('resize', closeAllDocsPanels);
});
</script>
@endpush