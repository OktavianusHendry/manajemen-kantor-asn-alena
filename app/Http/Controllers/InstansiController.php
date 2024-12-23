<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Tujuan;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $id_tujuan = $request->input('id_tujuan');

        $instansis = instansi::when($search, function ($query, $search) {
            return $query                
            ->where('nama_instansi', 'like', "%{$search}%")
            ->orWhere('alamat', 'like', "%{$search}%")
            ->orWhere('no_telepon', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
        })

        ->when($id_tujuan, function ($query, $id_tujuan) {
            return $query->where('nama_tujuan', $id_tujuan);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('instansi.index', compact('instansis', 'id_tujuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tujuans = Tujuan::all();

        return view('instansi.create', compact('tujuans'));
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
            'nama_instansi' => 'required|string|max:100',
            'id_tujuan' => 'required|exists:tujuan,id_tujuan',
            'alamat'        => 'required|string|max:255',
            'no_telepon'    => 'required|string|digits_between:1,14',
            'email'         => 'required|string|email|unique:instansi,email',
        ]);

        Instansi::create($request->all());

        return redirect()->route('instansi.index')
            ->with('success', 'Berhasil Menambah Instansi');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        return view('instansi.show', compact('instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Instansi $instansi)
    {
        $tujuans = Tujuan::all();

        return view('instansi.edit', compact('instansi', 'tujuans'));
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
            'nama_instansi' => 'required|string|max:100',
            'id_tujuan' => 'required|exists:tujuan,id_tujuan',
            'alamat'        => 'required|string|max:255',
            'no_telepon'    => 'required|string|digits_between:1,14',
            'email'         => 'required|string|email|unique:instansi,email',
        ]);

        $instansi = Instansi::findOrFail($id);

        $instansi->update([
            'nama_instansi' => $request->input('nama_instansi'),
            'id_tujuan'     => $request->input('id_tujuan'),
            'alamat'        => $request->input('alamat'),
            'no_telepon'    => $request->input('no_telepon'),
            'email'         => $request->input('email'),
        ]);

        return redirect()->route('instansi.index')
            ->with('success', 'Berhasil Memperbarui Info Instansi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->route('instansi.index')
            ->with('success', 'Berhasil Menghapus Instansi');
    }
}