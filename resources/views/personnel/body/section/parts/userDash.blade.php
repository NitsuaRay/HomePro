<div class=" mb-5 mt-5">
    <h2 class="mt-2 bg-blue-900 text-white font-bold p-2 rounded"> Reviews </h2>
    <div class="shadow-md sm:rounded-lg grid grid-cols-3 gap-4 bg-white">
        @if($bookings->isNotEmpty())
        @foreach($bookings as $booking)
        @if($booking->user && $booking->ratings->isNotEmpty())
        <div class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 shadow-md">
            <div class="flex gap-2 items-center">
                @if($booking->user->photo)
                <img class="mr-2 rounded-full h-10 w-10 border-2 border-gray-500" src="{{ asset("storage/{$booking->user->photo}") }}" alt="{{ $booking->user->first_name }}">
                @else
                <img src="{{ asset('backend/assets/images/logo.png') }}" alt="Default Pic" class="rounded-full h-10 w-10 border-2 border-gray-500">
                @endif
                <p class="font-bold text-lg">{{ $booking->user->first_name }} {{ $booking->user->middle_name }} {{ $booking->user->last_name }}</p>
            </div>

            <ul>
                @foreach($booking->ratings as $rating)
                <li>{{ $rating->rating_message }}</li>
                <li>
                    {{ $rating->rating }}
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$rating->rating)
                        <i class='bx bxs-star text-yellow-500'></i> <!-- Filled star -->
                        @else
                        <i class='bx bx-star text-yellow-500'></i> <!-- Unfilled star -->
                        @endif
                        @endfor
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @endforeach
        @else
        <p>No Bookings Found</p>
        @endif
    </div>
</div>