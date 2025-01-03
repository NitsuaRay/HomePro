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