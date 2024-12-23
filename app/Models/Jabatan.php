<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $fillable = [
        'nama_jabatan',
    ];

    public $timestamps = true;

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }
}