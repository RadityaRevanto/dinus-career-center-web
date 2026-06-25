<header class="min-h-16 bg-white border-b border-gray-100 flex items-center gap-2 sm:gap-3 px-4 sm:px-6 py-2 sm:py-0 shrink-0">

    <button
        type="button"
        @click="sidebarOpen = true"
        class="lg:hidden p-2.5 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition shrink-0"
        aria-label="Buka menu navigasi"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    @php
        $breadcrumbParent = null;
        $breadcrumbCurrent = null;

        if (request()->routeIs('overview')) {
            $breadcrumbCurrent = 'Dashboard';
        } elseif (request()->routeIs('jobs*')) {
            $breadcrumbParent = ['label' => 'Lowongan', 'route' => route('jobs')];
            $breadcrumbCurrent = match (true) {
                request()->routeIs('jobs.create') => 'Tambah Lowongan',
                request()->routeIs('jobs.edit') => 'Edit Lowongan',
                request()->routeIs('jobs.show') => 'Detail Lowongan',
                default => null,
            };
        } elseif (request()->routeIs('applicants*')) {
            $breadcrumbParent = ['label' => 'Pelamar', 'route' => route('applicants')];
            $breadcrumbCurrent = match (true) {
                request()->routeIs('applicants.edit') => 'Detail Pelamar',
                request()->routeIs('applicants.export') => 'Export Pelamar',
                default => null,
            };
        } elseif (request()->routeIs('interviews.*')) {
            $breadcrumbParent = ['label' => 'Jadwal Interview', 'route' => route('interviews.calendar')];
            $breadcrumbCurrent = request()->routeIs('interviews.calendar') ? null : 'Detail Interview';
        } elseif (request()->routeIs('company.password*')) {
            $breadcrumbParent = ['label' => 'Profil Perusahaan', 'route' => route('company.profile')];
            $breadcrumbCurrent = 'Ubah Password';
        } elseif (request()->routeIs('company.profile*')) {
            $breadcrumbParent = ['label' => 'Profil Perusahaan', 'route' => route('company.profile')];
            $breadcrumbCurrent = request()->routeIs('company.profile') ? null : 'Edit Profil';
        } else {
            $breadcrumbCurrent = ucfirst(request()->segment(2) ?? 'Halaman');
        }
    @endphp

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-1 sm:gap-1.5 text-xs sm:text-sm min-w-0 flex-1 overflow-hidden" aria-label="Breadcrumb">
        <a href="{{ route('overview') }}" class="flex items-center text-gray-400 hover:text-blue-600 transition shrink-0">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/>
            </svg>
        </a>

        @if($breadcrumbParent)
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ $breadcrumbParent['route'] }}" class="{{ $breadcrumbCurrent ? 'text-gray-500 hover:text-blue-600 truncate' : 'font-medium text-gray-800 truncate' }} transition min-w-0">
                {{ $breadcrumbParent['label'] }}
            </a>
        @endif

        @if($breadcrumbCurrent)
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium text-gray-800 truncate min-w-0">
                {{ $breadcrumbCurrent }}
            </span>
        @elseif(!$breadcrumbParent)
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium text-gray-800 truncate min-w-0">Dashboard</span>
        @endif
    </nav>

    <!-- Right Section -->
    <div class="flex items-center gap-1.5 sm:gap-3 ml-2 sm:ml-4 shrink-0">
        <!-- Notification -->
        <div x-data="notificationDropdown()" class="relative">
            <button @click="toggle()" class="relative p-2.5 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                <svg class="w-5 h-5" :class="{ 'animate-bell': hasUnread }" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/>
                </svg>

                <!-- Badge counter -->
                <span x-show="unreadCount > 0" x-cloak
                    class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] flex items-center justify-center text-[10px] font-bold text-white bg-red-500 rounded-full px-1 shadow-sm animate-pulse">
                    <span x-text="unreadCount > 9 ? '9+' : unreadCount"></span>
                </span>
            </button>

            <!-- Dropdown Panel -->
            <div x-show="open" @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                class="absolute right-0 mt-2 w-[calc(100vw-2rem)] sm:w-96 max-w-sm bg-white border border-gray-200 rounded-2xl shadow-xl z-50 overflow-hidden"
                x-cloak>

                <!-- Header -->
                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50/80 to-indigo-50/80">
                    <div>
                        <h6 class="text-sm font-bold text-gray-900">Notifikasi</h6>
                        <p class="text-xs text-gray-500 mt-0.5" x-text="unreadCount + ' notifikasi terbaru'"></p>
                    </div>
                    <button @click="markAllRead()" x-show="unreadCount > 0"
                        class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition hover:underline">
                        Tandai dibaca
                    </button>
                </div>

                <!-- Notification List -->
                <div class="max-h-[380px] overflow-y-auto overscroll-contain" style="scrollbar-width: thin;">

                    <!-- Loading State -->
                    <template x-if="loading">
                        <div class="flex flex-col items-center justify-center py-10">
                            <div class="w-8 h-8 border-2 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
                            <p class="text-xs text-gray-400 mt-3">Memuat notifikasi...</p>
                        </div>
                    </template>

                    <!-- Notification Items -->
                    <template x-if="!loading && notifications.length > 0">
                        <div>
                            <template x-for="(notif, index) in notifications" :key="notif.id">
                                <div class="group flex items-start gap-3 px-5 py-3.5 hover:bg-blue-50/50 transition cursor-pointer border-b border-gray-50 last:border-b-0"
                                     :class="{ 'bg-blue-50/40 border-l-2 border-l-blue-500': notif.is_new }">
                                    
                                    <!-- Avatar / Icon -->
                                    <div class="relative flex-shrink-0">
                                        <img :src="notif.foto" class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow-sm" />
                                        <span class="absolute -bottom-0.5 -right-0.5 w-5 h-5 rounded-full flex items-center justify-center shadow-sm"
                                              :class="{
                                                  'bg-blue-500': notif.icon === 'applied',
                                                  'bg-sky-500': notif.icon === 'reviewed',
                                                  'bg-amber-500': notif.icon === 'interview',
                                                  'bg-emerald-500': notif.icon === 'accepted' || notif.icon === 'completed',
                                                  'bg-rose-500': notif.icon === 'rejected'
                                              }">
                                            <!-- Applied Icon -->
                                            <svg x-show="notif.icon === 'applied'" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <!-- Reviewed Icon -->
                                            <svg x-show="notif.icon === 'reviewed'" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            <!-- Interview Icon -->
                                            <svg x-show="notif.icon === 'interview'" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <!-- Accepted Icon -->
                                            <svg x-show="notif.icon === 'accepted' || notif.icon === 'completed'" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <!-- Rejected Icon -->
                                            <svg x-show="notif.icon === 'rejected'" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </span>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-gray-900 truncate" x-text="notif.judul"></p>
                                            <span class="flex-shrink-0 text-[10px] font-medium px-1.5 py-0.5 rounded-full"
                                                :class="{
                                                    'bg-blue-100 text-blue-700': notif.icon === 'applied',
                                                    'bg-sky-100 text-sky-700': notif.icon === 'reviewed',
                                                    'bg-amber-100 text-amber-700': notif.icon === 'interview',
                                                    'bg-emerald-100 text-emerald-700': notif.icon === 'accepted' || notif.icon === 'completed',
                                                    'bg-rose-100 text-rose-700': notif.icon === 'rejected'
                                                }"
                                                x-text="notif.icon === 'applied' ? 'Baru' : notif.icon === 'reviewed' ? 'Review' : notif.icon === 'interview' ? 'Interview' : notif.icon === 'rejected' ? 'Ditolak' : 'Diterima'">
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-2" x-text="notif.pesan"></p>
                                        <p class="text-[11px] text-gray-400 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span x-text="notif.waktu"></span>
                                        </p>
                                    </div>

                                    <!-- Unread dot -->
                                    <div x-show="notif.is_new" class="flex-shrink-0 mt-2">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full block animate-pulse"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Empty State -->
                    <template x-if="!loading && notifications.length === 0">
                        <div class="flex flex-col items-center justify-center py-10 px-5">
                            <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center mb-3">
                                <svg class="w-7 h-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-700">Belum ada notifikasi</p>
                            <p class="text-xs text-gray-400 mt-1 text-center">Notifikasi terbaru akan muncul di sini</p>
                        </div>
                    </template>
                </div>

                <!-- Footer -->
                <div x-show="notifications.length > 0" class="border-t border-gray-100 px-5 py-3 bg-gray-50/50">
                    <a href="{{ route('applicants') }}" class="flex items-center justify-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                        Lihat Semua Aktivitas
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Settings Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="p-2.5 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8a4 4 0 100 8 4 4 0 000-8zm8 4a8 8 0 01-.2 1.7l2.1 1.6-2 3.5-2.5-1a8 8 0 01-3 1.7l-.4 2.6h-4l-.4-2.6a8 8 0 01-3-1.7l-2.5 1-2-3.5 2.1-1.6A8 8 0 014 12c0-.6.1-1.1.2-1.7L2.1 8.7l2-3.5 2.5 1a8 8 0 013-1.7l.4-2.6h4l.4 2.6a8 8 0 013 1.7l2.5-1 2 3.5-2.1 1.6c.1.6.2 1.1.2 1.7z"/>
                </svg>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                class="absolute right-0 mt-2 w-56 max-w-[calc(100vw-2rem)] bg-white border border-gray-200 rounded-xl shadow-lg z-50 py-1.5"
                x-cloak>

                <div class="px-4 py-2.5 border-b border-gray-100">
                    <p class="text-xs font-semibold text-gray-900">Pengaturan</p>
                    <p class="text-xs text-gray-400">Kelola akun perusahaan</p>
                </div>

                <div class="py-1">
                    <a href="{{ route('company.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Profil Perusahaan
                    </a>
                    <a href="{{ route('company.password') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Ubah Password
                    </a>
                </div>

                <div class="border-t border-gray-100 pt-1">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    @keyframes bell-shake {
        0%, 100% { transform: rotate(0deg); }
        15% { transform: rotate(12deg); }
        30% { transform: rotate(-10deg); }
        45% { transform: rotate(8deg); }
        60% { transform: rotate(-6deg); }
        75% { transform: rotate(3deg); }
    }
    .animate-bell {
        animation: bell-shake 0.8s ease-in-out;
        animation-iteration-count: 1;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    function notificationDropdown() {
        return {
            open: false,
            loading: false,
            notifications: [],
            unreadCount: 0,
            hasUnread: false,
            fetched: false,

            init() {
                // Auto-fetch on page load to show badge count
                this.fetchNotifications();
            },

            toggle() {
                this.open = !this.open;
                if (this.open && !this.fetched) {
                    this.fetchNotifications();
                }
            },

            async fetchNotifications() {
                this.loading = true;
                try {
                    const response = await fetch('{{ route("notifications.latest") }}', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    });
                    const data = await response.json();
                    this.notifications = data.notifications || [];
                    this.unreadCount = data.unread_count || 0;
                    this.hasUnread = this.unreadCount > 0;
                    this.fetched = true;
                } catch (error) {
                    console.error('Failed to fetch notifications:', error);
                    this.notifications = [];
                    this.unreadCount = 0;
                } finally {
                    this.loading = false;
                }
            },

            markAllRead() {
                this.unreadCount = 0;
                this.hasUnread = false;
            }
        }
    }
</script>