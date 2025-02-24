<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Cuti;
use App\Models\Jenis_Cuti;

class BiodataController extends Controller
{
    public function index()
    {
        // Mengambil data user dan biodata berdasarkan user yang login
        $user = auth()->user(); // Mendapatkan user yang sedang login
        $biodata = $user->biodata; // Mengambil biodata yang berelasi dengan user
        $cuti = Cuti::where('user_id', $user->id)->get(); // Pastikan ini sesuai dengan struktur database

        return view('biodata.index', compact('user', 'biodata', 'cuti'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $biodata = Biodata::where('id_user', $user->id)->first();

        return view('biodata.edit', compact('user', 'biodata'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'no_telepon' => 'nullable|string|max:14',
            'alamat' => 'nullable|string',
            'nip' => 'nullable|string|max:20|unique:biodata,nip,' . $id . ',id_user',
            'nik' => 'nullable|string|max:20|unique:biodata,nik,' . $id . ',id_user',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:15',
            'foto_ktp' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'data_ttd' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user = User::findOrFail($id);
        $biodata = Biodata::where('id_user', $user->id)->firstOrFail();

        // Update data Users
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        // Update data Biodata
        $biodata->update([
            'nama_lengkap' => $request->name, // Nama lengkap ikut diubah jika name diubah
            'nip' => $request->nip,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Upload Foto KTP jika ada file baru
        if ($request->hasFile('foto_ktp')) {
            if ($biodata->data_ktp) {
                Storage::delete('public/' . $biodata->data_ktp);
            }
            $biodata->data_ktp = $request->file('foto_ktp')->store('biodata', 'public');
        }

        // Upload Tanda Tangan jika ada file baru
        if ($request->hasFile('data_ttd')) {
            if ($biodata->data_ttd) {
                Storage::delete('public/' . $biodata->data_ttd);
            }
            $biodata->data_ttd = $request->file('data_ttd')->store('biodata', 'public');
        }

        $biodata->save();

        return redirect()->route('biodata.index')->with('success', 'Biodata berhasil diperbarui.');
    }

}
