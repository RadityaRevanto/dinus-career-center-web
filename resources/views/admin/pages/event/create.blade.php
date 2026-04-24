@extends('admin.layouts.app')

@section('content')

<div class="max-w-2xl">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Buat Event</h1>
        <p class="text-sm text-slate-500">Tambahkan event baru</p>
    </div>

    <!-- FORM -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <form class="space-y-5">

            <!-- NAMA -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nama Event
                </label>
                <input type="text"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Deskripsi
                </label>
                <textarea rows="3"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"></textarea>
            </div>

            <!-- TANGGAL -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Tanggal Mulai
                    </label>
                    <input type="date"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                        focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Tanggal Selesai
                    </label>
                    <input type="date"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                        focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
            </div>

            <!-- LOKASI -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Lokasi
                </label>
                <input type="text"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>

            <!-- STATUS -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Status
                </label>
                <select
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 outline-none">
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-2 pt-4">
                <a href="/admin/events"
                   class="px-4 py-2 text-sm border border-slate-300 rounded-lg hover:bg-slate-50">
                    Batal
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">
                    Simpan Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection