<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar_new'; // Specify the correct table name
    protected $primaryKey = 'id_surat'; // Ganti dengan nama kolom primary key jika berbeda
    public $timestamps = true; // Jika Anda menggunakan timestamps

    protected $fillable = [
        'tanggal_surat',
        'nomor_surat',
        'lampiran',
        'perihal',
        'tujuan_surat',
        'isi_surat',
        'foto_surat',
        'disahkan_oleh',
        'jabatan_pengesah',
        'tembusan',
        'status_validasi',
        'created_by',
    ];
}