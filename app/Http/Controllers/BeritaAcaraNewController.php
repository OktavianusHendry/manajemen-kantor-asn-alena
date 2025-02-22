<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcaraNew;
use App\Models\PesertaBeritaAcara;
use Illuminate\Http\Request;
use App\Models\User;

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
        $karyawan = User::where('role_as', 2)->get(); // Ambil data user dengan role karyawan
        
        return view('berita-acara.create', compact('karyawan'));
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
        $beritaAcara = BeritaAcaraNew::with('peserta.user')->findOrFail($id);
        return view('berita-acara.show', compact('beritaAcara'));
    }

    public function peserta()
    {
        return $this->hasMany(PesertaBeritaAcara::class, 'id_berita_acara');
    }

    public function edit($id)
    {
        $beritaAcara = BeritaAcaraNew::with('peserta')->findOrFail($id);
        $karyawan = User::where('role_as', 2)->get(); // Ambil semua karyawan dengan role 2

        return view('berita-acara.edit', compact('beritaAcara', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'berkas' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'tautan_website' => 'nullable|url',
        ]);

        $beritaAcara = BeritaAcaraNew::findOrFail($id);
        
        // Update data berita acara
        $beritaAcara->judul = $request->judul;
        $beritaAcara->deskripsi = $request->deskripsi;
        $beritaAcara->tanggal = $request->tanggal;
        $beritaAcara->tautan_website = $request->tautan_website;

        // Jika ada file baru diunggah
        if ($request->hasFile('berkas')) {
            // Hapus file lama jika ada
            if ($beritaAcara->berkas) {
                Storage::delete('public/' . $beritaAcara->berkas);
            }
            
            // Simpan file baru
            $beritaAcara->berkas = $request->file('berkas')->store('berkas', 'public');
        }

        $beritaAcara->save();

        // Update peserta internal (karyawan)
        if ($request->has('peserta_internal')) {
            $pesertaInternal = array_map(function ($id) {
                return [
                    'id_user' => $id,
                    'jenis_peserta' => 'karyawan'
                ];
            }, $request->peserta_internal);

            // Hapus peserta internal lama & tambahkan yang baru
            PesertaBeritaAcara::where('id_berita_acara', $id)->where('jenis_peserta', 'karyawan')->delete();
            $beritaAcara->peserta()->createMany($pesertaInternal);
        }

        // Update peserta eksternal (bukan karyawan)
        if ($request->has('peserta')) {
            PesertaBeritaAcara::where('id_berita_acara', $id)->where('jenis_peserta', 'luar')->delete();
            $beritaAcara->peserta()->createMany($request->peserta);
        }

        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $beritaAcara = BeritaAcaraNew::findOrFail($id);
        $beritaAcara->delete();

        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil dihapus.');
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
