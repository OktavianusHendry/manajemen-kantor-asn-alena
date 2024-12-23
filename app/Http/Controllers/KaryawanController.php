<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $nama_jabatan = $request->input('nama_jabatan');
        $nama_divisi = $request->input('nama_divisi');        
    
        $karyawans = Karyawan::with(['jabatan', 'divisi'])
            ->when($search, function ($query) use ($search) {
                return $query
                    ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->join('divisi', 'karyawan.id_divisi', '=', 'divisi.id_divisi')
                    ->where('nama_jabatan', 'like', '%' . $search . '%')
                    ->orWhere('nama_di  visi', 'like', '%' . $search . '%')
                    ->orWhere('kode_divisi', 'like', '%' . $search . '%')
                    ->orWhere('nama_karyawan', 'like', '%' . $search . '%');
            })
            ->orderBy('karyawan.created_at', 'desc')
            ->paginate(10);
    
        return view('karyawan.index', compact('karyawans'));
    }
    
    

    public function create()
    {
        $jabatans = Jabatan::all();
        $divisis = Divisi::all();
        
        return view('karyawan.create', compact('jabatans', 'divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:80',
            'foto_diri' => 'nullable|image|mimes:jpg,png|max:5048',
            'foto_ktp' => 'nullable|image|mimes:jpg,png|max:5048',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'id_divisi' => 'required|exists:divisi,id_divisi',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:14',
            'email' => 'nullable|string|email|unique:karyawan,email',
            'tanggal_bergabung'     => 'required',
        ]);

        $foto_diri_path = $request->file('foto_diri')->store('data_foto_karyawan', 'public');
        $foto_ktp_path = $request->file('foto_ktp')->store('data_ktp_karyawan', 'public');

        Karyawan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'foto_diri' => $foto_diri_path,
            'foto_ktp' => $foto_ktp_path,
            'id_jabatan' => $request->id_jabatan,
            'id_divisi' => $request->id_divisi,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'tanggal_bergabung' => $request->tanggal_bergabung,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    public function edit(Karyawan $karyawan)
    {
        $jabatans = Jabatan::all();
        $divisis = Divisi::all();

        return view('karyawan.edit', compact('karyawan', 'jabatans', 'divisis'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_karyawan' => 'required|string|max:80',
            'foto_diri' => 'nullable|image|mimes:jpg,png|max:5048',
            'foto_ktp' => 'nullable|image|mimes:jpg,png|max:5048',
            'id_jabatan' => 'required|integer',
            'id_divisi' => 'required|integer',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:14',
            'email' => 'nullable|string|email|max:255|unique:karyawan,email,' . $id . ',id_karyawan',
            'tanggal_bergabung'     => 'required',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        if ($request->hasFile('foto_diri')) {
            if ($karyawan->foto_diri) {
                Storage::disk('public')->delete($karyawan->foto_diri);
            }
            $karyawan->foto_diri = $request->file('foto_diri')->store('data_foto_karyawan', 'public');
        }

        if ($request->hasFile('foto_ktp')) {
            if ($karyawan->foto_ktp) {
                Storage::disk('public')->delete($karyawan->foto_ktp);
            }
            $karyawan->foto_ktp = $request->file('foto_ktp')->store('data_ktp_karyawan', 'public');
        }

        $karyawan->update($request->except(['foto_diri', 'foto_ktp']));

        return redirect()->route('karyawan.index')
            ->with('success', 'Profil karyawan berhasil diperbarui.')
            ->with('karyawan', $karyawan);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        
        if ($karyawan->foto_diri) {
            Storage::disk('public')->delete($karyawan->foto_diri);
        }
        if ($karyawan->foto_ktp) {
            Storage::disk('public')->delete($karyawan->foto_ktp);
        }

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}