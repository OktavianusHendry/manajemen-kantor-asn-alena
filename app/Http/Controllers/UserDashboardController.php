<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip_Pembelajaran;
use App\Models\Jenjang; // Pastikan model Jenjang ada
use App\Models\Kategori;
use App\Models\Sub_Kategori;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index(Request $request)
    {
        // Ambil parameter id_jenjang dan pencarian dari request
        $id_jenjang = $request->input('id_jenjang');
        $id_kategori = $request->input('id_kategori');
        $id_sub_kategori = $request->input('id_sub_kategori');
        $search = $request->input('search');

        // Query untuk mendapatkan data arsip_pembelajaran
        $query = Arsip_Pembelajaran::query();

        // Filter berdasarkan id_jenjang jika tersedia
        if ($id_jenjang) {
            $query->where('id_jenjang', $id_jenjang);
        }

        if ($id_kategori) {
            $query->where('id_kategori', $id_kategori);
        }

        if ($id_sub_kategori) {
            $query->where('id_sub_kategori', $id_sub_kategori);
        }

        // Pencarian berdasarkan judul, kategori, atau sub_kategori
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul_pembelajaran', 'LIKE', "%$search%")
                  ->orWhere('pertemuan_ke', 'LIKE', "%$search%");
            });
        }

        // Mengambil data arsip_pembelajaran dengan pagination
        $arsips = $query->paginate(16);

        // Mengambil semua data jenjang
        $jenjangs = Jenjang::all();
        $kategoris = Kategori::all();
        $sub_kategoris = Sub_Kategori::all();

        // Mengirimkan data ke view 'user.dashboard'
        return view('user.dashboard', compact('arsips', 'id_jenjang', 'id_kategori', 'id_sub_kategori', 'search', 'jenjangs', 'kategoris', 'sub_kategoris'));
    }
}
