<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanCuti;
use App\Models\Divisi;
use App\Models\Jenis_Cuti;
use App\Models\User;
use App\Notifications\CutiStatusUpdated;
use Illuminate\Support\Facades\Auth;

class LaporanCutiController extends Controller
{
    // Function to print a specific leave report
    public function cetaklaporan($id)
    { 
        $cetaklaporan = LaporanCuti::with(['users', 'divisi'])->findOrFail($id);
        return view('laporan_cuti.cetak-laporan-cuti', compact('cetaklaporan'));
    }
    
    // Function to print leave reports within a selected date range
    public function cetaklaporanpertanggal(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
    
        $cetakpertanggal = LaporanCuti::with(['divisi', 'users', 'jenis_cuti'])
            ->whereBetween('mulai_tanggal', [$tglawal, $tglakhir])
            ->get();
    
        return view('laporan_cuti.cetak-laporan-pertanggal', compact('cetakpertanggal'));
    }

    public function updateStatus(Request $request, $id) 
    {
        $cuti = LaporanCuti::findOrFail($id);
    
        if (Auth::user()->role_as != 1) {
            abort(403, 'Unauthorized action.');
        }
    
        // Validate request
        $request->validate([
            'status' => 'required|string',
            'catatan' => 'required_if:status,rejected', // Require 'catatan' if status is 'rejected'
        ]);
    
        $cuti->status = $request->input('status');
    
        if ($request->input('status') == 'rejected') {
            $cuti->catatan = $request->input('catatan');
        }
    
        $cuti->save();
    
        // Send notification to the user who submitted the leave report
        $user = $cuti->users; // Access the user relationship
        if ($user) {
            $user->notify(new CutiStatusUpdated($cuti));
        }
    
        return redirect()->route('laporan_cuti.index')->with('success', 'Status cuti berhasil diperbarui.');
    }
    
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = LaporanCuti::with(['users', 'divisi', 'jenis_cuti']);
    
        // Filter reports based on user role
        if (auth()->user()->role_as == '2') {
            $query->where('id', auth()->user()->id);  // Fixed the field to filter by user
        }
    
        // Filter based on search input
        if ($search) {
            $query->where('status', 'like', "%$search%")
                ->orWhereHas('users', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->orWhereHas('divisi', function ($query) use ($search) {
                    $query->where('kode_divisi', 'like', "%$search%");  // Fixed field name
                })
                ->orWhereHas('jenis_cuti', function ($query) use ($search) {
                    $query->where('nama_jenis_cuti', 'like', "%$search%");
                });
        }
    
        // Filter based on date range
        if ($startDate && $endDate) {
            $query->whereBetween('mulai_tanggal', [$startDate, $endDate])
                  ->orWhereBetween('sampai_tanggal', [$startDate, $endDate]);
        }
    
        $laporanCuti = $query->orderBy('created_at', 'desc')->paginate(10);
    
        return view('laporan_cuti.index', compact('laporanCuti'));
    }

    public function create()
    {
        $user = User::all();
        $divisi = Divisi::all();
        $jenis_cuti = Jenis_Cuti::all();
        $users = User::where('role_as', 2)->get();
        
        return view('laporan_cuti.create', compact('user', 'divisi', 'users', 'jenis_cuti'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'id_divisi' => 'required', // Ensure 'id_divisi' is validated
            'id_jenis_cuti' => 'required',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'status' => 'in:pending,approved,rejected',
            'catatan' => 'nullable|string|max:100',
        ]);
    
        // Explicitly set 'id_divisi' from authenticated user or request
        $laporanCuti = LaporanCuti::create([
            'id' => auth()->user()->id,
            'id_divisi' => $request->input('id_divisi', auth()->user()->id_divisi), // Use the value from the user or the form
            'id_jenis_cuti' => $request->input('id_jenis_cuti'),
            'mulai_tanggal' => $request->input('mulai_tanggal'),
            'sampai_tanggal' => $request->input('sampai_tanggal'),
            'keterangan' => $request->input('keterangan'),
            'status' => $request->input('status', 'pending'),  // Default to pending
            'catatan' => $request->input('catatan'),
        ]);
    
        // Kirim notifikasi kepada admin ketika laporan cuti baru dibuat
        $admins = User::where('role_as', '1')->get(); // Mengambil semua user dengan role admin
        foreach ($admins as $admin) {
            $admin->notify(new CutiStatusUpdated($laporanCuti));
        }
    
        return redirect()->route('laporan_cuti.index')->with('success', 'Pengajuan cuti berhasil diajukan');
    }
    
    
    public function show($id)
    {
        $laporanCuti = LaporanCuti::with(['users', 'divisi'])->findOrFail($id);
        return view('laporan_cuti.show', compact('laporanCuti'));
    }

    public function edit($id)
    {
        $laporanCuti = LaporanCuti::findOrFail($id);
        $user = User::all();
        $divisi = Divisi::all();
        $jenis_cuti = Jenis_Cuti::all();
        return view('laporan_cuti.edit', compact('laporanCuti', 'user', 'divisi', 'jenis_cuti'));
    }

    public function destroy($id)
    {
        $laporanCuti = LaporanCuti::findOrFail($id);
        $laporanCuti->delete();

        return redirect()->route('laporan_cuti.index')->with('success', 'Pengajuan Cuti berhasil dihapus');
    }
}