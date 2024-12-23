<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $jabatans = Jabatan::query();

    if ($search) {
        $jabatans->where('nama_jabatan', 'like', "%{$search}%");
    }

    $jabatans = $jabatans
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('jabatan.index', compact('jabatans'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
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
        'nama_jabatan' => 'required|string|max:100',
        ]);
    
        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'kode_jabatan' => $request->kode_jabatan,
        ]);
    
        return redirect()->route('jabatan.index')
            ->with('success', 'Berhasil Membuat jabatan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('jabatan.edit', compact('jabatan'));
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
            'nama_jabatan' => 'required|string|max:100',
        ]);
    
        $jabatan = Jabatan::findOrFail($id);
    
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
        ]);
    
        return redirect()->route('jabatan.index')
            ->with('success', 'Berhasil Memperbarui jabatan');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();
    
        return redirect()->route('jabatan.index')
            ->with('success', 'Berhasil Menghapus jabatan');
    }
}