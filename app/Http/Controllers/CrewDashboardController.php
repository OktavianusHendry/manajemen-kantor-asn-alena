<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Sub_Kategori;
use App\Models\Surat_Keluar;
use App\Models\Surat_Masuk;
use Illuminate\Http\Request;

class CrewDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $kategoris = Kategori::count();
        $sub_kategoris = Sub_Kategori::count();
        $suratmasuks = Surat_Masuk::count();
        $suratkeluars = Surat_Keluar::count();
        return view('crew.dashboard', compact('kategoris', 'sub_kategoris', 'suratmasuks', 'suratkeluars'));
    }

    public function crewDashboard()
{
    $user = auth()->user();

    // Tandai semua notifikasi sebagai dibaca
    $user->unreadNotifications->markAsRead();

    // Kode lainnya yang diperlukan untuk dashboard
    return view('crew.dashboard'); // ganti sesuai view dashboard Anda
}
}
