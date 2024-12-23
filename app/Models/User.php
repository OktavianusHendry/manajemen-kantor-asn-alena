<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'foto_diri',
        'foto_ktp',
        'id_jabatan',
        'id_divisi',
        'alamat',
        'no_telepon',
        'tanggal_bergabung',
        'surat_tugas',
        'role_as'
    ];

    public function getRoleNameAttribute()
    {
        $roles = [
            '0' => 'User',
            '1' => 'Admin',
            '2' => 'Crew'
        ];

        return $roles[$this->role_as];
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi'); // Sesuaikan dengan nama kolom foreign key di tabel users
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
