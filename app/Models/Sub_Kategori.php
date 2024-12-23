<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Kategori extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';
    protected $primaryKey = 'id_sub_kategori';
    protected $fillable = [
        'nama_sub_kategori',
    ];

    public $timestamps = true;

    public function sub_kategori()
    {
        return $this->hasMany(Sub_Kategori::class, 'id_sub_kategori', 'id_sub_kategori');
    }
}