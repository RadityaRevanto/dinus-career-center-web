@extends('company.layouts.app')
@section('content')

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

    <!-- PENDING -->
    <div class="bg-white p-5 rounded-xl border border-slate-200 ">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Pending
        </p>

        <div class="flex items-end justify-between mt-3">
            <h2 class="text-2xl font-bold text-black">0</h2>

            <span class="text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-600 font-medium">
                +12%
            </span>
        </div>
    </div>

    <!-- INTERVIEW -->
    <div class="bg-white p-5 rounded-xl border border-slate-200  border-l-4 border-indigo-500">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Interview
        </p>

        <div class="flex items-end justify-between mt-3">
            <h2 class="text-2xl font-bold text-black">0</h2>

            <span class="text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-600 font-medium">
                Tetap
            </span>
        </div>
    </div>

    <!-- DITERIMA -->
    <div class="bg-white p-5 rounded-xl border border-slate-200 ">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Diterima
        </p>

        <div class="flex items-end justify-between mt-3">
            <h2 class="text-2xl font-bold text-black">0</h2>

            <span class="text-xs px-2 py-1 rounded-full bg-emerald-50 text-emerald-600 font-medium">
                +5%
            </span>
        </div>
    </div>

    <!-- DITOLAK -->
    <div class="bg-white p-5 rounded-xl border border-slate-200 ">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Ditolak
        </p>

        <div class="flex items-end justify-between mt-3">
            <h2 class="text-2xl font-bold text-black">0</h2>

            <span class="text-xs px-2 py-1 rounded-full bg-rose-50 text-rose-600 font-medium">
                -2%
            </span>
        </div>
    </div>

</div>
    <div class="bg-white border border-slate-200 rounded-xl  overflow-hidden mb-8">
        <!-- Top Toolbar -->
        <div class="px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row gap-4 justify-between items-center bg-white">
            <div class="w-full sm:w-72 relative">
                <input type="text" placeholder="Search applicants..." class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                <svg class="h-5 w-5 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <select class="form-select border border-slate-300 rounded-lg px-4 py-2 bg-white text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <option>All Jobs</option>
                    <option>Frontend Developer</option>
                    <option>UI/UX Designer</option>
                </select>
                <select class="form-select border border-slate-300 rounded-lg px-4 py-2 bg-white text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <option>All Status</option>
                    <option>Applied</option>
                    <option>Reviewed</option>
                    <option>Interview</option>
                    <option>Hired</option>
                    <option>Rejected</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Applicant Name</th>
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
                            <span x-show="state == 'Applied'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Applied</span>
                            <span x-show="state == 'Reviewed'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Reviewed</span>
                            <span x-show="state == 'Interview'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Interview</span>
                            <span x-show="state == 'Hired'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Hired</span>
                            <span x-show="state == 'Rejected'" style="display: none" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">Rejected</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- DROPDOWN -->
                                <div x-data="{ open: false, state: 'applied', steps: ['applied','reviewed','interview','hired'], top:0, left:0 }">

                                    <button type="button"
                                        @click="
                                            open = !open;
                                            let rect = $el.getBoundingClientRect();
                                            top = rect.bottom + window.scrollY;
                                            left = rect.right - 160;
                                        "
                                        class="px-3 py-1.5 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded text-sm font-medium">
                                        <span class="capitalize" x-text="state"></span>
                                    </button>
                                    <!-- DROPDOWN -->
                                    <div x-show="open"
                                        @click.outside="open = false"
                                        x-transition
                                        x-cloak
                                        :style="'position:fixed; top:'+top+'px; left:'+left+'px;'"
                                        class="w-40 bg-white border border-slate-200 rounded-lg shadow-lg z-[9999]">
                                        <template x-for="step in steps" :key="step">
                                            <button type="button"
                                                @click="state = step; open = false"
                                                class="w-full text-left px-4 py-2 text-sm hover:bg-slate-50 capitalize">
                                                <span x-text="step"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                                <!-- VIEW DETAIL -->
                                <a href="{{ route('applicants.show') }}"
                                    class="px-3 py-1.5 text-sm bg-slate-100 text-slate-700 rounded hover:bg-slate-200 transition">
                                    View Detail
                                </a>
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
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">UI/UX Designer</td>
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
                            <div class="flex items-center justify-end gap-2">
                                <!-- DROPDOWN -->
                                <div x-data="{ open: false, state: 'applied', steps: ['applied','reviewed','interview','hired'], top:0, left:0 }">

                                    <button type="button"
                                        @click="
                                            open = !open;
                                            let rect = $el.getBoundingClientRect();
                                            top = rect.bottom + window.scrollY;
                                            left = rect.right - 160;
                                        "
                                        class="px-3 py-1.5 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded text-sm font-medium">
                                        <span class="capitalize" x-text="state"></span>
                                    </button>
                                    <!-- DROPDOWN -->
                                    <div x-show="open"
                                        @click.outside="open = false"
                                        x-transition
                                        x-cloak
                                        :style="'position:fixed; top:'+top+'px; left:'+left+'px;'"
                                        class="w-40 bg-white border border-slate-200 rounded-lg shadow-lg z-[9999]">
                                        <template x-for="step in steps" :key="step">
                                            <button type="button"
                                                @click="state = step; open = false"
                                                class="w-full text-left px-4 py-2 text-sm hover:bg-slate-50 capitalize">
                                                <span x-text="step"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                                <!-- VIEW DETAIL -->
                                <a href="#"
                                    class="px-3 py-1.5 text-sm bg-slate-100 text-slate-700 rounded hover:bg-slate-200 transition">
                                    View Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection