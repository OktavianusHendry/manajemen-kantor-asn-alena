<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::with('user', 'jenis_cuti')->paginate(10);
        return view('data_cuti.index', compact('cuti'));
    }

    public function create()
    {
        return view('data_cuti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_cuti' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required',
        ]);

        Cuti::create([
            'id_user' => Auth::id(),
            'id_jenis_cuti' => $request->id_jenis_cuti,
            'tanggal_pengajuan' => now(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'approved_by_director' => 'pending',
            'approved_by_head_acdemy' => 'pending',
        ]);

        return redirect()->route('data_cuti.index')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }

    public function edit(Cuti $cuti)
    {
        return view('cuti.edit', compact('cuti'));
    }

    public function update(Request $request, Cuti $cuti)
    {
        $request->validate([
            'id_jenis_cuti' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required',
        ]);

        $cuti->update($request->all());

        return redirect()->route('data_cuti.index')->with('success', 'Data cuti berhasil diperbarui.');
    }

    public function destroy(Cuti $cuti)
    {
        $cuti->delete();
        return redirect()->route('data_cuti.index')->with('success', 'Data cuti berhasil dihapus.');
    }

    public function validateCuti(Request $request, Cuti $cuti)
    {
        if (!in_array(Auth::user()->id_jabatan, [1, 2])) {
            return redirect()->route('data_cuti.index')->with('error', 'Anda tidak memiliki akses untuk validasi.');
        }

        if (Auth::user()->id_jabatan == 1) {
            $cuti->update(['approved_by_director' => $request->status]);
        } elseif (Auth::user()->id_jabatan == 2) {
            $cuti->update(['approved_by_head_acdemy' => $request->status]);
        }

        return redirect()->route('data_cuti.index')->with('success', 'Validasi cuti berhasil.');
    }
    
    public function validasi(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);
        $user = Auth::user();

        if ($user->id_jabatan == 1) { // Direktur
            $cuti->approved_by_director = $request->approval;
        } elseif ($user->id_jabatan == 2) { // Kepala Academy
            $cuti->approved_by_head_acdemy = $request->approval;
        } else {
            return redirect()->route('data_cuti.index')->with('error', 'Anda tidak memiliki akses untuk validasi cuti.');
        }

        $cuti->save();

        return redirect()->route('data_cuti.index')->with('success', 'Status cuti berhasil diperbarui.');
    }
}
