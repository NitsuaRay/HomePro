<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight ml-8">
            {{ __('Personnel Profile') }}
        </h2>
    </x-slot>

    <section class="body-font flex-grow">
        <div class="container mx-auto p-8">
            <div class="bg-white shadow-lg rounded-lg p-8 flex flex-col md:flex-row">
                <div class="md:w-1/3 flex flex-col items-center mb-4 md:mb-0">
                    <img src="{{ (!empty($personnel->photo)) ? url('upload/personnel_images/'.$personnel->photo) : url('upload/no_image.jpg') }}" alt="Personnel Image" class="border-2 border-white w-48 h-48 object-cover rounded-full mx-auto">
                    <h2 class="text-3xl font-semibold mb-4">{{ $personnel->name }}</h2>
                </div>

                <div class="md:w-2/3 mx-4">
                    <p class="text-gray-600 mb-2"><strong>Service Category:</strong> {{ $personnel->service_cat }}</p>
                    <p class="text-gray-600 mb-2"><strong>Address:</strong> {{ $personnel->address }}, Asingan, Pangasinan</p>
                    <p class="text-gray-600 mb-2"><strong>Phone:</strong> {{ $personnel->phone }}</p>
                    <p class="text-gray-600 mb-2"><strong>Email:</strong> {{ $personnel->email }}</p>
                    <p class="text-gray-600 mb-2"><strong>Gender:</strong> {{ $personnel->gender }}</p>
                    <p class="text-gray-600 mb-2"><strong>Service Fee:</strong> &#8369;{{ $personnel->fee }}</p>
                    <!-- Add more details as needed -->

                    <!-- Buttons for actions -->
                    <div class="flex justify-start gap-4 w-full mt-4">
                        <button class="px-4 py-2 bg-red-700 hover:bg-red-900 text-white rounded focus:outline-none focus:ring focus:border-red-700 transition duration-300 ease-in-out"><a href="{{ route('available.personnel') }}">Back</a></button>
                        <button class="px-4 py-2 bg-amber-700 hover:bg-amber-900 text-white rounded focus:outline-none focus:ring focus:border-amber-700 transition duration-300 ease-in-out" onclick="window.location.href=' /booking/{{$personnel->id}}'">Book Personnel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>