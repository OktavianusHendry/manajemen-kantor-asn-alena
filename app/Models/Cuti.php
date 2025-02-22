<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'data_cuti';

    protected $fillable = [
        'id_user', 'id_jenis_cuti', 'tanggal_pengajuan', 'tanggal_mulai', 'tanggal_selesai',
        'alasan', 'catatan', 'approved_by_director', 'approved_by_head_acdemy'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Jenis Cuti
    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'id_jenis_cuti');
    }
}
