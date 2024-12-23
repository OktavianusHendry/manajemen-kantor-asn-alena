<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansi';
    protected $primaryKey = 'id_instansi';
    protected $fillable = [
        'nama_instansi',
        'id_tujuan',
        'alamat',
        'no_telepon',
        'email',
    ];

    public $timestamps = true;

    public function instansi()
    {
        return $this->hasMany(Instansi::class, 'id_instansi', 'id_instansi');
    }

    public function tujuan()
    {
        return $this->belongsTo(Tujuan::class, 'id_tujuan', 'id_tujuan');
    }
}