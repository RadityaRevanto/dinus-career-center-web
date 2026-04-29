@extends('company.layouts.app')

@section('content')
<!-- HEADER -->
<div class="mb-6 flex justify-between items-center">
    <div class="relative w-64">
        <input type="text" placeholder="Cari lowongan..."
            class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm
            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
        <svg class="h-5 w-5 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
    </div>

    <a href="{{ route('jobs.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
        + Tambah Lowongan
    </a>
</div>

<!-- STATS -->
<div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 7h18M3 12h18M3 17h18" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-black/70">Total Lowongan</p>
            <p class="text-2xl font-semibold text-black">128</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-black/70">Lowongan Aktif</p>
            <p class="text-2xl font-semibold text-black">84</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="p-3 bg-orange-50 text-orange-600 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5V4H2v16h5m10 0v-6a4 4 0 10-8 0v6m8 0H9" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-black/70">Total Pelamar</p>
            <p class="text-2xl font-semibold text-black">1,402</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
        <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4l3 3M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
        </div>
        <div>
            <p class="text-sm font-medium text-black/70">Review Dibutuhkan</p>
            <p class="text-2xl font-semibold text-black">
                12 <span class="text-sm font-normal text-black/60">pending</span>
            </p>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wide">
            <tr>
                <th class="text-left px-6 py-3">Posisi</th>
                <th class="text-left px-6 py-3">Lokasi</th>
                <th class="text-left px-6 py-3">Tipe</th>
                <th class="text-left px-6 py-3">Status</th>
                <th class="text-left px-6 py-3">Pelamar</th>
                <th class="text-right px-6 py-3">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-200">

            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4">
                    <p class="font-semibold">Frontend Developer</p>
                    <p class="text-xs text-slate-500">Diposting 5 hari lalu</p>
                </td>
                <td class="px-6 py-4">Jakarta</td>
                <td class="px-6 py-4">Full-time</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs bg-emerald-100 text-emerald-700 rounded-full">
                        Aktif
                    </span>
                </td>
                <td class="px-6 py-4 text-indigo-600 font-semibold">32</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end items-center gap-2">
                        <a href="{{ route('jobs.show') }}"
                        class="px-3 py-1 text-xs bg-indigo-50 text-indigo-600 rounded hover:bg-indigo-100 transition">
                            View Detail
                        </a>
                        <a href="{{ route('jobs.edit') }}"
                        class="px-3 py-1 text-xs bg-slate-100 text-slate-700 rounded hover:bg-slate-200 transition">
                            Edit
                        </a>
                        <form action="" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="px-3 py-1 text-xs bg-rose-50 text-rose-600 rounded hover:bg-rose-100 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4">
                    <p class="font-semibold">HRD</p>
                    <p class="text-xs text-slate-500">Diposting 5 hari lalu</p>
                </td>
                <td class="px-6 py-4">Jakarta</td>
                <td class="px-6 py-4">Full-time</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs bg-emerald-100 text-emerald-700 rounded-full">
                        Aktif
                    </span>
                </td>
                <td class="px-6 py-4 text-indigo-600 font-semibold">32</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end items-center gap-2">
                        <a href="{{ route('jobs.show') }}"
                        class="px-3 py-1 text-xs bg-indigo-50 text-indigo-600 rounded hover:bg-indigo-100 transition">
                            View Detail
                        </a>
                        <a href="{{ route('jobs.edit') }}"
                        class="px-3 py-1 text-xs bg-slate-100 text-slate-700 rounded hover:bg-slate-200 transition">
                            Edit
                        </a>
                        <form action="" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 text-xs bg-rose-50 text-rose-600 rounded hover:bg-rose-100 transition">
                                Hapus
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
        </tbody>

    </table>

</div>

@endsection