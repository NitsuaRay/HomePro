<div class="sm:ml-64">
    @include('admin.partials.nav')
    <div class="max-w-7xl mx-auto px-2 mt-2">
        @if(Session::has('success'))
        <div id="toast-success" class="absolute top-10 right-0 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session::get('success') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif
        @if(Session::has('error'))
        <div id="toast-error" class="absolute top-10 right-0 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session::get('error') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-error" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
            <div class="flex justify-between items-center">
                @include('adminModal.searhFilterBooking')
            </div>
            <div class="overflow-x-auto mt-2">
                <form id="printForm" action="{{ route('generate.pdfBooking') }}" method="POST" target="_blank">
                    @csrf
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Homeowner
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Service Personnel
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Work Details
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Service Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Payment Method
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Booking Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fee
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $index => $booking)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }} border-b">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input name="selected_booking_id[]" value="{{ $booking->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->personnel->first_name }} {{ $booking->user->last_name }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->user->address }}
                                    <button data-modal-target="address_landmark-modal-{{$index}}" data-modal-toggle="address_landmark-modal-{{$index}}" class="block text-blue-900 underline font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                        See Landmark
                                    </button>

                                    <!-- Main modal -->
                                    <div id="address_landmark-modal-{{$index}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Landmark/Location
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="address_landmark-modal-{{$index}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 overflow-x-auto">
                                                    @if (!empty($booking->user->extra_add_picture))
                                                    <a href="{{ asset('storage/' . $booking->user->extra_add_picture) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $booking->user->extra_add_picture) }}" class="h-auto w-auto">
                                                    </a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->work_details }}
                                    <button data-modal-target="picture_details-modal-{{$index}}" data-modal-toggle="picture_details-modal-{{$index}}" class="block text-blue-900 underline font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                        See Pictures
                                    </button>

                                    <!-- Main modal -->
                                    <div id="picture_details-modal-{{$index}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Work Pictures
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="picture_details-modal-{{$index}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 overflow-x-auto flex flex-wrap">
                                                    <div class="w-full md:w-1/3 p-2">
                                                        @if (!empty($booking->picture_details))
                                                        @foreach(json_decode($booking->picture_details) as $image)
                                                        <img src="{{ asset('storage/bookings/' . $image) }}" class="h-auto w-auto">
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
                                    {{ \Carbon\Carbon::parse($booking->service_date)->format('F d, Y') }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->payment_method }}
                                </td>
                                <td class="px-2 py-2">
                                    @if($booking->booking_status === 'Pending')
                                    <button class="flex items-center justify-around w-24 bg-yellow-500 text-white font-medium px-2 rounded hover:bg-yellow-900" type="button" disabled name="reject"> Pending</button>
                                    @elseif($booking->booking_status === 'Cancelled')
                                    <button class="flex items-center justify-around w-24 bg-red-500 text-white font-medium px-2 rounded hover:bg-red-900" type="button" disabled name="reject"> Cancelled</button>
                                    @elseif($booking->booking_status === 'Accepted')
                                    <button class="flex items-center justify-around w-24 bg-blue-900 text-white font-medium px-2 rounded hover:bg-blue-500" type="button" disabled name="accept"> Accepted</button>
                                    @elseif($booking->booking_status === 'Completed')
                                    <button class="flex items-center justify-around w-24 bg-green-500 text-white font-medium px-2 rounded hover:bg-green-900" type="submit" name="complete">Completed</button>
                                    @endif
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->fee }} <br>
                                    {{ $booking->extra_fee }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="8"></td>
                                <td colspan="1" class=" flex justify-center items-center">
                                    <button type="submit" class="bg-blue-900 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded flex gap-2 items-center">
                                        <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z" />
                                            <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z" />
                                        </svg>
                                        <span>Print</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
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