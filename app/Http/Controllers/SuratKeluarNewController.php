<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarNewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $surat_keluars = SuratKeluar::when($search, function ($query) use ($search) {
            return $query->where('perihal', 'like', "%{$search}%")
                        ->orWhere('tujuan_surat', 'like', "%{$search}%");
        })->paginate(10);

        // Debugging
        \Log::info('Surat Keluar:', $surat_keluars->toArray());

        return view('surat-keluar.index', compact('surat_keluars'));
    }
}