<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $divisis = Divisi::query();

    if ($search) {
        $divisis->where('nama_divisi', 'like', "%{$search}%")
                ->orWhere('kode_divisi', 'like', "%{$search}%");
    }

    $divisis = $divisis
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('divisi.index', compact('divisis'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisi.create');
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
        'nama_divisi' => 'required|string|max:50',
        'kode_divisi' => 'required|string|max:20',
        ]);
    
        Divisi::create([
            'nama_divisi' => $request->nama_divisi,
            'kode_divisi' => $request->kode_divisi,
        ]);
    
        return redirect()->route('divisi.index')
            ->with('success', 'Berhasil Membuat Divisi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisi = Divisi::findOrFail($id);

        return view('divisi.edit', compact('divisi'));
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
            'nama_divisi' => 'required|string|max:50',
            'kode_divisi' => 'required|string|max:20',
        ]);
    
        $divisi = Divisi::findOrFail($id);
    
        $divisi->update([
            'nama_divisi' => $request->nama_divisi,
            'kode_divisi' => $request->kode_divisi,
        ]);
    
        return redirect()->route('divisi.index')
            ->with('success', 'Berhasil Memperbarui Divisi');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisi = Divisi::findOrFail($id);
        $divisi->delete();
    
        return redirect()->route('divisi.index')
            ->with('success', 'Berhasil Menghapus Divisi');
    }
}