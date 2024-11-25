<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Cancel;
use App\Models\Personnel;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function AvailablePersonnel()
    {
        // Fetch verified personnel excluding those with bookings for today
        $personnel = Personnel::where('isVerified', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate average ratings for each available personnel
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

    public function show($id)
    {
        $personnel = Personnel::find($id);
        if (!$personnel) {
            abort(404);
        }
        return view('booking.booking', ['personnel' => $personnel]);
    }

    public function viewPersonnel($id)
    {
        $personnel = Personnel::find($id);
        if (!$personnel) {
            abort(404); // Handle the case where personnel is not found
        }

        return view('auth.view_Personnel', compact('personnel'));
    }

    public function gcashPicture(Request $request, $booking)
    {
        // Validate the form data
        $request->validate([
            'gcash_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the booking by ID
        $booking = Booking::findOrFail($booking);

        // Handle GCash picture upload
        if ($request->hasFile('gcash_picture')) {
            $file = $request->file('gcash_picture');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/gcash_picture'), $filename);

            // Update the gcash_picture field for the specific booking
            $booking->update([
                'gcash_picture' => $filename,
            ]);
        }

        return redirect()->back()->with('success', 'Send Payment Successfully.');
    }

    public function showBookingLists()
    {
        $userId = auth()->id();
        $bookings = Booking::with(['personnel', 'ratings', 'cancelsP', 'cancels'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $averageRatings = [];

        foreach ($bookings as $booking) {
            $personnelId = $booking->personnel->id;
            $personnelBookings = Booking::where('personnel_id', $personnelId)->pluck('id');
            $personnelRatings = Rating::whereIn('booking_id', $personnelBookings)->pluck('rating');

            if ($personnelRatings->count() > 0) {
                $averageRating = $personnelRatings->avg();
                $averageRatings[$personnelId] = number_format($averageRating, 1);
            } else {
                $averageRatings[$personnelId] = 0; // or any default value you prefer
            }
        }

        $bookings->transform(function ($booking) use ($averageRatings) {
            $personnelId = $booking->personnel->id;
            $booking->personnel->averageRating = $averageRatings[$personnelId] ?? 0;
            return $booking;
        });

        return view('booking.submit_booking', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {

        $request->validate([
            'status' => 'required|in:Pending,Cancelled,Accepted,Completed',
        ]);

        $status = ucfirst($request->status); // Capitalize the first letter of the status

        $booking->update(['booking_status' => $status]);

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function cancelBooking(Request $request, $id)
    {
        $booking = Booking::find($id);

        $request->validate([
            'reason' => 'required|string|max:255', // Add validation for reason
        ]);

        $reason = $request->reason;
        $personnelId = $booking->personnel_id; // Retrieve personnel ID from the booking

        $cancel = new Cancel([
            'reason' => $reason,
            'booking_id' => $booking->id,
            'user_id' => auth()->id(), // Assuming you're using Laravel's authentication system
            'personnel_id' => $personnelId, // Associate the personnel ID
        ]);

        // Save the new Cancel record
        $cancel->save();

        // Update booking status
        $booking->update([
            'booking_status' => 'Cancelled',
            'completed_time' => Now(),
        ]);
        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
    public function completeBooking(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Pending,Cancelled,Accepted,Completed',
        ]);

        $status = ucfirst($request->status);
        $booking->update(['booking_status' => $status]);

        return redirect()->back()->with('success', 'Cancel booking successfully.');
    }

    public function acceptBooking(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:Pending,Cancelled,Accepted,Completed',
        ]);

        $status = ucfirst($request->status);
        $booking->update(['booking_status' => $status]);

        return redirect()->back()->with('success', 'Accept booking successfully.');
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::find($id);

        // Validate the form data
        $request->validate([
            'work_details' => 'required|string',
            'picture_details' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'service_date' => 'required|date',
            'payment_method' => 'required',
        ]);

        // Update the booking data
        $booking->work_details = $request->input('work_details');
        $booking->service_date = $request->input('service_date');
        $booking->payment_method = $request->input('payment_method');

        // Handle the image upload if provided
        if ($request->hasFile('picture_details')) {
            $file = $request->file('picture_details');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/booking'), $filename);
            $booking->picture_details = $filename;
        }

        // Save the updated booking
        $booking->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Booking updated successfully.');
    }

    public function personnelDate(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;
        $searchTerm = $request->input('personnelDate');

        // Fetch bookings for the selected date and personnel
        $bookings = Booking::with(['user', 'personnel'])
            ->where('personnel_id', $personnelId)
            ->whereDate('service_date', $searchTerm)
            ->get();

        return view('booking.personnel_booking', compact('bookings'));
    }


    public function addExtraFee(Request $request, $bookingId)
    {
        $request->validate([
            'extra_fee' => ['numeric', 'between:0,99999.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'fee_details' => 'nullable|string|max:255',
        ]);

        $booking = Booking::findOrFail($bookingId);

        // Update booking details with submitted data from the request
        $booking->extra_fee = $request->input('extra_fee');
        $booking->fee_details = $request->input('fee_details');
        $booking->save();

        return redirect()->back()->with('success', 'Extra fee added successfully.');
    }

    public function showReportPrint()
    {
        $userId = auth()->id();
        $bookings = Booking::with(['personnel'])
            ->where('user_id', $userId)->orderBy('created_at', 'desc')

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

    public function showReport()
    {
        $userId = auth()->id();
        $bookings = Booking::with('personnel')
            ->where('user_id', $userId)->orderBy('created_at', 'desc')

            ->get();
        return view('auth.report', compact('bookings'));
    }
}
