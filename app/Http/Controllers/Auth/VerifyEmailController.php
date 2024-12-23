<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectUserBasedOnRole($request->user());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->redirectUserBasedOnRole($request->user());
    }

    /**
     * Redirect the user based on their role.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectUserBasedOnRole($user)
    {
        switch ($user->role_as) {
            case 1:
                return redirect()->route('admin.dashboard')->with('verified', true);
            case 2:
                return redirect()->route('crew.dashboard')->with('verified', true);
            default:
                return redirect()->route('user.dashboard')->with('verified', true);
        }
    }
}
