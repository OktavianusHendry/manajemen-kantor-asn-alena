<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip_Pembelajaran extends Model
{
    use HasFactory;

    protected $table = 'arsip_pembelajaran';
    protected $primaryKey = 'id_arsip_pembelajaran';
    protected $fillable = [
        'judul_pembelajaran',
        'id_jenjang',
        'kelas',
        'pertemuan_ke',
        'id_kategori',
        'id_sub_kategori',
        'file_satu',
        'file_dua',
        'file_tiga',
        'file_empat',
        'file_lima',
        'catatan',
    ];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'id_jenjang', 'id_jenjang');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function sub_kategori()
    {
        return $this->belongsTo(Sub_Kategori::class, 'id_sub_kategori', 'id_sub_kategori');
    }
}
 