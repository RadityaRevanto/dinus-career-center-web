@extends('admin.layouts.app')
@section('content')
<div class="space-y-8">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('error') }}
    </div>
    @endif
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl text-sm font-medium">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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
                <div class="bg-gray-50/80 rounded-xl p-3.5">
                    <p class="text-xs text-gray-400 mb-1.5">Deskripsi Perusahaan</p>
                    <p class="text-sm font-semibold text-gray-900 leading-relaxed">{{ $data['deskripsi_perusahaan'] ?? 'Belum ada deskripsi.' }}</p>
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

    <!-- Daftar Lowongan -->
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Lowongan Perusahaan</h2>
                <p class="text-sm text-gray-500 mt-1">Semua lowongan yang dipublikasikan oleh {{ $data['nama_perusahaan'] ?? 'perusahaan ini' }}.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2 text-sm">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                    Total: {{ $totalLowongan }}
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                    Aktif: {{ $lowonganAktif }}
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                    Ditutup: {{ $lowonganTutup }}
                </span>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Posisi / Judul</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tipe & Sektor</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kuota</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Batas Akhir</th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Gaji</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($lowongan as $item)
                        <tr class="hover:bg-indigo-50/30 transition-colors group {{ ($item['status_loker'] ?? '') == 'tidak' ? 'opacity-60' : '' }}">
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="shrink-0 h-12 w-12 flex items-center justify-center rounded-2xl border border-gray-100 bg-white shadow-sm group-hover:border-indigo-200 group-hover:shadow-indigo-100 transition-all duration-200">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $item['judul'] ?? '-' }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $item['jabatan']['nama'] ?? '-' }} &bull; {{ $item['jurusan']['nama'] ?? '-' }}</div>
                                        @if(!empty($item['created_at']))
                                        <div class="text-xs text-gray-400 mt-0.5">Diposting {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex flex-col gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 w-fit">
                                        {{ $item['tipe_pekerjaan']['nama'] ?? '-' }}
                                    </span>
                                    <div class="text-xs text-gray-500 flex items-center gap-1 font-medium">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        {{ $item['sektor']['nama'] ?? '-' }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                @if(($item['status_loker'] ?? '') == 'aktif')
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Aktif
                                </span>
                                @else
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Ditutup
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="text-sm font-bold text-gray-900">{{ $item['jumlah_person'] ?? 0 }}</span>
                                    <span class="text-xs text-gray-400">orang</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                @php
                                    $batasAkhir = $item['batas_akhir'] ?? null;
                                    $isExpired = $batasAkhir && \Carbon\Carbon::parse($batasAkhir)->isPast();
                                @endphp
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 {{ $isExpired ? 'text-rose-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm {{ $isExpired ? 'text-rose-600 font-semibold' : 'text-gray-700' }}">
                                        {{ $batasAkhir ? \Carbon\Carbon::parse($batasAkhir)->format('d M Y') : '-' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-700">{{ $item['range_gaji'] ?? '-' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-gray-900 font-semibold text-lg">Belum ada lowongan</p>
                                    <p class="text-gray-400 text-sm mt-1">Perusahaan ini belum memublikasikan lowongan pekerjaan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($totalLowongan > 0)
            @include('company.components.table-pagination', [
                'id' => 'company-jobs',
                'paginator' => $lowongan,
                'rowsPerPageOptions' => $lowonganPerPageOptions ?? [10, 25, 50, 100],
                'label' => 'Company jobs table pagination',
            ])
            @endif
        </div>
    </div>

    <!-- Action Bar -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] p-5 space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-sm font-bold text-gray-900">Keputusan Verifikasi</h2>
                @if(($data['status_verifikasi'] ?? '') === 'pending')
                <p class="text-sm text-gray-500 mt-1">Review identitas, kontak, alamat, dan lowongan perusahaan sebelum menyetujui atau menolak. Email notifikasi akan dikirim ke <strong>{{ $data['email_perusahaan'] ?? '-' }}</strong>.</p>
                @elseif(($data['status_verifikasi'] ?? '') === 'accepted')
                <p class="text-sm text-gray-500 mt-1">Perusahaan ini sudah terverifikasi. Status masih bisa diubah jika ditemukan masalah.</p>
                @else
                <p class="text-sm text-gray-500 mt-1">Perusahaan ini ditolak. Status masih bisa diubah jika perusahaan sudah memenuhi syarat.</p>
                @endif
            </div>
            @if(($data['status_verifikasi'] ?? '') !== 'accepted')
            <form method="POST" action="{{ route('admin.verify.company') }}" onsubmit="return confirm('Setujui perusahaan ini? Email notifikasi akan dikirim ke perusahaan.')">
                @csrf
                <input type="hidden" name="id" value="{{ $data['perusahaan_id'] }}">
                <input type="hidden" name="status" value="accepted">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Setujui & Kirim Email
                </button>
            </form>
            @endif
        </div>

        @if(($data['status_verifikasi'] ?? '') !== 'rejected')
        <form method="POST" action="{{ route('admin.verify.company') }}" class="border-t border-gray-100 pt-5 space-y-4"
            onsubmit="return confirm('Tolak perusahaan ini? Alasan penolakan akan dikirim ke email perusahaan.')">
            @csrf
            <input type="hidden" name="id" value="{{ $data['perusahaan_id'] }}">
            <input type="hidden" name="status" value="rejected">
            <div>
                <label for="alasan_penolakan" class="block text-sm font-semibold text-gray-900">
                    Alasan Penolakan <span class="text-rose-500">*</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">Wajib diisi. Teks ini akan dikirim ke email perusahaan bersama notifikasi penolakan.</p>
                <textarea
                    id="alasan_penolakan"
                    name="alasan_penolakan"
                    rows="4"
                    required
                    minlength="10"
                    maxlength="1000"
                    placeholder="Contoh: Data profil perusahaan belum lengkap atau dokumen legalitas belum valid."
                    class="mt-3 block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all duration-200"
                >{{ old('alasan_penolakan') }}</textarea>
                @error('alasan_penolakan')
                <p class="mt-2 text-xs font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    Tolak & Kirim Email
                </button>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
