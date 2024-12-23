<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratStatusUpdated extends Notification
{
    use Queueable;

    protected $surat_Keluar;

    public function __construct($surat_Keluar)
    {
        $this->surat_Keluar = $surat_Keluar;
    }

    public function via($notifiable)
    {
        return ['database']; // Menyimpan di database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Status surat keluar yang anda ajukan telah di ' . $this->surat_Keluar->status_surat,
            'surat_keluar_id' => $this->surat_Keluar->id,
        ];
    }
}