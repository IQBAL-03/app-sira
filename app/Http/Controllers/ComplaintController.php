<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Admin bisa lihat semua, Warga hanya lihat miliknya
        if ($request->user()->role === 'admin') {
            $complaints = Complaint::with('user')->get();
        } else {
            $complaints = Complaint::where('user_id', $request->user()->id)->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar Pengaduan',
            'data' => $complaints
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints', 'public');
        }

        $complaint = Complaint::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan berhasil ditambahkan!',
            'data' => $complaint
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $complaint = Complaint::with('user')->findOrFail($id);

        if ($request->user()->role !== 'admin' && $complaint->user_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $complaint
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * (Admin Only)
     */
    public function update(Request $request, string $id)
    {
        $complaint = Complaint::find($id);

        if (!$complaint){
            return response()->json([
                'success' => false,
                'message' => 'Data Pengaduan tidak ditemukan !'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,process,resolved'
        ]);

        $complaint->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status Pengaduan berhasil diperbarui',
            'data' => $complaint
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        if ($complaint->photo) {
            Storage::disk('public')->delete($complaint->photo);
        }

        $complaint->delete();

        return response()->json(['success' => true, 'message' => 'Pengaduan dihapus'], 200);
    }
}
