<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use App\Models\Jenis_Cuti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Tambahkan di atas

class CutiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Cuti::query();

        // Jika bukan Direktur atau Kepala Academy, hanya tampilkan cuti miliknya
        if ($user->id_jabatan != 1 && $user->id_jabatan != 2) {
            $query->where('id_user', $user->id);
        }

        // Filter berdasarkan tanggal
        if ($request->has('tanggal_mulai') && $request->has('tanggal_selesai')) {
            $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        // Pencarian berdasarkan nama atau jenis cuti
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })->orWhereHas('Jenis_Cuti', function ($q) use ($search) {
                $q->where('nama_jenis_cuti', 'like', "%$search%");
            });
        }

        // Urutkan berdasarkan tanggal terbaru
        $cuti = $query->orderBy('tanggal_pengajuan', 'desc')->paginate(10);

        return view('data_cuti.index', compact('cuti'));
    }

    public function create()
    {
        $jenisCuti = Jenis_Cuti::select('id_jenis_cuti', 'nama_jenis_cuti')->get();
        return view('data_cuti.create', compact('jenisCuti'));
    }

    public function store(Request $request)
    {
        // Cek apakah request masuk
        \Log::info('Data Cuti Masuk:', $request->all());

        $request->validate([
            'id_jenis_cuti' => 'exists:jenis_cuti,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'alasan' => 'required|string|max:255',
            'catatan' => 'nullable|string|max:100',
        ]);

        // Cek apakah sudah lolos validasi
        \Log::info('Data Valid:', $request->all());

        $cuti = Cuti::create([
            'id_user' => auth()->id(),
            'id_jenis_cuti' => $request->id_jenis_cuti,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tanggal_pengajuan' => now(),
            'alasan' => $request->alasan,
            'catatan' => $request->input('catatan'),
            'approved_by_director' => 'pending',
            'approved_by_head_acdemy' => 'pending',
        ]);

        // Cek apakah data benar-benar tersimpan
        if ($cuti) {
            \Log::info('Data Berhasil Disimpan:', $cuti->toArray());
        } else {
            \Log::error('Gagal Menyimpan Data');
        }

        return redirect()->route('data_cuti.index')->with('success', 'Pengajuan cuti berhasil diajukan.');
    }



    public function edit($id)
    {
        $cuti = Cuti::where('id', $id)->where('id_user', Auth::id())->firstOrFail();
        $jenisCuti = Jenis_Cuti::all();

        return view('data_cuti.edit', compact('cuti', 'jenisCuti'));
    }

    public function update(Request $request, $id)
    {
        $cuti = Cuti::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

        $request->validate([
            'id_jenis_cuti' => '',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|min:10',
        ]);

        $cuti->update([
            'id_jenis_cuti' => $request->id_jenis_cuti,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('data_cuti.index')->with('success', 'Pengajuan cuti berhasil diperbarui.');
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

    public function show($id)
    {
        $cuti = Cuti::findOrFail($id);
        return view('data_cuti.show', compact('cuti'));
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
