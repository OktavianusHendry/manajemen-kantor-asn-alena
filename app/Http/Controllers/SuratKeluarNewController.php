<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarNewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $surat_keluar = SuratKeluar::when($search, function ($query) use ($search) {
            return $query->where('perihal', 'like', "%{$search}%")
                         ->orWhere('tujuan_surat', 'like', "%{$search}%");
        })->paginate(10);

        return view('surat-keluar.index', compact('surat_keluar'));
    }

    // Menampilkan form untuk membuat surat keluar
    public function create()
    {
        // Ambil data instansi dan tujuan jika diperlukan
        $instansi = []; // Ganti dengan query untuk mengambil data instansi
        $tujuan = []; // Ganti dengan query untuk mengambil data tujuan

        return view('surat-keluar.create', compact('instansi', 'tujuan'));
    }

    // Menyimpan surat keluar baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:50',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string|max:255',
            'tujuan_surat' => 'required|string|max:255',
            'disahkan_oleh' => 'nullable|string|max:100',
            'jabatan_pengesah' => 'nullable|string|max:100',
            'tembusan' => 'nullable|string',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_surat' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi_surat' => 'required|string',
        ]);

        // Menyimpan lampiran jika ada
        $lampiranPath = $request->file('lampiran') ? $request->file('lampiran')->store('lampiran') : null;
        $fotoPath = $request->file('foto_surat') ? $request->file('foto_surat')->store('foto_surat') : null;

        SuratKeluar::create([
            'nomor_surat' => $request->nomor_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'tujuan_surat' => $request->tujuan_surat,
            'disahkan_oleh' => $request->disahkan_oleh,
            'jabatan_pengesah' => $request->jabatan_pengesah,
            'tembusan' => $request->tembusan,
            'lampiran' => $lampiranPath,
            'foto_surat' => $fotoPath,
            'isi_surat' => $request->isi_surat,
            'status_validasi' => 'Pending', // Set default status
            'created_by' => auth()->id(), // Menyimpan ID pengguna yang membuat
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function edit($id_surat)
{
    $suratKeluar = SuratKeluar::findOrFail($id_surat);
    return view('surat-keluar.edit', compact('suratKeluar'));
}

public function update(Request $request, $id_surat)
{
    $request->validate([
        'nomor_surat' => 'required|string|max:50',
        'tanggal_surat' => 'required|date',
        'perihal' => 'required|string|max:255',
        'tujuan_surat' => 'required|string|max:255',
        'disahkan_oleh' => 'nullable|string|max:100',
        'jabatan_pengesah' => 'nullable|string|max:100',
        'tembusan' => 'nullable|string',
        'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'foto_surat' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'isi_surat' => 'required|string',
    ]);

    $suratKeluar = SuratKeluar::findOrFail($id_surat);

    // Menyimpan lampiran jika ada
    if ($request->hasFile('lampiran')) {
        // Hapus file lama jika ada
        if ($suratKeluar->lampiran) {
            Storage::delete($suratKeluar->lampiran);
        }
        $lampiranPath = $request->file('lampiran')->store('lampiran');
    } else {
        $lampiranPath = $suratKeluar->lampiran; // Tetap menggunakan file lama
    }

    // Menyimpan foto surat jika ada
    if ($request->hasFile('foto_surat')) {
        // Hapus file lama jika ada
        if ($suratKeluar->foto_surat) {
            Storage::delete($suratKeluar->foto_surat);
        }
        $fotoPath = $request->file('foto_surat')->store('foto_surat');
    } else {
        $fotoPath = $suratKeluar->foto_surat; // Tetap menggunakan file lama
    }

    $suratKeluar->update([
        'nomor_surat' => $request->nomor_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'perihal' => $request->perihal,
        'tujuan_surat' => $request->tujuan_surat,
        'disahkan_oleh' => $request->disahkan_oleh,
        'jabatan_pengesah' => $request->jabatan_pengesah,
        'tembusan' => $request->tembusan,
        'lampiran' => $lampiranPath,
        'foto_surat' => $fotoPath,
        'isi_surat' => $request->isi_surat,
    ]);

    return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui.');
}

public function destroy($id_surat)
{
    $suratKeluar = SuratKeluar::findOrFail($id_surat);

    // Hapus file jika ada
    if ($suratKeluar->lampiran) {
        Storage::delete($suratKeluar->lampiran);
    }
    if ($suratKeluar->foto_surat) {
        Storage::delete($suratKeluar->foto_surat);
    }

    $suratKeluar->delete();

    return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
}


    public function exportPDF($id)
    {
        // Logika untuk mengunduh surat dalam format PDF
        $surat = SuratKeluar::findOrFail($id);
        // Buat PDF menggunakan library seperti DomPDF atau Snappy
        // Kode untuk mengunduh PDF
    }

    public function validasi(Request $request, $id)
    {
        // Logika untuk memvalidasi surat
        $surat = SuratKeluar::findOrFail($id);
        $surat->status_validasi = 'Disetujui'; // Atau logika lain sesuai kebutuhan
        $surat->save();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil divalidasi.');
    }
}