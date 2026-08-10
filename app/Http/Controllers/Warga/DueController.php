<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Due;

class DueController extends Controller
{
    public function index()
    {
        $dues = Due::where('user_id', auth()->id())->orderByDesc('created_at')->get();
        $totalTagihan = $dues->where('status', 'unpaid')->sum('amount');
        $totalLunas = $dues->where('status', 'paid')->sum('amount');
        return view('warga.iuran.index', compact('dues', 'totalTagihan', 'totalLunas'));
    }
}
