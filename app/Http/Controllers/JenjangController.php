<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $jenjangs = Jenjang::query();

    if ($search) {
        $jenjangs->where('nama_jenjang', 'like', "%{$search}%");
    }

    $jenjangs = $jenjangs
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('jenjang.index', compact('jenjangs'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenjang.create');
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
            'nama_jenjang' => 'required|string|max:25',
        ]);
    
        Jenjang::create([
            'nama_jenjang' => $request->nama_jenjang,
        ]);
    
        return redirect()->route('jenjang.index')
            ->with('success', 'Berhasil Membuat jenjang');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenjang = Jenjang::findOrFail($id);

        return view('jenjang.edit', compact('jenjang'));
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
            'nama_jenjang' => 'required|string|max:25',
        ]);
    
        $jenjang = Jenjang::findOrFail($id);
    
        $jenjang->update([
            'nama_jenjang' => $request->nama_jenjang,
        ]);
    
        return redirect()->route('jenjang.index')
            ->with('success', 'Berhasil Memperbarui jenjang');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenjang = Jenjang::findOrFail($id);
        $jenjang->delete();
    
        return redirect()->route('jenjang.index')
            ->with('success', 'Berhasil Menghapus jenjang');
    }
}