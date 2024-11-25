@extends('personnel.personnel_Dashboard')
@section('personnel')

<div class="pt-5 mt-4">
    <div class="container">
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <form method="POST" action="{{ route('personnel.dateForm') }}" class="d-flex me-2">
                @csrf
                <div class="input-group mb-2 mb-md-0">
                    <input type="date" name="personnelDate" id="personnelDate" class="p-2 border rounded-b-4 border-blue-900" placeholder="Search date">
                </div>
                <button type="submit" class="btn btn-primary"><i class='bx bx-search-alt'></i></button>
            </form>
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                Download Report
            </button>
        </div>
    </div>
</div>
<div class="py-2 mt-4">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Booking Lists</h6>
                    <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="color: white;">Name</th>
                                <th class="text-center " style="color: white;">Address</th>
                                <th class="text-center " style="color: white;">Work Details</th>
                                <th class="text-center " style="color: white;">Service Date</th>
                                <th class="text-center " style="color: white;">Payment Method</th>
                                <th class="text-center " style="color: white;">GCash Proof(If there are)</th>
                                <th class="text-center " style="color: white;">Booking Status</th>
                                <th class="text-center " style="color: white;">Booking Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td class="d-flex flex-column">
                                    {{ $booking->user->first_name }} {{ $booking->user->middle_name }} {{ $booking->user->last_name }}
                                    <button class="viewProf mx-auto mt-1" data-bs-toggle="modal" data-bs-target="#profileModal{{ $booking->id }}">View Profile</button>
                                    <div class="modal fade" id="profileModal{{ $booking->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-4" id="staticBackdropLabel">User's Profile</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modalUser d-flex justify-content-around align-items-center">
                                                        <img src="{{ asset("storage/{$booking->user->photo}") }}" alt="User Photo" style="width: 10rem; height: 10rem; object-fit:cover; border-radius: 2%; object-position: center;">
                                                        <div class="d-flex flex-column p-2">
                                                            <h3 class="bookingIns fs-5">Name:</h3>
                                                            <span class="ms-3 mb-1">{{ $booking->user->first_name }} {{ $booking->user->middle_name }} {{ $booking->user->last_name }}</span>
                                                            <h3 class="bookingIns fs-5">Extra Address Information:</h3>
                                                            <span class="ms-3 mb-1">{{ $booking->user->extra_add }}</span>
                                                            <h3 class="bookingIns fs-5">Address:</h3>
                                                            <span class="ms-3 mb-1">{{ $booking->user->address }}, Asingan, Pangasinan</span>
                                                            <h3 class="bookingIns fs-5">Phone Number:</h3>
                                                            <span class="ms-3 mb-1">{{ $booking->user->phone }}</span>
                                                            <h3 class="bookingIns fs-5">Email:</h3>
                                                            <span class="ms-3">{{ $booking->user->email }}</span>
                                                        </div>

                                                    </div>

                                                    <div class=" modal-footer">
                                                        <div>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        <div class="d-flex">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $booking->user->address }}, Asingan, Pangasinan</td>
                                <td class="d-flex flex-column">{{ $booking->work_details }}
                                    <a href="{{ (!empty($booking->picture_details)) ? url('upload/booking/'.$booking->picture_details): url('upload/no_image.jpg') }}" target="_blank" class="pictureLink">
                                        <button class="viewProf mx-auto mt-1">See Image</button>
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->service_date)->format('F j, Y h:i A') }}</td>
                                <td>{{ $booking->payment_method }}</td>
                                <td>
                                    <a href="{{ (!empty($booking->gcash_picture)) ? url('upload/gcash_picture/'.$booking->gcash_picture): url('upload/no_image.jpg') }}" target="_blank" class="pictureLink">
                                        <button class="viewProf mx-auto mt-1">See Image</button>
                                    </a>
                                </td>
                                <td class="text-center whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                    @if($booking->booking_status === 'Pending')
                                    <span class="badge bg-info">Pending</span>
                                    @elseif($booking->booking_status === 'Cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                    @elseif($booking->booking_status === 'Accepted')
                                    <span class="badge bg-warning">Accepted</span>
                                    @elseif($booking->booking_status === 'Completed')
                                    <span class="badge bg-success">Completed</span>
                                    @endif
                                </td>
                                <td class="text-center whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                    @if($booking->booking_status === 'Pending')
                                    <a data-bs-toggle="modal" data-bs-target="#bookingModal{{ $booking->id }}" style="cursor: pointer; pointer-events: auto;">
                                        <button type="button" class="btn btn-primary">Action</button>
                                    </a>
                                    @elseif($booking->booking_status === 'Accepted')
                                    <a data-bs-toggle="modal" data-bs-target="#bookingModal{{ $booking->id }}" style="cursor: pointer; pointer-events: auto;">
                                        <button type="button" class="btn btn-primary">Action</button>
                                    </a>
                                    @else
                                    <a style="cursor: pointer;">
                                        <button type="button" class="btn btn-primary" disabled>Action</button>
                                    </a>
                                    @endif
                                    <div class="modal fade" id="bookingModal{{ $booking->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Booking Information</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="userInfo">
                                                        <h3 class="bookingIns">User's Information</h3>
                                                        <p>Name: {{ $booking->work_details }}</p>
                                                        <p>Extra Information Address: {{ $booking->user->extra_add }}</p>
                                                        <p>Address: {{ $booking->user->address }}, Asingan, Pangasinan</p>
                                                        <p>Phone Number: {{ $booking->user->phone }}</p>
                                                    </div>
                                                    <hr>
                                                    <div class="workInfo">
                                                        <div>
                                                            <h3 class="bookingIns">Work's Details</h3>
                                                            <p>Details: {{ $booking->work_details }}</p>
                                                            <p>Picture: {{ $booking->picture_details }}</p>
                                                            <p>Fee: {{ $booking->fee }}</p>
                                                            <p>Extra Fee: {{ $booking->extra_fee }}</p>
                                                        </div>
                                                        <div>
                                                            @if($booking->booking_status === "Pending")
                                                            <form class="d-flex" method="POST" action="{{ route('personnel.add.extra-fee', ['id' => $booking->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="form-control-groups">
                                                                    <label for="extra_fee" class="form-label text-muted fw-normal">Additional Fee (If there are)</label>
                                                                    <input type="text" class="form-control" name="extra_fee" id="extra_fee">
                                                                    @error('extra_fee')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    <button type="submit" class="btn mx-auto rounded-sm mt-2 btn-primary">Add Extra Fee</button>
                                                                </div>
                                                            </form>
                                                            @else
                                                            <div></div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class=" modal-footer">
                                                        <div>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        <div class="d-flex">
                                                            @if($booking->booking_status === "Pending")
                                                            <form class="d-flex" method="POST" action="{{ route('update.booking.status', ['booking' => $booking->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger me-3 fs-6" name="status" value="Cancelled">Reject</button>
                                                            </form>
                                                            <form method="POST" action="{{ route('accept.booking.status', ['booking' => $booking->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-primary fs-6" name="status" value="Accepted">Accept</button>
                                                            </form>
                                                            @elseif($booking->booking_status === "Accepted")
                                                            <form method="POST" action="{{ route('complete.personnel.status', ['booking' => $booking->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success fs-6" name="status" value="Completed">Complete Booking</button>
                                                            </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection