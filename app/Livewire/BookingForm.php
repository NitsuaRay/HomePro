<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Personnel;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class BookingForm extends Component
{
    use WithFileUploads;

    public $personnelId;
    public $workDetails;
    public $pictureDetails = []; // For multiple file uploads
    public $serviceDate;
    public $paymentMethod;
    public $personnel;

    public function mount($id)
    {
        $this->personnelId = $id;
        $this->personnel = Personnel::find($id);
        if (!$this->personnel) {
            abort(404);
        }
    }

    public function store()
    {
        $validatedData = $this->validate([
            'workDetails' => 'required|string',
            'pictureDetails.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'serviceDate' => [
                'required',
                'date_format:Y-m-d\TH:i', // Adjust the format to match the HTML input
                'after_or_equal:now',
            ],
            'paymentMethod' => 'required',
        ]);

        $startTime = Carbon::createFromTime(8, 0, 0)->format('H:i'); // 8 AM
        $endTime = Carbon::createFromTime(17, 0, 0)->format('H:i'); // 5 PM

        $serviceTime = Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['serviceDate'])->format('H:i');

        if ($serviceTime < $startTime || $serviceTime >= $endTime) {
            $this->addError('serviceDate', 'You can only book personnel between 8 AM and 5 PM.');
            return;
        }

        $user_id = Auth::id();
        $personnelId = $this->personnelId;
        $serviceDate = Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['serviceDate']);

        $existingBooking = Booking::where('personnel_id', $personnelId)
            ->whereDate('service_date', $serviceDate->toDateString())
            ->orderBy('service_date', 'desc')
            ->first();

        if ($existingBooking) {
            if ($existingBooking->completed_time !== null) {
                $endTimeLastBooking = Carbon::parse($existingBooking->completed_time)->format('H:i'); // Completed time of the previous booking
                $endTimeLastBookingCarbon = Carbon::createFromFormat('H:i', $endTimeLastBooking);

                if ($endTimeLastBookingCarbon->lessThan($endTime)) {
                    $startTime = $endTimeLastBookingCarbon->format('H:i');
                }
            } else {
                // Booking in progress or not completed yet
                $this->addError('serviceDate', 'The personnel have an ongoing booking for this day.');
                return;
            }
        }

        $personnel = Personnel::find($personnelId);

        if (!$personnel) {
            abort(404); // or handle the error appropriately
        }

        $filenames = [];
        foreach ($this->pictureDetails as $file) {
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->storeAs('bookings', $filename, 'public');
            $filenames[] = $filename; // Store the filenames in an array
        }

        $totalFee = $personnel->fee;

        Booking::create([
            'work_details' => $validatedData['workDetails'],
            'picture_details' => json_encode($filenames),
            'service_date' => $serviceDate,
            'payment_method' => $validatedData['paymentMethod'],
            'personnel_id' => $personnelId,
            'user_id' => $user_id,
            'fee' => $totalFee,
        ]);

        session()->flash('success', 'Booking request sent successfully!');
        return redirect()->route('submit.booking');
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}
