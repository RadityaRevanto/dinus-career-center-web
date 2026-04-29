@extends('admin.layouts.app')
@section('content')
        <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat 1 -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Companies</p>
                <p class="text-2xl font-bold text-slate-900">0</p>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-amber-100 text-amber-600 rounded-lg">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Pending Approvals</p>
                <p class="text-2xl font-bold text-slate-900">0</p>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Active Jobs</p>
                <p class="text-2xl font-bold text-slate-900">0</p>
            </div>
        </div>

        <!-- Stat 4 -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Applicants</p>
                <p class="text-2xl font-bold text-slate-900">0</p>
            </div>
        </div>
    </div>
    <!-- Approved Companies Table -->
    <!-- <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden mb-8">

        <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-900">Approved Companies</h2>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">View All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Perusahaan</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Lowongan Aktif</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-sm">
                                    TV
                                </div>
                                <span class="font-medium text-slate-900">TechVision Inc.</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            Technology
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            5
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">


                                <button class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="View">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12H9m12 0A9 9 0 113 12a9 9 0 0118 0z"/>
                                    </svg>
                                </button>

                                <button class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Deactivate">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 5.636l-12.728 12.728M6.343 6.343a8 8 0 1111.314 11.314"/>
                                    </svg>
                                </button>

                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-sm">
                                    NS
                                </div>
                                <span class="font-medium text-slate-900">Nexus Solutions</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            Software
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            3
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">

                                <button class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12H9m12 0A9 9 0 113 12a9 9 0 0118 0z"/>
                                    </svg>
                                </button>

                                <button class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 5.636l-12.728 12.728M6.343 6.343a8 8 0 1111.314 11.314"/>
                                    </svg>
                                </button>

                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div> -->

    <!-- Approvals Table Section -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-900">Pending Company Approvals</h2>
            <a href="{{ route('companies') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">View All</a>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
        <div class="mx-6 mt-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
            <p class="text-emerald-700 text-sm">{{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="mx-6 mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-700 text-sm">{{ session('error') }}</p>
        </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Company Name</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Requested On</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($perusahaan as $p)
                    <tr class="hover:bg-slate-50 transition-colors">

                        {{-- COMPANY NAME --}}
                        <td class="px-6 py-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-sm">
                                    {{ strtoupper(substr($p['nama_perusahaan'], 0, 2)) }}
                                </div>
                                <span class="font-medium text-slate-900">{{ $p['nama_perusahaan'] }}</span>
                            </div>
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-4 border-b border-slate-100 text-sm text-slate-600">
                            {{ $p['email_perusahaan'] }}
                        </td>

                        {{-- REQUESTED ON --}}
                        <td class="px-6 py-4 border-b border-slate-100 text-sm text-slate-600">
                            {{ \Carbon\Carbon::parse($p['created_at'])->format('M d, Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 border-b border-slate-100">
                            @if($p['status_verifikasi'] === 'pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                Pending
                            </span>
                            @elseif($p['status_verifikasi'] === 'accepted')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                Accepted
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                Rejected
                            </span>
                            @endif
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-4 border-b border-slate-100 text-right">
                            <div class="flex items-center justify-end gap-2">

                                @if($p['status_verifikasi'] !== 'accepted')
                                <form method="POST" action="{{ route('admin.verify.company') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $p['perusahaan_id'] }}">
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit"
                                        class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                                        title="Approve">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>
                                @endif

                                @if($p['status_verifikasi'] !== 'rejected')
                                <form method="POST" action="{{ route('admin.verify.company') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $p['perusahaan_id'] }}">
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit"
                                        class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                        title="Reject">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 text-sm">
                            Belum ada perusahaan yang mendaftar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
