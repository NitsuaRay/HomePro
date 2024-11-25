<div class=" overflow-x-auto shadow-md sm:rounded-lg grid grid-cols-3 gap-4">
    <a href="">
        <div class="bg-green-500 border-b dark:bg-gray-800 dark:border-gray-700 p-4 text-center">
            <div class="flex justify-center items-center text-2xl text-white font-bold gap-4">
                <h3>{{ $userCount }}</h3>
                <i class='bx bxs-user-account'></i>
            </div>
            <p class="text-white">User/s</p>
        </div>
    </a>
    <a href="">
        <div class="bg-blue-900 border-b p-4 text-center">
            <div class="flex justify-center items-center text-2xl text-white font-bold gap-4">
                <h3>{{ $personnelCount }}</h3>
                <i class='bx bxs-hard-hat'></i>
            </div>
            <p class="text-white">Personnel/s</p>
        </div>
    </a>
    <a href="">
        <div class="bg-amber-700 border-b dark:bg-gray-800 dark:border-gray-700 p-4 text-center">
            <div class="flex justify-center items-center text-2xl text-white font-bold gap-4">
                <h3>{{ $bookingCount }}</h3>
                <i class='bx bxs-calendar'></i>
            </div>
            <p class="text-white">Booking/s</p>
        </div>
    </a>
</div>