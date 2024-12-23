<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CutiStatusUpdated extends Notification
{
    use Queueable;

    protected $laporanCuti;

    public function __construct($laporanCuti)
    {
        $this->laporanCuti = $laporanCuti;
    }

    public function via($notifiable)
    {
        return ['database']; // Menyimpan di database
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Pengajuan cuti Anda telah di ' . $this->laporanCuti->status,
            'message_2' => 'Pengajuan cuti dari ' . $this->laporanCuti->users->name,
            'cuti_id' => $this->laporanCuti->id,
        ];        
    }
    
}