<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;

    protected $table = 'jenjang';
    protected $primaryKey = 'id_jenjang';
    protected $fillable = [
        'nama_jenjang',
    ];

    public $timestamps = true;

    public function jenjang()
    {
        return $this->hasMany(Jenjang::class, 'id_jenjang', 'id_jenjang');
    }
}