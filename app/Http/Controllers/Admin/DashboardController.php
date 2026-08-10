<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LetterRequest;
use App\Models\Complaint;
use App\Models\Due;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarga = User::where('role', 'warga')->count();
        $suratPending = LetterRequest::where('status', 'pending')->count();
        $pengaduanBelumSelesai = Complaint::whereIn('status', ['pending', 'process'])->count();
        $totalIuranTerkumpul = Due::where('status', 'paid')->sum('amount');

        $recentSurat = LetterRequest::with('user')->latest()->take(5)->get();
        $recentPengaduan = Complaint::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalWarga', 'suratPending', 'pengaduanBelumSelesai',
            'totalIuranTerkumpul', 'recentSurat', 'recentPengaduan'
        ));
    }
}
