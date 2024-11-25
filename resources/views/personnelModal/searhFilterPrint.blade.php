    <div class="h-full px-3 py-1 overflow-y-auto flex justify-center w-full">
        <div class="flex justify-between w-full">
            <div class="flex gap-4 w-1/2">
                <form class="flex items-center gap-1 w-full" action="{{ route('booking.searchPersonnelPrint') }}" method="GET">
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

                <div id="filter-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full items-center justify-center bg-transparent">
                    <div class="bg-white rounded-lg shadow dark:bg-gray-700 mx-auto w-64">
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
                            <form action="{{route('filter.bookingPersonnelPrint')}}" method="POST" class="p-3">
                                @csrf
                                <div class=" flex justify-around">

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