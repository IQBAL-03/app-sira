<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

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
        ], [
            'title.required' => 'Judul pengaduan wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'description.required' => 'Deskripsi pengaduan wajib diisi.',
            'description.max' => 'Deskripsi maksimal 2000 karakter.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format gambar harus: jpeg, png, jpg, atau webp.',
            'photo.max' => 'Ukuran gambar maksimal 10MB.',
        ]);

        $photoUrl = null;
        if ($request->hasFile('photo')) {
            // Upload ke Cloudinary
            $upload = $this->cloudinary->upload($request->file('photo'), 'sira/complaints');
            
            if ($upload['success']) {
                $photoUrl = $upload['url'];
            } else {
                return back()->with('error', 'Gagal upload gambar: ' . $upload['error'])->withInput();
            }
        }

        Complaint::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoUrl, // Simpan URL Cloudinary
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim.');
    }
}
