<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
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
        return view('personnel.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => 'required|date|before_or_equal:today',
            'phone' => [
                'required',
                'regex:/^(09|\+639)\d{9}$/',
                'unique:users',
                'string',
                function ($attribute, $value, $fail) {
                    if (Personnel::where('phone', $value)->exists()) {
                        $fail('The phone number has already been taken.');
                    }
                },
            ],
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'isGCash' => 'required|in:YES,NO',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Personnel::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'fee' => [
                'required', 'numeric', 'between:0,9999.99', 'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'service_cat' => ['required', 'string', 'max:255'],
            'terms' => 'required',
        ]);

        $firstName = ucwords(strtolower($request->first_name));
        $middleName = ucwords(strtolower($request->middle_name));
        $lastName = ucwords(strtolower($request->last_name));

        $birthday = $request->input('birthday');
        $age = null;

        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }

        $user = Personnel::create([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'email' => $request->email,
            'age' => $age,
            'isGCash' => $request->isGCash,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'service_cat' => $request->service_cat,
            'fee' => $request->fee,
            'birthday' => $birthday,
        ]);

        if ($request->has('terms')) {
            // Store the acceptance of terms in the database using Eloquent ORM
            $user->accepted_terms = true;
            $user->save();
        }
        event(new Registered($user));

        Auth::guard('personnel')->login($user);

        return redirect(RouteServiceProvider::PERSONNEL)->with('success', 'Login Successfully');
    }
}
