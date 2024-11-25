<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{
    public function getChartDataAdmin(Request $request)
    {
        // Fetch data from the database or any other source
        $userCount = User::count();
        $personnelCount = Personnel::count();

        // Transform the data into the format expected by the chart
        $chartData = [
            'series' => [$userCount, $personnelCount],
            'labels' => ['Users', 'Personnel'],
        ];

        return response()->json($chartData);
    }

    public function getChartDataBooking(Request $request)
    {
        // Fetch data from the database or any other source
        $pendingCount = Booking::where('booking_status', 'Pending')->count();
        $acceptedCount = Booking::where('booking_status', 'Accepted')->count();
        $cancelledCount = Booking::where('booking_status', 'Cancelled')->count();
        $completedCount = Booking::where('booking_status', 'Completed')->count();


        // Transform the data into the format expected by the chart
        $chartData = [
            'series' => [$pendingCount, $cancelledCount, $acceptedCount, $completedCount], // Ensure series is an array of data points
            'labels' => ['Pending', 'Cancelled', 'Accepted', 'Completed'], // Ensure labels are in an array
        ];

        return response()->json($chartData);
    }

    public function showUser()
    {
        $user = User::orderBy('created_at', 'desc')->get();

        $userCount = User::count();

        foreach ($user as $users) {
            if ($users->photo !== null) {
                $users->isVerified = "Verified";
                $users->save();
            }
        }

        return view('admin.body.user', compact('user', 'userCount'));
    }

    public function showUserPrint()
    {
        $user = User::orderBy('created_at', 'desc')->get();

        $userCount = User::count();

        return view('admin.report.userPrint', compact('user', 'userCount'));
    }

    public function showPersonnelPrint()
    {
        $personnel = Personnel::orderBy('created_at', 'desc')->get();

        $personnelCount = Personnel::count();

        return view('admin.report.personnelPrint', compact('personnel', 'personnelCount'));
    }

    public function showBookingPrint()
    {
        $bookings = Booking::with(['user', 'personnel'])->orderBy('created_at', 'desc')

            ->get();

        return view('admin.report.bookingPrint', compact('bookings'));
    }

    public function showBooking()
    {
        $bookings = Booking::with(['user', 'personnel'])->orderBy('created_at', 'desc')

            ->get();

        return view('admin.body.booking', compact('bookings'));
    }

    public function showPersonnel()
    {
        $personnel = Personnel::orderBy('created_at', 'desc')->get();

        $personnelCount = Personnel::count();

        return view('admin.body.personnel', compact('personnel', 'personnelCount'));
    }

    public function verifyPersonnel($personnelId)
    {
        $personnel = Personnel::find($personnelId);

        if ($personnel) {
            $personnel->update(['isVerified' => 'Verified']);
        }

        return redirect()->back();
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => 'nullable|date|before_or_equal:today',
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
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $firstName = ucwords(strtolower($request->first_name));
        $middleName = ucwords(strtolower($request->middle_name));
        $lastName = ucwords(strtolower($request->last_name));
        $birthday = $request->input('birthday');
        $age = null;

        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }
        User::create([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'age' => $age,
            'birthday' => $birthday,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->back();
    }

    public function storePersonnel(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => 'nullable|date|before_or_equal:today',
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
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'fee' => [
                'required', 'numeric', 'between:0,9999.99', 'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'service_cat' => ['required', 'string', 'max:255'],

        ]);

        $firstName = ucwords(strtolower($request->first_name));
        $middleName = ucwords(strtolower($request->middle_name));
        $lastName = ucwords(strtolower($request->last_name));
        $birthday = $request->input('birthday');
        $age = null;

        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }
        Personnel::create([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'age' => $age,
            'birthday' => $birthday,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'service_cat' => $request->service_cat,
            'fee' => $request->fee,
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->back();
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Validate the request data as needed
        $request->validate([
            'first_name' => 'string|max:255',
            'midde_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'birthday' => 'nullable|date|before_or_equal:today',
            'phone' => [
                'regex:/^(09|\+639)\d{9}$/',
                Rule::unique('users')->ignore($user->id),
                'string',
            ],
            'address' => 'string|max:255',
            'gender' => 'in:male,female,other',
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
        ]);

        $firstName = ucwords(strtolower($request->first_name));
        $middleName = ucwords(strtolower($request->middle_name));
        $lastName = ucwords(strtolower($request->last_name));
        $birthday = $request->input('birthday');
        $age = null;

        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }

        $userData = [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'age' => $age,
            'birthday' => $birthday,
            'email' => $request->email,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone' => $request->phone,
        ];

        // Only hash the password if it is provided
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        }

        // Update user data
        $user->update($userData);

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function updatePersonnel(Request $request, $id)
    {
        $personnel = Personnel::findOrFail($id);

        // Validate the request data as needed
        $request->validate([
            'first_name' => 'string|max:255',
            'middle_name' => 'string|max:255', // Corrected typo here
            'last_name' => 'string|max:255',
            'birthday' => 'nullable|date|before_or_equal:today',
            'phone' => [
                'regex:/^(09|\+639)\d{9}$/',
                Rule::unique('personnels')->ignore($personnel->id),
                'string',
            ],
            'address' => 'string|max:255',
            'extra_add' => 'string|max:255',
            'gender' => 'in:male,female,other',
            'email' => [
                'email',
                Rule::unique('personnels')->ignore($personnel->id),
            ],
            'password' => 'nullable|string|min:8',
            'fee' => [
                'numeric', 'between:0,9999.99', 'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'service_cat' => ['string', 'max:255'],
        ]);

        $firstName = ucwords(strtolower($request->first_name));
        $middleName = ucwords(strtolower($request->middle_name));
        $lastName = ucwords(strtolower($request->last_name));
        $birthday = $request->input('birthday');
        $age = null;

        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }
        // Prepare user data for update
        $personnelData = [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'age' => $age,
            'birthday' => $birthday,
            'email' => $request->email,
            'address' => $request->address,
            'extra_add' => $request->extra_add,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'service_cat' => $request->service_cat,
            'fee' => $request->fee,
        ];

        // Only hash the password if it is provided
        if ($request->filled('password')) {
            $personnelData['password'] = bcrypt($request->input('password'));
        }

        // Update user data
        $personnel->update($personnelData);

        return redirect()->back()->with('success', 'User updated successfully!');
    }
}
