<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesertaDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        return view('peserta.dashboard');
    }

    public function pesertaDashboard()
{
    $user = auth()->user();

    // Tandai semua notifikasi sebagai dibaca
    $user->unreadNotifications->markAsRead();

    // Kode lainnya yang diperlukan untuk dashboard
    return view('peserta.dashboard'); // ganti sesuai view dashboard Anda
}
}
