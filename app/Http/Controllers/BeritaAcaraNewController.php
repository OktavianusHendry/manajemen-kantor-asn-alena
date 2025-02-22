<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcaraNew;
use App\Models\PesertaBeritaAcara;
use Illuminate\Http\Request;

class BeritaAcaraNewController extends Controller
{
    public function index(Request $request)
    {
        $query = BeritaAcaraNew::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%")
                ->orWhere('tanggal', 'like', "%{$search}%");
        }

        $beritaAcara = $query->orderBy('tanggal', 'desc')->paginate(10);

        return view('berita-acara.index', compact('beritaAcara'));
    }


    public function create()
    {
        $karyawan = User::where('role_as', 'karyawan')->get(); // Ambil data user dengan role karyawan
        return view('berita-acara.create');
    }

    public function store(Request $request)
    {
        // Simpan Berita Acara
        $beritaAcara = BeritaAcaraNew::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'berkas' => $request->berkas,
            'tautan_website' => $request->tautan_website,
        ]);

        // Simpan Peserta Internal
        if ($request->has('peserta_internal')) {
            foreach ($request->peserta_internal as $id_user) {
                PesertaBeritaAcara::create([
                    'id_berita_acara' => $beritaAcara->id,
                    'id_user' => $id_user,
                    'jenis_peserta' => 'karyawan',
                ]);
            }
        }

        // Simpan Peserta Eksternal
        if ($request->has('peserta')) {
            foreach ($request->peserta as $peserta) {
                PesertaBeritaAcara::create([
                    'id_berita_acara' => $beritaAcara->id,
                    'nama_lengkap' => $peserta['nama_lengkap'],
                    'instansi' => $peserta['instansi'],
                    'jabatan' => $peserta['jabatan'],
                    'jenis_peserta' => 'luar',
                ]);
            }
        }

        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil disimpan!');
    }

    public function show($id)
    {
        $berita_acara = BeritaAcaraNew::with('peserta')->findOrFail($id);
        return view('berita_acara.show', compact('berita_acara'));
    }

    public function edit($id)
    {
        $berita_acara = BeritaAcaraNew::findOrFail($id);
        return view('berita_acara.edit', compact('berita_acara'));
    }

    public function update(Request $request, $id)
    {
        $berita_acara = BeritaAcaraNew::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'berkas' => 'nullable|file|mimes:pdf,doc,docx',
            'tautan_website' => 'nullable|url',
        ]);

        if ($request->hasFile('berkas')) {
            $filePath = $request->file('berkas')->store('berkas', 'public');
            $berita_acara->berkas = $filePath;
        }

        $berita_acara->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'tautan_website' => $request->tautan_website,
        ]);

        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita_acara = BeritaAcaraNew::findOrFail($id);
        $berita_acara->delete();

        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara berhasil dihapus!');
    }

    public function updateValidation(Request $request, $id)
    {
        $request->validate([
            'approved_by_director' => 'required|in:pending,approved,rejected',
            'catatan_direktur' => 'nullable|string',
        ]);

        $ba = BeritaAcaraNew::findOrFail($id);
        $ba->approved_by_director = $request->approved_by_director;
        $ba->catatan_direktur = $request->catatan_direktur;
        $ba->save();

        return redirect()->route('berita-acara.index')->with('success', 'Status validasi diperbarui.');
    }
}
