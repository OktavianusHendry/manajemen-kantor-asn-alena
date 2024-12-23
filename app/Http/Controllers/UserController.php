<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index(Request $request)
    {
        $search = $request->input('search');
        $nama_jabatan = $request->input('nama_jabatan');
        $nama_divisi = $request->input('nama_divisi');        
    
        $users = User::with(['jabatan', 'divisi'])
            ->when($search, function ($query) use ($search) {
                return $query
                    ->join('jabatan', 'users.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->join('divisi', 'users.id_divisi', '=', 'divisi.id_divisi')
                    ->where('nama_jabatan', 'like', '%' . $search . '%')
                    ->orWhere('nama_divisi', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('role_as', 'like', '%' . $search . '%');
            })
            ->orderBy('users.created_at', 'desc')
            ->paginate(8);

        return view('users.index', compact('users'));
    }

    // Menampilkan form untuk mengedit user (menggunakan data yang sudah ada)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $jabatans = Jabatan::all();
        $divisis = Divisi::all();

        return view('users.edit', compact('user', 'jabatans', 'divisis'));
    }

    // Memperbarui data user yang sudah ada
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([ 
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_as' => 'required|string|in:0,1,2',
            // Validasi lain yang dibutuhkan
        ]);

        // Jika admin mengupload file baru untuk foto_diri, foto_ktp, atau surat_tugas, maka file lama akan dihapus dan digantikan
        if ($request->hasFile('foto_diri')) {
            $foto_diri_path = $request->file('foto_diri')->store('data_foto_karyawan', 'public');
            $user->foto_diri = $foto_diri_path;
        }

        if ($request->hasFile('foto_ktp')) {
            $foto_ktp_path = $request->file('foto_ktp')->store('data_ktp_karyawan', 'public');
            $user->foto_ktp = $foto_ktp_path;
        }

        if ($request->hasFile('surat_tugas')) {
            $surat_tugas_path = $request->file('surat_tugas')->store('data_surat_tugas', 'public');
            $user->surat_tugas = $surat_tugas_path;
        }

        // Memperbarui data lainnya
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_as' => $request->role_as,
            'id_jabatan' => $request->id_jabatan,
            'id_divisi' => $request->id_divisi,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'tanggal_bergabung' => $request->tanggal_bergabung,
            'surat_tugas' => $user->surat_tugas,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Menghapus user
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}