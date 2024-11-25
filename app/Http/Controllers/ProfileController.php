<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileUpdateRequestPersonnel;
use App\Http\Requests\ProfileUpdateRequestAdmin;
use App\Models\Booking;
use App\Models\Personnel;
use App\Models\Rating;
use App\Models\User;
use App\Models\Municipality;
use App\Models\Barangay;
use App\Models\Province;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function editPersonnel(Request $request): View
    {
        $user = Auth::guard('personnel')->user();

        return view('personnel.profile', [
            'personnel' => $user,
        ]);
    }

    public function editAdmin(Request $request): View
    {
        $user = Auth::guard('admin')->user();

        return view('admin.profile', [
            'admin' => $user,
        ]);
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
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'extra_add' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'service_cat' => ['nullable', 'string', 'max:255'],
            'birthday' => 'nullable|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'extra_add_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => [
                'string',
                'max:255',
                'regex:/^(09|\+639)\d{9}$/',
                Rule::unique('users')->ignore($user->id),
            ],

        ]);

        $birthday = $request->birthday;
        $age = null;
        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }

        if ($request->hasFile('extra_add_picture')) {
            $picturePath = $request->file('extra_add_picture')->store('user_landmark', 'public');

            // Delete the old extra_add_picture if it exists
            if ($oldPicture = $user->extra_add_picture) {
                Storage::disk('public')->delete($oldPicture);
            }

            $user->extra_add_picture = $picturePath;
        }

        $userData = $request->except('extra_add_picture');
        $userData['age'] = $age;
        $user->fill($userData);
        // If email is updated, mark email_verified_at as null for re-verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Profile Updated Successfully');
    }

    public function updatePersonnel(ProfileUpdateRequestPersonnel $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'extra_add' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'service_cat' => ['nullable', 'string', 'max:255'],
            'birthday' => 'nullable|date|before_or_equal:today',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'extra_add_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'fee' => ['nullable', 'numeric', 'min:0'],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('personnels')->ignore($user->id),
            ],
            'phone' => [
                'string',
                'max:255',
                'regex:/^(09|\+639)\d{9}$/',
                Rule::unique('personnels')->ignore($user->id),
            ],

        ]);
        if ($request->hasFile('extra_add_picture')) {
            $picturePath = $request->file('extra_add_picture')->store('personnel_landmark', 'public');

            // Delete the old extra_add_picture if it exists
            if ($oldPicture = $user->extra_add_picture) {
                Storage::disk('public')->delete($oldPicture);
            }

            $user->extra_add_picture = $picturePath;
        }
        $birthday = $request->birthday;
        $age = null;
        if ($birthday) {
            $age = \Carbon\Carbon::parse($birthday)->age;
        }
        // Check if a new profile picture is uploaded
        if ($request->hasFile('photo')) {
            // Store the new profile picture
            $path = $request->file('photo')->store('user_images', 'public');

            // Delete the old profile picture if it exists
            if ($oldPhoto = $user->photo) {
                Storage::disk('public')->delete($oldPhoto);
            }

            $user->photo = $path;
        }

        // Fill the user data except for profile picture

        $userData = $request->except('extra_add_picture', 'photo');
        $userData['age'] = $age;
        $user->fill($userData);
        // If email is updated, mark email_verified_at as null for re-verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('personnel.profile.edit')->with('success', 'Profile Updated Successfully');
    }

    public function updateAdmin(ProfileUpdateRequestAdmin $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'firstname' => ['nullable', 'string', 'max:255'],
            'middlename' => ['nullable', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255'],
            'extra_add' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('admins')->ignore($user->id),
            ],
            'phone' => [
                'string',
                'max:255',
                'regex:/^(09|\+639)\d{9}$/',
                Rule::unique('admins')->ignore($user->id),
            ],

        ]);

        // Check if a new profile picture is uploaded
        if ($request->hasFile('photo')) {
            // Store the new profile picture
            $path = $request->file('photo')->store('user_images', 'public');

            // Delete the old profile picture if it exists
            if ($oldPhoto = $user->photo) {
                Storage::disk('public')->delete($oldPhoto);
            }

            $user->photo = $path;
        }

        // Fill the user data except for profile picture
        $user->fill($request->except('photo'));

        // If email is updated, mark email_verified_at as null for re-verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('success', 'Profile Updated Successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function destroyPersonnel(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function destroyAdmin(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function dashboard()
    {
        $userCount = User::count();
        $personnelCount = Personnel::count();
        $bookingCount = Booking::count();

        return view('admin.dashboard', compact('userCount', 'personnelCount', 'bookingCount'));
    }

    public function dashboardHomeowner()
    {
        // Fetch top-rated 'Cook' personnel
        $topRatedCookPersonnel = Personnel::where('service_cat', 'Cook')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )
            ->orderByDesc('average_rating')
            ->first();
        $topRatedPCGPersonnel = Personnel::where('service_cat', 'Pet Care and Grooming')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $topCarpenter = Personnel::where('service_cat', 'Carpenter')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $topConstruction = Personnel::where('service_cat', 'Construction')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Plumbing = Personnel::where('service_cat', 'Plumbing')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Electrical = Personnel::where('service_cat', 'Electrical')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Gardening = Personnel::where('service_cat', 'Gardening')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Housekeeping = Personnel::where('service_cat', 'Housekeeping')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Laundry = Personnel::where('service_cat', 'Laundry')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Babysitter = Personnel::where('service_cat', 'Babysitter')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Therapy = Personnel::where('service_cat', 'Physical Therapy')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $HMWA = Personnel::where('service_cat', 'Hair & Makeup')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Barber = Personnel::where('service_cat', 'Barber')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Tutor = Personnel::where('service_cat', 'Tutor')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $furniture = Personnel::where('service_cat', 'Furniture Assembly and Repair')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $pest = Personnel::where('service_cat', 'Pest Control')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $appliance = Personnel::where('service_cat', 'Appliance Repair')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Tailor = Personnel::where('service_cat', 'Tailoring and Sewing')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $fitness = Personnel::where('service_cat', 'Fitness Training')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $ManicureandPedicure = Personnel::where('service_cat', 'Manicure and Pedicure')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();

        return view('dashboard', compact('topRatedCookPersonnel', 'topRatedPCGPersonnel', 'topCarpenter', 'topConstruction', 'Plumbing', 'Electrical', 'Gardening', 'Housekeeping', 'Laundry', 'Babysitter', 'Therapy', 'HMWA', 'Barber', 'Tutor', 'furniture', 'pest', 'appliance', 'Tailor', 'fitness', 'ManicureandPedicure'));
    }
    public function homepage()
    {
        // Fetch top-rated 'Cook' personnel
        $topRatedCookPersonnel = Personnel::where('service_cat', 'Cook')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )
            ->orderByDesc('average_rating')
            ->first();
        $topRatedPCGPersonnel = Personnel::where('service_cat', 'Pet Care and Grooming')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $topCarpenter = Personnel::where('service_cat', 'Carpenter')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $topConstruction = Personnel::where('service_cat', 'Construction')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Plumbing = Personnel::where('service_cat', 'Plumbing')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Electrical = Personnel::where('service_cat', 'Electrical')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Gardening = Personnel::where('service_cat', 'Gardening')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Housekeeping = Personnel::where('service_cat', 'Housekeeping')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Laundry = Personnel::where('service_cat', 'Laundry')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Babysitter = Personnel::where('service_cat', 'Babysitter')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Therapy = Personnel::where('service_cat', 'Physical Therapy')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $HMWA = Personnel::where('service_cat', 'Hair & Makeup')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Barber = Personnel::where('service_cat', 'Barber')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Tutor = Personnel::where('service_cat', 'Tutor')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $furniture = Personnel::where('service_cat', 'Furniture Assembly and Repair')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $pest = Personnel::where('service_cat', 'Pest Control')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $appliance = Personnel::where('service_cat', 'Appliance Repair')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $Tailor = Personnel::where('service_cat', 'Tailoring and Sewing')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $fitness = Personnel::where('service_cat', 'Fitness Training')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();
        $ManicureandPedicure = Personnel::where('service_cat', 'Manicure and Pedicure')
            ->join('bookings', 'personnels.id', '=', 'bookings.personnel_id')
            ->join('ratings', 'bookings.id', '=', 'ratings.booking_id')
            ->select(
                'personnels.id',
                'personnels.photo',
                'personnels.first_name',
                'personnels.last_name',
                DB::raw('AVG(ratings.rating) as average_rating')
            )
            ->groupBy(
                'personnels.id',
                'personnels.first_name',
                'personnels.last_name',
                'personnels.photo',
            )->orderByDesc('average_rating')
            ->first();

        return view('welcome', compact('topRatedCookPersonnel', 'topRatedPCGPersonnel', 'topCarpenter', 'topConstruction', 'Plumbing', 'Electrical', 'Gardening', 'Housekeeping', 'Laundry', 'Babysitter', 'Therapy', 'HMWA', 'Barber', 'Tutor', 'furniture', 'pest', 'appliance', 'Tailor', 'fitness', 'ManicureandPedicure'));
    }


    public function dashboardPersonnel()
    {
        $personnelId = Auth::guard('personnel')->user()->id;
        $specificUser = User::where('id', $personnelId)->first();
        $bookings = Booking::with(['user', 'personnel'])
            ->where('personnel_id', $personnelId)
            ->get();

        $dailyEarnings = Booking::select(
            DB::raw('DATE_FORMAT(service_date, "%M %e, %Y") as formatted_date'),
            DB::raw('SUM(COALESCE(fee, 0) + COALESCE(extra_fee, 0)) as daily_earnings')
        )
            ->where('personnel_id', $personnelId)
            ->where('booking_status', 'Completed')
            ->groupBy('formatted_date')
            ->orderBy('formatted_date', 'asc')
            ->get();


        $averageRatings = [];
        $ratingMessages = [];
        $pendingCount = Booking::where('personnel_id', $personnelId)->where('booking_status', 'pending')->count();
        $cancelledCount = Booking::where('personnel_id', $personnelId)->where('booking_status', 'cancelled')->count();
        $acceptedCount = Booking::where('personnel_id', $personnelId)->where('booking_status', 'accepted')->count();
        $completedCount = Booking::where('personnel_id', $personnelId)->where('booking_status', 'completed')->count();
        if ($specificUser) {
            $personnelBookings = Booking::where('user_id', $specificUser->id)->pluck('id');
            $personnelRatings = Rating::whereIn('booking_id', $personnelBookings)->get();

            if ($personnelRatings->count() > 0) {
                $averageRating = $personnelRatings->avg('rating');
                $averageRating = number_format($averageRating, 1);

                $ratingMessages = $personnelRatings->pluck('rating_message')->implode(', ');
            }
        }
        return view('personnel.dashboard', compact('specificUser', 'averageRatings', 'ratingMessages', 'pendingCount', 'cancelledCount', 'acceptedCount', 'completedCount', 'bookings', 'dailyEarnings'));
    }
}
