@extends('admin.layouts.app')
@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Audit Log</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau semua aktivitas sistem secara real-time.</p>
        </div>
        <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 sm:flex-none sm:w-72">
                <input type="text" id="audit-log-search" placeholder="Cari aktivitas..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-full bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all text-sm shadow-sm">
                <svg class="h-5 w-5 text-gray-400 absolute left-3.5 top-2.5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <p id="audit-log-search-count" class="hidden text-xs font-medium text-gray-500 whitespace-nowrap"></p>
            <select id="audit-log-modul"
                class="border border-gray-200 rounded-full px-4 py-2.5 bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all text-sm shadow-sm cursor-pointer">
                <option value="">Semua Modul</option>
                <option value="auth">Auth</option>
                <option value="lamaran">Lamaran</option>
                <option value="perusahaan">Perusahaan</option>
                <option value="lowongan">Lowongan</option>
                <option value="berkas">Berkas</option>
            </select>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Log</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $totalLog }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 rounded-2xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Hari Ini</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $todayLog ?? 0 }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-2xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Modul Aktif</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $activeModuleCount ?? 0 }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-2xl">
                    <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Audit Log Table -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
        <div class="overflow-x-auto">
            <table id="audit-log-table" class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aktivitas</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Modul</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Role</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Detail</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">IP Address</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($logs as $log)
                    @php
                        $aktivitas = $log['aktivitas'] ?? '-';
                        $modulColor = match($log['modul'] ?? '') {
                            'auth' => 'bg-blue-50 text-blue-700 border-blue-100',
                            'lamaran' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            'perusahaan' => 'bg-amber-50 text-amber-700 border-amber-100',
                            'lowongan' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                            'berkas' => 'bg-purple-50 text-purple-700 border-purple-100',
                            default => 'bg-gray-50 text-gray-700 border-gray-200',
                        };
                        $aktivitasIcon = match(true) {
                            str_contains($aktivitas, 'login') => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>',
                            str_contains($aktivitas, 'apply') => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
                            str_contains($aktivitas, 'verifikasi') => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
                            str_contains($aktivitas, 'update') => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>',
                            default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                        };
                        $aktivitasBg = match(true) {
                            str_contains($aktivitas, 'login') => 'bg-blue-50 text-blue-600',
                            str_contains($aktivitas, 'apply') => 'bg-emerald-50 text-emerald-600',
                            str_contains($aktivitas, 'verifikasi') => 'bg-amber-50 text-amber-600',
                            str_contains($aktivitas, 'update') => 'bg-indigo-50 text-indigo-600',
                            default => 'bg-gray-50 text-gray-600',
                        };
                    @endphp
                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                        <!-- Aktivitas -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="shrink-0 h-12 w-12 flex items-center justify-center rounded-2xl {{ $aktivitasBg }} border border-gray-100 shadow-sm group-hover:shadow-indigo-100 transition-all duration-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $aktivitasIcon !!}</svg>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ str_replace('_', ' ', ucfirst($aktivitas)) }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5">{{ $log['user_id'] ? substr($log['user_id'], 0, 8) . '...' : 'System' }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Modul -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $modulColor }} w-fit">
                                {{ ucfirst($log['modul'] ?? '-') }}
                            </span>
                        </td>

                        <!-- Role -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-700">{{ ucfirst($log['role'] ?? '-') }}</span>
                        </td>

                        <!-- Detail -->
                        <td class="px-6 py-5">
                            @if(!empty($log['detail']))
                            <div class="max-w-xs">
                                @foreach((array)$log['detail'] as $key => $val)
                                <div class="text-xs text-gray-500 truncate">
                                    <span class="font-medium text-gray-600">{{ $key }}:</span> {{ is_string($val) ? $val : json_encode($val) }}
                                </div>
                                @endforeach
                            </div>
                            @else
                            <span class="text-xs text-gray-400">-</span>
                            @endif
                        </td>

                        <!-- IP Address -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="text-sm text-gray-600 font-mono">{{ $log['ip_address'] ?? '-' }}</span>
                        </td>

                        <!-- Waktu -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <div class="text-sm text-gray-700">{{ isset($log['created_at']) ? \Carbon\Carbon::parse($log['created_at'])->diffForHumans() : '-' }}</div>
                                    <div class="text-xs text-gray-400">{{ isset($log['created_at']) ? \Carbon\Carbon::parse($log['created_at'])->format('d M Y, H:i') : '' }}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                </div>
                                <p class="text-gray-900 font-semibold text-lg">Belum ada log</p>
                                <p class="text-gray-400 text-sm mt-1">Tidak ada aktivitas yang tercatat saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(($totalLog ?? 0) > 0)
        @include('company.components.table-pagination', [
            'paginator' => $logs,
            'rowsPerPageOptions' => $auditLogPerPageOptions ?? [10, 25, 50, 100],
            'label' => 'Audit log pagination',
            'id' => 'audit-log',
        ])
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script type="application/json" id="audit-log-data">{!! json_encode($allLogs ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const allLogs = JSON.parse(document.getElementById('audit-log-data')?.textContent || '[]');
    const tbody = document.querySelector('#audit-log-table tbody');
    const searchInput = document.getElementById('audit-log-search');
    const modulFilter = document.getElementById('audit-log-modul');
    const searchCount = document.getElementById('audit-log-search-count');
    const paginationNav = document.querySelector('nav[aria-label="Audit log pagination"]');
    const rowsPerPageSelect = document.getElementById('rows-per-page-audit-log');
    const currentPageInput = document.getElementById('current-page-audit-log');
    const rowsInfoSpan = paginationNav?.querySelector(':scope > div:first-child > span:last-child');
    const totalPagesSpan = paginationNav?.querySelector(':scope > div:last-child > span.whitespace-nowrap');
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

    function formatRelativeTime(value) {
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

    function formatDateTime(value) {
        if (!value) return '';
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) return '';
        return date.toLocaleString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });
    }

    function getAktivitasStyle(aktivitas) {
        const value = (aktivitas ?? '').toLowerCase();
        if (value.includes('login')) {
            return {
                bg: 'bg-blue-50 text-blue-600',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>',
            };
        }
        if (value.includes('apply')) {
            return {
                bg: 'bg-emerald-50 text-emerald-600',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
            };
        }
        if (value.includes('verifikasi')) {
            return {
                bg: 'bg-amber-50 text-amber-600',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
            };
        }
        if (value.includes('update')) {
            return {
                bg: 'bg-indigo-50 text-indigo-600',
                icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>',
            };
        }
        return {
            bg: 'bg-gray-50 text-gray-600',
            icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        };
    }

    function getModulBadge(modul) {
        const colors = {
            auth: 'bg-blue-50 text-blue-700 border-blue-100',
            lamaran: 'bg-emerald-50 text-emerald-700 border-emerald-100',
            perusahaan: 'bg-amber-50 text-amber-700 border-amber-100',
            lowongan: 'bg-indigo-50 text-indigo-700 border-indigo-100',
            berkas: 'bg-purple-50 text-purple-700 border-purple-100',
        };
        const color = colors[modul] ?? 'bg-gray-50 text-gray-700 border-gray-200';
        const label = modul ? modul.charAt(0).toUpperCase() + modul.slice(1) : '-';
        return `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border ${color} w-fit">${escapeHtml(label)}</span>`;
    }

    function formatAktivitasLabel(aktivitas) {
        const value = aktivitas ?? '-';
        return escapeHtml(String(value).replace(/_/g, ' ').replace(/^\w/, (c) => c.toUpperCase()));
    }

    function renderDetail(detail) {
        if (!detail || (typeof detail === 'object' && Object.keys(detail).length === 0)) {
            return '<span class="text-xs text-gray-400">-</span>';
        }

        const entries = typeof detail === 'object' ? Object.entries(detail) : [];
        if (!entries.length) {
            return '<span class="text-xs text-gray-400">-</span>';
        }

        return `<div class="max-w-xs">${entries.map(([key, val]) => {
            const display = typeof val === 'string' ? val : JSON.stringify(val);
            return `<div class="text-xs text-gray-500 truncate"><span class="font-medium text-gray-600">${escapeHtml(key)}:</span> ${escapeHtml(display)}</div>`;
        }).join('')}</div>`;
    }

    function renderRow(log) {
        const aktivitas = log.aktivitas ?? '-';
        const style = getAktivitasStyle(aktivitas);
        const userId = log.user_id ?? '';
        const userLabel = userId ? `${String(userId).slice(0, 8)}...` : 'System';

        return `
            <tr class="hover:bg-indigo-50/30 transition-colors group">
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="shrink-0 h-12 w-12 flex items-center justify-center rounded-2xl ${style.bg} border border-gray-100 shadow-sm group-hover:shadow-indigo-100 transition-all duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">${style.icon}</svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">${formatAktivitasLabel(aktivitas)}</div>
                            <div class="text-xs text-gray-400 mt-0.5">${escapeHtml(userLabel)}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">${getModulBadge(log.modul ?? '')}</td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="text-sm font-medium text-gray-700">${escapeHtml((log.role ?? '-').charAt(0).toUpperCase() + (log.role ?? '-').slice(1))}</span>
                </td>
                <td class="px-6 py-5">${renderDetail(log.detail)}</td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <span class="text-sm text-gray-600 font-mono">${escapeHtml(log.ip_address ?? '-')}</span>
                </td>
                <td class="px-6 py-5 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <div class="text-sm text-gray-700">${escapeHtml(formatRelativeTime(log.created_at))}</div>
                            <div class="text-xs text-gray-400">${escapeHtml(formatDateTime(log.created_at))}</div>
                        </div>
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
                        <p class="text-gray-900 font-semibold text-lg">Tidak ada log yang cocok</p>
                        <p class="text-gray-400 text-sm mt-1">Coba ubah kata kunci atau filter modul.</p>
                    </div>
                </td>
            </tr>
        `;
    }

    function detailToSearchText(detail) {
        if (!detail) return '';
        if (typeof detail === 'string') return detail.toLowerCase();
        try {
            return JSON.stringify(detail).toLowerCase();
        } catch {
            return '';
        }
    }

    function isClientMode() {
        const query = searchInput.value.toLowerCase().trim();
        const modul = modulFilter?.value ?? '';
        return query !== '' || modul !== '';
    }

    function getClientPerPage() {
        const value = parseInt(rowsPerPageSelect?.value || '10', 10);
        return Number.isNaN(value) ? 10 : value;
    }

    function getFilteredLogs() {
        const query = searchInput.value.toLowerCase().trim();
        const modul = modulFilter?.value ?? '';

        return allLogs.filter(function (log) {
            const aktivitas = (log.aktivitas ?? '').toLowerCase();
            const role = (log.role ?? '').toLowerCase();
            const modulValue = (log.modul ?? '').toLowerCase();
            const userId = (log.user_id ?? '').toLowerCase();
            const ip = (log.ip_address ?? '').toLowerCase();
            const detail = detailToSearchText(log.detail);

            const matchesQuery = !query
                || aktivitas.includes(query)
                || role.includes(query)
                || modulValue.includes(query)
                || userId.includes(query)
                || ip.includes(query)
                || detail.includes(query);

            const matchesModul = !modul || modulValue === modul;

            return matchesQuery && matchesModul;
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
        const filtered = getFilteredLogs();
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

    modulFilter?.addEventListener('change', applyFilters);

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

        const filtered = getFilteredLogs();
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