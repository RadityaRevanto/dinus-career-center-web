@extends('admin.layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Edit Event</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui detail event, jadwal, gambar, dan status publikasi.</p>
        </div>
        <a href="{{ route('events') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white hover:bg-gray-50 border border-gray-200 rounded-xl transition-all duration-200">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
        <div class="px-6 sm:px-8 py-5 border-b border-gray-100 bg-gray-50/30">
            <h2 class="text-sm font-bold text-gray-900">Informasi Event</h2>
            <p class="text-xs text-gray-500 mt-1">Kosongkan input gambar jika tidak ingin mengganti gambar yang sudah ada.</p>
        </div>

        @if(session('error'))
        <div class="mx-6 mt-6 rounded-2xl border border-rose-100 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mx-6 mt-6 rounded-2xl border border-rose-100 bg-rose-50 px-4 py-3 text-sm text-rose-700">
            <p class="font-semibold">Periksa kembali input event:</p>
            <ul class="mt-2 list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('events.update', $event['id']) }}" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Event <span class="text-rose-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $event['title'] ?? '') }}" placeholder="Contoh: Job Fair 2026"
                            class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" required>
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">Slug <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $event['slug'] ?? '') }}" placeholder="job-fair-2026"
                            class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="description" name="description" rows="7" placeholder="Tuliskan ringkasan event, target peserta, dan informasi penting lainnya."
                            class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 resize-y">{{ old('description', $event['description'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="benefits" class="block text-sm font-semibold text-gray-700 mb-2">Benefits</label>
                        <textarea id="benefits" name="benefits" rows="4" placeholder="Contoh: Sertifikat, networking, sesi konsultasi karier."
                            class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 resize-y">{{ old('benefits', $event['benefits'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Banner Event</label>
                        @if(!empty($event['image_url']))
                        <img src="{{ $event['image_url'] }}" alt="Banner Event" class="mb-3 h-32 w-full rounded-2xl object-cover border border-gray-100">
                        @endif
                        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50/50 px-4 py-3 text-sm text-gray-900 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                        <p class="mt-1 text-xs text-gray-400">Upload ke Supabase Storage: <span class="font-semibold">event-images/banners</span>. Maksimal 2MB.</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label for="event_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Event <span class="text-rose-500">*</span></label>
                            <input type="date" id="event_date" name="event_date" value="{{ old('event_date', $event['event_date'] ?? '') }}"
                                class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" required>
                        </div>
                        <div>
                            <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">Jam Mulai <span class="text-rose-500">*</span></label>
                            <input type="time" id="start_time" name="start_time" value="{{ old('start_time', isset($event['start_time']) ? substr($event['start_time'], 0, 5) : '') }}"
                                class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200" required>
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">Jam Selesai</label>
                            <input type="time" id="end_time" name="end_time" value="{{ old('end_time', isset($event['end_time']) ? substr($event['end_time'], 0, 5) : '') }}"
                                class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                        </div>
                    </div>

                    <div>
                        <label for="location_name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lokasi</label>
                        <input type="text" id="location_name" name="location_name" value="{{ old('location_name', $event['location_name'] ?? '') }}" placeholder="Contoh: Aula UDINUS"
                            class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea id="address" name="address" rows="3" placeholder="Alamat lengkap lokasi event."
                            class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 resize-y">{{ old('address', $event['address'] ?? '') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <input type="text" id="category" name="category" value="{{ old('category', $event['category'] ?? '') }}" placeholder="Career Fair"
                                class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                        </div>
                        <div>
                            <label for="organizer" class="block text-sm font-semibold text-gray-700 mb-2">Organizer</label>
                            <input type="text" id="organizer" name="organizer" value="{{ old('organizer', $event['organizer'] ?? '') }}" placeholder="Dinus Career Center"
                                class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status Event</label>
                        <select id="status" name="status"
                            class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                            @foreach(['draft' => 'Draft', 'published' => 'Published', 'closed' => 'Closed', 'cancelled' => 'Cancelled'] as $value => $label)
                            <option value="{{ $value }}" {{ old('status', $event['status'] ?? 'draft') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    @php
                        $speakerRows = old('speakers');
                        if ($speakerRows === null) {
                            $speakerRows = !empty($speakers) ? $speakers : [['nama' => '', 'jabatan' => '', 'foto' => '']];
                        }
                    @endphp
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900">Speakers</h3>
                            <p class="text-xs text-gray-500 mt-1">Edit, hapus, atau tambahkan speaker untuk event ini.</p>
                        </div>
                        <button type="button" id="add-speaker"
                            class="inline-flex items-center gap-2 rounded-xl bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah Speaker
                        </button>
                    </div>

                    <div id="speakers-wrapper" class="space-y-4">
                        @foreach($speakerRows as $index => $speaker)
                        @php
                            $existingImage = $speaker['existing_speaker_image'] ?? ($speaker['foto'] ?? ($speaker['speaker_image'] ?? ''));
                        @endphp
                        <div class="speaker-item rounded-2xl border border-gray-100 bg-gray-50/40 p-4">
                            <div class="mb-4 flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-800">Speaker <span data-speaker-number>{{ $index + 1 }}</span></p>
                                <button type="button" data-remove-speaker class="text-xs font-semibold text-rose-600 hover:text-rose-700">Hapus</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Speaker</label>
                                    <input type="text" name="speakers[{{ $index }}][speaker_name]" value="{{ $speaker['speaker_name'] ?? ($speaker['nama'] ?? '') }}" placeholder="Nama narasumber"
                                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan Speaker</label>
                                    <input type="text" name="speakers[{{ $index }}][speaker_title]" value="{{ $speaker['speaker_title'] ?? ($speaker['jabatan'] ?? '') }}" placeholder="HR Manager, CEO, dll"
                                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Speaker</label>
                                @if(!empty($existingImage))
                                <img src="{{ $existingImage }}" alt="Foto Speaker" class="mb-3 h-24 w-24 rounded-2xl object-cover border border-gray-100">
                                @endif
                                <input type="hidden" name="speakers[{{ $index }}][existing_speaker_image]" value="{{ $existingImage }}">
                                <input type="file" name="speakers[{{ $index }}][speaker_image]" accept="image/jpeg,image/png,image/jpg,image/webp"
                                    class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                                <p class="mt-1 text-xs text-gray-400">Kosongkan jika tidak ingin mengganti foto. Upload ke <span class="font-semibold">event-images/speakers</span>.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="max_participants" class="block text-sm font-semibold text-gray-700 mb-2">Max Participants</label>
                            <input type="number" id="max_participants" name="max_participants" value="{{ old('max_participants', $event['max_participants'] ?? 0) }}" min="0"
                                class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                        </div>
                        <div>
                            <label for="registration_link" class="block text-sm font-semibold text-gray-700 mb-2">Registration Link</label>
                            <input type="url" id="registration_link" name="registration_link" value="{{ old('registration_link', $event['registration_link'] ?? '') }}" placeholder="https://forms.gle/..."
                                class="block w-full px-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('events') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.getElementById('speakers-wrapper');
    const addButton = document.getElementById('add-speaker');

    function refreshSpeakerNumbers() {
        wrapper.querySelectorAll('.speaker-item').forEach(function (item, index) {
            item.querySelector('[data-speaker-number]').textContent = index + 1;
            item.querySelectorAll('input').forEach(function (input) {
                input.name = input.name.replace(/speakers\[\d+\]/, 'speakers[' + index + ']');
            });
        });
    }

    function createSpeakerItem(index) {
        const item = document.createElement('div');
        item.className = 'speaker-item rounded-2xl border border-gray-100 bg-gray-50/40 p-4';
        item.innerHTML = `
            <div class="mb-4 flex items-center justify-between">
                <p class="text-sm font-semibold text-gray-800">Speaker <span data-speaker-number>${index + 1}</span></p>
                <button type="button" data-remove-speaker class="text-xs font-semibold text-rose-600 hover:text-rose-700">Hapus</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Speaker</label>
                    <input type="text" name="speakers[${index}][speaker_name]" placeholder="Nama narasumber"
                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan Speaker</label>
                    <input type="text" name="speakers[${index}][speaker_title]" placeholder="HR Manager, CEO, dll"
                        class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-900 placeholder:text-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Speaker</label>
                <input type="hidden" name="speakers[${index}][existing_speaker_image]" value="">
                <input type="file" name="speakers[${index}][speaker_image]" accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200">
                <p class="mt-1 text-xs text-gray-400">Upload ke Supabase Storage: <span class="font-semibold">event-images/speakers</span>. Maksimal 2MB.</p>
            </div>
        `;

        return item;
    }

    addButton?.addEventListener('click', function () {
        wrapper.appendChild(createSpeakerItem(wrapper.querySelectorAll('.speaker-item').length));
    });

    wrapper?.addEventListener('click', function (event) {
        if (!event.target.matches('[data-remove-speaker]')) return;

        if (wrapper.querySelectorAll('.speaker-item').length === 1) {
            event.target.closest('.speaker-item').querySelectorAll('input').forEach(function (input) {
                input.value = '';
            });
            event.target.closest('.speaker-item').querySelectorAll('img').forEach(function (image) {
                image.remove();
            });
            return;
        }

        event.target.closest('.speaker-item').remove();
        refreshSpeakerNumbers();
    });

    refreshSpeakerNumbers();
});
</script>
@endpush
@endsection
