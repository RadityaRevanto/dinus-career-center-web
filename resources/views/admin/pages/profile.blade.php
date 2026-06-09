@extends('admin.layouts.app')

@section('content')
@php
    $userName = session('full_name') ?: 'Admin';
    $userEmail = session('email') ?? data_get(session('user'), 'email', '-');
    $role = session('role') === 'admin' ? 'Superadmin' : ucfirst(session('role') ?? 'Admin');
    $loggedInAt = session('logged_in_at') ? \Carbon\Carbon::parse(session('logged_in_at'))->locale('id')->translatedFormat('d M Y, H:i') : '-';
    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=2563eb&color=fff&bold=true';
@endphp

<div class="space-y-6 max-w-4xl">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Profil Admin</h1>
        <p class="text-sm text-gray-500 mt-1">Informasi akun Superadmin yang sedang login.</p>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl border border-emerald-200 bg-emerald-50 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
        <div class="p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center gap-6 border-b border-gray-100 bg-gray-50/40">
            <img src="{{ $avatarUrl }}" alt="{{ $userName }}" class="w-20 h-20 rounded-3xl object-cover ring-4 ring-white shadow-sm">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $userName }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $userEmail }}</p>
                <span class="inline-flex items-center mt-3 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                    {{ $role }}
                </span>
            </div>
        </div>

        <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/60">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Nama</p>
                <p class="text-sm font-semibold text-gray-900 mt-1">{{ $userName }}</p>
            </div>
            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/60">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Email</p>
                <p class="text-sm font-semibold text-gray-900 mt-1">{{ $userEmail }}</p>
            </div>
            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/60">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Role</p>
                <p class="text-sm font-semibold text-gray-900 mt-1">{{ $role }}</p>
            </div>
            <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/60">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Login Terakhir</p>
                <p class="text-sm font-semibold text-gray-900 mt-1">{{ $loggedInAt }}</p>
            </div>
        </div>

        <div class="px-6 sm:px-8 py-5 border-t border-gray-100 flex justify-end">
            <a href="{{ route('admin.password') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-blue-600 text-sm font-semibold text-white hover:bg-blue-700 transition">
                Ubah Password
            </a>
        </div>
    </div>
</div>
@endsection
