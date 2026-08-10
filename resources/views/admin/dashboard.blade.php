<x-app-layout>
    <x-slot name="title">Dashboard Admin</x-slot>

    <div class="space-y-6">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Dashboard Admin</h3>
            <p class="text-slate-500 text-sm">Selamat datang, {{ auth()->user()->name }}. Berikut ringkasan sistem hari ini.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Warga</p>
                        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalWarga }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.warga.index') }}" class="mt-3 text-xs text-blue-500 hover:text-blue-700 font-medium flex items-center gap-1">
                    Lihat semua <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Surat Pending</p>
                        <p class="text-3xl font-bold text-amber-500 mt-1">{{ $suratPending }}</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.surat.index') }}" class="mt-3 text-xs text-amber-500 hover:text-amber-700 font-medium flex items-center gap-1">
                    Tinjau sekarang <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Pengaduan Aktif</p>
                        <p class="text-3xl font-bold text-red-600 mt-1">{{ $pengaduanBelumSelesai }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.pengaduan.index') }}" class="mt-3 text-xs text-red-500 hover:text-red-700 font-medium flex items-center gap-1">
                    Tangani <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Iuran Terkumpul</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">Rp{{ number_format($totalIuranTerkumpul, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.iuran.index') }}" class="mt-3 text-xs text-green-500 hover:text-green-700 font-medium flex items-center gap-1">
                    Detail iuran <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-semibold text-slate-800">Surat Pengantar Terbaru</h4>
                    <a href="{{ route('admin.surat.index') }}" class="text-xs text-red-600 hover:text-red-700 font-medium">Lihat semua</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentSurat as $surat)
                        <div class="px-6 py-3.5 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $surat->user->name ?? 'N/A' }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $surat->letter_type }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $surat->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($surat->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($surat->status) }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada pengajuan surat.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-semibold text-slate-800">Pengaduan Terbaru</h4>
                    <a href="{{ route('admin.pengaduan.index') }}" class="text-xs text-red-600 hover:text-red-700 font-medium">Lihat semua</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentPengaduan as $pengaduan)
                        <div class="px-6 py-3.5 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $pengaduan->user->name ?? 'N/A' }}</p>
                                <p class="text-xs text-slate-500 mt-0.5 truncate max-w-48">{{ $pengaduan->title }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $pengaduan->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($pengaduan->status === 'process' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                {{ $pengaduan->status === 'pending' ? 'Pending' : ($pengaduan->status === 'process' ? 'Diproses' : 'Selesai') }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada pengaduan.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
