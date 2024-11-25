<x-app-layout>
    <div class="h-full px-3 py-4 overflow-y-auto flex justify-center w-full ">
        <div class="flex justify-between w-full">
            <div class="flex gap-4 lg:w-1/2 w-full">
                <form class="flex items-center gap-1 w-full" action="{{ route('available.search') }}" method="GET">
                    <label for="searchStock" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <input type="text" id="searchBorrow" name="searchBorrow"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  "
                            placeholder="Search here..." required>

                    </div>
                    <button type="submit"
                        class="py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-900 rounded-lg border hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Search
                    </button>
                </form>
                <div x-data="{ open: false, office: '' }">
                    <button data-modal-target="filter_modal" data-modal-toggle="filter_modal"
                        class="flex gap-2 items-center py-2.5 px-4 ms-2 text-sm font-medium text-white bg-blue-900 rounded-lg border focus:ring-4 focus:outline-none focus:ring-blue-300"
                        type="button">
                        <i class='bx bx-filter'></i>
                        Filter
                    </button>

                    <div id="filter_modal" tabindex="-1" aria-hidden="true"
                        class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full items-center justify-center bg-transparent">
                        <div class="bg-white rounded-lg shadow dark:bg-gray-700 mx-auto w-80">
                            <div class="flex items-start justify-between px-4 py-2 border-b rounded-t bg-blue-900">
                                <h3 class="text-xl font-semibold text-white">
                                    Filter
                                </h3>
                                <button data-modal-hide="filter_modal" type="button"
                                    class="text-white bg-transparent hover:bg-gray-200 hover:text-blue-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>

                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="">
                                <form action="{{ route('filter.personnel') }}" method="POST" class="p-3">
                                    @csrf

                                    <div class=" flex justify-around">
                                        <select class="p-2 border rounded" name="rating">
                                            <option value="">Rating</option>
                                            <option value="5.0">Five Stars</option>
                                            <option value="4.0">Four Stars</option>
                                            <option value="3.0">Three stars</option>
                                            <option value="2.0">Two Stars</option>
                                            <option value="1.0">One Star</option>
                                        </select>

                                        <input type="date" id="selected_date" name="selected_date"
                                            class="p-2 rounded border">
                                    </div>

                                    <div
                                        class="flex items-center justify-end p-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button type="submit"
                                            class="text-white bg-blue-900 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->photo !== null)
        <section class="text-blue body-font flex-grow">
            <div class="bg-gray-100 py-4 px-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                    @foreach ($personnel as $person)
                        <div
                            class="bg-blue-900 p-4 shadow-lg flex flex-col items-center justify-center transition duration-300 transform hover:scale-105 cursor-pointer rounded-lg">
                            <div class="flex justify-between gap-1 items-center mb-2 w-full bg-amber-700 rounded">
                                <a href=" {{ !empty($person->photo) ? asset('storage/' . $person->photo) : url('upload/no_image.jpg') }}"
                                    target="_blank" class="w-1/3"><img
                                        src="{{ !empty($person->photo) ? asset('storage/' . $person->photo) : url('upload/no_image.jpg') }}"
                                        alt="Personnel Image" class="w-64 h-32"> </a>
                                <div class="flex flex-col justify-center w-full">
                                    <h3 class="text-md font-semibold text-white text-center">{{ $person->first_name }}
                                        {{ $person->middle_name }} {{ $person->last_name }}</h3>
                                    <p class="text-white text-xs flex gap-2 items-center justify-center"><i
                                            class='bx bxs-envelope'></i> {{ $person->email }}</p>
                                    @if ($person->isGCash === 'YES')
                                        <p class="text-white text-xs flex gap-2 items-center justify-center"><img
                                                src="{{ asset('upload/gcash.png') }}" alt=""
                                                class="w-auto h-6">{{ $person->phone }}</p>
                                    @else
                                        <p class="text-white text-xs flex gap-2 items-center justify-center"><i
                                                class='bx bxs-phone'></i>{{ $person->phone }}</p>
                                    @endif
                                    <p class="text-white text-md text-center font-bold">
                                        {{ $averageRatings[$person->id] }}
                                        <span class="text-yellow-500"> <i
                                                class='bx bxs-star text-lg text-yellow-300'></i></span>
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-start w-full">
                                <p class="text-white mb-2 text-text-center flex gap-2 justify-center items-center">
                                    <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M19.728 10.686c-2.38 2.256-6.153 3.381-9.875 3.381-3.722 0-7.4-1.126-9.571-3.371L0 10.437V18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-7.6l-.272.286Z" />
                                        <path
                                            d="m.135 7.847 1.542 1.417c3.6 3.712 12.747 3.7 16.635.01L19.605 7.9A.98.98 0 0 1 20 7.652V6a2 2 0 0 0-2-2h-3V3a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v1H2a2 2 0 0 0-2 2v1.765c.047.024.092.051.135.082ZM10 10.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5ZM7 3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1H7V3Z" />
                                    </svg>
                                    {{ $person->service_cat }}
                                </p>
                                <p class="text-white mb-1 text-md  flex gap-2 items-center justify-center">Additional
                                    Skills: {{ $person->description }}</p>
                                <p class="text-white mb-1 text-md flex gap-2 items-center"><i
                                        class='bx bxs-location-plus'></i> {{ $person->address }}</p>
                                <p class="text-white mb-1 text-md flex gap-2 items-center"><i
                                        class='bx bxs-user-circle'></i>{{ $person->gender }}</p>
                                <p class="text-white text-md flex gap-2 items-center"><i class='bx bx-money'></i>
                                    &#8369;{{ $person->fee }}</p>
                            </div>
                            <div class="flex justify-end w-full mt-1">
                                <button
                                    class="text-md sm:px-2 sm:py-2 px-2 py-1 bg-amber-700 hover:bg-amber-900 text-white rounded focus:outline-none focus:ring focus:border-amber-700 transition duration-300 ease-in-out"
                                    onclick="window.location.href='/booking/{{ $person->id }}'">Book
                                    Personnel</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <p class="px-4 py-2 bg-red-500 text-white text-center">Please update your profile image to verify your account.
            Click the Update Profile
            Image button at the top-right.</p>
    @endif
</x-app-layout>
