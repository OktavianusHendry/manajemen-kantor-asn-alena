<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return $this->authenticated($request, Auth::user());
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        cache()->flush();

        if ($user->role_as == '1') // 1 = Admin
        {
            return redirect()->route('admin.dashboard')->with('status', 'Welcome to your dashboard');
        }
        if ($user->role_as == '2') // 2 = Crew
        {
            return redirect()->route('crew.dashboard')->with('status', 'Welcome to your dashboard');
        }
        if ($user->role_as == '0') // 0 = User Biasa
        {
            return redirect()->route('user.dashboard')->with('status', 'Welcome to your dashboard');
        }
        return redirect('/')->with('status', 'Logged in successfully');
    }
}
