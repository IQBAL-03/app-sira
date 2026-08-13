<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('user_id', auth()->id())->latest()->get();
        return view('warga.pengaduan.index', compact('complaints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints', 'public');
        }

        Complaint::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim.');
    }
}
