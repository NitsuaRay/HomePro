<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('personnel')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::PERSONNEL . '?verified=1');
        }

        if ($request->user('personnel')->markEmailAsVerified()) {
            event(new Verified($request->user('personnel')));
        }

        return redirect()->intended(RouteServiceProvider::PERSONNEL . '?verified=1');
    }
}
