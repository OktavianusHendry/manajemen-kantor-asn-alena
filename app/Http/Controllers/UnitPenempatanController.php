<?php

namespace App\Http\Controllers;

use App\Models\Unit_Penempatan;
use App\Models\User;
use App\Models\Sekolah;
use App\Models\Kategori;
use App\Models\Sub_Kategori;
use Illuminate\Http\Request;

class UnitPenempatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $mulai_tanggal = $request->input('mulai_tanggal');
        $sampai_tanggal = $request->input('sampai_tanggal');
        
        $unitPenempatans = Unit_Penempatan::with(['user', 'sekolah', 'kategori', 'sub_kategori'])
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('sekolah', function ($q) use ($search) {
                        $q->where('nama_sekolah', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('sub_kategori', function ($q) use ($search) {
                        $q->where('nama_sub_kategori', 'like', '%' . $search . '%');
                    });
                });
            })
            ->when($mulai_tanggal && $sampai_tanggal, function ($query) use ($mulai_tanggal, $sampai_tanggal) {
                return $query->whereBetween('mulai_tanggal', [$mulai_tanggal, $sampai_tanggal])
                             ->whereBetween('sampai_tanggal', [$mulai_tanggal, $sampai_tanggal]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('unit_penempatan.index', compact('unitPenempatans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role_as', 0)->get();
        $sekolas = Sekolah::all();
        $kategoris = Kategori::all();
        $sub_kategoris = Sub_Kategori::all();

        return view('unit_penempatan.create', compact('users', 'sekolas', 'kategoris', 'sub_kategoris'));
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
            'id_sekolah' => 'required',
            'id_kategori' => 'required',
            'id_sub_kategori' => 'required',
            'kelas' => 'required|string|max:50',
            'jumlah_anak' => 'required|integer|max:99',
            'detail' => 'nullable|string|max:100',
            'jumlah_pertemuan' => 'required|integer|max:100',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:mulai_tanggal',
        ]);

        Unit_Penempatan::create($request->all());

        return redirect()->route('unit_penempatan.index')->with('success', 'Unit Penempatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit_Penempatan  $unitPenempatan
     * @return \Illuminate\Http\Response
     */
    public function show(Unit_Penempatan $unitPenempatan)
    {
        return view('unit_penempatan.show', compact('unitPenempatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit_Penempatan  $unitPenempatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit_Penempatan $unitPenempatan)
    {
        $users = User::where('role_as', 0)->get();
        $sekolas = Sekolah::all();
        $kategoris = Kategori::all();
        $sub_kategoris = Sub_Kategori::all();

        return view('unit_penempatan.edit', compact('unitPenempatan', 'users', 'sekolas', 'kategoris', 'sub_kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit_Penempatan  $unitPenempatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit_Penempatan $unitPenempatan)
    {
        $request->validate([
            'id_sekolah' => 'required',
            'id_kategori' => 'required',
            'id_sub_kategori' => 'required',
            'kelas' => 'required|string|max:50',
            'jumlah_anak' => 'required|integer|max:99',
            'detail' => 'nullable|string|max:100',
            'jumlah_pertemuan' => 'required|integer|max:100',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:mulai_tanggal',
        ]);

        $unitPenempatan->update($request->all());

        return redirect()->route('unit_penempatan.index')->with('success', 'Unit Penempatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit_Penempatan  $unitPenempatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit_Penempatan $unitPenempatan)
    {
        $unitPenempatan->delete();

        return redirect()->route('unit_penempatan.index')->with('success', 'Unit Penempatan berhasil dihapus.');
    }
}