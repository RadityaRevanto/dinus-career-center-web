<aside
    class="fixed inset-y-0 left-0 z-50 w-72 max-w-[85vw] h-screen bg-white border-r border-gray-200 flex flex-col justify-between shrink-0
           transform transition-transform duration-300 ease-in-out
           -translate-x-full lg:translate-x-0 lg:static lg:z-auto lg:max-w-none"
    :class="{ 'translate-x-0': sidebarOpen }"
    aria-label="Navigasi utama"
>
    <!-- Header -->
    <div class="flex-1 flex flex-col min-h-0 overflow-y-auto">
        <div class="px-4 sm:px-6 py-5 sm:py-6 flex items-center gap-3 sm:gap-4 border-b border-gray-100">
            <div class="w-10 h-10 sm:w-11 sm:h-11 flex items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 6V5a3 3 0 013-3h0a3 3 0 013 3v1m-9 0h12a2 2 0 012 2v3H4V8a2 2 0 012-2zm0 5h16v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7z"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h1 class="text-sm font-semibold text-gray-900 tracking-tight truncate">DCC Mobile</h1>
                <p class="text-xs text-gray-400 truncate">Perusahaan Management</p>
            </div>
            <button
                type="button"
                @click="sidebarOpen = false"
                class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition shrink-0"
                aria-label="Tutup menu"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="mt-2 px-3 space-y-1 pb-4">
            <a href="{{ route('overview') }}" @click="sidebarOpen = false"
                class="relative overflow-hidden flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
                {{ request()->routeIs('overview')
                        ? 'bg-blue-50 text-blue-600 font-medium before:absolute before:inset-y-0 before:right-0 before:w-1 before:bg-blue-600'
                        : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                Dashboard
            </a>
            <a href="{{ route('jobs') }}" @click="sidebarOpen = false"
                class="relative overflow-hidden flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
                {{ request()->routeIs('jobs*')
                        ? 'bg-blue-50 text-blue-600 font-medium before:absolute before:inset-y-0 before:right-0 before:w-1 before:bg-blue-600'
                        : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                Lowongan
            </a>
            <a href="{{ route('applicants') }}" @click="sidebarOpen = false"
                class="relative overflow-hidden flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
                {{ request()->routeIs('applicants*')
                        ? 'bg-blue-50 text-blue-600 font-medium before:absolute before:inset-y-0 before:right-0 before:w-1 before:bg-blue-600'
                        : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                Pelamar
            </a>
            <a href="{{ route('interviews.calendar') }}" @click="sidebarOpen = false"
                class="relative overflow-hidden flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
                {{ request()->routeIs('interviews.*')
                        ? 'bg-blue-50 text-blue-600 font-medium before:absolute before:inset-y-0 before:right-0 before:w-1 before:bg-blue-600'
                        : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                Jadwal Interview
            </a>
        </nav>
    </div>

    <!-- Bottom -->
    <div class="px-3 pb-4 pt-3 border-t border-gray-100 bg-gray-50/50 shrink-0">
        <div class="relative group">
            <button type="button" class="w-full flex items-center gap-3 px-3 py-2 rounded-xl">
                <div class="relative shrink-0">
                    <img
                        src="https://ui-avatars.com/api/?name=Admin&background=random"
                        class="w-10 h-10 rounded-full object-cover ring-1 ring-gray-200"
                        alt="Avatar workspace"
                    />
                </div>
                <div class="flex flex-col text-left flex-1 min-w-0 overflow-hidden">
                    <span class="text-sm font-semibold text-gray-900 truncate">
                        Admin Workspace
                    </span>
                </div>
            </button>
        </div>
    </div>
</aside>
