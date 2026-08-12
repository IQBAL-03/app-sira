<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $warga = User::where('role', 'warga')->latest()->get();
        return view('admin.warga.index', compact('warga'));
    }

    public function verify(User $user)
    {
        $user->is_verified = !$user->is_verified;
        $user->save();
        $msg = $user->is_verified ? 'Akun warga berhasil diverifikasi.' : 'Verifikasi akun warga dibatalkan.';
        return back()->with('success', $msg);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Data warga berhasil dihapus.');
    }
}
