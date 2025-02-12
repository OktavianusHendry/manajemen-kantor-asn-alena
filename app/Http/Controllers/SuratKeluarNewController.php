<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarNewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $surat_keluar = SuratKeluar::when($search, function ($query) use ($search) {
            return $query->where('perihal', 'like', "%{$search}%")
                         ->orWhere('tujuan_surat', 'like', "%{$search}%");
        })->paginate(10);

        return view('surat-keluar.index', compact('surat_keluar'));
    }

    public function exportPDF($id)
    {
        // Logika untuk mengunduh surat dalam format PDF
        $surat = SuratKeluar::findOrFail($id);
        // Buat PDF menggunakan library seperti DomPDF atau Snappy
        // Kode untuk mengunduh PDF
    }

    public function validasi(Request $request, $id)
    {
        // Logika untuk memvalidasi surat
        $surat = SuratKeluar::findOrFail($id);
        $surat->status_validasi = 'Disetujui'; // Atau logika lain sesuai kebutuhan
        $surat->save();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil divalidasi.');
    }

    public function destroy($id)
    {
        // Logika untuk menghapus surat
        $surat = SuratKeluar::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil dihapus.');
    }
}