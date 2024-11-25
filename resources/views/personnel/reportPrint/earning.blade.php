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
            @include('personnelModal.searhFilterPrint')
            <div class="overflow-x-auto mt-3">
                <form id="printForm" action="{{ route('generate.pdfBookingPersonnelEarning') }}" method="POST" target="_blank">
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
                                <th scope="col" class="px-4 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Service Category
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Service Date
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Total Fee
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Total Extra Fee
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personnelBookings as $booking)
                            <tr class="{{ $loop->index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }} border-b">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input name="selected_booking_id[]" value="{{ $booking->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->user->address }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Auth::guard('personnel')->user()->service_cat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($booking->service_date)->format('F d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    &#8369;{{ $booking->fee }}
                                </td>
                                <td class="px-6 py-4">
                                    &#8369;{{ $booking->extra_fee }}
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-white border-b">
                                <td colspan="5" class="px-6 py-4">Total</td>
                                <td colspan="1" class="px-6 py-4">
                                    &#8369;{{ $totalFee }}
                                </td>
                                <td colspan="1" class="px-6 py-4">
                                    &#8369;{{ $totalExtraFee  }}
                                </td>
                            </tr>
                            <tr class="bg-gray-100 border-b">
                                <td colspan="6" class="px-6 py-4">Grand Total</td>
                                <td colspan="1" class="px-6 py-4">
                                    &#8369;{{ $grandTotal   }}
                                </td>
                            </tr>
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