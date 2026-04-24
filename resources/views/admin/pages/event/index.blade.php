@extends('admin.layouts.app')

@section('content')

<!-- HEADER -->
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-semibold text-slate-900">Manajemen Event</h1>
        <p class="text-sm text-slate-500">Kelola semua event yang tersedia</p>
    </div>

    <a href="{{ route('events.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
        + Buat Event
    </a>
</div>

<!-- SEARCH -->
<div class="mb-4">
    <input type="text" placeholder="Cari event..."
        class="w-full md:w-64 px-3 py-2 border border-slate-300 rounded-lg text-sm
        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
</div>

<!-- TABLE -->
<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wide">
            <tr>
                <th class="px-6 py-3 text-left">Nama Event</th>
                <th class="px-6 py-3 text-left">Tanggal</th>
                <th class="px-6 py-3 text-left">Lokasi</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-200">

            <!-- ROW -->
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4">
                    <p class="font-semibold text-slate-900">Job Fair 2026</p>
                    <p class="text-xs text-slate-500">Career Expo UDINUS</p>
                </td>

                <td class="px-6 py-4 text-slate-600">
                    12 Juni 2026
                </td>

                <td class="px-6 py-4 text-slate-600">
                    Aula UDINUS
                </td>

                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs bg-emerald-100 text-emerald-700 rounded-full">
                        Aktif
                    </span>
                </td>

                <td class="px-6 py-4 text-right space-x-2">
                    <button class="px-3 py-1 text-xs bg-slate-100 rounded hover:bg-slate-200">
                        Edit
                    </button>
                    <button class="px-3 py-1 text-xs bg-rose-50 text-rose-600 rounded hover:bg-rose-100">
                        Hapus
                    </button>
                </td>
            </tr>

        </tbody>

    </table>

</div>

@endsection