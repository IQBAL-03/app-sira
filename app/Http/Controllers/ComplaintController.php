<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::with('user')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Semua Pengaduan Warga',
            'data' => $complaints
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $complaint = Complaint::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
        //
    }
}
