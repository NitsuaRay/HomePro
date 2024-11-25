<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function saveRating(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'rating_message' => 'nullable|string|max:255',
            'bookingId' => 'required|exists:bookings,id', // Ensure that the booking ID exists in the bookings table
        ]);

        $bookingId = $request->input('bookingId');

        // Check if the user has already rated this booking
        $existingRating = Rating::where('booking_id', $bookingId)->first();

        if ($existingRating) {
            return redirect()->back()->with('error', 'You have already rated this booking.');
        }

        // Create a new Rating record and associate it with the Booking
        $rating = Rating::create([
            'booking_id' => $bookingId,
            'rating' => $request->input('rating'),
            'rating_message' => $request->input('rating_message'),
        ]);

        return redirect()->back()->with('success', 'Rated Successfully.');
    }
}
