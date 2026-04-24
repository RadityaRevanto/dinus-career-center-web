@extends('company.layouts.app')

@section('content')

<div class="max-w-3xl">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-black">Edit Lowongan</h1>
        <p class="text-sm text-slate-500">Perbarui informasi lowongan pekerjaan</p>
    </div>

    <!-- FORM -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <form action="#" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- NAMA POSISI -->
            <div>
                <label class="text-sm font-medium text-black">Posisi</label>
                <input type="text" name="title"
                    value=""
                    class="mt-1 w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>

            <!-- LOKASI -->
            <div>
                <label class="text-sm font-medium text-black">Lokasi</label>
                <input type="text" name="location"
                    value=""
                    class="mt-1 w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>

            <!-- TIPE -->
            <div>
                <label class="text-sm font-medium text-black">Tipe Pekerjaan</label>
                <select name="type"
                    class="mt-1 w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 outline-none">

                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="remote">Remote</option>

                </select>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="text-sm font-medium text-black">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="mt-1 w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
            </div>

            <!-- STATUS -->
            <div>
                <label class="text-sm font-medium text-black">Status</label>
                <select name="status"
                    class="mt-1 w-full border border-slate-300 rounded-lg px-3 py-2 text-sm
                    focus:ring-2 focus:ring-indigo-500 outline-none">

                    <option value="active">Aktif</option>
                    <option value="closed">Ditutup</option>

                </select>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-2 pt-4">

                <a href="{{ route('jobs') }}"
                   class="px-4 py-2 text-sm border border-slate-300 rounded-lg hover:bg-slate-50">
                    Batal
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                    Update Lowongan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection