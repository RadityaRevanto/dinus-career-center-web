@extends('company.layouts.app')
@section('content')

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Stat 1 -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Active Job Posts</p>
                <p class="text-2xl font-bold text-slate-900">0</p>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-lg">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Applicants</p>
                <p class="text-2xl font-bold text-slate-900">0</p>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Recent Applications</p>
                <p class="text-2xl font-bold text-slate-900">0 <span class="text-sm font-normal text-slate-500">this week</span></p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <a href="/company/jobs/create" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors shadow-sm">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Post a New Job
        </a>
    </div>

    <!-- Recent Applicants -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50">
            <h2 class="text-lg font-semibold text-slate-900">Recent Applicants</h2>
            <a href="/company/applicants" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-slate-200">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Applicant Info</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Applied Position</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="h-8 w-8 rounded-full bg-slate-200" src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="">
                                <div>
                                    <span class="block font-medium text-slate-900">John Doe</span>
                                    <span class="block text-xs text-slate-500">john.doe@example.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">Frontend Developer</td>
                        <td class="px-6 py-4 text-sm text-slate-500">2 hours ago</td>
                        <td class="px-6 py-4">
                             <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                Pending Review
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img class="h-8 w-8 rounded-full bg-slate-200" src="https://ui-avatars.com/api/?name=Jane+Smith&background=random" alt="">
                                <div>
                                    <span class="block font-medium text-slate-900">Jane Smith</span>
                                    <span class="block text-xs text-slate-500">jane.smith@example.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-700 font-medium">UI/UX Designer</td>
                        <td class="px-6 py-4 text-sm text-slate-500">1 day ago</td>
                        <td class="px-6 py-4">
                             <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                Interview Scheduled
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection