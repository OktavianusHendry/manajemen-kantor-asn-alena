<?php

namespace App\Http\Controllers;

use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $releases = Release::query();

    if ($search) {
        $releases->where('judul_release', 'like', "%{$search}%")
                ->orWhere('isi_release', 'like', "%{$search}%");
    }

    $releases = $releases
    ->orderBy('created_at', 'desc') 
    ->paginate(10);

    return view('release.index', compact('releases'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('release.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_release' => 'string|max:155',
            'isi_release' => 'string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,doc|max:10048',
        ]);
    
        $file_Release_path = null;

        if ($request->hasFile('file')) {
            $file_Release_path = $request->file('file')->store('data_file_Release', 'public');
        }

        Release::create([
            'judul_release' => $request->judul_release,
            'isi_release' => $request->isi_release,
            'file' => $file_Release_path, 
        ]);
    
        return redirect()->route('release.index')->with('success', 'Release berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Release  $realese
     * @return \Illuminate\Http\Response
     */
    public function show(Release $release)
    {
        return view('release.show', ['release' => $release]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Release  $realese
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $release = Release::findOrFail($id);

        return view('release.edit', compact('release'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Release  $realese
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul_release' => 'required|string|max:155',
            'isi_release' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,doc|max:10048',
        ]);

        $release = Release::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($release->file) {
                Storage::disk('public')->delete($release->file);
            }
            $release->file = $request->file('file')->store('data_file_Release', 'public');
        }

        $release->update($request->except(['file']));

        return redirect()->route('release.index')
            ->with('success', 'Berita Acara berhasil diperbarui.')
            ->with('berita', $release);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Release  $realese
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $release = Release::findOrFail($id);
        
        if ($release->file) {
            Storage::disk('public')->delete($release->file);
        }

        $release->delete();

        return redirect()->route('release.index')->with('success', 'Release berhasil dihapus.');
    }
}