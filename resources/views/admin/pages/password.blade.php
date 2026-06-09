@extends('admin.layouts.app')

@section('content')
<div class="space-y-6 max-w-3xl">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Ubah Password</h1>
        <p class="text-sm text-gray-500 mt-1">Masukkan password saat ini sebelum membuat password baru.</p>
    </div>

    @if(session('error'))
        <div class="p-4 rounded-xl border border-red-200 bg-red-50 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl border border-red-200 bg-red-50 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gray-50/40">
            <h2 class="text-sm font-bold text-gray-900">Keamanan Akun</h2>
            <p class="text-xs text-gray-500 mt-1">Setelah password berhasil diubah, Anda akan diminta login kembali.</p>
        </div>

        <form action="{{ route('admin.password.update') }}" method="POST" class="p-6 sm:p-8 space-y-5">
            @csrf

            <div>
                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                <input id="current_password" type="password" name="current_password" required
                    class="block w-full px-4 py-3 bg-gray-50/70 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition"
                    placeholder="Masukkan password saat ini">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                <input id="password" type="password" name="password" required minlength="8"
                    class="block w-full px-4 py-3 bg-gray-50/70 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition"
                    placeholder="Minimal 8 karakter">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required minlength="8"
                    class="block w-full px-4 py-3 bg-gray-50/70 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition"
                    placeholder="Ulangi password baru">
            </div>

            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-3">
                <a href="{{ route('admin.profile') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-blue-600 text-sm font-semibold text-white hover:bg-blue-700 transition">
                    Simpan Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
