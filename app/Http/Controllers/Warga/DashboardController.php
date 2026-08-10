<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use App\Models\Complaint;
use App\Models\Due;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $suratCount = LetterRequest::where('user_id', $user->id)->count();
        $suratPending = LetterRequest::where('user_id', $user->id)->where('status', 'pending')->count();
        $pengaduanCount = Complaint::where('user_id', $user->id)->count();
        $iuranBulanIni = Due::where('user_id', $user->id)
            ->where('month_year', now()->format('Y-m'))
            ->first();

        $recentSurat = LetterRequest::where('user_id', $user->id)->latest()->take(3)->get();
        $recentPengaduan = Complaint::where('user_id', $user->id)->latest()->take(3)->get();

        return view('warga.dashboard', compact(
            'suratCount', 'suratPending', 'pengaduanCount',
            'iuranBulanIni', 'recentSurat', 'recentPengaduan'
        ));
    }
}
