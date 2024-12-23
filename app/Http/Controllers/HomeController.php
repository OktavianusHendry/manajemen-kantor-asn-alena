<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Kurpel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectUser()
    {
        $user = Auth::user();

        if ($user->role_as == 1) {
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        } elseif ($user->role_as == 2) {
            // Redirect to crew dashboard
            return redirect()->route('crew.dashboard');
        } else {
            // Redirect to user dashboard
            return redirect()->route('user.dashboard');
        }
    }
}