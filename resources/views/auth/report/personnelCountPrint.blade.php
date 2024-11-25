<div class="sm:ml-64">

    <div class="p-3">
        <h2 class="text-xl font-bold text-blue-900">Booking Report</h2>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex justify-between items-center">
                <div class="h-full px-3 py-4 overflow-y-auto flex justify-center w-full">
                    <div class="flex justify-between w-full">
                        <div class="flex gap-4 w-1/2">
                            <form class="flex items-center gap-1 w-full" action="{{ route('booking.searchPrintCount') }}" method="GET">
                                <label for="searchStock" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <input type="text" id="searchBorrow" name="searchBorrow" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  " placeholder="Search here..." required>

                                </div>
                                <button type="submit" class="py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-900 rounded-lg border hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    Search
                                </button>
                            </form>
                            <button data-modal-target="filter-modal" data-modal-toggle="filter-modal" class="flex gap-2 items-center py-2.5 px-4 ms-2 text-sm font-medium text-white bg-blue-900 rounded-lg border focus:ring-4 focus:outline-none focus:ring-blue-300" type="button">
                                <i class='bx bx-filter'></i>
                                Filter
                            </button>

                            <div id="filter-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full items-center justify-center bg-gray-700">
                                <div class="bg-white rounded-lg shadow dark:bg-gray-700 mx-auto w-1/2">
                                    <div class="flex items-start justify-between px-4 py-2 border-b rounded-t bg-blue-900">
                                        <h3 class="text-xl font-semibold text-white">
                                            Filter
                                        </h3>
                                        <button data-modal-hide="filter-modal" class="text-white bg-transparent hover:bg-gray-200 hover:text-blue-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" type="button">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>

                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <div class="">
                                        <form action="{{ route('count.bookingPrint') }}" method="POST" class="p-3">
                                            @csrf
                                            <div class=" flex justify-around">
                                                <select class="p-2 border rounded" name="service_cat">
                                                    <option value="">Select Service</option>
                                                    <optgroup label="Carpentry Services">
                                                        <option value="Carpentry">Carpentry</option>
                                                        <option value="Construction">Construction</option>
                                                        <option value="Electrical">Electrical</option>
                                                        <option value="Plumbing">Plumbing</option>
                                                    </optgroup>
                                                    <optgroup label="Cleaning Services">
                                                        <option value="Cleaning">Cleaning</option>
                                                        <option value="Housekeeping">Housekeeping</option>
                                                        <option value="Gardening">Gardening</option>
                                                        <option value="Laundry">Laundry</option>
                                                    </optgroup>
                                                    <optgroup label="Home Services">
                                                        <option value="Manicure and Pedicure">Manicure and Pedicure</option>
                                                        <option value="Nanny">Nanny</option>
                                                        <option value="Computer Repair">Computer Repair</option>
                                                    </optgroup>
                                                </select>
                                                <input type="date" id="selected_date" name="selected_date" class="p-2 rounded border">
                                            </div>
                                            <div class="flex items-center justify-end p-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit" class="text-white bg-blue-900 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="flex gap-2 flex-col" action="{{ route('generate.pdf.userAllReportSpend') }}" method="Get">
                    @csrf
                    @foreach($bookings as $booking)
                    <input type="hidden" name="barCheckAll[]" value="{{ $booking->id }}">
                    @endforeach

                    <button type="submit" class="flex items-center justify-center bg-blue-900 text-white font-medium px-5 hover:bg-blue-500 w-48">
                        Download All
                    </button>
                </form>
            </div>
            <form class="flex gap-2 flex-col" action="{{ route('generate.pdfUserReportSpend') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center bg-blue-900 text-white font-medium px-5 rounded hover:bg-blue-500 w-48 my-3">
                    Download
                </button>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <span class="ml-2"> Print </span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Service Personnel
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Service Offered
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bookings Count
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Service Fee
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Extra Fee
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $key => $booking)
                        <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-100' }} border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <input type="checkbox" name="barCheck[]" value="{{ $booking->id }}" class="text-blue-600 bg-gray-100 border-blue-500 rounded focus:ring-blue-500 focus:ring-2">
                            </th>
                            <td class="px-6 py-4">
                                {{ $booking->personnel->first_name }} {{ $booking->personnel->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->personnel->service_cat }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->booking_count }}
                            </td>
                            <td class="px-6 py-4">
                                &#8369;{{ $booking->total_fee }}
                            </td>
                            <td class="px-6 py-4">
                                &#8369;{{ $booking->total_extra_fee }}
                            </td>
                        </tr>
                        @endforeach

                        <!-- Display grand totals row -->
                        <tr class="bg-gray-200 border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Total</th>
                            <td colspan="2"></td>
                            <td class="px-6 py-4">{{ $totalBooking }}</td>
                            <td class="px-6 py-4">&#8369;{{ $totalFee }}</td>
                            <td class="px-6 py-4">&#8369;{{ $totalExtraFee }}</td>
                        </tr>
                    </tbody>

                </table>
            </form>
        </div>
    </div>
</div>