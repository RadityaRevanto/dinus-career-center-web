@extends('company.layouts.app')
@section('content')
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden mb-8 max-w-4xl">
        <form class="p-6 sm:p-8 space-y-6">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Job Title -->
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium leading-6 text-slate-900">Job Title <span class="text-rose-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" id="title" name="title" placeholder="e.g. Senior Frontend Developer" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>

                <!-- Job Type -->
                <div>
                    <label for="type" class="block text-sm font-medium leading-6 text-slate-900">Job Type <span class="text-rose-500">*</span></label>
                    <div class="mt-2 text-slate-900">
                        <select id="type" name="type" class="block w-full rounded-md border-0 py-2 px-3 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option>Full-time</option>
                            <option>Part-time</option>
                            <option>Contract</option>
                            <option>Internship</option>
                        </select>
                    </div>
                </div>

                <!-- Workplace Type -->
                <div>
                    <label for="workplace" class="block text-sm font-medium leading-6 text-slate-900">Workplace <span class="text-rose-500">*</span></label>
                    <div class="mt-2 text-slate-900">
                        <select id="workplace" name="workplace" class="block w-full rounded-md border-0 py-2 px-3 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option>On-site</option>
                            <option>Hybrid</option>
                            <option>Remote</option>
                        </select>
                    </div>
                </div>

                <!-- Salary Range -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium leading-6 text-slate-900">Salary Range (Optional)</label>
                    <div class="mt-2 flex items-center gap-4">
                        <input type="text" placeholder="Min" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <span class="text-slate-500">-</span>
                        <input type="text" placeholder="Max" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
            </div>

            <!-- Job Description -->
            <div>
                <label for="description" class="block text-sm font-medium leading-6 text-slate-900">Job Description <span class="text-rose-500">*</span></label>
                <div class="mt-2">
                    <textarea id="description" name="description" rows="5" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Describe the responsibilities and context for this role..."></textarea>
                </div>
            </div>

            <!-- Requirements -->
            <div>
                <label for="requirements" class="block text-sm font-medium leading-6 text-slate-900">Requirements <span class="text-rose-500">*</span></label>
                <div class="mt-2">
                    <textarea id="requirements" name="requirements" rows="5" class="block w-full rounded-md border-0 py-2 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="List the qualifications, skills, and experience required..."></textarea>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200">
                <a href="/company/jobs" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                    Cancel
                </a>
                <button type="button" onclick="alert('Job Vacancy Created Simulator!')" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                    Publish Job
                </button>
            </div>
        </form>
    </div>
@endsection