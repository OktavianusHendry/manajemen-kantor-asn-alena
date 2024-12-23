<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_Penempatan extends Model
{
    use HasFactory;

    protected $table = 'unit_penempatan';
    protected $primaryKey = 'id_unit_penempatan';
    protected $fillable = [
        'id', 
        'id_sekolah', 
        'id_kategori', 
        'id_sub_kategori', 
        'kelas', 
        'jumlah_anak', 
        'detail', 
        'jumlah_pertemuan', 
        'mulai_tanggal', 
        'sampai_tanggal', 
    ];
    
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah', 'id_sekolah');
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