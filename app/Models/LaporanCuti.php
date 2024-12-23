<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanCuti extends Model
{
    use HasFactory;

    protected $table = 'laporan_cuti';
    protected $primaryKey = 'cuti_id';
    
    protected $fillable = [
        'id',  // Add this line to ensure the user ID is fillable
        'id_divisi',
        'id_jenis_cuti',
        'mulai_tanggal',
        'sampai_tanggal',
        'keterangan',
        'status',
        'catatan',
    ];
    

    public $timestamps = true;

    // Mengubah relasi pengguna (user)
    public function users()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    public function jenis_cuti()
    {
        return $this->belongsTo(jenis_cuti::class, 'id_jenis_cuti', 'id_jenis_cuti');
    }
}