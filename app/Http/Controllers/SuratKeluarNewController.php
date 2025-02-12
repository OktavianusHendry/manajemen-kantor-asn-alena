<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarNewController extends Controller
{
    public function index()
    {
        // Retrieve all surat keluar records
        $suratKeluar = SuratKeluar::all();
        return view('surat_keluar.index', compact('suratKeluar'));
    }

    public function create()
    {
        // Show the form to create a new surat keluar
        return view('surat_keluar.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'tanggal_surat' => 'required|date',
            'nomor_surat' => 'required|string|max:50',
            'lampiran' => 'nullable|string|max:255',
            'perihal' => 'required|string|max:255',
            'tujuan_surat' => 'required|string|max:255',
            'isi_surat' => 'nullable|string',
            'foto_surat' => 'nullable|string|max:255',
            'disahkan_oleh' => 'required|string|max:100',
            'jabatan_pengesah' => 'required|string|max:100',
            'tembusan' => 'nullable|string',
            'status_validasi' => 'required|in:Disetujui,Ditolak,Pending',
            'created_by' => 'required|string|max:100',
        ]);

        // Create a new surat keluar record
        SuratKeluar::create($request->all());
        return redirect()->route('surat_keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Retrieve a specific surat keluar record
        $suratKeluar = SuratKeluar::findOrFail($id);
        return view('surat_keluar.show', compact('suratKeluar'));
    }

    public function edit($id)
    {
        // Retrieve a specific surat keluar record for editing
        $suratKeluar = SuratKeluar::findOrFail($id);
        return view('surat_keluar.edit', compact('suratKeluar'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'tanggal_surat' => 'required|date',
            'nomor_surat' => 'required|string|max:50',
            'lampiran' => 'nullable|string|max:255',
            'perihal' => 'required|string|max:255',
            'tujuan_surat' => 'required|string|max:255',
            'isi_surat' => 'nullable|string',
            'foto_surat' => 'nullable|string|max:255',
            'disahkan_oleh' => 'required|string|max:100',
            'jabatan_pengesah' => 'required|string|max:100',
            'tembusan' => 'nullable|string',
            'status_validasi' => 'required|in:Disetujui,Ditolak,Pending',
            'created_by' => 'required|string|max:100',
        ]);

        // Update the specific surat keluar record
        $suratKeluar = SuratKeluar::findOrFail($id);
        $suratKeluar->update($request->all());
        return redirect()->route('surat_keluar.index')->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Delete the specific surat keluar record
        $suratKeluar = SuratKeluar::findOrFail($id);
        $suratKeluar->delete();
        return redirect()->route('surat_keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
    }
}