<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use Notifiable;

    protected $table = 'karyawan';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'email',
        'password',
        'jabatan',
        'divisi',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'foto',
        'no_hp',
        'alamat',
        'email_verified_at',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date',
    ];
}
