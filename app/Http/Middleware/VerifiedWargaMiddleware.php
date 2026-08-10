<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedWargaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && !$request->user()->is_verified) {
            auth()->logout();
            return redirect()->route('login')->with('status', 'Akun Anda belum diverifikasi oleh admin. Silakan tunggu konfirmasi.');
        }

        return $next($request);
    }
}
