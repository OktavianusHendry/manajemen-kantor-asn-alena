<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcaraNew;
use App\Models\PesertaBeritaAcara;
use Illuminate\Support\Facades\Auth; // Tambahkan ini!
use Illuminate\Support\Facades\Storage;
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'berkas' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048', // Validasi file
            'tautan_website' => 'nullable|url',
        ]);

       // Simpan file ke storage/berita-acara di disk public
       //$berkasPath = null;
       // if ($request->hasFile('berkas')) {
       //     $berkasPath = $request->file('berkas')->storeAs(
       //         'berita-acara', // Folder di dalam storage/app/public/
       //         time() . '_' . $request->file('berkas')->getClientOriginalName(), // Nama unik
       //         'public' // Disk public
       //     );
       // }
        $berkasPath = $request->file('berkas') ? $request->file('berkas')->store('data_file_berita_acara', 'public') : null;

        // Simpan Berita Acara
        $beritaAcara = BeritaAcaraNew::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'berkas' => $berkasPath,
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
        $karyawan = User::where('role_as', 2)->get(); // Ambil karyawan dengan role_as = 2
    
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
    
        // Jika da file baru diunggah, hapus file lama dan simpan yang baru
        if ($request->hasFile('berkas')) {
            // Hapus file lama jika ada
            if ($beritaAcara->berkas) {
                Storage::disk('public')->delete($beritaAcara->berkas);
            }

            // Simpan file baru dengan nama unik
            $berkasPath = $request->file('berkas')->storeAs(
                'berita-acara', // Folder dalam storage/app/public/
                time() . '_' . $request->file('berkas')->getClientOriginalName(), // Nama unik
                'public' // Disk public
            );

            // Simpan path file baru ke database
            $beritaAcara->berkas = $berkasPath;
        }
    
        // Update data berita acara
        $beritaAcara->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'tautan_website' => $request->tautan_website,
        ]);
    
        // Update peserta internal
        PesertaBeritaAcara::where('id_berita_acara', $id)->where('jenis_peserta', 'karyawan')->delete();
        if ($request->has('peserta_internal')) {
            foreach ($request->peserta_internal as $id_user) {
                PesertaBeritaAcara::create([
                    'id_berita_acara' => $beritaAcara->id,
                    'id_user' => $id_user,
                    'jenis_peserta' => 'karyawan',
                ]);
            }
        }
    
        // Update peserta eksternal
        PesertaBeritaAcara::where('id_berita_acara', $id)->where('jenis_peserta', 'luar')->delete();
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
    
        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $beritaAcara = BeritaAcaraNew::findOrFail($id);

        // Hapus semua peserta yang terkait
        $beritaAcara->peserta()->delete();

        // Hapus berita acara
        $beritaAcara->delete();

        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil dihapus.');
    }

    public function showValidate($id)
    {
        $beritaAcara = BeritaAcaraNew::findOrFail($id);

        // Cek apakah user adalah direktur
        if (Auth::user()->id_jabatan != 1) {
            return redirect()->route('berita-acara.index')->with('error', 'Anda tidak memiliki izin untuk validasi.');
        }

        return view('berita-acara.validate', compact('beritaAcara'));
    }

    public function validateBeritaAcara(Request $request, $id)
    {
        $beritaAcara = BeritaAcaraNew::findOrFail($id);

        // Pastikan hanya direktur yang bisa validasi
        if (Auth::user()->id_jabatan != 1) {
            return redirect()->route('berita-acara.index')->with('error', 'Anda tidak memiliki izin untuk validasi.');
        }

        // Validasi input
        $request->validate([
            'approved_by_director' => 'required|in:approved,pending,rejected',
            'catatan_direktur' => $request->approved_by_director == 'rejected' ? 'required|string' : 'nullable'
        ]);

        // Simpan status validasi
        $beritaAcara->approved_by_director = $request->approved_by_director;
        $beritaAcara->catatan_direktur = $request->approved_by_director == 'rejected' ? $request->catatan_direktur : null;
        $beritaAcara->save();

        return redirect()->route('berita-acara.index')->with('success', 'Validasi berhasil diperbarui.');
    }

}
