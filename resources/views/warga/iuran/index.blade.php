<x-app-layout>
    <x-slot name="title">Iuran Bulanan</x-slot>

    <div class="space-y-6">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Tagihan & Riwayat Iuran</h3>
            <p class="text-slate-500 text-sm">Pantau tagihan dan riwayat pembayaran iuran RT/RW Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="bg-red-600 rounded-xl shadow-md p-6 relative overflow-hidden text-white">
                <div class="absolute top-0 right-0 p-4 opacity-20">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-red-100 text-sm font-medium mb-1">Total Tagihan Belum Dibayar</p>
                    <p class="text-4xl font-bold">Rp{{ number_format($totalTagihan, 0, ',', '.') }}</p>
                    <p class="text-red-200 text-xs mt-3">Silakan lakukan pembayaran ke pengurus RT/RW.</p>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-5">
                    <svg class="w-24 h-24 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="relative z-10">
                    <p class="text-slate-500 text-sm font-medium mb-1">Total Sudah Dibayar</p>
                    <p class="text-3xl font-bold text-slate-800">Rp{{ number_format($totalLunas, 0, ',', '.') }}</p>
                    <p class="text-green-600 text-xs mt-3 font-medium flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Terima kasih atas partisipasi Anda
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h4 class="font-semibold text-slate-800">Detail Tagihan & Riwayat</h4>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Bulan & Tahun</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Jumlah (Rp)</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wider">Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dues as $due)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-800">
                                    @php
                                        $parts = explode('-', $due->month_year);
                                        $months = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                        echo ($months[(int)($parts[1] ?? 0)] ?? '-') . ' ' . ($parts[0] ?? '');
                                    @endphp
                                </td>
                                <td class="px-6 py-4 text-slate-800 font-semibold">Rp{{ number_format($due->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $due->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $due->status === 'paid' ? 'Lunas' : 'Belum Dibayar' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">
                                    {{ $due->payment_date ? \Carbon\Carbon::parse($due->payment_date)->translatedFormat('d F Y') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Belum ada data tagihan iuran Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
