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
        <button class="relative p-2.5 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/>
            </svg>

            <!-- Dot notification -->
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-blue-500 rounded-full"></span>
        </button>

        <!-- Settings -->
        <button class="p-2.5 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8a4 4 0 100 8 4 4 0 000-8zm8 4a8 8 0 01-.2 1.7l2.1 1.6-2 3.5-2.5-1a8 8 0 01-3 1.7l-.4 2.6h-4l-.4-2.6a8 8 0 01-3-1.7l-2.5 1-2-3.5 2.1-1.6A8 8 0 014 12c0-.6.1-1.1.2-1.7L2.1 8.7l2-3.5 2.5 1a8 8 0 013-1.7l.4-2.6h4l.4 2.6a8 8 0 013 1.7l2.5-1 2 3.5-2.1 1.6c.1.6.2 1.1.2 1.7z"/>
            </svg>
        </button>


    </div>

</header>