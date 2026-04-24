@extends('admin.layouts.app')
@section('content')
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden mb-8">
        <!-- Top Toolbar -->
        <div class="px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row gap-4 justify-between items-center bg-white">
            <div class="w-full sm:w-72 relative">
                <input type="text" placeholder="Search companies..." class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                <svg class="h-5 w-5 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <select class="form-select border border-slate-300 rounded-lg px-4 py-2 bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    <option>All Status</option>
                    <option>Approved</option>
                    <option>Pending</option>
                    <option>Rejected</option>
                </select>
                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Company
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Company Info</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Jobs Posted</th>
                        <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-lg">G</div>
                                <div>
                                    <span class="block font-medium text-slate-900">Global Tech Corp</span>
                                    <span class="block text-sm text-slate-500">hr@globaltech.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">Jakarta, Indonesia</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                Approved
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">12</td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View Details</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold text-lg">TV</div>
                                <div>
                                    <span class="block font-medium text-slate-900">TechVision Inc.</span>
                                    <span class="block text-sm text-slate-500">contact@techvision.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">Bandung, Indonesia</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                Pending
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">0</td>
                        <td class="px-6 py-4 text-right">
                             <div class="flex items-center justify-end gap-2">
                                <button class="text-emerald-600 hover:text-emerald-800 font-medium text-sm">Approve</button>
                                <span class="text-slate-300">|</span>
                                <button class="text-rose-600 hover:text-rose-800 font-medium text-sm">Reject</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-600">Showing <span class="font-medium text-slate-900">1</span> to <span class="font-medium text-slate-900">2</span> of <span class="font-medium text-slate-900">142</span> results</p>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 border border-slate-300 rounded text-sm text-slate-600 hover:bg-slate-50 disabled:opacity-50" disabled>Previous</button>
                <button class="px-3 py-1 border border-slate-300 rounded text-sm text-slate-600 hover:bg-slate-50">Next</button>
            </div>
        </div>
    </div>
@endsection