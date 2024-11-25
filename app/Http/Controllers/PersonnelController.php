<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CancelP;
use App\Models\Personnel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersonnelController extends Controller
{
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($request->has('accept')) {
            $booking->booking_status = 'Accepted';
        } elseif ($request->has('complete')) {
            $booking->booking_status = 'Completed';

            $serviceDateTime = Carbon::parse($booking->service_date);

            // Check if it's the day of the service_date and the current time is after or equal to the service time
            if (now()->greaterThanOrEqualTo($serviceDateTime)) {
                $startTime = Carbon::parse('8:00');
                $endTime = Carbon::parse('17:00');

                $currentTime = now();

                // Check if the current time is within the acceptable time range (from service time onwards)
                if ($currentTime->greaterThanOrEqualTo($startTime) && $currentTime->lessThanOrEqualTo($endTime)) {
                    $personnel = Personnel::find($booking->personnel_id);

                    if ($personnel) {
                        $newEarning = $personnel->earning + ($booking->fee + $booking->extra_fee);
                        $personnel->update([
                            'earning' => $newEarning,
                            'updated_at_earning' => now(),
                        ]);
                    }
                    $booking->completed_time = now();
                } else {
                    return redirect()->back()->with('error', 'You can only complete the booking on the service date between 8 AM and 5 PM.');
                }
            } else {
                return redirect()->back()->with('error', 'You can only complete the booking on or after the service date.');
            }
        } elseif ($request->has('reject_on_expire')) {
            $booking->booking_status = 'Cancelled';
        }
        $booking->save();

        return redirect()->back()->with('success', 'Booking status updated successfully');
    }

    public function rejectBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Update the booking status and rejection reason
        $booking->update([
            'booking_status' => 'Cancelled',
            'reason' => $request->reason,
            'completed_time' => Carbon::now(), // Assuming you have a column named rejection_reason in your bookings table
        ]);

        // Create a new Cancel record and associate it with the user and personnel
        $cancel = new CancelP([
            'reason' => $request->reason,
            'booking_id' => $booking->id,
            'personnel_id' => $booking->personnel_id, // Assuming personnel_id is associated with the booking
            'user_id' => $booking->user_id,
        ]);

        // Save the new Cancel record
        $cancel->save();

        return redirect()->back()->with('success', 'Booking rejected successfully');
    }

    public function showBooking()
    {
        $personnelId = Auth::guard('personnel')->user()->id;
        $bookings = Booking::with(['user', 'personnel', 'cancels', 'cancelsP'])
            ->where('personnel_id', $personnelId)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($bookings as $booking) {
            if ($booking->booking_status === 'Pending' && now()->gt($booking->service_date)) {
                $booking->booking_status = 'Cancelled';
                $booking->save();
            }
        }

        return view('personnel.booking', compact('bookings'));
    }


    public function showPersonnelBookingPrint()
    {
        $personnelId = Auth::guard('personnel')->user()->id;
        $bookings = Booking::with(['user', 'personnel'])
            ->where('personnel_id', $personnelId)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($bookings as $booking) {
            if ($booking->booking_status === 'Pending' && now()->gt($booking->service_date)) {
                $booking->booking_status = 'Cancelled';
                $booking->save();
            }
        }

        return view('personnel.report.booking', compact('bookings'));
    }

    public function showBookingPrintPersonnelUser()
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $userCount = Booking::with(['user', 'personnel'])
            ->where('personnel_id', $personnelId)->orderBy('created_at', 'desc')

            ->select('user_id', DB::raw('count(*) as booking_count'))
            ->groupBy('user_id')
            ->get();

        return view('personnel.report.user', compact('userCount'));
    }

    public function showPersonnelEarningPrint()
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $personnelBookings = Booking::with(['user'])
            ->where('personnel_id', $personnelId)
            ->where('booking_status', 'Completed')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate total fees and total extra fees
        $totalFee = $personnelBookings->sum('fee');
        $totalExtraFee = $personnelBookings->sum('extra_fee');
        $grandTotal = $totalFee + $totalExtraFee;
        return view('personnel.report.earning', compact('personnelBookings', 'totalFee', 'totalExtraFee', 'grandTotal'));
    }

    public function showUserPrint()
    {
        $personnelId = Auth::guard('personnel')->user()->id;
        $bookings = Booking::with(['user', 'personnel'])
            ->where('personnel_id', $personnelId)->orderBy('created_at', 'desc')

            ->get();

        return view('personnel.booking', compact('bookings'));
    }

    public function showEarningPrint()
    {
        $personnelId = Auth::guard('personnel')->user()->id;
        $bookings = Booking::with(['user', 'personnel'])
            ->where('personnel_id', $personnelId)->orderBy('created_at', 'desc')
            ->get();

        return view('personnel.booking', compact('bookings'));
    }

    public function uploadIdPicture(Request $request)
    {
        $request->validate([
            'id_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Adjust the file type and size as needed
        ]);

        $user = Auth::user();

        if ($request->hasFile('id_picture')) {
            // Store the new profile picture
            $path = $request->file('id_picture')->store('idPicture', 'public');

            // Delete the old profile picture if it exists
            if ($oldPhoto = $user->id_picture) {
                Storage::disk('public')->delete($oldPhoto);
            }

            $user->id_picture = $path;
            $user->save();

            return redirect()->back()->with('success', 'ID picture uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload ID picture.');
    }

    public function uploadNbiClearance(Request $request)
    {
        $request->validate([
            'nbiClearance' => 'required|mimes:jpeg,png,gif|max:10240', // Adjust the file type and size as needed
        ]);
        $user = Auth::user();

        if ($request->hasFile('nbiClearance')) {
            // Store the new profile picture
            $path = $request->file('nbiClearance')->store('nbiClearance', 'public');

            // Delete the old profile picture if it exists
            if ($oldPhoto = $user->nbiClearance) {
                Storage::disk('public')->delete($oldPhoto);
            }

            $user->nbiClearance = $path;
            $user->save();

            return back()->with('success', 'NBI Clearance uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload NBI Clearance.');
    }
}
