<x-app-layout>
    <x-slot name="title">Dashboard Saya</x-slot>

    <div class="space-y-6">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Selamat Datang, {{ auth()->user()->name }}!</h3>
            <p class="text-slate-500 text-sm">Berikut ringkasan layanan Anda hari ini.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Pengajuan Surat</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $suratCount }}</p>
                    </div>
                </div>
                @if($suratPending > 0)
                    <p class="text-xs text-amber-600 font-medium">⏳ {{ $suratPending }} sedang pending</p>
                @else
                    <p class="text-xs text-green-600 font-medium">✓ Tidak ada yang pending</p>
                @endif
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Pengaduan Saya</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $pengaduanCount }}</p>
                    </div>
                </div>
                <a href="{{ route('warga.pengaduan.index') }}" class="text-xs text-red-600 font-medium hover:text-red-700">Lihat semua →</a>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 {{ $iuranBulanIni?->status === 'paid' ? 'bg-green-50' : 'bg-red-50' }} rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 {{ $iuranBulanIni?->status === 'paid' ? 'text-green-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500">Iuran Bulan Ini</p>
                        @if($iuranBulanIni)
                            <p class="text-2xl font-bold {{ $iuranBulanIni->status === 'paid' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $iuranBulanIni->status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                            </p>
                        @else
                            <p class="text-sm font-medium text-slate-400">Belum ada tagihan</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('warga.iuran.index') }}" class="text-xs text-red-600 font-medium hover:text-red-700">Lihat riwayat →</a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-semibold text-slate-800">Surat Pengantar Terakhir</h4>
                    <a href="{{ route('warga.surat.index') }}" class="text-xs text-red-600 hover:text-red-700 font-medium">Lihat semua</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentSurat as $surat)
                        <div class="px-6 py-3.5 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $surat->letter_type }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $surat->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                {{ $surat->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($surat->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                {{ $surat->status === 'pending' ? 'Pending' : ($surat->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                            </span>
                        </div>
                    @empty
                        <div class="px-6 py-8 text-center text-slate-400 text-sm">Belum ada pengajuan surat.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="font-semibold text-slate-800">Pengaduan Terakhir</h4>
                    <a href="{{ route('warga.pengaduan.index') }}" class="text-xs text-red-600 hover:text-red-700 font-medium">Lihat semua</a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentPengaduan as $pengaduan)
                        <div class="px-6 py-3.5 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $pengaduan->title }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $pengaduan->created_at->diffForHumans() }}</p>
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('warga.surat.index') }}" class="bg-white border border-slate-200 rounded-xl p-5 flex items-center gap-4 hover:border-red-300 hover:shadow-md transition-all group">
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-red-100 transition-colors">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <p class="font-semibold text-slate-800">Ajukan Surat Pengantar</p>
                    <p class="text-xs text-slate-500 mt-0.5">KTP, SKCK, Kelahiran & lainnya</p>
                </div>
            </a>
            <a href="{{ route('warga.pengaduan.index') }}" class="bg-white border border-slate-200 rounded-xl p-5 flex items-center gap-4 hover:border-red-300 hover:shadow-md transition-all group">
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-red-100 transition-colors">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="font-semibold text-slate-800">Kirim Pengaduan</p>
                    <p class="text-xs text-slate-500 mt-0.5">Laporkan masalah dengan foto bukti</p>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
