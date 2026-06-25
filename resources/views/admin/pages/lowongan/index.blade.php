@extends('admin.layouts.app')
@section('content')
<div class="space-y-8">

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
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelola Lowongan</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau dan kelola semua lowongan pekerjaan yang terdaftar.</p>
        </div>
    </div>

    @php
        $totalLowongan = $totalLowongan ?? (is_array($lowongan) ? count($lowongan) : $lowongan->total());
        $lowonganAktif = $lowonganAktif ?? (is_array($lowongan) ? collect($lowongan)->where('status_loker', 'aktif')->count() : 0);
        $lowonganTutup = $lowonganTutup ?? (is_array($lowongan) ? collect($lowongan)->where('status_loker', 'tidak')->count() : 0);
    @endphp

    <!-- Stats Section -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Jobs</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $totalLowongan }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 rounded-2xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Active Jobs</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $lowonganAktif }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-2xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Closed Jobs</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $lowonganTutup }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-2xl">
                    <svg class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs Table List -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
                <!-- Toolbar (Search & Filters) -->
        <div class="p-6 sm:px-8 border-b border-gray-100 flex flex-col sm:flex-row gap-4 justify-between items-center bg-gray-50/30">
            <!-- Search -->
            <div class="relative w-full sm:max-w-md">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="admin-lowongan-search"
                    class="block w-full pl-11 pr-4 py-2.5 border border-gray-200 bg-white hover:bg-gray-50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"
                    placeholder="Cari lowongan atau perusahaan..." autocomplete="off">
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                <p id="admin-lowongan-search-count" class="hidden text-xs font-medium text-gray-500 whitespace-nowrap"></p>
                <div class="relative w-full sm:w-40">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </div>
                    <select id="admin-lowongan-status"
                        class="block w-full pl-9 pr-8 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none shadow-sm cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak">Closed</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>
        </div>


        <div class="overflow-x-auto">
            <table id="admin-lowongan-table" class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Job Title</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <div class="inline-flex items-center gap-1.5">
                                <span>Company</span>
                                <button type="button" id="admin-lowongan-company-sort"
                                    aria-pressed="false"
                                    title="Kelompokkan perusahaan yang sama"
                                    class="inline-flex items-center justify-center h-7 w-7 rounded-lg border border-gray-200 bg-white text-gray-400 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50/50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                                    <svg data-sort-icon="default" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                    <svg data-sort-icon="active" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Location</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Applicants</th>
                        <th scope="col" class="px-6 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($lowongan as $item)
                    <tr class="hover:bg-indigo-50/30 transition-colors group {{ ($item['status_loker'] ?? '') == 'tidak' ? 'opacity-60' : '' }}">
                        <!-- Job Title -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="shrink-0 h-12 w-12 flex items-center justify-center rounded-2xl border border-gray-100 bg-white shadow-sm group-hover:border-indigo-200 group-hover:shadow-indigo-100 transition-all duration-200">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $item['judul'] ?? '-' }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">Posted {{ isset($item['created_at']) ? \Carbon\Carbon::parse($item['created_at'])->diffForHumans() : '-' }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Company -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            @php $namaPerusahaan = $item['perusahaan']['nama_perusahaan'] ?? '-'; @endphp
                            <div class="flex items-center gap-3">
                                <div class="shrink-0 h-10 w-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-700 font-bold text-sm border border-indigo-100">{{ strtoupper(substr($namaPerusahaan, 0, 1)) }}</div>
                                <span class="text-sm font-medium text-gray-700">{{ $namaPerusahaan }}</span>
                            </div>
                        </td>

                        <!-- Location -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-sm text-gray-700">{{ $item['perusahaan']['kota'] ?? '-' }}</span>
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            @if(($item['status_loker'] ?? '') == 'aktif')
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                Active
                            </span>
                            @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Closed
                            </span>
                            @endif
                        </td>

                        <!-- Applicants -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-sm font-bold text-gray-900">{{ $item['jumlah_pelamar'] ?? 0 }}</span>
                                <span class="text-xs text-gray-400">pelamar</span>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('lowongan.show', $item['lowongan_id']) }}" class="p-2.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all duration-200" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                                <form action="{{ route('lowongan.destroy', $item['lowongan_id']) }}" method="POST"
                                    class="inline-block"
                                    data-confirm="{{ e('Yakin ingin menghapus lowongan ' . ($item['judul'] ?? 'ini') . '? Semua lamaran terkait akan ikut dihapus.') }}"
                                    data-confirm-title="Hapus Lowongan"
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
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-gray-900 font-semibold text-lg">Belum ada lowongan</p>
                                <p class="text-gray-400 text-sm mt-1">Tidak ada lowongan pekerjaan yang terdaftar saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($totalLowongan > 0)
        @include('company.components.table-pagination', [
            'id' => 'admin-lowongan',
            'paginator' => $lowongan,
            'rowsPerPageOptions' => $lowonganPerPageOptions ?? [10, 25, 50, 100],
            'label' => 'Lowongan table pagination',
        ])
        @endif
    </div>

