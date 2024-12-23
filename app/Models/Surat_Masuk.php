<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_Masuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_surat_masuk';
    protected $fillable = [ 'tgl_surat_masuk',
                            'id_instansi',
                            'sifat_surat',
                            'perihal',
                            'tindak_lanjut',
                            'file_surat',
                            'catatan'];
          
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }
}