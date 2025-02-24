<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        // Mengambil data user dan biodata berdasarkan user yang login
        $user = auth()->user(); // Mendapatkan user yang sedang login
        $biodata = $user->biodata; // Mengambil biodata yang berelasi dengan user

        return view('biodata.index', compact('user', 'biodata'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
            'tanggal_lahir' => 'nullable|date',
            // Validasi lainnya sesuai kebutuhan
        ]);

        // Mengambil data user yang sedang login
        $user = auth()->user();

        // Update data user
        $user->update([
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_hp,
            'tanggal_lahir' => $request->tanggal_lahir,
            // update data lainnya jika diperlukan
        ]);

        // Jika ada biodata, update biodata juga
        if ($user->biodata) {
            $user->biodata->update([
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'tanggal_lahir' => $request->tanggal_lahir,
                // update biodata lainnya
            ]);
        } else {
            // Jika biodata belum ada, buat baru
            $user->biodata()->create([
                'nama_lengkap' => $request->nama_lengkap,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'tanggal_lahir' => $request->tanggal_lahir,
                // create biodata lainnya
            ]);
        }

        return redirect()->route('biodata.index')->with('success', 'Data biodata berhasil diperbarui.');
    }
}
