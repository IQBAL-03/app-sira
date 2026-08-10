<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use Illuminate\Http\Request;

class LetterRequestController extends Controller
{
    public function index()
    {
        $letters = LetterRequest::where('user_id', auth()->id())->latest()->get();
        return view('warga.surat.index', compact('letters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:1000',
        ]);

        LetterRequest::create([
            'user_id' => auth()->id(),
            'letter_type' => $request->letter_type,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengajuan surat berhasil dikirim. Mohon tunggu verifikasi admin.');
    }
}
