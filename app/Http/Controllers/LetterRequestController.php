<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LetterRequest;

class LetterRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $letters = LetterRequest::with('user')->get();
        } else {
            $letters = LetterRequest::where('user_id', $request->user()->id)->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar Pengajuan Surat Pengantar',
            'data' => $letters
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_type' => 'required|string|max:255',
            'purpose' => 'required|string'
        ]);

        $letter = LetterRequest::create([
            'user_id' => $request->user()->id,
            'letter_type' => $request->letter_type,
            'purpose' => $request->purpose,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan surat berhasil dikirim!',
            'data' => $letter
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $letter = LetterRequest::with('user')->findOrFail($id);

        if ($request->user()->role !== 'admin' && $letter->user_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $letter
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * (Admin Only)
     */
    public function update(Request $request, string $id)
    {
        $letter = LetterRequest::find($id);

        if (!$letter){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan !'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $letter->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status surat berhasil diperbarui',
            'data' => $letter
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $letter = LetterRequest::find($id);

        if (!$letter) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $letter->delete();

        return response()->json(['success' => true, 'message' => 'Data dihapus'], 200);
    }
}
