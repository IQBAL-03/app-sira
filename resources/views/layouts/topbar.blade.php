<header class="bg-white border-b border-slate-200 px-6 lg:px-8 py-4 flex items-center justify-between">
    <div>
        <h2 class="text-lg font-semibold text-slate-800">{{ $title ?? 'Dashboard' }}</h2>
        <p class="text-xs text-slate-500 mt-0.5">{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-sm text-slate-600 hover:text-red-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            {{ auth()->user()->name }}
        </a>
    </div>
</header>
