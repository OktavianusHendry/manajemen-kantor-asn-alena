<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KaryawanNewController extends Controller
{
    public function index()
    {
        $karyawan = User::where('role_as', 2)->with('biodata')->get();
        return view('karyawan.index', compact('karyawan'));
    }
}
