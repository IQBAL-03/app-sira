<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Due;
use App\Models\User;
use Illuminate\Http\Request;

class DueController extends Controller
{
    public function index()
    {
        $dues = Due::with('user')->latest()->get();
        $wargaList = User::where('role', 'warga')->where('is_verified', true)->get();
        $totalTerkumpul = Due::where('status', 'paid')->sum('amount');
        return view('admin.iuran.index', compact('dues', 'wargaList', 'totalTerkumpul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'month_year' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        Due::create([
            'user_id' => $request->user_id,
            'month_year' => $request->month_year,
            'amount' => $request->amount,
            'status' => 'unpaid',
        ]);

        return back()->with('success', 'Tagihan iuran berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, Due $due)
    {
        $request->validate([
            'status' => 'required|in:unpaid,paid',
            'payment_date' => 'nullable|date',
        ]);

        $due->update([
            'status' => $request->status,
            'payment_date' => $request->status === 'paid' ? now() : null,
        ]);

        return back()->with('success', 'Status iuran berhasil diperbarui.');
    }

    public function destroy(Due $due)
    {
        $due->delete();
        return back()->with('success', 'Data iuran berhasil dihapus.');
    }
}
