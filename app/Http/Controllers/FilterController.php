<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Personnel;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filterPersonnel(Request $request)
    {
        $ratingFilter = $request->input('rating');
        $dateFilter = $request->input('selected_date');

        $query = Personnel::query();

        if ($ratingFilter) {
            $rating = (float)$ratingFilter;
            $lowerRating = $rating - 0.9;
            $upperRating = $rating;

            $personnelIdsWithAverageRating = Rating::join('bookings', 'ratings.booking_id', '=', 'bookings.id')
                ->selectRaw('AVG(ratings.rating) as avg_rating, bookings.personnel_id')
                ->groupBy('bookings.personnel_id')
                ->havingRaw('AVG(ratings.rating) BETWEEN ? AND ?', [$lowerRating, $upperRating])
                ->pluck('bookings.personnel_id')
                ->toArray();

            $query->whereIn('id', $personnelIdsWithAverageRating);
        }

        if ($dateFilter) {
            $query->whereHas('bookings', function ($q) use ($dateFilter) {
                $q->whereDate('service_date', $dateFilter);
            });
        }

        $personnel = $query->get();

        $averageRatings = [];
        foreach ($personnel as $person) {
            $personnelBookings = Booking::where('personnel_id', $person->id)->pluck('id');
            $personnelRatings = Rating::whereIn('booking_id', $personnelBookings)->pluck('rating');

            if ($personnelRatings->count() > 0) {
                $averageRating = $personnelRatings->avg();
                $averageRatings[$person->id] = number_format($averageRating, 1);
            } else {
                $averageRatings[$person->id] = 0; // or any default value you prefer
            }
        }

        return view('available.available', compact('personnel', 'averageRatings'));
    }


    public function searchPersonnel(Request $request)
    {
        $query = Personnel::query();

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('phone', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                    ->orWhere('description', 'LIKE', "%$searchTerm%")
                    ->orWhere('address', 'LIKE', "%$searchTerm%");
            });
        }
        $personnel = $query->get();

        $averageRatings = [];
        foreach ($personnel as $person) {
            $personnelBookings = Booking::where('personnel_id', $person->id)->pluck('id');
            $personnelRatings = Rating::whereIn('booking_id', $personnelBookings)->pluck('rating');

            if ($personnelRatings->count() > 0) {
                $averageRating = $personnelRatings->avg();
                $averageRatings[$person->id] = number_format($averageRating, 1);
            } else {
                $averageRatings[$person->id] = 0; // or any default value you prefer
            }
        }
        return view('available.available', compact('personnel', 'averageRatings'));
    }

    public function searchUserAdmin(Request $request)
    {
        $query = User::query();

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('phone', 'LIKE', "%$searchTerm%")
                    ->orWhere('email', 'LIKE', "%$searchTerm%")
                    ->orWhere('age', 'LIKE', "%$searchTerm%")
                    ->orWhere('isVerified', 'LIKE', "%$searchTerm%")
                    ->orWhere('gender', 'LIKE', "%$searchTerm%")
                    ->orWhere('address', 'LIKE', "%$searchTerm%");
            });
        }
        $user = $query->get();
        return view('admin.body.user', compact('user'));
    }

    public function searchUserAdminPrint(Request $request)
    {
        $query = User::query();

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('phone', 'LIKE', "%$searchTerm%")
                    ->orWhere('email', 'LIKE', "%$searchTerm%")
                    ->orWhere('age', 'LIKE', "%$searchTerm%")
                    ->orWhere('isVerified', 'LIKE', "%$searchTerm%")
                    ->orWhere('gender', 'LIKE', "%$searchTerm%")
                    ->orWhere('address', 'LIKE', "%$searchTerm%");
            });
        }
        $user = $query->get();
        return view('admin.report.userPrint', compact('user'));
    }

    public function searchPersonnelAdminPrint(Request $request)
    {
        $query = Personnel::query();

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('phone', 'LIKE', "%$searchTerm%")
                    ->orWhere('email', 'LIKE', "%$searchTerm%")
                    ->orWhere('age', 'LIKE', "%$searchTerm%")
                    ->orWhere('isVerified', 'LIKE', "%$searchTerm%")
                    ->orWhere('gender', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                    ->orWhere('description', 'LIKE', "%$searchTerm%")
                    ->orWhere('address', 'LIKE', "%$searchTerm%");
            });
        }
        $personnel = $query->get();
        return view('admin.report.personnelPrint', compact('personnel'));
    }

    public function searchPersonnelAdmin(Request $request)
    {
        $query = Personnel::query();

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('phone', 'LIKE', "%$searchTerm%")
                    ->orWhere('email', 'LIKE', "%$searchTerm%")
                    ->orWhere('age', 'LIKE', "%$searchTerm%")
                    ->orWhere('isVerified', 'LIKE', "%$searchTerm%")
                    ->orWhere('gender', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                    ->orWhere('description', 'LIKE', "%$searchTerm%")
                    ->orWhere('address', 'LIKE', "%$searchTerm%");
            });
        }
        $personnel = $query->get();
        return view('admin.body.personnel', compact('personnel'));
    }

    public function searchBookingUserReport(Request $request)
    {
        $userId = auth()->user()->id; // Assuming you're using Laravel's authentication and the user ID is retrievable this way

        $query = Booking::where('user_id', $userId);

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('personnel_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                // Include search on related 'personnel' model
                $q->orWhereHas('personnel', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                        ->orWhere('phone', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $bookings = $query->get();
        return view('auth.report', compact('bookings'));
    }

    public function searchBookingCountReport(Request $request)
    {
        $userId = auth()->user()->id; // Assuming you're using Laravel's authentication and the user ID is retrievable this way

        $query = Booking::where('user_id', $userId);

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('personnel_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                // Include search on related 'personnel' model
                $q->orWhereHas('personnel', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                        ->orWhere('phone', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $bookings = $query->get();
        return view('auth.reportCount', compact('bookings'));
    }

    public function searchBookingPersonnels(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $query = Booking::where('personnel_id', $personnelId);

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('user_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                // Include search on related 'personnel' model
                $q->orWhereHas('user', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%")
                        ->orWhere('phone', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $bookings = $query->get();
        return view('personnel.report.booking', compact('bookings'));
    }

    public function searchBookingPersonnel(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $query = Booking::where('personnel_id', $personnelId);

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('user_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                // Include search on related 'personnel' model
                $q->orWhereHas('user', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%")
                        ->orWhere('phone', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $bookings = $query->get();
        return view('personnel.booking', compact('bookings'));
    }

    public function searchBookingPersonnelPrint(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $query = Booking::where('personnel_id', $personnelId)
            ->where('booking_status', 'Completed');

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('user_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                // Include search on related 'personnel' model
                $q->orWhereHas('user', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%")
                        ->orWhere('phone', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $personnelBookings = $query->get();
        $totalFee = $personnelBookings->where('booking_status', 'Completed')->sum('fee');
        $totalExtraFee = $personnelBookings->where('booking_status', 'Completed')->sum('extra_fee');
        $grandTotal = $totalFee + $totalExtraFee;
        return view('personnel.report.earning', compact('personnelBookings', 'totalFee', 'totalExtraFee', 'grandTotal'));
    }

    public function searchBookingAdminPrint(Request $request)
    {
        $query = Booking::query();

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('user_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                $q->orWhereHas('personnel', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                        ->orWhere('description', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('email', 'LIKE', "%$searchTerm%")
                        ->orWhere('age', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%");
                });

                $q->orWhereHas('user', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('email', 'LIKE', "%$searchTerm%")
                        ->orWhere('age', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $bookings = $query->get();
        return view('admin.report.bookingPrint', compact('bookings'));
    }

    public function searchBookingAdmin(Request $request)
    {

        $query = Booking::query();

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('user_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                $q->orWhereHas('personnel', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                        ->orWhere('description', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('email', 'LIKE', "%$searchTerm%")
                        ->orWhere('age', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%");
                });

                $q->orWhereHas('user', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('email', 'LIKE', "%$searchTerm%")
                        ->orWhere('age', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $bookings = $query->get();
        return view('admin.body.booking', compact('bookings'));
    }
    public function searchBooking(Request $request)
    {
        $userId = auth()->user()->id; // Assuming you're using Laravel's authentication and the user ID is retrievable this way

        $query = Booking::where('user_id', $userId);

        if ($request->has('searchBorrow')) {
            $searchTerm = $request->input('searchBorrow');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('personnel_id', 'LIKE', "%$searchTerm%")
                    ->orWhere('work_details', 'LIKE', "%$searchTerm%")
                    ->orWhere('service_date', 'LIKE', "%$searchTerm%")
                    ->orWhere('fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('extra_fee', 'LIKE', "%$searchTerm%")
                    ->orWhere('payment_method', 'LIKE', "%$searchTerm%")
                    ->orWhere('booking_status', 'LIKE', "%$searchTerm%");

                // Include search on related 'personnel' model
                $q->orWhereHas('personnel', function ($q) use ($searchTerm) {
                    $q->where('first_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('middle_name', 'LIKE', "%$searchTerm%")
                        ->orWhere('service_cat', 'LIKE', "%$searchTerm%")
                        ->orWhere('description', 'LIKE', "%$searchTerm%")
                        ->orWhere('address', 'LIKE', "%$searchTerm%")
                        ->orWhere('extra_add', 'LIKE', "%$searchTerm%")
                        ->orWhere('last_name', 'LIKE', "%$searchTerm%");
                });
            });
        }

        $bookings = $query->get();
        return view('booking.submit_booking', compact('bookings'));
    }
    public function filterBookingPersonnels(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $dateFilter = $request->input('selected_date');
        $query = Booking::where('personnel_id', $personnelId); // Assuming 'user_id' is the column name

        if ($dateFilter) {
            $searchTerm = $request->input('selected_date');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereDate('service_date', '=', $searchTerm);
            });
        }

        $bookings = $query->get();
        return view('personnel.report.booking', compact('bookings'));
    }
    public function filterBookingPersonnel(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $dateFilter = $request->input('selected_date');
        $query = Booking::where('personnel_id', $personnelId); // Assuming 'user_id' is the column name

        if ($dateFilter) {
            $searchTerm = $request->input('selected_date');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereDate('service_date', '=', $searchTerm);
            });
        }

        $bookings = $query->get();
        return view('personnel.booking', compact('bookings'));
    }
    public function filterBookingPersonnelPrint(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $dateFilter = $request->input('selected_date');
        $query = Booking::where('personnel_id', $personnelId); // Assuming 'user_id' is the column name

        if ($dateFilter) {
            $query->whereDate('service_date', '=', $dateFilter);
        }

        // Filtering completed bookings
        $query->where('booking_status', 'Completed');

        $personnelBookings = $query->get();

        // Calculate total fees and total extra fees
        $totalFee = $personnelBookings->sum('fee');
        $totalExtraFee = $personnelBookings->sum('extra_fee');
        $grandTotal = $totalFee + $totalExtraFee;
        return view('personnel.report.earning', compact('personnelBookings', 'totalFee', 'totalExtraFee', 'grandTotal'));
    }
    public function filterBooking(Request $request)
    {
        $userId = auth()->user()->id;

        $dateFilter = $request->input('selected_date');
        $query = Booking::where('user_id', $userId);

        if ($dateFilter) {
            $searchTerm = $request->input('selected_date');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereDate('service_date', '=', $searchTerm);
            });
        }

        $bookings = $query->get();
        return view('booking.submit_booking', compact('bookings'));
    }
    public function filterBookingAdmin(Request $request)
    {
        $dateFilter = $request->input('selected_date');
        $query = Booking::query();

        if ($dateFilter) {
            $searchTerm = $request->input('selected_date');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereDate('service_date', '=', $searchTerm);
            });
        }

        $bookings = $query->get();
        return view('admin.body.booking', compact('bookings'));
    }
    public function filterBookingAdminPrint(Request $request)
    {
        $dateFilter = $request->input('selected_date');
        $query = Booking::query();

        if ($dateFilter) {
            $searchTerm = $request->input('selected_date');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereDate('service_date', '=', $searchTerm);
            });
        }

        $bookings = $query->get();
        return view('admin.report.bookingPrint', compact('bookings'));
    }
    public function filterBookingCountReport(Request $request)
    {
        $userId = auth()->user()->id;
        $serviceCatFilter = $request->input('service_cat');
        $dateFilter = $request->input('selected_date');

        $query = Booking::where('user_id', $userId);

        if ($dateFilter) {
            $query->whereDate('service_date', '=', $dateFilter);
        }

        if ($serviceCatFilter) {
            $query->whereHas('personnel', function ($q) use ($serviceCatFilter) {
                $q->where('service_cat', $serviceCatFilter);
            });
        }

        $bookings = $query->with('personnel')
            ->select(
                'personnel_id',
                DB::raw('count(*) as booking_count'),
                DB::raw('SUM(fee) as total_fee'),
                DB::raw('SUM(extra_fee) as total_extra_fee')
            )
            ->groupBy('personnel_id')
            ->get();

        $totalFee = $bookings->sum('total_fee');
        $totalExtraFee = $bookings->sum('total_extra_fee');
        $totalBooking = $bookings->sum('booking_count');

        return view('auth.reportCount', compact('bookings', 'totalFee', 'totalExtraFee', 'totalBooking'));
    }

    public function filterBookingUserReport(Request $request)
    {
        $userId = auth()->user()->id;

        $serviceCatFilter = $request->input('service_cat');
        $dateFilter = $request->input('selected_date');
        $query = Booking::where('user_id', $userId); // Assuming 'user_id' is the column name

        if ($dateFilter) {
            $searchTerm = $request->input('selected_date');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereDate('service_date', '=', $searchTerm);
            });
        }

        if ($serviceCatFilter) {
            $query->whereHas('personnel', function ($q) use ($serviceCatFilter) {
                $q->where('service_cat', $serviceCatFilter);
            });
        }

        $bookings = $query->get();
        return view('auth.report', compact('bookings'));
    }
}
