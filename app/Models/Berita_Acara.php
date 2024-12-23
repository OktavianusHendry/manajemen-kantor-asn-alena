<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita_Acara extends Model
{
    use HasFactory;

    protected $table = 'berita_acara';
    protected $primaryKey = 'id_berita';
    protected $fillable = [
        'judul_berita',
        'isi_berita',
        'file',
    ];

    public $timestamps = true;
}