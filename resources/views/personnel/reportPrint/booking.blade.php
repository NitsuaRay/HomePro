<div class="sm:ml-64">
    @include('personnel.partials.nav')
    <div class="max-w-7xl mx-auto px-2 mt-2">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-green-800 dark:text-green-200">
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
            @include('personnelModal.searhFilterBooking')
            <div class="overflow-x-auto mt-3">
                <form id="printForm" action="{{ route('generate.pdfPersonnelBooking') }}" method="POST" target="_blank">
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
                                    Fee
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $index => $booking)
                            <tr class="{{ $loop->index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }} border-b">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input name="selected_booking_id[]" value="{{ $booking->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                    <button class="flex items-center justify-around w-24 underline text-blue-900 font-medium" type="button" data-modal-target="personnel-modal-{{ $booking->id }}" data-modal-toggle="personnel-modal-{{ $booking->id }}">
                                        View Details
                                    </button>

                                    <!-- Main modal -->
                                    <div id="personnel-modal-{{ $booking->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-2 md:p-3 border-b rounded-t bg-blue-900">
                                                    <h3 class="text-lg font-semibold text-white dark:text-white">
                                                        {{ $booking->user->first_name }}'s Details
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="personnel-modal-{{ $booking->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5">
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div class="flex items-center justify-center">
                                                            @if (!empty($booking->user->photo))
                                                            <img src="{{ asset('storage/' . $booking->user->photo) }}" class="h-auto w-auto">
                                                            @else
                                                            <img src="{{ asset('backend/assets/images/logo.png') }}" alt="Default Pic" class="h-auto w-auto">
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <div class="flex flex-col">
                                                                <p class="font-bold">Name:</p>
                                                                <p class="px-2">{{ $booking->user->first_name }} {{ $booking->user->middle_name }} {{ $booking->user->last_name }}</p>
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
                                    {{ $booking->work_details }} <br>
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
                                    {{ \Carbon\Carbon::parse($booking->service_date)->format('F d, Y h:i A') }}
                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->payment_method }}

                                    @if($booking->payment_method === 'GCash')
                                    <p>
                                        Proof: <br>
                                        <a href="{{ (!empty($booking->gcash_picture)) ? url('upload/gcash_picture/'.$booking->gcash_picture) : url('upload/no_image.jpg') }}" target="_blank" class="underline">
                                            See Image
                                        </a>
                                    </p>
                                    @endif

                                </td>
                                <td class="px-2 py-2">
                                    {{ $booking->fee }} <br>
                                    {{ $booking->extra_fee }}
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-white border-b">
                                <td colspan="6"></td>
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