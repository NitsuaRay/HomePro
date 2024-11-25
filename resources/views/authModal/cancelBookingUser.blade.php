@if ($booking->booking_status === 'Pending' || $booking->booking_status === 'Accepted')
    <button data-modal-target="popup-modal-{{ $index }}" data-modal-toggle="popup-modal-{{ $index }}"
        class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-xs px-3 py-2 text-center dark:bg-red-700 dark:hover:bg-red-700 dark:focus:ring-red-500"
        type="button">
        Cancel
    </button>
@else
    <button class="mt-1 text-white bg-gray-400 cursor-not-allowed rounded-lg text-xs px-3 py-2 text-center" type="button"
        disabled>
        Cancel
    </button>
@endif

<div id="popup-modal-{{ $index }}" tabindex="-1"
    class="hidden fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen bg-black bg-opacity-50">
    <div class="relative w-full max-w-md mx-auto my-8">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button data-modal-hide="popup-modal-{{ $index }}" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to cancel
                    this booking?</h3>
                <form method="POST" action="{{ route('cancel.booking.status', $booking->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="booking_status" value="Cancelled"> <!-- Send the 'Cancelled' status -->

                    <!-- Reason for cancelation -->
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-gray-700">Reason for
                            cancellation</label>
                        <input type="text" name="reason" id="reason"
                            class="mt-1 focus:ring-amber-300 focus:border-amber-300 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <button value="Cancelled" type="submit"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="popup-modal-{{ $index }}" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">
                        No, cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
