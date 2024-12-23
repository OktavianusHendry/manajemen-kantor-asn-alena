<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $kategoris = Kategori::query();

    if ($search) {
        $kategoris->where('nama_kategori', 'like', "%{$search}%");
    }

    $kategoris = $kategoris
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('kategori.index', compact('kategoris'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|string|max:25',
        ]);
    
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
    
        return redirect()->route('kategori.index')
            ->with('success', 'Berhasil Membuat kategori');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|string|max:25',
        ]);
    
        $kategori = Kategori::findOrFail($id);
    
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);
    
        return redirect()->route('kategori.index')
            ->with('success', 'Berhasil Memperbarui kategori');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
    
        return redirect()->route('kategori.index')
            ->with('success', 'Berhasil Menghapus kategori');
    }
}