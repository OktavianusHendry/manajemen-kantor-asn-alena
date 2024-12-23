<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Cuti;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

   $jenis_cutis = Jenis_Cuti::query();

    if ($search) {
       $jenis_cutis->where('nama_jenis_cuti', 'like', "%{$search}%");
    }

   $jenis_cutis =$jenis_cutis
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('jenis_cuti.index', compact('jenis_cutis'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis_cuti.create');
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
            'nama_jenis_cuti' => 'required|string|max:25',
        ]);
    
        Jenis_Cuti::create([
            'nama_jenis_cuti' => $request->nama_jenis_cuti,
        ]);
    
        return redirect()->route('jenis_cuti.index')
            ->with('success', 'Berhasil Membuat Jenis Cuti');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $jenis_cuti = Jenis_Cuti::findOrFail($id);

        return view('jenis_cuti.edit', compact('jenis_cuti'));
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
            'nama_jenis_cuti' => 'required|string|max:25',
        ]);
    
       $jenis_cuti = Jenis_Cuti::findOrFail($id);
    
       $jenis_cuti->update([
            'nama_jenis_cuti' => $request->nama_jenis_cuti,
        ]);
    
        return redirect()->route('jenis_cuti.index')
            ->with('success', 'Berhasil Memperbarui Jenis Cuti');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $jenis_cuti = Jenis_Cuti::findOrFail($id);
       $jenis_cuti->delete();
    
        return redirect()->route('jenis_cuti.index')
            ->with('success', 'Berhasil Menghapus Jenis Cuti');
    }
}