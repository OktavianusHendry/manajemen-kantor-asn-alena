<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcaraNew extends Model
{
    use HasFactory;

    protected $table = 'berita_acara_new';

    protected $fillable = [
        'judul', 'deskripsi', 'tanggal', 'berkas', 'tautan_website',
        'catatan_direktur', 'approved_by_director'
    ];

    public function peserta()
    {
        return $this->hasMany(PesertaBeritaAcara::class, 'id_berita_acara');
    }
}
