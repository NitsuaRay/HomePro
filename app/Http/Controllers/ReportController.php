<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ReportController extends Controller
{

    public function generatePDFPersonnel(Request $request)
    {
        $selectedBookingIds = $request->input('selected_booking_id');

        $personnel = Personnel::whereIn('id', $selectedBookingIds)->orderBy('created_at', 'desc')->get(); // Retrieve selected items

        $html = View::make('pdf.personnel', compact('personnel'))->render();

        $pdf = PDF::loadHTML($html);

        // Set paper size to A4
        $pdf->setPaper('a4');

        return $pdf->download('PersonnelReport.pdf');
    }

    public function generatePDFAllPersonnel(Request $request)
    {
        $selectedItemIds = $request->input('barCheckAll', []); // Retrieve all item IDs

        $personnel = Personnel::whereIn('id', $selectedItemIds)->orderBy('created_at', 'desc')->get(); // Retrieve selected items

        $html = view('pdf.personnel', compact('personnel'))->render();

        $pdf = PDF::loadHTML($html);

        // Set paper size to A4
        $pdf->setPaper('a4');

        return $pdf->download('PersonnelReportAll.pdf');
    }
    public function generatePDFBooking(Request $request)
    {
        $selectedBookingIds = $request->input('selected_booking_id');

        $booking = Booking::whereIn('id', $selectedBookingIds)->orderBy('created_at', 'desc')->get(); // Retrieve selected items

        $html = View::make('pdf.booking', compact('booking'))->render();

        $pdf = PDF::loadHTML($html);

        // Set paper size to A4
        $pdf->setPaper('a4');

        return $pdf->download('BookingReport.pdf');
    }

    public function generatePDFAllBooking(Request $request)
    {
        $selectedItemIds = $request->input('barCheckAll', []); // Retrieve all item IDs

        $booking = Booking::whereIn('id', $selectedItemIds)->orderBy('created_at', 'desc')->get(); // Retrieve selected items

        $html = view('pdf.booking', compact('booking'))->render();

        $pdf = PDF::loadHTML($html);

        // Set paper size to A4
        $pdf->setPaper('a4');

        return $pdf->download('BookingReportAll.pdf');
    }
    public function generatePDFBookingPersonnelEarning(Request $request)
    {
        $personnelId = Auth::guard('personnel')->user()->id;

        $selectedBookingIds = $request->input('selected_booking_id');

        if (!$selectedBookingIds || count($selectedBookingIds) === 0) {
            return redirect()->back()->with('error', 'No items selected for the report.');
        }

        $personnelBookings = Booking::with(['user'])
            ->whereIn('id', $selectedBookingIds)
            ->where('personnel_id', $personnelId)
            ->where('booking_status', 'Completed')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($personnelBookings->isEmpty()) {
            return redirect()->back()->with('error', 'No bookings found for the selected items.');
        }

        $totalFee = $personnelBookings->sum('fee');
        $totalExtraFee = $personnelBookings->sum('extra_fee');
        $grandTotal = $totalFee + $totalExtraFee;

        $html = View::make('pdf.earning', compact('personnelBookings', 'totalFee', 'totalExtraFee', 'grandTotal'))->render();
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('a4');

        return $pdf->download('BookingReportPersonnelEarning.pdf');
    }

    public function generateUserReport($id)
    {
        $booking = Booking::find($id);
        $pdf = new Dompdf();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        $html = View::make('pdf.ubooking', compact('booking'))->render();
        $pdf = PDF::loadHTML($html);

        $pdf->setPaper(array(0, 0, 595, 350));

        return $pdf->download('BookingReport.pdf');
    }

    public function generatePDFUser(Request $request)
    {
        $selectedBookingIds = $request->input('selected_booking_id');

        $user = User::whereIn('id', $selectedBookingIds)->orderBy('created_at', 'desc')->get(); // Retrieve selected items

        $html = View::make('pdf.user', compact('user'))->render();

        $pdf = PDF::loadHTML($html);

        // Set paper size to A4
        $pdf->setPaper('a4');

        return $pdf->download('UserReport.pdf');
    }

    public function generatePDFBookingPersonnel(Request $request)
    {
        $selectedBookingIds = $request->input('selected_booking_id');

        if ($selectedBookingIds && count($selectedBookingIds) > 0) {
            $booking = Booking::whereIn('id', $selectedBookingIds)->get();

            if ($booking && $booking->count() > 0) {
                $html = View::make('pdf.pbookingAll', compact('booking'))->render();

                $pdf = PDF::loadHTML($html);
                $pdf->setPaper('a4');

                return $pdf->stream("BookingReportAllPersonnel.pdf");
            } else {
                return redirect()->back()->with('error', 'No bookings found for the selected IDs.');
            }
        } else {
            return redirect()->back()->with('error', 'No booking selected.');
        }
    }
}
