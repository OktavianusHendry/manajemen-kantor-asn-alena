<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_Keluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar'; // Pastikan nama tabel sesuai
    protected $primaryKey = 'id_surat_keluar';
    protected $fillable = [
        'tgl_surat_keluar',
        'id_instansi',
        'id_tujuan',
        'id',
        'sifat_surat_keluar',
        'perihal_surat',
        'tindak_lanjut',
        'file_surat',
        'status_surat',
        'catatan_surat'
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class, 'id_tujuan', 'id_tujuan');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}