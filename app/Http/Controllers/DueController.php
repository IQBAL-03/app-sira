<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Due;

class DueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->role === 'admin') {
            $dues = Due::with('user')->get();
        } else {
            $dues = Due::where('user_id', $request->user()->id)->get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar Iuran Warga',
            'data' => $dues
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Admin bisa mencatat tagihan iuran untuk warga, 
        // atau warga bisa mencatat bahwa dia akan membayar bulan tertentu (tergantung alur).
        // Kita buat sederhana: siapa saja bisa membuat record iuran (tagihan / laporan), default unpaid.
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'month_year' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        $userId = $request->user()->role === 'admin' && $request->has('user_id') 
                    ? $request->user_id 
                    : $request->user()->id;

        $due = Due::create([
            'user_id' => $userId,
            'month_year' => $request->month_year,
            'amount' => $request->amount,
            'status' => 'unpaid'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Catatan iuran berhasil dibuat',
            'data' => $due
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $due = Due::with('user')->findOrFail($id);

        if ($request->user()->role !== 'admin' && $due->user_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $due
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * (Admin Only)
     */
    public function update(Request $request, string $id)
    {
        $due = Due::find($id);

        if (!$due){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan !'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:unpaid,paid',
            'payment_date' => 'nullable|date'
        ]);

        $due->update([
            'status' => $request->status,
            'payment_date' => $request->payment_date
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status iuran berhasil diperbarui',
            'data' => $due
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $due = Due::find($id);

        if (!$due) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $due->delete();

        return response()->json(['success' => true, 'message' => 'Data dihapus'], 200);
    }
}
