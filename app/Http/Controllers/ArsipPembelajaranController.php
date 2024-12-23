<?php

namespace App\Http\Controllers;

use App\Models\Arsip_Pembelajaran;
use App\Models\Kategori;
use App\Models\Sub_Kategori;
use App\Models\Jenjang;
use Illuminate\Http\Request;

class ArsipPembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $id_jenjang = $request->input('id_jenjang');
        $id_kategori = $request->input('id_kategori');
        $id_sub_kategori = $request->input('id_sub_kategori');
    
        $query = Arsip_Pembelajaran::with(['kategori', 'sub_kategori', 'jenjang']);
    
        // Filter berdasarkan search
// Filter berdasarkan id_jenjang jika tersedia
if ($id_jenjang) {
    $query->where('id_jenjang', $id_jenjang);
}

if ($id_kategori) {
    $query->where('id_kategori', $id_kategori);
}

if ($id_sub_kategori) {
    $query->where('id_sub_kategori', $id_sub_kategori);
}

// Pencarian berdasarkan judul, kategori, atau sub_kategori
if ($search) {
    $query->where(function ($q) use ($search) {
        $q->where('judul_pembelajaran', 'LIKE', "%$search%")
          ->orWhere('pertemuan_ke', 'LIKE', "%$search%");
    });
}

        $arsips = $query->orderBy('created_at', 'desc')->paginate(10);

                // Mengambil semua data jenjang
                $jenjangs = Jenjang::all();
                $kategoris = Kategori::all();
                $sub_kategoris = Sub_Kategori::all();
    
        return view('arsip_pembelajaran.index', compact('arsips', 'id_jenjang', 'id_kategori', 'id_sub_kategori', 'search', 'jenjangs', 'kategoris', 'sub_kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $subkategori = Sub_Kategori::all();
        $jenjang = Jenjang::all();
        
        return view('arsip_pembelajaran.create', compact('kategori', 'subkategori', 'jenjang'));
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
            'judul_pembelajaran' => 'required|max:150',
            'id_jenjang'         => 'required',
            'kelas'              => 'required',
            'pertemuan_ke'       => 'required',
            'id_kategori'        => 'required',
            'id_sub_kategori'    => 'required',
            'file_satu'          => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_dua'           => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_tiga'          => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_empat'         => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_lima'          => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'catatan'            => 'nullable|string',
        ]);

        $file_dokumen_satu_path = $request->file('file_satu') ? $request->file('file_satu')->store('data_file_dokumen_satu', 'public') : null;
        $file_dokumen_dua_path = $request->file('file_dua') ? $request->file('file_dua')->store('data_file_dokumen_dua', 'public') : null;
        $file_dokumen_tiga_path = $request->file('file_tiga') ? $request->file('file_tiga')->store('data_file_dokumen_tiga', 'public') : null;
        $file_dokumen_empat_path = $request->file('file_empat') ? $request->file('file_empat')->store('data_file_dokumen_empat', 'public') : null;
        $file_dokumen_lima_path = $request->file('file_lima') ? $request->file('file_lima')->store('data_file_dokumen_lima', 'public') : null;

        Arsip_Pembelajaran::create([
            'judul_pembelajaran' => $request->input('judul_pembelajaran'),
            'id_jenjang'         => $request->input('id_jenjang'),
            'kelas'              => $request->input('kelas'),
            'pertemuan_ke'       => $request->input('pertemuan_ke'),
            'id_kategori'        => $request->input('id_kategori'),
            'id_sub_kategori'    => $request->input('id_sub_kategori'),
            'file_satu'          => $file_dokumen_satu_path,
            'file_dua'           => $file_dokumen_dua_path,
            'file_tiga'          => $file_dokumen_tiga_path,
            'file_empat'         => $file_dokumen_empat_path,
            'file_lima'          => $file_dokumen_lima_path,
            'catatan'            => $request->input('catatan'),
        ]);

        return redirect()->route('arsip_pembelajaran.index')->with('success', 'Arsip Pembelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arsip_Pembelajaran  $arsip_Pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arsip = Arsip_Pembelajaran::with(['jenjang', 'kategori', 'sub_kategori'])->findOrFail($id);
        return view('arsip_pembelajaran.show', compact('arsip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Arsip_Pembelajaran  $arsip_Pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arsip = Arsip_Pembelajaran::findOrFail($id);
        $kategori = Kategori::all();
        $subkategori = Sub_Kategori::all();
        $jenjang = Jenjang::all();

        return view('arsip_pembelajaran.edit', compact('arsip', 'kategori', 'subkategori', 'jenjang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arsip_Pembelajaran  $arsip_Pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul_pembelajaran' => 'required|max:150',
            'id_jenjang'         => 'required',
            'kelas'              => 'required',
            'pertemuan_ke'       => 'required',
            'id_kategori'        => 'required',
            'id_sub_kategori'    => 'required',
            'file_satu'          => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_dua'           => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_tiga'          => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_empat'         => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'file_lima'          => 'nullable|file|mimes:zip,rar,pdf,docx,doc,sb3|max:30048',
            'catatan'            => 'nullable|string',
        ]);

        $arsip = Arsip_Pembelajaran::findOrFail($id);

        $file_dokumen_satu_path = $request->file('file_satu') ? $request->file('file_satu')->store('data_file_dokumen_satu', 'public') : $arsip->file_satu;
        $file_dokumen_dua_path = $request->file('file_dua') ? $request->file('file_dua')->store('data_file_dokumen_dua', 'public') : $arsip->file_dua;
        $file_dokumen_tiga_path = $request->file('file_tiga') ? $request->file('file_tiga')->store('data_file_dokumen_tiga', 'public') : $arsip->file_tiga;
        $file_dokumen_empat_path = $request->file('file_empat') ? $request->file('file_empat')->store('data_file_dokumen_empat', 'public') : $arsip->file_empat;
        $file_dokumen_lima_path = $request->file('file_lima') ? $request->file('file_lima')->store('data_file_dokumen_lima', 'public') : $arsip->file_lima;

        $arsip->update([
            'judul_pembelajaran' => $request->input('judul_pembelajaran'),
            'id_jenjang'         => $request->input('id_jenjang'),
            'kelas'              => $request->input('kelas'),
            'pertemuan_ke'       => $request->input('pertemuan_ke'),
            'id_kategori'        => $request->input('id_kategori'),
            'id_sub_kategori'    => $request->input('id_sub_kategori'),
            'file_satu'          => $file_dokumen_satu_path,
            'file_dua'           => $file_dokumen_dua_path,
            'file_tiga'          => $file_dokumen_tiga_path,
            'file_empat'         => $file_dokumen_empat_path,
            'file_lima'          => $file_dokumen_lima_path,
            'catatan'            => $request->input('catatan'),
        ]);

        return redirect()->route('arsip_pembelajaran.index')->with('success', 'Arsip Pembelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arsip_Pembelajaran  $arsip_Pembelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arsip = Arsip_Pembelajaran::findOrFail($id);

        $arsip->delete();

        return redirect()->route('arsip_pembelajaran.index')->with('success', 'Arsip Pembelajaran berhasil dihapus.');
    }
}