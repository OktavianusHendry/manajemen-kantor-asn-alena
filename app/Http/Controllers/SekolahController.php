<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $sekolas = Sekolah::query();

    if ($search) {
        $sekolas
        ->where('nama_sekolah', 'like', "%{$search}%")
        ->orWhere('alamat_sekolah', 'like', "%{$search}%")
        ;
    }

    $sekolas = $sekolas
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('sekolah.index', compact('sekolas'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sekolah.create');
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
            'nama_sekolah' => 'required|string|max:100',
            'alamat_sekolah'        => 'required|string|max:255',
            'no_telp'    => 'nullable|string|digits_between:1,14',
            'email'         => 'nullable|string|email|unique:sekolah,email',
        ]);

        Sekolah::create($request->all());

        return redirect()->route('sekolah.index')
            ->with('success', 'Berhasil Menambah Sekolah');
    }

            /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        return view('sekolah.show', compact('sekolah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sekolah = Sekolah::findOrFail($id);

        return view('sekolah.edit', compact('sekolah'));
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
            'nama_sekolah' => 'required|string|max:100',
            'alamat_sekolah'        => 'required|string|max:255',
            'no_telp'    => 'nullable|string|digits_between:1,14',
            'email'         => 'nullable|string|email|unique:sekolah,email',
        ]);

        $sekolah = Sekolah::findOrFail($id);

        $sekolah->update([
            'nama_sekolah' => $request->input('nama_sekolah'),
            'alamat_sekolah'     => $request->input('alamat_sekolah'),
            'no_telp'    => $request->input('no_telp'),
            'email'         => $request->input('email'),
        ]);

        return redirect()->route('sekolah.index')
            ->with('success', 'Berhasil Memperbarui Info Sekolah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $sekolah->delete();

        return redirect()->route('sekolah.index')
            ->with('success', 'Berhasil Menghapus Sekolah');
    }
}