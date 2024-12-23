<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at',
    ];

    // Casting data to array
    protected $casts = [
        'data' => 'array',
    ];

    // Relasi dengan user (atau entitas lain yang bisa menerima notifikasi)
    public function notifiable()
    {
        return $this->morphTo();
    }
}