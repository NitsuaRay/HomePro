<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight ml-8">
            {{ __('Booking Lists') }}
        </h2>
    </x-slot>

    @include('booking.table_User')
</x-app-layout>