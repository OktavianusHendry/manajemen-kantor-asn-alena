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
        // Attempt to authenticate as a Karyawan first
        if (Auth::guard('karyawan')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::guard('karyawan')->user());
        }

        // If Karyawan authentication fails, attempt to authenticate as a User
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return $this->authenticated($request, Auth::user());
        }

        // If both attempts fail, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy(Request $request)
    {
        // Logout from both guards
        Auth::guard('web')->logout();
        Auth::guard('karyawan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        cache()->flush();

        // Check user role and redirect accordingly
        if ($user instanceof \App\Models\User) {
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
        } elseif ($user instanceof \App\Models\Karyawan) {
            // Handle Karyawan specific redirection if needed
            if ($user->jabatan == '3') // 3 = Manager
            {
                return redirect()->route('admin.dashboard')->with('status', 'Welcome to your dashboard');
            }
            if ($user->role_as == '0') // 0 = User Biasa
            {
                return redirect()->route('admin.dashboard')->with('status', 'Welcome to your dashboard');
            }
        }

        return redirect('/')->with('status', 'Logged in successfully');
    }
}
