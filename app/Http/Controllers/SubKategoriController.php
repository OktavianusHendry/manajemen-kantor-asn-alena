<?php

namespace App\Http\Controllers;

use App\Models\Sub_Kategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $sub_kategoris = Sub_Kategori::query();

    if ($search) {
        $sub_kategoris->where('nama_sub_kategori', 'like', "%{$search}%");
    }

    $sub_kategoris = $sub_kategoris
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('sub_kategori.index', compact('sub_kategoris'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sub_kategori.create');
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
            'nama_sub_kategori' => 'required|string|max:50',
        ]);
    
        Sub_Kategori::create([
            'nama_sub_kategori' => $request->nama_sub_kategori,
        ]);
    
        return redirect()->route('sub_kategori.index')
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
        $sub_kategori = Sub_Kategori::findOrFail($id);

        return view('sub_kategori.edit', compact('sub_kategori'));
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
            'nama_sub_kategori' => 'required|string|max:50',
        ]);
    
        $sub_kategori = Sub_Kategori::findOrFail($id);
    
        $sub_kategori->update([
            'nama_sub_kategori' => $request->nama_sub_kategori,
        ]);
    
        return redirect()->route('sub_kategori.index')
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
        $sub_kategori = Sub_Kategori::findOrFail($id);
        $sub_kategori->delete();
    
        return redirect()->route('sub_kategori.index')
            ->with('success', 'Berhasil Menghapus kategori');
    }
}