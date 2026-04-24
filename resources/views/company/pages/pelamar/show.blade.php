@extends('company.layouts.app')

@section('content')

<div class="max-w-5xl">
    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm mb-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <!-- AVATAR -->
            <img class="h-14 w-14 rounded-full"
                 src="https://ui-avatars.com/api/?name={{ $applicant->name ?? 'John Doe' }}&background=random">

            <div>
                <h1 class="text-lg font-semibold text-black">
                    {{ $applicant->name ?? 'John Doe' }}
                </h1>
                <p class="text-sm text-slate-500">
                    {{ $applicant->email ?? 'john.doe@example.com' }}
                </p>
            </div>
        </div>
        <!-- STATUS BADGE -->
        <span class="px-3 py-1 text-xs font-medium rounded-full
            @if(($applicant->status ?? 'applied') == 'applied') bg-slate-100 text-slate-700
            @elseif($applicant->status == 'reviewed') bg-indigo-50 text-indigo-600
            @elseif($applicant->status == 'interview') bg-amber-50 text-amber-600
            @elseif($applicant->status == 'hired') bg-emerald-50 text-emerald-600
            @elseif($applicant->status == 'rejected') bg-rose-50 text-rose-600
            @endif
        ">
            {{ strtoupper($applicant->status ?? 'APPLIED') }}
        </span>
    </div>

    <!-- MAIN CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- LEFT -->
        <div class="lg:col-span-2 space-y-6">
            <!-- INFORMASI -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-700 mb-4">Informasi Pelamar</h2>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-slate-500">Nama</p>
                        <p class="font-medium text-black">{{ $applicant->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Email</p>
                        <p class="font-medium text-black">{{ $applicant->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-500">Posisi Dilamar</p>
                        <p class="font-medium text-black">{{ $applicant->job_title ?? 'Frontend Developer' }}</p>
                    </div>

                </div>
            </div>
            <!-- DOKUMEN -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-700 mb-4">Dokumen</h2>
                <div class="flex gap-3">
                    <a href="{{ $applicant->cv ?? '#' }}"
                       class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">
                        📄 CV
                    </a>
                    <a href="{{ $applicant->portfolio ?? '#' }}"
                       class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-lg text-sm hover:bg-slate-50">
                        📁 Portofolio
                    </a>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="space-y-6">
            <!-- STATUS PIPELINE -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                <h2 class="text-sm font-semibold text-slate-700 mb-4">Progress Status</h2>
                @php
                    $steps = ['applied','reviewed','interview','hired','rejected'];
                    $current = $applicant->status ?? 'applied';
                @endphp
                <div class="space-y-3">
                    @foreach($steps as $step)
                        <div class="flex items-center gap-3">

                            <div class="w-2.5 h-2.5 rounded-full
                                {{ $current == $step ? 'bg-indigo-600' : 'bg-slate-300' }}">
                            </div>

                            <span class="text-sm
                                {{ $current == $step ? 'text-black font-medium' : 'text-slate-400' }}">
                                {{ ucfirst($step) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection