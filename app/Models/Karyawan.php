<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'nama_karyawan',
        'foto_diri',
        'foto_ktp',
        'id_jabatan',
        'id_divisi',
        'alamat',
        'no_telepon',
        'tanggal_bergabung',
        'email',
    ];

    public $timestamps = true;

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }

}