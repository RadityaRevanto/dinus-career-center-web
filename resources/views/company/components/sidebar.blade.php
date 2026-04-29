<aside class="w-72 h-screen bg-white border-r border-gray-200 flex flex-col justify-between">
    <!-- Header -->
    <div>
        <div class="px-6 py-6 flex items-center gap-4 border-b border-gray-100">
            <div class="w-11 h-11 flex items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" 
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M9 6V5a3 3 0 013-3h0a3 3 0 013 3v1m-9 0h12a2 2 0 012 2v3H4V8a2 2 0 012-2zm0 5h16v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-sm font-semibold text-gray-900 tracking-tight">DCC Mobile</h1>
                <p class="text-xs text-gray-400">Admin Management</p>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2 px-3 space-y-1">
            <!-- Item -->
            <a href="{{ route('overview') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
            {{ request()->routeIs('overview') 
                    ? 'bg-blue-50 text-blue-600 font-medium' 
                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <!-- icon -->
                Dashboard
            </a>
            <a href="{{ route('jobs') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
            {{ request()->routeIs('jobs') 
                    ? 'bg-blue-50 text-blue-600 font-medium' 
                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <!-- icon -->
                Lowongan
            </a>
            <a href="{{ route('applicants') }}"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm
            {{ request()->routeIs('applicants') 
                    ? 'bg-blue-50 text-blue-600 font-medium' 
                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <!-- icon -->
                Pelamar
            </a>
        </nav>
    </div>

<!-- Bottom (refined) -->
<div class="px-3 pb-4 pt-3 border-t border-gray-100 bg-gray-50/50">
    <div class="relative group">
        <!-- Trigger -->
        <button class="w-full flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-100 transition">
            <!-- Avatar -->
            <div class="relative">
                <img 
                    src="https://ui-avatars.com/api/?name=Admin&background=random" 
                    class="w-10 h-10 rounded-full object-cover ring-1 ring-gray-200"
                />
            </div>

            <!-- Info -->
            <div class="flex flex-col text-left flex-1 overflow-hidden">
                <span class="text-sm font-semibold text-gray-900 truncate">
                    Admin Workspace
                </span>
                <span class="text-xs text-gray-400 tracking-wide">
                    Pro Plan
                </span>
            </div>

            <!-- Arrow -->
            <svg class="w-4 h-4 text-gray-400 transition group-hover:rotate-180" 
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- Dropdown -->
        <div class="absolute bottom-full mb-2 w-full opacity-0 scale-95 pointer-events-none 
                    group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto 
                    transition-all duration-150">
            
            <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-1">
                
                <form action="#" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-500 
                               hover:bg-red-50 rounded-lg transition">
                        
                        <svg class="w-4 h-4 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                        </svg>

                        Logout
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

</aside>