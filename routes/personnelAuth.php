<?php

use App\Http\Controllers\Personnel\AuthenticatedSessionController;
use App\Http\Controllers\Personnel\ConfirmablePasswordController;
use App\Http\Controllers\Personnel\EmailVerificationNotificationController;
use App\Http\Controllers\Personnel\EmailVerificationPromptController;
use App\Http\Controllers\Personnel\NewPasswordController;
use App\Http\Controllers\Personnel\PasswordController;
use App\Http\Controllers\Personnel\PasswordResetLinkController;
use App\Http\Controllers\Personnel\RegisteredUserController;
use App\Http\Controllers\Personnel\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:personnel')->group(function () {
    Route::get('personnel/register', [RegisteredUserController::class, 'create'])
        ->name('personnel.register');

    Route::post('personnel/register', [RegisteredUserController::class, 'store']);

    Route::get('personnel/login', [AuthenticatedSessionController::class, 'create'])
        ->name('personnel.login');

    Route::post('personnel/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('personnel/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('personnel.password.request');

    Route::post('personnel/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('personnel.password.email');

    Route::get('personnel/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('personnel.password.reset');

    Route::post('personnel/reset-password', [NewPasswordController::class, 'store'])
        ->name('personnel.password.store');
});

Route::middleware('auth:personnel')->group(function () {
    Route::get('personnel/verify-email', EmailVerificationPromptController::class)
        ->name('personnel.verification.notice');

    Route::get('personnel/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('personnel.verification.verify');

    Route::post('personnel/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('personnel.verification.send');

    Route::get('personnel/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('personnel.password.confirm');

    Route::post('personnel/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('personnel/password', [PasswordController::class, 'update'])->name('personnel.password.update');

    Route::post('personnel/logout', [AuthenticatedSessionController::class, 'destroy'])->name('personnel.logout');
});
