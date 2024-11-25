<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('personnel')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::PERSONNEL);
        }

        $request->user('personnel')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
