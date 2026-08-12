<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIRA') }} - {{ $title ?? 'Dashboard' }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex">
            @include('layouts.sidebar')
            <div class="flex-1 flex flex-col min-w-0 lg:ml-0">
                @include('layouts.topbar')
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    @if(session('success'))
                        <div id="alert-success" class="mb-4 flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm">
                            <svg class="w-5 h-5 flex-shrink-0 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div id="alert-error" class="mb-4 flex items-center gap-3 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm">
                            <svg class="w-5 h-5 flex-shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            {{ session('error') }}
                        </div>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>
        <script>
            setTimeout(() => {
                ['alert-success','alert-error'].forEach(id => {
                    const el = document.getElementById(id);
                    if(el) el.style.display = 'none';
                });
            }, 4000);
        </script>
    </body>
</html>
