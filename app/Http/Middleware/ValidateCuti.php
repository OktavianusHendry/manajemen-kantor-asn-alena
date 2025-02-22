<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidateCuti
{
    public function handle(Request $request, Closure $next)
    {
        if (!in_array(Auth::user()->id_jabatan, [1, 2])) {
            return redirect()->route('cuti.index')->with('error', 'Anda tidak memiliki akses untuk validasi.');
        }

        return $next($request);
    }
}

