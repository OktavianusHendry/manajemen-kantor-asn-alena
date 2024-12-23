<?php

namespace App\Http\Controllers;

use App\Models\Surat_Keluar;
use App\Models\Instansi;
use App\Models\Tujuan;
use App\Models\User;
use App\Notifications\SuratStatusUpdated; // Make sure to import this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('sifat_surat');
    
        $surat_keluars = Surat_Keluar::with('instansi');
    
        // Jika pengguna bukan admin (role_as != 1), hanya tampilkan data miliknya sendiri
        if (auth()->user()->role_as != 1) {
            $surat_keluars->where('id', auth()->id());
        }
    
        if ($search) {
            $surat_keluars->where('perihal', 'like', "%{$search}%");
        }
    
        if ($filter) {
            $surat_keluars->where('sifat_surat_keluar', $filter);
        }
    
        $surat_keluars = $surat_keluars->orderBy('created_at', 'desc')->paginate(10);
    
        return view('surat_keluar.index', compact('surat_keluars'));
    }
    
    
    public function create()
    {
        $instansi = Instansi::all();
        $tujuan = Tujuan::all();
        return view('surat_keluar.create', compact('instansi', 'tujuan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_surat_keluar' => 'required|date',
            'id_instansi'      => 'required',
            'id_tujuan'        => 'required',
            'id'               => 'required',
            'sifat_surat'      => 'in:Formal,Bisnis,Resmi',
            'perihal_surat'    => 'string|max:100',
            'tindak_lanjut'    => 'required|string|max:100',
            'file_surat'       => 'nullable|file|mimes:pdf,docx,doc|max:10048',
            'status_surat'     => 'in:Pending,Approved,Rejected',
            'catatan_surat'    => 'nullable|string|max:150',
        ]);

        $file_surat_keluar_path = null;

        if ($request->hasFile('file_surat')) {
            $file_surat_keluar_path = $request->file('file_surat')->store('data_file_surat_keluar', 'public');
        }

        Surat_Keluar::create([
            'tgl_surat_keluar' => $request->input('tgl_surat_keluar'),
            'id_instansi'      => $request->input('id_instansi'),
            'id_tujuan'        => $request->input('id_tujuan'),
            'sifat_surat'      => $request->input('sifat_surat'),
            'perihal_surat'    => $request->input('perihal_surat'),
            'tindak_lanjut'    => $request->input('tindak_lanjut'),
            'file_surat'       => $file_surat_keluar_path,
            'status_surat'     => $request->input('status_surat'),
            'catatan_surat'    => $request->input('catatan_surat'),
            'id'               => auth()->id(), // Associate with the authenticated user
        ]);

        return redirect()->route('surat_keluar.index')->with('success', 'Surat Keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $surat_keluar = Surat_Keluar::with(['users', 'instansi', 'tujuan'])->findOrFail($id);
        return view('surat_keluar.show', compact('surat_keluar'));
    }

    public function edit($id)
    {
        $surat_keluar = Surat_Keluar::findOrFail($id);
        $user = User::all();
        $instansi = Instansi::all();
        $tujuan = Tujuan::all();
        return view('surat_keluar.edit', compact('surat_keluar', 'user', 'instansi', 'tujuan'));
    }

    public function update(Request $request, $id)
    {
        $surat_keluar = Surat_Keluar::findOrFail($id);
        $originalStatus = $surat_keluar->status_surat; // Simpan status sebelumnya
    
        // Update surat_keluar dengan data dari request
        $surat_keluar->update($request->all());
    
        if ($originalStatus !== $surat_keluar->status_surat) {
            // Kirim notifikasi hanya kepada user yang surat keluar-nya diubah
            $user = User::find($surat_keluar->id); // Sesuaikan dengan nama kolom yang sesuai, seperti 'user_id'
            
            if ($user) {
                $user->notify(new SuratStatusUpdated($surat_keluar));
            } else {
                // Tangani kasus jika pengguna tidak ditemukan
                return redirect()->route('surat_keluar.index')->with('error', 'Pengguna tidak ditemukan untuk notifikasi.');
            }
        }
    
        return redirect()->route('surat_keluar.index')->with('success', 'Surat Keluar berhasil diperbarui');
    }
    
    
    public function destroy(Surat_Keluar $surat_keluar)
    {
        if ($surat_keluar->file_surat) {
            Storage::disk('public')->delete($surat_keluar->file_surat);
        }

        $surat_keluar->delete();

        return redirect()->route('surat_keluar.index')->with('success', 'Surat Keluar berhasil dihapus.');
    }
}