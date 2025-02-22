<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcaraNew;
use App\Models\PesertaBeritaAcara;
use Illuminate\Http\Request;

class BeritaAcaraNewController extends Controller
{
    public function index(Request $request)
    {
        $query = BeritaAcaraNew::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%")
                ->orWhere('tanggal', 'like', "%{$search}%");
        }

        $beritaAcara = $query->orderBy('tanggal', 'desc')->paginate(10);

        return view('berita-acara.index', compact('beritaAcara'));
    }


    public function create()
    {
        return view('berita_acara.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'berkas' => 'nullable|file|mimes:pdf,doc,docx',
            'tautan_website' => 'nullable|url',
        ]);

        if ($request->hasFile('berkas')) {
            $filePath = $request->file('berkas')->store('berkas', 'public');
        }

        $berita_acara = BeritaAcaraNew::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'berkas' => $filePath ?? null,
            'tautan_website' => $request->tautan_website,
            'approved_by_director' => 'pending'
        ]);

        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara berhasil dibuat!');
    }

    public function show($id)
    {
        $berita_acara = BeritaAcaraNew::with('peserta')->findOrFail($id);
        return view('berita_acara.show', compact('berita_acara'));
    }

    public function edit($id)
    {
        $berita_acara = BeritaAcaraNew::findOrFail($id);
        return view('berita_acara.edit', compact('berita_acara'));
    }

    public function update(Request $request, $id)
    {
        $berita_acara = BeritaAcaraNew::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'berkas' => 'nullable|file|mimes:pdf,doc,docx',
            'tautan_website' => 'nullable|url',
        ]);

        if ($request->hasFile('berkas')) {
            $filePath = $request->file('berkas')->store('berkas', 'public');
            $berita_acara->berkas = $filePath;
        }

        $berita_acara->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'tautan_website' => $request->tautan_website,
        ]);

        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita_acara = BeritaAcaraNew::findOrFail($id);
        $berita_acara->delete();

        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara berhasil dihapus!');
    }

    public function approve(Request $request, $id)
    {
        $berita_acara = BeritaAcaraNew::findOrFail($id);
        $berita_acara->update([
            'approved_by_director' => $request->status,
            'catatan_direktur' => $request->catatan
        ]);

        return redirect()->route('berita_acara.index')->with('success', 'Status Berita Acara diperbarui!');
    }
}