</div>
@endsection

@push('scripts')
<script type="application/json" id="admin-lowongan-data">{!! json_encode($allLowongan ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
<script type="application/json" id="admin-lowongan-config">{!! json_encode(['showUrlBase' => url('/admin/lowongan'), 'csrfToken' => csrf_token()], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const allLowongan = JSON.parse(document.getElementById('admin-lowongan-data')?.textContent || '[]');
    const tbody = document.querySelector('#admin-lowongan-table tbody');
    const searchInput = document.getElementById('admin-lowongan-search');
    const statusFilter = document.getElementById('admin-lowongan-status');
    const companySortBtn = document.getElementById('admin-lowongan-company-sort');
    const searchCount = document.getElementById('admin-lowongan-search-count');
    const paginationNav = document.querySelector('nav[aria-label="Lowongan table pagination"]');
    const rowsPerPageSelect = document.getElementById('rows-per-page-admin-lowongan');
    const currentPageInput = document.getElementById('current-page-admin-lowongan');
    const rowsInfoSpan = paginationNav?.querySelector(':scope > div:first-child > span:last-child');
    const totalPagesSpan = paginationNav?.querySelector(':scope > div:last-child > span.whitespace-nowrap');
    const { showUrlBase, csrfToken } = JSON.parse(document.getElementById('admin-lowongan-config')?.textContent || '{}');
    const initialTbodyHtml = tbody ? tbody.innerHTML : '';
    const initialRowsInfo = rowsInfoSpan?.textContent ?? '';
    const initialCurrentPage = currentPageInput?.value ?? '1';
    const initialTotalPages = totalPagesSpan?.textContent ?? '';
    let clientPage = 1;
    let clientModeActive = false;

    if (!tbody || !searchInput) return;

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatPostedAt(value) {
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

    function renderDeleteForm(item) {
        const judul = item.judul ?? 'lowongan ini';
        const lowonganId = item.lowongan_id ?? '';
        const confirmMessage = `Yakin ingin menghapus lowongan ${judul}? Semua lamaran terkait akan ikut dihapus.`;

        return `
            <form action="${showUrlBase}/${encodeURIComponent(lowonganId)}" method="POST"
                class="inline-block"
                data-confirm="${escapeHtml(confirmMessage)}"
                data-confirm-title="Hapus Lowongan"
                data-confirm-label="Ya, hapus"
                data-confirm-tone="danger">
                <input type="hidden" name="_token" value="${escapeHtml(csrfToken)}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="p-2.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all duration-200" title="Hapus">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </form>
        `;
    }

    function renderRow(item) {
        const judul = item.judul ?? '-';
        const namaPerusahaan = item.perusahaan?.nama_perusahaan ?? '-';
        const kota = item.perusahaan?.kota ?? '-';
        const isActive = (item.status_loker ?? '') === 'aktif';
        const jumlahPelamar = item.jumlah_pelamar ?? 0;
        const lowonganId = item.lowongan_id ?? '';
        const initial = escapeHtml(namaPerusahaan.charAt(0).toUpperCase());

        return `
            <tr class="hover:bg-indigo-50/30 transition-colors group ${isActive ? '' : 'opacity-60'}">
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="shrink-0 h-12 w-12 flex items-center justify-center rounded-2xl border border-gray-100 bg-white shadow-sm group-hover:border-indigo-200 group-hover:shadow-indigo-100 transition-all duration-200">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">${escapeHtml(judul)}</div>
                            <div class="text-xs text-gray-400 mt-0.5">Posted ${escapeHtml(formatPostedAt(item.created_at))}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex items-center gap-3">
                        <div class="shrink-0 h-10 w-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-700 font-bold text-sm border border-indigo-100">${initial}</div>
                        <span class="text-sm font-medium text-gray-700">${escapeHtml(namaPerusahaan)}</span>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-sm text-gray-700">${escapeHtml(kota)}</span>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    ${isActive
                        ? '<span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>Active</span>'
                        : '<span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200 shadow-sm"><span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Closed</span>'}
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-sm font-bold text-gray-900">${escapeHtml(jumlahPelamar)}</span>
                        <span class="text-xs text-gray-400">pelamar</span>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end items-center gap-2">
                        <a href="${showUrlBase}/${encodeURIComponent(lowonganId)}" class="p-2.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all duration-200" title="View Details">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
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
                <td colspan="6" class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center">
                        <p class="text-gray-900 font-semibold text-lg">Tidak ada lowongan yang cocok</p>
                        <p class="text-gray-400 text-sm mt-1">Coba ubah kata kunci atau filter status.</p>
                    </div>
                </td>
            </tr>
        `;
    }

    function isCompanySortActive() {
        return companySortBtn?.getAttribute('aria-pressed') === 'true';
    }

    function updateCompanySortButton(active) {
        if (!companySortBtn) return;

        companySortBtn.setAttribute('aria-pressed', active ? 'true' : 'false');
        companySortBtn.classList.toggle('text-indigo-600', active);
        companySortBtn.classList.toggle('border-indigo-300', active);
        companySortBtn.classList.toggle('bg-indigo-50', active);

        const defaultIcon = companySortBtn.querySelector('[data-sort-icon="default"]');
        const activeIcon = companySortBtn.querySelector('[data-sort-icon="active"]');
        defaultIcon?.classList.toggle('hidden', active);
        activeIcon?.classList.toggle('hidden', !active);
    }

    function sortByCompany(items) {
        if (!isCompanySortActive()) return items;

        return [...items].sort(function (a, b) {
            const companyA = (a.perusahaan?.nama_perusahaan ?? '').toLowerCase();
            const companyB = (b.perusahaan?.nama_perusahaan ?? '').toLowerCase();
            const compare = companyA.localeCompare(companyB, 'id');
            if (compare !== 0) return compare;

            const dateA = new Date(a.created_at || 0).getTime();
            const dateB = new Date(b.created_at || 0).getTime();
            return dateB - dateA;
        });
    }

    function isClientMode() {
        const query = searchInput.value.toLowerCase().trim();
        const status = statusFilter?.value ?? '';
        return query !== '' || status !== '' || isCompanySortActive();
    }

    function getClientPerPage() {
        const value = parseInt(rowsPerPageSelect?.value || '10', 10);
        return Number.isNaN(value) ? 10 : value;
    }

    function getFilteredItems() {
        const query = searchInput.value.toLowerCase().trim();
        const status = statusFilter?.value ?? '';

        return sortByCompany(allLowongan.filter(function (item) {
            const judul = (item.judul ?? '').toLowerCase();
            const perusahaan = (item.perusahaan?.nama_perusahaan ?? '').toLowerCase();
            const kota = (item.perusahaan?.kota ?? '').toLowerCase();
            const matchesQuery = !query || judul.includes(query) || perusahaan.includes(query) || kota.includes(query);
            const matchesStatus = !status || (item.status_loker ?? '') === status;

            return matchesQuery && matchesStatus;
        }));
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
            if (filtered.length !== allLowongan.length) {
                searchCount.textContent = `${filtered.length} hasil`;
                searchCount.classList.remove('hidden');
            } else {
                searchCount.classList.add('hidden');
            }
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
    companySortBtn?.addEventListener('click', function () {
        updateCompanySortButton(!isCompanySortActive());
        applyFilters();
    });

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
});
</script>
@endpush