<div class="flex justify-center items-center">
    <button data-modal-target="rating-modal-{{ $index }}" data-modal-toggle="rating-modal-{{ $index }}"
        class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2 text-center
{{ $booking->ratings->isNotEmpty() ? 'bg-gray-500' : '' }}"
        {{ $booking->ratings->isNotEmpty() ? 'disabled' : '' }}>
        Rate Personnel
    </button>
</div>
<!-- edit booking modal -->
<div id="rating-modal-{{ $index }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 left-0 right-0 z-50 justify-center items-center h-full bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow w-full max-w-md pb-2">
        <h3
            class="rounded-sm text-xl font-medium text-white w-full bg-blue-900 px-4 py-2 border-b-3 border-solid border-amber-700">
            Rate Service Personnel</h3>
        <form action="{{ route('booking.rating') }}" method="POST" enctype="multipart/form-data"
            class="space-y-3 px-2 pb-2">
            @csrf
            <input type="hidden" name="bookingId" value="{{ $booking->id }}">
            <label for="rating" class="block mb-2 text-sm font-medium text-blue-900">Rate</label>
            <div class="flex items-center space-x-1 justify-center">
                <input type="radio" id="star1" name="rating" value="1" class="hidden" />
                <label for="star1" id="star1-label">
                    <i class='bx bx-star text-3xl text-yellow-300'></i>
                </label>
                <input type="radio" id="star2" name="rating" value="2" class="hidden" />
                <label for="star2" id="star2-label">
                    <i class='bx bx-star text-3xl text-yellow-300'></i>
                </label>

                <input type="radio" id="star3" name="rating" value="3" class="hidden" />
                <label for="star3" id="star3-label">
                    <i class='bx bx-star text-3xl text-yellow-300'></i>
                </label>

                <input type="radio" id="star4" name="rating" value="4" class="hidden" />
                <label for="star4" id="star4-label">
                    <i class='bx bx-star text-3xl text-yellow-300'></i>
                </label>

                <input type="radio" id="star5" name="rating" value="5" class="hidden" />
                <label for="star5" id="star5-label">
                    <i class='bx bx-star text-3xl text-yellow-300'></i>
                </label>
            </div>

            <div>
                <label for="rating_message" class="block mb-2 text-sm font-medium text-blue-900">Comment</label>
                <textarea id="rating_message" name="rating_message" rows="4"
                    class="block p-2.5 w-full text-sm text-blue-900 bg-gray-50 rounded-lg border border-blue-900 focus:ring-amber-700 focus:border-amber-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-amber-700 dark:focus:border-blue-500"
                    placeholder="Write your thoughts here..."></textarea>
            </div>

            <div class="flex justify-between mt-4">
                <button type="button" data-modal-hide="rating-modal-{{ $index }}"
                    class="bg-red-500 hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </button>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-300 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
