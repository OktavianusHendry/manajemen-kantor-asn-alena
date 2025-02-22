<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KaryawanNewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $karyawan = User::where('role_as', 2) // Role 2 untuk karyawan
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate(10); // <-- Gunakan paginate() bukan get()

        return view('karyawan.index', compact('karyawan'));
    }


    public function show($id)
    {
        $karyawan = User::where('role_as', 2)->where('id', $id)->firstOrFail();
        return view('karyawan.show', compact('karyawan'));
    }

}
