<?php

namespace App\Http\Controllers;

use App\Models\Berita_Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $beritas = Berita_Acara::query();

    if ($search) {
        $beritas->where('judul_berita', 'like', "%{$search}%")
                ->orWhere('isi_berita', 'like', "%{$search}%");
    }

    $beritas = $beritas
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('berita_acara.index', compact('beritas'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita_acara.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required|string|max:155',
            'isi_berita' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,doc|max:10048',
        ]);

        $file_berita_acara_path = $request->file('file')->store('data_file_berita_acara', 'public');

        Berita_Acara::create([
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita,
            'file' => $file_berita_acara_path
        ]);

        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita_Acara  $berita_Acara
     * @return \Illuminate\Http\Response
     */
    public function show(Berita_Acara $berita_acara)
    {
        return view('berita_acara.show', ['berita' => $berita_acara]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita_Acara  $berita_Acara
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita_Acara::findOrFail($id);

        return view('berita_acara.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita_Acara  $berita_Acara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul_berita' => 'required|string|max:155',
            'isi_berita' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,doc|max:10048',
        ]);

        $berita = Berita_Acara::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($berita->file) {
                Storage::disk('public')->delete($berita->file);
            }
            $berita->file = $request->file('file')->store('data_file_berita_acara', 'public');
        }

        $berita->update($request->except(['file']));

        return redirect()->route('berita_acara.index')
            ->with('success', 'Berita Acara berhasil diperbarui.')
            ->with('berita', $berita);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita_Acara  $berita_Acara
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita_Acara::findOrFail($id);
        
        if ($berita->file) {
            Storage::disk('public')->delete($berita->file);
        }

        $berita->delete();

        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara berhasil dihapus.');
    }
}