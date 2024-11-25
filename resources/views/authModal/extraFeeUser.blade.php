  @if($booking->extra_fee)
  <button data-modal-target="extraFee-modal-{{ $index }}" data-modal-toggle="extraFee-modal-{{ $index }}" class="block text-blue-900 underline " type="button">
      View Extra Fee
  </button>
  <div id="extraFee-modal-{{ $index }}" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 justify-center h-full bg-black bg-opacity-50">
      <div class="bg-white rounded-lg shadow pb-4 w-full max-w-md">
          <div class="flex justify-between p-2 items-center bg-blue-900">
              <h2 class=" text-white font-medium">Extra Fee Details</h2>
              <button class="text-white text-sm w-8 h-8" data-modal-hide="extraFee-modal-{{ $index }}" type="button">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close</span>
              </button>
          </div>
          <div class="flex flex-col items-start text-left px-4">
              <h4 class="text-amber-700 font-medium">Extra Fee:</h4>
              <span class="text-blue-900  ml-3 font-bold">&#8369;{{ $booking->extra_fee }}</span>
              <h4 class="text-amber-700 font-medium"> Details:</h4>
              <span class="text-blue-900  ml-3 font-bold">{{ $booking->fee_details }}</span>
          </div>
      </div>
  </div>
  @endif