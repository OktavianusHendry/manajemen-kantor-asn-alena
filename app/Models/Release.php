<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    protected $table = 'release';
    protected $primaryKey = 'id_release';
    protected $fillable = [
        'judul_release',
        'isi_release',
        'file',
    ];

    public $timestamps = true;
}