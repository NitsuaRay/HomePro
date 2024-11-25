<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;
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
        $provinces = Province::all();

        return view('auth.register', compact('provinces'));
    }

    public function fetchMunicipalities(Request $request)
    {
        $provinceId = $request->input('province_id');

        $municipalities = Municipality::where('province_id', $provinceId)->pluck('name', 'id');

        return response()->json($municipalities);
    }

    public function fetchBarangays(Request $request)
    {
        $municipalityId = $request->input('municipality_id');

        $barangays = Barangay::where('municipality_id', $municipalityId)->pluck('name', 'id');

        return response()->json($barangays);
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
                    if (User::where('phone', $value)->exists()) {
                        $fail('The phone number has already been taken.');
                    }
                },
            ],
            'barangay' => ['required', 'exists:barangays,id'],
            'municipality' => ['required', 'exists:municipalities,id'],
            'province' => ['required', 'exists:provinces,id'],
            'gender' => 'required|in:male,female,other',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'extra_add' => ['required', 'string', 'max:255'],
            'accepted_terms' => ['required', 'accepted'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'id_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $firstName = ucwords(strtolower($request->first_name));
        $middleName = ucwords(strtolower($request->middle_name));
        $lastName = ucwords(strtolower($request->last_name));

        $birthday = $request->input('birthday');
        $age = null;

        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('profile-images', 'public');
        } else {
            $imagePath = null;
        }

        if ($request->hasFile('id_picture')) {
            $imagePath2 = $request->file('id_picture')->store('id-images', 'public');
        } else {
            $imagePath2 = null;
        }


        $barangay = Barangay::findOrFail($request->barangay);
        $municipality = Municipality::findOrFail($request->municipality);
        $province = Province::findOrFail($request->province);

        $user = User::create([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'age' => $age,
            'birthday' => $birthday,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'barangay_id' => $barangay->id,
            'municipality_id' => $municipality->id,
            'province_id' => $province->id,
            'extra_add' => $request->extra_add,
            'accepted_terms' => true,
            'photo' => $imagePath,
            'id_picture' => $imagePath2,
            'isVerified' => true,
        ]);

        if ($request->has('accepted_terms')) {
            $user->accepted_terms = true;
            $user->save();
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Login Successfully');
    }
}
