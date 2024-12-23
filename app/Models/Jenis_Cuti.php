<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Cuti extends Model
{
    use HasFactory;

    protected $table = 'jenis_cuti';
    protected $primaryKey = 'id_jenis_cuti';
    protected $fillable = [
        'nama_jenis_cuti',
    ];

    public $timestamps = true;

    public function jenis_cuti()
    {
        return $this->hasMany(jenis_cuti::class, 'id_jenis_cuti', 'id_jenis_cuti');
    }
}