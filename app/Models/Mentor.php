<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $table = 'mentor';
    protected $primaryKey = 'id_mentor';
    protected $fillable = [
        'nama_mentor',
        'foto_diri',
        'foto_ktp',
        'alamat',
        'no_telepon',
        'email',
        'surat_tugas',
    ];

    public $timestamps = true;

    public function mentor()
    {
        return $this->hasMany(Mentor::class, 'id_mentor', 'id_mentor');
    }
}