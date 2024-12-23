<?php

namespace App\Http\Controllers;

use App\Models\tujuan;
use Illuminate\Http\Request;

class TujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $tujuans = Tujuan::query();

    if ($search) {
        $tujuans->where('nama_tujuan', 'like', "%{$search}%");
    }

    $tujuans = $tujuans
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('tujuan.index', compact('tujuans'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tujuan.create');
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
        'nama_tujuan' => 'required|string|max:80',
        ]);
    
        Tujuan::create([
            'nama_tujuan' => $request->nama_tujuan,
        ]);
    
        return redirect()->route('tujuan.index')
            ->with('success', 'Berhasil Membuat tujuan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tujuan = Tujuan::findOrFail($id);

        return view('tujuan.edit', compact('tujuan'));
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
            'nama_tujuan' => 'required|string|max:80',
        ]);
    
        $tujuan = Tujuan::findOrFail($id);
    
        $tujuan->update([
            'nama_tujuan' => $request->nama_tujuan,
        ]);
    
        return redirect()->route('tujuan.index')
            ->with('success', 'Berhasil Memperbarui tujuan');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tujuan = Tujuan::findOrFail($id);
        $tujuan->delete();
    
        return redirect()->route('tujuan.index')
            ->with('success', 'Berhasil Menghapus tujuan');
    }
}