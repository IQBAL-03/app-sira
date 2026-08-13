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

    public function export()
    {
        $complaints = Complaint::with('user')->latest()->get();
        
        $filename = 'laporan_pengaduan_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($complaints) {
            $file = fopen('php://output', 'w');
            
            // Add BOM untuk support Unicode di Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header CSV
            fputcsv($file, [
                'No',
                'Nama Pelapor',
                'No. Telepon',
                'Judul Pengaduan',
                'Deskripsi',
                'Status',
                'Tanggal Lapor',
                'Link Foto'
            ]);

            // Data
            $no = 1;
            foreach ($complaints as $complaint) {
                fputcsv($file, [
                    $no++,
                    $complaint->user->name ?? 'N/A',
                    $complaint->user->phone ?? '-',
                    $complaint->title,
                    $complaint->description,
                    match($complaint->status) {
                        'pending' => 'Pending',
                        'process' => 'Diproses',
                        'resolved' => 'Selesai',
                        default => $complaint->status
                    },
                    $complaint->created_at->format('d/m/Y H:i'),
                    $complaint->photo ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
