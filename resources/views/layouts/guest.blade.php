<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIRA') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800">
        <div class="min-h-screen flex">
            <div class="hidden lg:flex lg:w-1/2 bg-red-600 flex-col justify-between p-12 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-20 left-20 w-64 h-64 rounded-full bg-white"></div>
                    <div class="absolute bottom-20 right-10 w-96 h-96 rounded-full bg-white"></div>
                    <div class="absolute top-1/2 left-1/3 w-32 h-32 rounded-full bg-white"></div>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white tracking-tight">SIRA</h1>
                            <p class="text-red-200 text-sm">Sistem Informasi RT/RW</p>
                        </div>
                    </div>
                </div>
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white leading-tight mb-4">Layanan Warga<br>Digital & Transparan</h2>
                    <p class="text-red-100 text-lg leading-relaxed mb-8">Urus surat pengantar, kirim pengaduan, dan pantau iuran bulanan Anda dengan mudah dan cepat.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-white font-semibold text-sm mb-1">Surat Pengantar</div>
                            <div class="text-red-200 text-xs">KTP, SKCK, Kelahiran & lainnya</div>
                        </div>
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-white font-semibold text-sm mb-1">Pengaduan Online</div>
                            <div class="text-red-200 text-xs">Laporkan masalah dengan bukti foto</div>
                        </div>
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-white font-semibold text-sm mb-1">Iuran Bulanan</div>
                            <div class="text-red-200 text-xs">Pantau tagihan & riwayat bayar</div>
                        </div>
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-white font-semibold text-sm mb-1">Admin RT/RW</div>
                            <div class="text-red-200 text-xs">Pengelolaan data warga terintegrasi</div>
                        </div>
                    </div>
                </div>
                <div class="relative z-10 text-red-200 text-xs">
                    &copy; {{ date('Y') }} SIRA — Sistem Informasi & Pelaporan RT/RW
                </div>
            </div>

            <div class="flex-1 flex flex-col justify-center items-center p-8 lg:p-16">
                <div class="w-full max-w-md">
                    <div class="lg:hidden flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-slate-800">SIRA</h1>
                            <p class="text-slate-500 text-xs">Sistem Informasi RT/RW</p>
                        </div>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
