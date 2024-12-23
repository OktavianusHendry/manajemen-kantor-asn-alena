<?php

namespace App\Http\Controllers;

use App\Models\Surat_Masuk;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('sifat_surat'); // Mengambil filter dari input 'sifat_surat'
    
        $suratMasuks = Surat_Masuk::with('instansi');
    
        if ($search) {
            $suratMasuks->where('perihal', 'like', "%{$search}%");
        }
    
        if ($filter) {
            $suratMasuks->where('sifat_surat', $filter);
        }
    
        $suratMasuks = $suratMasuks->orderBy('created_at', 'desc')->paginate(10);
    
        return view('surat_masuk.index', compact('suratMasuks'));
    }
    

    public function create()
    {
        $instansi = Instansi::all();
        return view('surat_masuk.create', compact('instansi'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_surat_masuk' => 'required|date',
            'id_instansi'     => 'required',
            'sifat_surat'     => 'required|in:Formal,Bisnis,Resmi',
            'perihal'         => 'required|string|max:100',
            'tindak_lanjut'   => 'required|string|max:50',
            'file_surat'      => 'nullable|file|mimes:pdf,docx,doc|max:10048',
        ]);

        $file_surat_path = null;
        
        if ($request->hasFile('file_surat')) {
            $file_surat_path = $request->file('file_surat')->store('data_file_surat_masuk', 'public');
        }
        
        Surat_Masuk::create([
            'tgl_surat_masuk' => $request->input('tgl_surat_masuk'),
            'id_instansi'     => $request->input('id_instansi'),
            'sifat_surat'     => $request->input('sifat_surat'),
            'perihal'         => $request->input('perihal'),
            'tujuan'          => $request->input('tujuan'),
            'tindak_lanjut'   => $request->input('tindak_lanjut'),
            'file_surat'      => $file_surat_path,
            'catatan'         => $request->input('catatan'),
        ]);

        return redirect()->route('surat_masuk.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
    }

    public function show(Surat_Masuk $suratMasuk)
    {
        return view('surat_masuk.show', compact('suratMasuk'));
    }

    public function edit(Surat_Masuk $suratMasuk)
    {
        $instansi = Instansi::all();
        return view('surat_masuk.edit', compact('suratMasuk', 'instansi'));
    }

    public function update(Request $request, Surat_Masuk $suratMasuk)
    {
        $this->validate($request, [
            'tgl_surat_masuk' => 'required|date',
            'id_instansi'     => 'required',
            'sifat_surat'     => 'required|in:Formal,Bisnis,Resmi',
            'perihal'         => 'required|string|max:100',
            'tindak_lanjut'   => 'required|string|max:50',
            'file_surat'      => 'nullable|file|mimes:pdf,docx,doc|max:10048',
        ]);

        if ($request->hasFile('file_surat')) {
            if ($suratMasuk->file_surat) {
                Storage::disk('public')->delete($suratMasuk->file_surat);
            }
            $suratMasuk->file_surat = $request->file('file_surat')->store('data_file_surat_masuk', 'public');
        }

        $suratMasuk->update($request->except(['file_surat']));

        return redirect()->route('surat_masuk.index')->with('success', 'Surat Masuk berhasil diperbarui.');
    }

    public function destroy(Surat_Masuk $suratMasuk)
    {
        if ($suratMasuk->file_surat) {
            Storage::disk('public')->delete($suratMasuk->file_surat);
        }

        $suratMasuk->delete();

        return redirect()->route('surat_masuk.index')->with('success', 'Surat Masuk berhasil dihapus.');
    }
}