<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use App\Models\LaporanCuti;

class LaporanCutiCreated extends Notification
{
    use Queueable;

    protected $laporanCuti;

    public function __construct(LaporanCuti $laporanCuti)
    {
        $this->laporanCuti = $laporanCuti;
    }

    public function via($notifiable)
    {
        // Menggunakan channel database untuk menyimpan notifikasi
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Laporan cuti baru telah diajukan oleh ' . $this->laporanCuti->users->name,
            'laporan_cuti_id' => $this->laporanCuti->id, // Mengarahkan ke laporan cuti
        ];
    }
}