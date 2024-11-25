  @if($booking->booking_status === 'Pending')
  <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-2 text-center" type="button" data-modal-target="form-modal-{{$index}}" data-modal-toggle="form-modal-{{$index}}">
      Edit
  </button>
  @endif
  <!-- edit booking modal -->
  <div id="form-modal-{{$index}}" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 justify-center items-center h-full bg-black bg-opacity-50">
      <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Booking Details</h3>
          <form action="{{ route('booking.update', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
              @csrf
              @method('PUT')

              <input type="hidden" name="bookingId" value="{{ $booking->id }}"> <!-- Add this line for the booking ID -->

              <div class="mb-4">
                  <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="work_details">Work Description</x-input-label>
                  <textarea class="w-full p-2 border rounded" id="work_details" name="work_details" rows="4">{{ old('work_details', $booking->work_details) }}</textarea>
              </div>

              <div class="mb-4">
                  <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="picture_details">Work to be done picture</x-input-label>
                  <input type="file" class="w-full p-2 border rounded" id="picture_details" name="picture_details">
              </div>

              <div class="mb-4">
                  <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="service_date">Schedule</x-input-label>
                  <input class="w-full p-2 border rounded" type="datetime-local" id="service_date" name="service_date" value="{{ old('service_date', $booking->service_date) }}">
              </div>

              <div class="mb-4">
                  <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="payment_method">Payment Method</x-input-label>
                  <select class="w-full p-2 border rounded" id="payment_method" name="payment_method">
                      <option value="Cash On Hand" {{ old('payment_method', $booking->payment_method) == 'Cash On Hand' ? 'selected' : '' }}>Cash On Hand</option>
                      <option value="GCash" {{ old('payment_method', $booking->payment_method) == 'GCash' ? 'selected' : '' }}>GCash</option>
                  </select>
              </div>

              <div class="flex justify-between">
                  <button type="button" data-modal-hide="form-modal-{{$index}}" class="bg-red-500 hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
                      Cancel
                  </button>
                  <button type="submit" class="bg-blue-900 hover:bg-primary-half text-white font-bold py-2 px-4 rounded">
                      Save
                  </button>
              </div>
          </form>
      </div>
  </div>