<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full overflow-y-auto bg-gray-50 shadow">
        <ul class="font-medium">
            <li class=" bg-white h-16 p-1 flex items-center justify-center">
                <div class="cursor-pointer">
                    <a class="flex items-center" href="{{ route('personnel.dashboard') }}">
                        <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" class="w-10 h-10">
                        <h2 class="ml-3 text-2xl text-blue-900 font-bold">Home<span class="text-amber-700">Pro</span></h2>
                    </a>
                </div>
            </li>
            <li class="bg-blue-900">
                <a href="{{ route('personnel.profile.edit') }}" class=" flex items-center px-3 py-2 gap-4">
                    @if (!empty(Auth::guard('personnel')->user()->photo))
                    <img src="{{ asset('storage/' . Auth::guard('personnel')->user()->photo) }}" alt="User Profile Picture" class="rounded-full h-14 w-14">
                    @else
                    <img src="{{ asset('upload/no_image.jpg') }}" alt="Default Profile Picture" class="w-10 h-10 border-2 border-gray-500 rounded-full">
                    @endif
                    <p class="text-md text-white font-medium dark:text-white text-center">{{ Auth::guard('personnel')->user()->first_name }} {{ Auth::guard('personnel')->user()->last_name }}</p>
                </a>
            </li>
            <li class="px-3 py-2">
                <a href="{{ route('personnel.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-white dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group {{ request()->routeIs('personnel.dashboard') ? 'text-white bg-blue-900' : '' }}">
                    <svg class=" w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white {{ request()->routeIs('personnel.dashboard') ? 'text-white' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li class="px-3 py-2">
                <a href="{{ route('show.bookingPersonnel') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-white dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group {{ request()->routeIs('show.bookingPersonnel') ? 'text-white bg-blue-900' : '' }}">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white {{ request()->routeIs('show.bookingPersonnel') ? 'text-white' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Bookings</span>
                </a>
            </li>
            <li class="px-3 py-2">
                <a href="{{ route('personnel.profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:text-white dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group {{ request()->routeIs('personnel.profile.edit') ? 'text-white bg-blue-900' : '' }}">
                    <svg class=" w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white {{ request()->routeIs('personnel.profile.edit') ? 'text-white' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
                </a>
            </li>
            @if (Auth::guard('personnel')->user()->isVerified === "Verified")
            <li class="px-3 py-2">
                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 grouptext-gray-900 rounded-lg hover:text-white dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group {{ request()->routeIs('personnel.bookingPrintPersonnelEarning') ? 'text-white bg-blue-900' : '' }}" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class=" w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white {{ request()->routeIs('personnel.bookingPrintPersonnelEarning') ? 'text-white' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Reports</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('personnel.bookingPrintPersonnel') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Booking</a>
                    </li>
                    <li>
                        <a href="{{ route('personnel.bookingPrintPersonnelEarning') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Earning</a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="px-3 py-2">

            </li>

            <li class="flex items-center bg-blue-900">
                <form method="POST" action="{{ route('personnel.logout') }}" class="px-5 py-3 w-full">
                    @csrf

                    <button type="submit" class="items-start w-full flex gap-4 text-sm text-white">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>