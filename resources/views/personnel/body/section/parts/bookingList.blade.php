<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    @if (Session::has('success'))
        <div id="toast-success"
            class="absolute top-10 right-0 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session::get('success') }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div id="toast-error"
            class="absolute top-10 right-0 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session::get('error') }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-error" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    @include('personnelModal.searhFilter')
    <div class="overflow-x-auto mt-3">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-3 text-center">
                        Name
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        Address
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        Work Details
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        Service Date
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        Payment Method
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        Booking Status
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        Fee
                    </th>
                    <th scope="col" class="px-3 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($bookings as $index => $booking)
                    <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }} border-b">
                        <td class="px-2 py-2">
                            {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                            <button class="flex items-center justify-around w-24 underline text-blue-900 font-medium"
                                type="button" data-modal-target="personnel-modal-{{ $booking->id }}"
                                data-modal-toggle="personnel-modal-{{ $booking->id }}">
                                View Details
                            </button>

                            <!-- Main modal -->
                            <div id="personnel-modal-{{ $booking->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-2 md:p-3 border-b rounded-t bg-blue-900">
                                            <h3 class="text-lg font-semibold text-white dark:text-white">
                                                {{ $booking->user->first_name }}'s Details
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="personnel-modal-{{ $booking->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="flex items-center justify-center">
                                                    @if (!empty($booking->user->photo))
                                                        <img src="{{ asset('storage/' . $booking->user->photo) }}"
                                                            class="h-auto w-auto">
                                                    @else
                                                        <img src="{{ asset('backend/assets/images/logo.png') }}"
                                                            alt="Default Pic" class="h-auto w-auto">
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="flex flex-col">
                                                        <p class="font-bold">Name:</p>
                                                        <p class="px-2">{{ $booking->user->first_name }}
                                                            {{ $booking->user->middle_name }}
                                                            {{ $booking->user->last_name }}</p>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <p class="font-bold">Age:</p>
                                                        <p class="px-2">{{ $booking->user->age }}</p>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <p class="font-bold">Email:</p>
                                                        <p class="px-2">{{ $booking->user->email }}</p>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <p class="font-bold">Phone Number:</p>
                                                        <p class="px-2">{{ $booking->user->phone }}</p>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <p class="font-bold">Address:</p>
                                                        <p class="px-2">{{ $booking->user->address }}</p>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <p class="font-bold">Extra Address:</p>
                                                        <p class="px-2">{{ $booking->user->extra_add }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-2">
                            {{ $booking->user->address }} <br>
                            {{ $booking->user->extra_add }}
                            <button data-modal-target="address_landmark-modal-{{ $index }}"
                                data-modal-toggle="address_landmark-modal-{{ $index }}"
                                class="block text-blue-900 underline font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                type="button">
                                See Landmark
                            </button>

                            <!-- Main modal -->
                            <div id="address_landmark-modal-{{ $index }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Landmark/Location
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="address_landmark-modal-{{ $index }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 overflow-x-auto">
                                            @if (!empty($booking->user->extra_add_picture))
                                                <a href="{{ asset('storage/' . $booking->user->extra_add_picture) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $booking->user->extra_add_picture) }}"
                                                        class="h-auto w-auto">
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-2">
                            {{ $booking->work_details }} <br>
                            <button data-modal-target="picture_details-modal-{{ $index }}"
                                data-modal-toggle="picture_details-modal-{{ $index }}"
                                class="block text-blue-900 underline font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                type="button">
                                See Pictures
                            </button>
                            <!-- Main modal -->
                            <div id="picture_details-modal-{{ $index }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Work Pictures
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="picture_details-modal-{{ $index }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 overflow-x-auto flex flex-wrap">
                                            <div class="w-full md:w-1/3 p-2">
                                                @if (!empty($booking->picture_details))
                                                    @foreach (json_decode($booking->picture_details) as $image)
                                                        <img src="{{ asset('storage/bookings/' . $image) }}"
                                                            class="h-auto w-auto">
                                                    @endforeach
                                                @else
                                                    No images available.
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-2 py-2">
                            {{ \Carbon\Carbon::parse($booking->service_date)->format('F d, Y h:i A') }}
                        </td>
                        <td class="px-2 py-2">
                            {{ $booking->payment_method }}

                            @if ($booking->payment_method === 'GCash')
                                <p>
                                    Proof: <br>
                                    <a href="{{ !empty($booking->gcash_picture) ? url('upload/gcash_picture/' . $booking->gcash_picture) : url('upload/no_image.jpg') }}"
                                        target="_blank" class="underline">
                                        See Image
                                    </a>
                                </p>
                            @endif

                        </td>
                        <td class="px-2 py-2">
                            @if ($booking->booking_status === 'Pending')
                                <button
                                    class="flex items-center justify-around w-24 bg-yellow-500 text-white font-medium px-2 rounded"
                                    disabled> Pending</button>
                            @elseif($booking->booking_status === 'Cancelled')
                                <button
                                    class="flex items-center justify-around w-24 bg-red-500 text-white font-medium px-2 rounded"
                                    disabled> Cancelled</button>
                            @elseif($booking->booking_status === 'Accepted')
                                <button
                                    class="flex items-center justify-around w-24 bg-blue-900 text-white font-medium px-2 rounded"
                                    disabled> Accepted</button>
                            @elseif($booking->booking_status === 'Completed')
                                <button
                                    class="flex items-center justify-around w-24 bg-green-500 text-white font-medium px-2 rounded hover:bg-green-900"
                                    disabled>Completed</button>
                            @endif
                        </td>
                        <td class="px-2 py-2">
                            {{ $booking->fee }} <br>
                            {{ $booking->extra_fee }}
                        </td>
                        <td class="px-2 py-2">
                            <div class=" flex items-center justify-around flex-col">
                                @if ($booking->booking_status === 'Completed')
                                    <button
                                        class="flex items-center justify-around w-24 bg-green-500 text-white font-medium px-2 rounded">Completed</button>
                                @elseif($booking->booking_status === 'Cancelled')
                                    <button
                                        class="flex items-center justify-around w-24 bg-red-500 text-white font-medium px-2 rounded"
                                        disabled> Cancelled</button>
                                    @foreach ($booking->cancels as $cancel)
                                        <p>by {{ $booking->user->first_name }} {{ $booking->user->last_name }}</p>
                                        <p class="mx-auto text-center mt-2 font-medium">Reason for cancellation: <br>
                                            {{ $cancel->reason }}
                                        </p>
                                    @endforeach
                                    @foreach ($booking->cancelsP as $cancel)
                                        <p>by {{ $booking->personnel->first_name }}
                                            {{ $booking->personnel->last_name }}</p>
                                        <p class="mx-auto text-center mt-2 font-medium">Reason for cancellation: <br>
                                            {{ $cancel->reason }}
                                        </p>
                                    @endforeach
                                @else
                                    <button
                                        class="flex items-center justify-around w-24 bg-blue-900 text-white font-medium px-2 rounded hover:bg-blue-500"
                                        type="button" data-modal-target="action-modal-{{ $booking->id }}"
                                        data-modal-toggle="action-modal-{{ $booking->id }}">
                                        Action
                                    </button>

                                    <div id="action-modal-{{ $booking->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-2 md:p-3 border-b rounded-t bg-blue-900">
                                                    <h3 class="text-lg font-semibold text-white dark:text-white">
                                                        Booking Action
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="action-modal-{{ $booking->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>

                                                <div class="flex gap-2 p-2 md:p-3 border-b rounded-t flex-col">
                                                    @if ($booking->booking_status === 'Pending' && is_null($booking->extra_fee))
                                                        <form
                                                            action="{{ route('bookings.extra-fee', ['bookingId' => $booking->id]) }}"
                                                            method="POST" class="block">
                                                            @csrf
                                                            <div class="div">
                                                                <label for="extra_fee"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Extra
                                                                    Fee</label>
                                                                <input type="text" name="extra_fee" id="extra_fee"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                @error('extra_fee')
                                                                    <span
                                                                        class=" text-red-500 text-sm">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="mt-1">
                                                                <label for="fee_details"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Extra
                                                                    Fee Details</label>
                                                                <textarea type="text" rows="4" name="fee_details" id="fee_details"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                                    placeholder="Extra fee details..."></textarea>
                                                                @error('fee_details')
                                                                    <span
                                                                        class=" text-red-500 text-sm">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <button
                                                                class="w-36 bg-blue-900 text-white font-medium px-2 rounded hover:bg-blue-500 mt-3"
                                                                type="submit">Add Extra Fee</button>
                                                        </form>
                                                    @endif
                                                    <div>
                                                        <form
                                                            action="{{ route('bookings.update-status', ['id' => $booking->id]) }}"
                                                            method="POST" class="flex justify-end gap-2">
                                                            @csrf
                                                            @if ($booking->booking_status === 'Pending' && now()->gt($booking->service_date))
                                                                <input type="hidden" name="reject_on_expire"
                                                                    value="true">
                                                            @else
                                                                @if ($booking->booking_status === 'Pending')
                                                                    <button
                                                                        class="flex items-center justify-around w-24 bg-blue-900 text-white font-medium px-2 rounded hover:bg-blue-500"
                                                                        type="submit" name="accept"> Accept</button>

                                                                    <button
                                                                        class="flex items-center justify-around w-24 bg-red-500 text-white font-medium px-2 rounded hover:bg-red-900 reject-btn"
                                                                        data-modal-target="popup-modal-{{ $booking->id }}"
                                                                        data-modal-toggle="popup-modal-{{ $booking->id }}"
                                                                        type="button" type="button"> Reject</button>
                                                                @elseif($booking->booking_status === 'Accepted')
                                                                    <button
                                                                        class="flex items-center justify-around w-24 bg-green-500 text-white font-medium px-2 rounded hover:bg-green-900"
                                                                        type="submit" name="complete">
                                                                        Complete</button>
                                                                @endif
                                                            @endif
                                                        </form>
                                                        @include('authModal.cancelP')

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Get the header checkbox and all table row checkboxes
    const checkboxAll = document.getElementById('checkbox-all');
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');

    // Add an event listener to the header checkbox
    checkboxAll.addEventListener('change', function() {
        // Loop through all checkboxes in the table rows and set their checked property
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkboxAll.checked;
        });
    });

    // Add an event listener to each table row checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Check if all checkboxes in the table rows are checked and update the header checkbox accordingly
            let allChecked = true;
            checkboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });
            checkboxAll.checked = allChecked;
        });
    });
</script>
