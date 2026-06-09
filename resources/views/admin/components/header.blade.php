<header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-6">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-1.5 text-sm">
        <a href="{{ route('dashboard') }}" class="flex items-center text-gray-400 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/>
            </svg>
        </a>
        <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="font-medium text-gray-800">
            @if(request()->routeIs('dashboard'))
                Dashboard
            @elseif(request()->routeIs('admin.profile'))
                Profil Admin
            @elseif(request()->routeIs('admin.password'))
                Ubah Password
            @elseif(request()->routeIs('companies*'))
                Perusahaan
            @elseif(request()->routeIs('job_listings*'))
                Lowongan
            @elseif(request()->routeIs('events*'))
                Event
            @else
                {{ ucfirst(request()->segment(2) ?? 'Halaman') }}
            @endif
        </span>
    </nav>

    <!-- Right Section -->
    <div class="flex items-center gap-3 ml-6">

        <!-- Notification -->
        <div id="admin-notification" class="relative">
            <button type="button" data-notification-toggle
                class="relative p-2.5 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/>
                </svg>

                <span data-notification-badge
                    class="hidden absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white shadow-sm">
                    0
                </span>
            </button>

            <div data-notification-panel
                class="hidden absolute right-0 mt-2 w-96 overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-xl z-50">
                <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 bg-linear-to-r from-blue-50/80 to-indigo-50/80">
                    <div>
                        <h6 class="text-sm font-bold text-gray-900">Notifikasi Admin</h6>
                        <p data-notification-summary class="text-xs text-gray-500 mt-0.5">Memuat notifikasi...</p>
                    </div>
                    <button type="button" data-notification-read
                        class="hidden text-xs font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                        Tandai dibaca
                    </button>
                </div>

                <div data-notification-list class="max-h-[380px] overflow-y-auto overscroll-contain">
                    <div class="flex flex-col items-center justify-center py-10">
                        <div class="w-8 h-8 border-2 border-blue-200 border-t-blue-600 rounded-full animate-spin"></div>
                        <p class="text-xs text-gray-400 mt-3">Memuat notifikasi...</p>
                    </div>
                </div>

                <div class="border-t border-gray-100 px-5 py-3 bg-gray-50/50">
                    <a href="{{ route('companies', ['status' => 'pending']) }}"
                        class="flex items-center justify-center gap-1.5 text-sm font-semibold text-blue-600 hover:text-blue-700 transition">
                        Lihat Antrian Review
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <details class="relative group">
            <summary class="list-none cursor-pointer p-2.5 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8a4 4 0 100 8 4 4 0 000-8zm8 4a8 8 0 01-.2 1.7l2.1 1.6-2 3.5-2.5-1a8 8 0 01-3 1.7l-.4 2.6h-4l-.4-2.6a8 8 0 01-3-1.7l-2.5 1-2-3.5 2.1-1.6A8 8 0 014 12c0-.6.1-1.1.2-1.7L2.1 8.7l2-3.5 2.5 1a8 8 0 013-1.7l.4-2.6h4l.4 2.6a8 8 0 013 1.7l2.5-1 2 3.5-2.1 1.6c.1.6.2 1.1.2 1.7z"/>
                </svg>
            </summary>

            <div class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-2xl shadow-xl z-50 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/70">
                    <p class="text-xs font-bold text-gray-900">Pengaturan Admin</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ session('email') ?? data_get(session('user'), 'email', 'Superadmin') }}</p>
                </div>

                <div class="py-1.5">
                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0"/>
                        </svg>
                        Profil Admin
                    </a>
                    <a href="{{ route('admin.password') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Ubah Password
                    </a>
                </div>

                <div class="border-t border-gray-100 py-1.5">
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
        </details>


    </div>

