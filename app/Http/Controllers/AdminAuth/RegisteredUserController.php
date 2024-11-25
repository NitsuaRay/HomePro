<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:1'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'regex:/^(09|\+639)\d{9}$/',
                'unique:users',
                'string',
                function ($attribute, $value, $fail) {
                    if (Admin::where('phone', $value)->exists()) {
                        $fail('The phone number has already been taken.');
                    }
                },
            ],
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $firstName = ucwords(strtolower($request->firstname));
        $middleName = ucwords(strtolower($request->middlename));
        $lastName = ucwords(strtolower($request->lastname));

        $user = Admin::create([
            'firstname' => $firstName,
            'middlename' => $middleName,
            'lastname' => $lastName,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('admin')->login($user);

        return redirect(RouteServiceProvider::ADMIN)->with('success', 'Login Successfully');
    }
}
