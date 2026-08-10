<x-app-layout>
    <x-slot name="title">Data Warga</x-slot>

    <div class="space-y-5">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Data Warga</h3>
            <p class="text-slate-500 text-sm">Kelola dan verifikasi akun warga terdaftar.</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <p class="text-sm font-medium text-slate-600">Total: <span class="font-bold text-slate-800">{{ $warga->count() }} warga</span></p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Nama</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">NIK</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Kontak</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Alamat</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($warga as $w)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                            <span class="text-red-600 font-semibold text-xs">{{ strtoupper(substr($w->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">{{ $w->name }}</p>
                                            <p class="text-xs text-slate-500">{{ $w->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-slate-600">{{ $w->nik }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $w->phone }}</td>
                                <td class="px-6 py-4 text-slate-600 max-w-48">
                                    <p class="truncate text-xs">{{ $w->address }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $w->is_verified ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $w->is_verified ? 'Terverifikasi' : 'Menunggu' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('admin.warga.verify', $w) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium transition-all {{ $w->is_verified ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                                {{ $w->is_verified ? 'Batalkan' : 'Verifikasi' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.warga.destroy', $w) }}" method="POST" onsubmit="return confirm('Hapus data warga ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-100 text-red-600 hover:bg-red-200 transition-all">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Belum ada data warga terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
