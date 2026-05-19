@extends('admin.layouts.app')
@section('content')
<div class="space-y-8">

    <!-- Back Button & Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Perusahaan</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap perusahaan yang terdaftar.</p>
            </div>
        </div>
        <div>
            @if(($data['status_verifikasi'] ?? '') === 'pending')
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span> Menunggu Verifikasi
            </span>
            @elseif(($data['status_verifikasi'] ?? '') === 'accepted')
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Terverifikasi
            </span>
            @else
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-red-50 text-red-700 border border-red-100">
                <span class="w-2 h-2 rounded-full bg-red-500"></span> Ditolak
            </span>
            @endif
        </div>
    </div>

    <!-- 2-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Column: Identitas -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-900">Identitas Perusahaan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Logo, nama, dan informasi umum.</p>
            </div>
            <div class="p-6 space-y-5">
                <!-- Logo & Name -->
                <div class="flex items-center gap-4">
                    @if(!empty($data['logo']))
                        <img src="{{ $data['logo'] }}" class="w-16 h-16 rounded-2xl object-cover border border-gray-200 shadow-sm" />
                    @else
                        <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xl border border-indigo-100">
                            {{ strtoupper(substr($data['nama_perusahaan'] ?? 'N', 0, 2)) }}
                        </div>
                    @endif
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">{{ $data['nama_perusahaan'] ?? '-' }}</h4>
                        <p class="text-sm text-gray-500">{{ $data['email_perusahaan'] ?? '-' }}</p>
                    </div>
                </div>
                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Jenis Penyedia</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['jenis_penyedia'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Website</p>
                        @if(!empty($data['website_perusahaan']))
                            <a href="{{ $data['website_perusahaan'] }}" target="_blank" class="text-sm font-semibold text-blue-600 hover:underline truncate block">{{ $data['website_perusahaan'] }}</a>
                        @else
                            <p class="text-sm font-semibold text-gray-900">-</p>
                        @endif
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <p class="text-xs text-gray-400 mb-1.5">Deskripsi Perusahaan</p>
                    <p class="text-sm text-gray-700 leading-relaxed">{{ $data['deskripsi_perusahaan'] ?? 'Belum ada deskripsi.' }}</p>
                </div>

                <!-- Tanggal Daftar -->
                <div class="bg-gray-50/80 rounded-xl p-3.5">
                    <p class="text-xs text-gray-400 mb-1">Terdaftar Sejak</p>
                    <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($data['created_at'])->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Kontak & Alamat -->
        <div class="flex flex-col gap-6">

            <!-- Kontak -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900">Informasi Kontak</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Contact person dan nomor telepon.</p>
                </div>
                <div class="p-6 grid grid-cols-2 gap-4">
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Contact Person</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['nama_cp'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Jabatan</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['jabatan'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">No. Handphone</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['no_handphone'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">No. Telepon</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['no_telepon'] ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50/80 rounded-xl p-3.5 col-span-2">
                        <p class="text-xs text-gray-400 mb-1">No. Fax</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['no_fax'] ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900">Alamat & Lokasi</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Alamat lengkap kantor perusahaan.</p>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-gray-50/80 rounded-xl p-3.5">
                        <p class="text-xs text-gray-400 mb-1">Alamat</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $data['alamat_perusahaan'] ?? '-' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50/80 rounded-xl p-3.5">
                            <p class="text-xs text-gray-400 mb-1">Kota</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $data['kota'] ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50/80 rounded-xl p-3.5">
                            <p class="text-xs text-gray-400 mb-1">Kode Pos</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $data['kode_pos'] ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Action Bar -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-500">Ubah status verifikasi perusahaan ini.</p>
        <div class="flex items-center gap-3">
            @if(($data['status_verifikasi'] ?? '') !== 'accepted')
            <form method="POST" action="{{ route('admin.verify.company') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $data['perusahaan_id'] }}">
                <input type="hidden" name="status" value="accepted">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Setuju
                </button>
            </form>
            @endif
            @if(($data['status_verifikasi'] ?? '') !== 'rejected')
            <form method="POST" action="{{ route('admin.verify.company') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $data['perusahaan_id'] }}">
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    Tolak
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
