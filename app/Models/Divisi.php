<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $primaryKey = 'id_divisi';
    protected $fillable = [
        'nama_divisi',
        'kode_divisi',
    ];

    public $timestamps = true;

    public function divisi()
    {
        return $this->hasMany(Divisi::class, 'id_divisi', 'id_divisi');
    }
}