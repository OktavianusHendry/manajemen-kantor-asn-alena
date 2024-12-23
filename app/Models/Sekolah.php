<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah';
    protected $primaryKey = 'id_sekolah';
    protected $fillable = [
        'nama_sekolah',
        'alamat_sekolah',
        'no_telp',
        'email',
    ];

    public $timestamps = true;

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class, 'id_sekolah', 'id_sekolah');
    }
}