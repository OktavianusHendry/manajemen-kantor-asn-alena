<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';
    protected $fillable = [
        'id_user', 'nip', 'nama_lengkap', 'jabatan', 'divisi', 'nik',
        'tempat_lahir', 'tanggal_lahir', 'foto', 'no_hp', 'alamat',
        'tanggal_bergabung', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

