    <button data-modal-target="profile-modal-{{ $index }}" data-modal-toggle="profile-modal-{{ $index }}" class="text-blue-900 text-sm dark:text-blue-900 underline" type="button">
        View Profile
    </button>
    <!-- edit booking modal -->
    <div id="profile-modal-{{ $index }}" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 justify-center h-full bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow pb-4 w-full max-w-md">
            <div class="flex justify-between p-2 items-center bg-blue-900">
                <h2 class=" text-white font-medium">Personnel's Profile</h2>
                <button class="text-white text-sm w-8 h-8" data-modal-hide="profile-modal-{{ $index }}" type="button">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="flex items-center justify-around">
                @if (!empty($booking->personnel->photo))
                <img src="{{ asset('storage/' . $booking->personnel->photo) }}" alt="User Profile Picture" class="h-24 w-auto">
                @else
                <img src="{{ asset('upload/no_image.jpg') }}" alt="Default Profile Picture" class="w-25 h-25 border-2 border-gray-500">
                @endif
                <div class="flex flex-col">
                    <h3 class="font-bold text-lg text-blue-900 p-3">{{ $booking->personnel->first_name }} {{ $booking->personnel->middle_name }} {{ $booking->personnel->last_name }}</h3>

                    <p class="ml-2 text-yellow-500">
                        @if($booking->personnel->averageRating > 0)
                        {{ $booking->personnel->averageRating }}
                        <i class='bx bxs-star'></i>
                        @else
                        0
                        <i class='bx bxs-star'></i>
                        @endif
                    </p>
                </div>
            </div>
            <div class="w-full p-3 bg-blue-900">
                <p class="text-lg text-white font-bold">Personnel's Information </p>

            </div>
            <div class="flex flex-col items-start text-left px-4">
                <h4 class="text-amber-700 font-medium">Service Offered:</h4>
                <span class="text-blue-900  ml-3 font-bold">{{ $booking->personnel->service_cat }} </span>
                <h4 class="text-amber-700 font-medium">Service Fee:</h4>
                <span class="text-blue-900  ml-3 font-bold">{{ $booking->personnel->fee }}</span>
                <h4 class="text-amber-700 font-medium">Landmark/Location:</h4>
                <span class="text-blue-900  ml-3 font-bold">{{ $booking->personnel->extra_add }}</span>
                <h4 class="text-amber-700 font-medium">Address: </h4>
                <span class="text-blue-900  ml-3 font-bold">{{ $booking->personnel->address }}</span>
                <h4 class="text-amber-700 font-medium">Phone Number: </h4>
                <span class="text-blue-900  ml-3 font-bold">{{ $booking->personnel->phone }}</span>
                <h4 class="text-amber-700 font-medium">Email: </h4>
                <span class="text-blue-900 ml-3 font-bold">{{ $booking->personnel->email }}</span>
            </div>
        </div>
    </div>