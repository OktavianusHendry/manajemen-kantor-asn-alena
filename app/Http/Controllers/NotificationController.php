<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Ensure that only the owner can delete the notification
        if ($notification->notifiable_id === Auth::id()) {
            $notification->delete();
            return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
        }
    
        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus notifikasi ini.');
    }  
}