</header>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const root = document.getElementById('admin-notification');

    if (!root) {
        return;
    }

    const toggle = root.querySelector('[data-notification-toggle]');
    const panel = root.querySelector('[data-notification-panel]');
    const badge = root.querySelector('[data-notification-badge]');
    const list = root.querySelector('[data-notification-list]');
    const summary = root.querySelector('[data-notification-summary]');
    const readButton = root.querySelector('[data-notification-read]');
    let loaded = false;

    const escapeHtml = (value) => String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

    const iconClass = (type) => {
        if (type === 'company') {
            return 'bg-amber-100 text-amber-700';
        }

        if (type === 'application') {
            return 'bg-violet-100 text-violet-700';
        }

        if (type === 'job') {
            return 'bg-indigo-100 text-indigo-700';
        }

        return 'bg-blue-100 text-blue-700';
    };

    const iconText = (type) => {
        if (type === 'company') {
            return 'P';
        }

        if (type === 'application') {
            return 'L';
        }

        if (type === 'job') {
            return 'J';
        }

        return 'N';
    };

    const renderBadge = (count) => {
        if (count > 0) {
            badge.textContent = count > 9 ? '9+' : count;
            badge.classList.remove('hidden');
            badge.classList.add('flex');
            readButton.classList.remove('hidden');
            return;
        }

        badge.classList.add('hidden');
        badge.classList.remove('flex');
        readButton.classList.add('hidden');
    };

    const renderNotifications = (notifications) => {
        if (!notifications.length) {
            list.innerHTML = `
                <div class="flex flex-col items-center justify-center py-10 px-5">
                    <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center mb-3">
                        <svg class="w-7 h-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Belum ada notifikasi</p>
                    <p class="text-xs text-gray-400 mt-1 text-center">Aktivitas terbaru akan muncul di sini</p>
                </div>
            `;
            return;
        }

        list.innerHTML = notifications.map((notif) => {
            const tag = notif.url ? 'a' : 'div';
            const href = notif.url ? ` href="${escapeHtml(notif.url)}"` : '';

            return `
                <${tag}${href} class="group flex items-start gap-3 px-5 py-3.5 hover:bg-blue-50/50 transition border-b border-gray-50 last:border-b-0 ${notif.is_new ? 'bg-blue-50/40 border-l-2 border-l-blue-500' : ''}">
                    <div class="shrink-0 w-10 h-10 rounded-xl ${iconClass(notif.type)} flex items-center justify-center text-xs font-bold">
                        ${iconText(notif.type)}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-semibold text-gray-900 truncate">${escapeHtml(notif.judul)}</p>
                            ${notif.is_new ? '<span class="shrink-0 text-[10px] font-semibold px-1.5 py-0.5 rounded-full bg-blue-100 text-blue-700">Baru</span>' : ''}
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">${escapeHtml(notif.pesan)}</p>
                        <p class="text-[11px] text-gray-400 mt-1">${escapeHtml(notif.waktu)}</p>
                    </div>
                    ${notif.is_new ? '<span class="shrink-0 mt-2 w-2 h-2 bg-blue-500 rounded-full"></span>' : ''}
                </${tag}>
            `;
        }).join('');
    };

    const fetchNotifications = async () => {
        try {
            const response = await fetch("{{ route('admin.notifications.latest') }}", {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
            const data = await response.json();
            const notifications = data.notifications || [];
            const unreadCount = data.unread_count || 0;

            summary.textContent = `${unreadCount} notifikasi baru`;
            renderBadge(unreadCount);
            renderNotifications(notifications);
            loaded = true;
        } catch (error) {
            console.error('Failed to fetch admin notifications:', error);
            summary.textContent = 'Gagal memuat notifikasi';
            list.innerHTML = '<div class="p-6 text-center text-sm text-red-500">Notifikasi gagal dimuat.</div>';
        }
    };

    toggle.addEventListener('click', function () {
        panel.classList.toggle('hidden');

        if (!loaded) {
            fetchNotifications();
        }
    });

    readButton.addEventListener('click', function () {
        renderBadge(0);
        summary.textContent = '0 notifikasi baru';
        list.querySelectorAll('.bg-blue-50\\/40').forEach((item) => item.classList.remove('bg-blue-50/40', 'border-l-2', 'border-l-blue-500'));
        list.querySelectorAll('.bg-blue-100.text-blue-700').forEach((item) => {
            if (item.textContent.trim() === 'Baru') {
                item.remove();
            }
        });
    });

    document.addEventListener('click', function (event) {
        if (!root.contains(event.target)) {
            panel.classList.add('hidden');
        }
    });

    fetchNotifications();
});
</script>