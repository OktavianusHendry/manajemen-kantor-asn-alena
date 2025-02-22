<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaBeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'peserta_berita_acara';

    protected $fillable = [
        'id_berita_acara', 'id_user', 'nama_lengkap', 'instansi', 'jabatan', 'jenis_peserta'
    ];

    public function beritaAcara()
    {
        return $this->belongsTo(BeritaAcaraNew::class, 'id_berita_acara');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
