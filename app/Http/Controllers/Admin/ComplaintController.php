<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('user')->latest()->get();
        return view('admin.pengaduan.index', compact('complaints'));
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate(['status' => 'required|in:pending,process,resolved']);
        $complaint->update(['status' => $request->status]);
        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
