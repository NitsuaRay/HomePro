<x-guest-layout>
    <div class="mb-2 flex justify-between">
        <div class="text-blue-900">
            <p class="font-bold">{{ $personnel->first_name }} {{ $personnel->last_name }}</p>
            <p class="text-blue-900 flex gap-2 items-center">
                <svg class="w-4 h-4 text-blue-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M19.728 10.686c-2.38 2.256-6.153 3.381-9.875 3.381-3.722 0-7.4-1.126-9.571-3.371L0 10.437V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-7.6l-.272.286Z" />
                    <path d="m.135 7.847 1.542 1.417c3.6 3.712 12.747 3.7 16.635.01L19.605 7.9A.98.98 0 0 1 20 7.652V6a2 2 0 0 0-2-2h-3V3a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v1H2a2 2 0 0 0-2 2v1.765c.047.024.092.051.135.082ZM10 10.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5ZM7 3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1H7V3Z" />
                </svg>
                {{ $personnel->service_cat }} |
                <span>{{ $personnel->description }}</span>
            </p>
        </div>
        <div>
            @if($personnel->isGCash === "YES")
            <p class="text-blue-900 text-sm flex gap-2 items-center justify-center"><img src="{{ asset('upload/gcash.png') }}" alt="" class="w-auto h-6">{{ $personnel->phone }}</p>
            @else
            <p class="text-blue-900 text-sm flex gap-2 items-center justify-center"><i class='bx bxs-phone'></i>{{ $personnel->phone }}</p>
            @endif
        </div>
    </div>
    @if(session('error'))
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium">{{ session('error') }}</span>
    </div>
    @endif

    <livewire:booking-form :id="$personnel->id" />

</x-guest-layout>