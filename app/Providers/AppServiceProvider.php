<?php

namespace App\Providers;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // $personnel = Personnel::all();
        // $users = User::all();
        // View::share('personnel', $personnel);
        // View::share('users', $users);
    }
}
