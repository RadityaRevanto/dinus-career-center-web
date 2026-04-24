@extends('company.layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-semibold text-black">Frontend Developer</h1>
        <p class="text-sm text-slate-500">Jakarta • Full-time</p>
    </div>

    <span class="px-3 py-1 text-sm bg-emerald-100 text-emerald-700 rounded-full font-medium">
        Aktif
    </span>
</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl border border-slate-200">
        <p class="text-xs text-slate-500">Total Pelamar</p>
        <p class="text-xl font-semibold text-black mt-1">32</p>
    </div>

    <div class="bg-white p-4 rounded-xl border border-slate-200">
        <p class="text-xs text-slate-500">Interview</p>
        <p class="text-xl font-semibold text-black mt-1">10</p>
    </div>

    <div class="bg-white p-4 rounded-xl border border-slate-200">
        <p class="text-xs text-slate-500">Diterima</p>
        <p class="text-xl font-semibold text-black mt-1">4</p>
    </div>

</div>

<!-- APPLICANT LIST -->
<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

    <!-- HEADER -->
    <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
        <h2 class="font-semibold text-black">Daftar Pelamar</h2>

        <input type="text" placeholder="Cari pelamar..."
            class="border border-slate-300 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
                <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pelamar</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Applied For</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">CV / Match</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50 transition-colors" x-data="{ state: 'pending' }">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="h-10 w-10 rounded-full bg-slate-200" src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="">
                                <div>
                                    <span class="block font-medium text-slate-900">John Doe</span>
                                    <span class="block text-sm text-slate-500">john.doe@example.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">Frontend Developer</td>
                        <td class="px-6 py-4">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded border border-slate-200 text-sm font-medium transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                Resume.pdf
                            </button>
                        </td>
                        <td class="px-6 py-4">
                            <span x-show="state == 'pending'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                            <span x-show="state == 'accepted'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Accepted</span>
                            <span x-show="state == 'rejected'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">Rejected</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                             <div class="flex flex-col items-end gap-2" x-data="{ open: false }">
                                 <div class="relative">
                                    <button @click="open = !open" @click.away="open = false" class="px-3 py-1.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded border border-indigo-200 text-sm font-medium transition-colors flex items-center gap-1">
                                        Update Status
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </button>
                                    <div x-show="open" x-transition x-cloak class="absolute right-0 mt-1 w-32 bg-white border border-slate-200 rounded-lg shadow-lg py-1 z-10 text-left">
                                        <button @click="state = 'accepted'; open = false" class="w-full text-left px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-50">Accept</button>
                                        <button @click="state = 'rejected'; open = false" class="w-full text-left px-4 py-2 text-sm text-rose-700 hover:bg-rose-50">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50 transition-colors" x-data="{ state: 'accepted' }">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="h-10 w-10 rounded-full bg-slate-200" src="https://ui-avatars.com/api/?name=Jane+Smith&background=random" alt="">
                                <div>
                                    <span class="block font-medium text-slate-900">Jane Smith</span>
                                    <span class="block text-sm text-slate-500">jane.smith@example.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">Frontend Developer</td>
                        <td class="px-6 py-4">
                            <button class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded border border-slate-200 text-sm font-medium transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                Portfolio.pdf
                            </button>
                        </td>
                        <td class="px-6 py-4">
                            <span x-show="state == 'pending'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                            <span x-show="state == 'accepted'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Accepted</span>
                            <span x-show="state == 'rejected'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">Rejected</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                             <div class="flex flex-col items-end gap-2" x-data="{ open: false }">
                                 <div class="relative">
                                    <button @click="open = !open" @click.away="open = false" class="px-3 py-1.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded border border-indigo-200 text-sm font-medium transition-colors flex items-center gap-1">
                                        Update Status
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </button>
                                    <div x-show="open" x-transition x-cloak class="absolute right-0 mt-1 w-32 bg-white border border-slate-200 rounded-lg shadow-lg py-1 z-10 text-left">
                                        <button @click="state = 'accepted'; open = false" class="w-full text-left px-4 py-2 text-sm text-emerald-700 hover:bg-emerald-50">Accept</button>
                                        <button @click="state = 'rejected'; open = false" class="w-full text-left px-4 py-2 text-sm text-rose-700 hover:bg-rose-50">Reject</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection