<button data-modal-target="gcash-modal-{{$index}}" data-modal-toggle="gcash-modal-{{$index}}" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2 text-center" type="button">
    Payment
</button>
<!-- edit booking modal -->
<div id="gcash-modal-{{$index}}" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 justify-center items-center h-full bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow w-full max-w-md pb-2">
        <h3 class="rounded-sm text-xl font-medium text-white w-full bg-blue-900 px-4 py-2 border-b-3 border-solid border-amber-700">Send Payment Proof</h3>
        <form action="{{ route('booking.gcash', ['booking' => $booking->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-3 px-2 pb-2">
            @csrf
            @method('PATCH')
            <input type="hidden" name="booking" value="{{ $booking->id }}">
            <label for="gcash_picture" class="block mb-2 text-sm font-medium text-blue-900">Upload your proof of payment in GCash</label>
            <div class="flex items-center space-x-1 justify-center">
                <input type="file" class="w-full p-2 border rounded" id="gcash_picture" name="gcash_picture" required>
            </div>

            <div class="flex justify-between mt-4">
                <button type="button" data-modal-hide="gcash-modal-{{$index}}" class="bg-red-500 hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </button>
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-300 text-white font-bold py-2 px-4 rounded">
                    Send
                </button>
            </div>
        </form>
    </div>
</div>