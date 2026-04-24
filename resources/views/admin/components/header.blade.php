<header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-6">

    <!-- Search -->
    <div class="flex items-center w-full max-w-md">
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <!-- icon search -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.3-4.3m1.3-5.2a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>

            <input type="text" placeholder="Search..."
                class="w-full pl-9 pr-4 py-2 text-sm rounded-xl bg-gray-50 border border-gray-200 
                       focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 
                       transition">
        </div>
    </div>

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