<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user('personnel')->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::PERSONNEL)
            : view('personnel.verify-email');
    }
}
