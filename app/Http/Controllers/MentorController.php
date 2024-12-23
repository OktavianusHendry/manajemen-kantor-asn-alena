<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MentorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');      
    
        $mentors = Mentor::when($search, function ($query, $search) {
                return $query
                    ->where('nama_Mentor', 'like', '%' . $search . '%')
                    ->orWhere('no_telepon', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderBy('mentor.created_at', 'desc')
            ->paginate(10);
    
        return view('mentor.index', compact('mentors'));
    }
    
    

    public function create()
    {
        return view('mentor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mentor' => 'required|string|max:80',
            'foto_diri' => 'nullable|image|mimes:jpg,png|max:5048',
            'foto_ktp' => 'nullable|image|mimes:jpg,png|max:5048',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:14',
            'email' => 'nullable|string|email|unique:mentor,email',
            'surat_tugas' => 'nullable|file|mimes:pdf,pptx,doc,docx,zip,rar|max:5048',
        ]);
    
        $foto_diri_path = $request->file('foto_diri')->store('data_foto_mentor', 'public');
        $foto_ktp_path = $request->file('foto_ktp')->store('data_ktp_mentor', 'public');
        $surat_tugas_path = $request->file('surat_tugas')->store('data_surat_tugas', 'public');
    
        Mentor::create([
            'nama_mentor' => $request->nama_mentor,
            'foto_diri' => $foto_diri_path,
            'foto_ktp' => $foto_ktp_path,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'surat_tugas' => $surat_tugas_path,
        ]);
    
        return redirect()->route('mentor.index')->with('success', 'Mentor berhasil ditambahkan.');
    }

    public function show(Mentor $mentor)
    {
        return view('mentor.show', compact('mentor'));
    }

    public function edit(Mentor $mentor)
    {
        return view('mentor.edit', compact('mentor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mentor' => 'required|string|max:80',
            'foto_diri' => 'image|mimes:jpg,png|max:5048',
            'foto_ktp' => 'image|mimes:jpg,png|max:5048',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:14',
            'email' => 'nullable|string|email|max:255|unique:mentor,email,' . $id . ',id_mentor',
            'surat_tugas' => 'nullable|file|mimes:pdf,pptx,doc,docx,zip,rar|max:5048',
        ]);
    
        $mentor = Mentor::findOrFail($id);
    
        if ($request->hasFile('foto_diri')) {
            if ($mentor->foto_diri) {
                Storage::disk('public')->delete($mentor->foto_diri);
            }
            $mentor->foto_diri = $request->file('foto_diri')->store('data_foto_mentor', 'public');
        }
    
        if ($request->hasFile('foto_ktp')) {
            if ($mentor->foto_ktp) {
                Storage::disk('public')->delete($mentor->foto_ktp);
            }
            $mentor->foto_ktp = $request->file('foto_ktp')->store('data_ktp_mentor', 'public');
        }
    
        if ($request->hasFile('surat_tugas')) {
            if ($mentor->surat_tugas) {
                Storage::disk('public')->delete($mentor->surat_tugas);
            }
            $mentor->surat_tugas = $request->file('surat_tugas')->store('data_surat_tugas', 'public');
        }
    
        $mentor->update($request->except(['foto_diri', 'foto_ktp', 'surat_tugas']));
    
        return redirect()->route('mentor.index')
            ->with('success', 'Profil Mentor berhasil diperbarui.')
            ->with('mentor', $mentor);
    }

    public function destroy($id)
    {
        $mentor = Mentor::findOrFail($id);
        
        if ($mentor->foto_diri) {
            Storage::disk('public')->delete($mentor->foto_diri);
        }
        if ($mentor->foto_ktp) {
            Storage::disk('public')->delete($mentor->foto_ktp);
        }
        if ($mentor->surat_tugas) {
            Storage::disk('public')->delete($mentor->surat_tugas);
        }

        $mentor->delete();

        return redirect()->route('mentor.index')->with('success', 'Mentor berhasil dihapus.');
    }
}