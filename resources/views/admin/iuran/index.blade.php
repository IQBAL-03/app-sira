<x-app-layout>
    <x-slot name="title">Iuran Bulanan</x-slot>

    <div class="space-y-5">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Iuran Bulanan</h3>
            <p class="text-slate-500 text-sm">Catat dan kelola tagihan iuran warga.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h4 class="font-semibold text-slate-800 mb-4">Tambah Tagihan Iuran</h4>
                <form action="{{ route('admin.iuran.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Warga</label>
                        <select name="user_id" required class="w-full border-slate-300 rounded-lg text-sm focus:ring-red-500 focus:border-red-500">
                            <option value="">-- Pilih Warga --</option>
                            @foreach($wargaList as $w)
                                <option value="{{ $w->id }}">{{ $w->name }} ({{ $w->nik }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Bulan & Tahun</label>
                        <x-text-input name="month_year" type="month" class="w-full" :value="old('month_year', now()->format('Y-m'))" required />
                        <x-input-error :messages="$errors->get('month_year')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jumlah (Rp)</label>
                        <x-text-input name="amount" type="number" class="w-full" placeholder="50000" :value="old('amount')" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-1" />
                    </div>
                    <x-primary-button>Tambah Tagihan</x-primary-button>
                </form>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 flex flex-col justify-center items-center">
                <p class="text-sm text-slate-500 font-medium mb-1">Total Iuran Terkumpul</p>
                <p class="text-4xl font-bold text-green-600">Rp{{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
                <p class="text-xs text-slate-400 mt-2">Dari semua pembayaran yang sudah lunas</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Warga</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Bulan</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Jumlah</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Tgl. Bayar</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dues as $due)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-800">{{ $due->user->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-slate-500">{{ $due->user->nik ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    @php
                                        $parts = explode('-', $due->month_year);
                                        $months = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                        echo ($months[(int)($parts[1] ?? 0)] ?? '-') . ' ' . ($parts[0] ?? '');
                                    @endphp
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-800">Rp{{ number_format($due->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-slate-500 text-xs">{{ $due->payment_date ? \Carbon\Carbon::parse($due->payment_date)->format('d/m/Y') : '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $due->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $due->status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('admin.iuran.status', $due) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="{{ $due->status === 'paid' ? 'unpaid' : 'paid' }}">
                                            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-medium transition-all {{ $due->status === 'paid' ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                                {{ $due->status === 'paid' ? 'Batalkan' : 'Tandai Lunas' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.iuran.destroy', $due) }}" method="POST" onsubmit="return confirm('Hapus data iuran ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-medium bg-red-100 text-red-600 hover:bg-red-200 transition-all">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Belum ada data iuran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
