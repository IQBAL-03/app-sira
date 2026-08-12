<header class="bg-white border-b border-slate-200 px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between sticky top-0 z-30">
    <div class="flex items-center gap-4">
        <!-- Hamburger Button -->
        <button @click="sidebarOpen = !sidebarOpen" 
                class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        
        <div>
            <h2 class="text-base sm:text-lg font-semibold text-slate-800">{{ $title ?? 'Dashboard' }}</h2>
            <p class="text-xs text-slate-500 mt-0.5 hidden sm:block">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-xs sm:text-sm text-slate-600 hover:text-red-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
            <span class="sm:hidden">{{ substr(auth()->user()->name, 0, 1) }}</span>
        </a>
    </div>
</header>
