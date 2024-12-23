<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Sekolah;
use App\Models\Kategori;
use App\Models\Sub_Kategori;
use App\Models\Unit_Penempatan;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index()
    {
        // Hitung jumlah data untuk statistik
        $instansis = Instansi::count();
        $users = User::count();
        $sekolahs = Sekolah::count();
        $totalUnitPenempatans = Unit_Penempatan::count();

        // Kirimkan data ke view
        return view('admin.dashboard', compact('instansis', 'users', 'sekolahs', 'totalUnitPenempatans',));
    }
}
