 @if (Session::has('success'))
     <div id="toast-success"
         class="absolute top-10 right-0 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
         role="alert">
         <div
             class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
             <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                 viewBox="0 0 20 20">
                 <path
                     d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
             </svg>
             <span class="sr-only">Check icon</span>
         </div>
         <div class="ms-3 text-sm font-normal">{{ session::get('success') }}</div>
         <button type="button"
             class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
             data-dismiss-target="#toast-success" aria-label="Close">
             <span class="sr-only">Close</span>
             <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 14 14">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
             </svg>
         </button>
     </div>
 @endif
 @if (Session::has('error'))
     <div id="toast-error"
         class="absolute top-10 right-0 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
         role="alert">
         <div
             class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-green-100 rounded-lg">
             <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                 viewBox="0 0 20 20">
                 <path
                     d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
             </svg>
             <span class="sr-only">Check icon</span>
         </div>
         <div class="ms-3 text-sm font-normal">{{ session::get('error') }}</div>
         <button type="button"
             class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
             data-dismiss-target="#toast-error" aria-label="Close">
             <span class="sr-only">Close</span>
             <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 14 14">
                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
             </svg>
         </button>
     </div>
 @endif

 @include('authModal.filterBookingUser')

 @if (Auth::user()->photo !== null)

     <div class="py-4 px-2">
         <div class="w-full">
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                     <div class="overflow-x-auto">
                         <table
                             class="bg-white dark:bg-gray-800 border-collapse border border-slate-400 w-32 md:w-full">
                             <thead>
                                 <tr class="bg-blue-900 text-whte text-center">
                                     <th
                                         class="px-6 py-1 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Pesonnel Name
                                     </th>
                                     <th
                                         class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Service Offered
                                     </th>
                                     <th
                                         class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Work Details
                                     </th>
                                     <th
                                         class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Fee
                                     </th>
                                     <th
                                         class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Service Date
                                     </th>
                                     <th
                                         class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Payment Method
                                     </th>
                                     <th
                                         class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Booking Status
                                     </th>
                                     <th
                                         class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-700 text-left text-xs leading-4 font-semibold text-white dark:text-white uppercase tracking-wider">
                                         Edit Booking
                                     </th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($bookings as $index => $booking)
                                     <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                                         <td
                                             class=" whitespace-no-wrap border border-gray-200 dark:border-gray-700 text-center">
                                             {{ $booking->personnel->first_name }}
                                             {{ $booking->personnel->middle_name }}
                                             {{ $booking->personnel->last_name }} <br>
                                             @include('authModal.viewPersonnelUser')
                                         </td>
                                         <td
                                             class="text-center whitespace-no-wrap border border-gray-200 dark:border-gray-700 px-1">
                                             {{ $booking->personnel->service_cat }} <br> Additional Skill:
                                             {{ $booking->personnel->description }}
                                         </td>
                                         <td class="text-center whitespace-no-wrap px-1 flex items-center flex-col">
                                             {{ $booking->work_details }}
                                             @include('authModal.pictureDetails')
                                         </td>
                                         <td
                                             class="text-left whitespace-no-wrap border border-gray-200 dark:border-gray-700 px-1">
                                             &#8369;{{ $booking->fee }}
                                             @include('authModal.extraFeeUser')
                                         </td>
                                         <td
                                             class="text-center whitespace-no-wrap border border-gray-200 dark:border-gray-700 px-1">
                                             {{ \Carbon\Carbon::parse($booking->service_date)->format('F j, Y h:i A') }}
                                         </td>
                                         <td
                                             class="text-center whitespace-no-wrap border border-gray-200 dark:border-gray-700 px-1">
                                             {{ $booking->payment_method }}
                                         </td>
                                         <td
                                             class="text-center whitespace-no-wrap border border-gray-200 dark:border-gray-700 px-1">
                                             @if ($booking->booking_status === 'Pending')
                                                 <span
                                                     class="bg-blue-100 text-blue-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Pending</span>
                                             @elseif($booking->booking_status === 'Cancelled')
                                                 <span
                                                     class="bg-red-100 text-red-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Cancelled</span>
                                                 @foreach ($booking->cancelsP as $cancel)
                                                     <p>by {{ $booking->personnel->first_name }}
                                                         {{ $booking->personnel->last_name }}</p>
                                                     <p class="mx-auto text-center mt-2 font-medium">Reason for
                                                         cancellation: <br>
                                                         {{ $cancel->reason }}
                                                     </p>
                                                 @endforeach
                                                 @foreach ($booking->cancels as $cancel)
                                                     <p>by {{ $booking->user->first_name }}
                                                         {{ $booking->user->last_name }}</p>
                                                     <p class="mx-auto text-center mt-2 font-medium">Reason for
                                                         cancellation: <br>
                                                         {{ $cancel->reason }}
                                                     </p>
                                                 @endforeach
                                             @elseif($booking->booking_status === 'Accepted')
                                                 <span
                                                     class="bg-yellow-100 text-yellow-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Accepted</span>
                                             @elseif($booking->booking_status === 'Completed')
                                                 <span
                                                     class="bg-green-300 text-green-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Completed</span>
                                             @endif
                                         </td>
                                         <td class="p-1 whitespace-no-wrap">
                                             @if (in_array($booking->booking_status, ['Pending', 'Cancelled', 'Accepted']))
                                                 <div class="flex justify-around items-center gap-2">
                                                     @include('authModal.editBookingUser')
                                                     @include('authModal.cancelBookingUser')
                                                 </div>
                                             @else
                                                 @if ($booking->booking_status === 'Completed' && $booking->payment_method === 'GCash')
                                                     @if (!empty($booking->gcash_picture))
                                                         @if ($booking->ratings->isNotEmpty())
                                                             <div class="flex justify-center items-center">
                                                                 <button type="button"
                                                                     class="text-white bg-gray-400 font-medium rounded-lg text-xs px-3 py-2 text-center"
                                                                     disabled>
                                                                     Rated
                                                                 </button>
                                                             </div>
                                                         @else
                                                             @include('authModal.ratingUser')
                                                         @endif
                                                     @else
                                                         @include('authModal.gcashUser')
                                                         @if ($booking->ratings->isNotEmpty())
                                                             <div class="flex justify-center items-center">
                                                                 <button type="button"
                                                                     class="text-white bg-gray-400 font-medium rounded-lg text-xs px-3 py-2 text-center"
                                                                     disabled>
                                                                     Rated
                                                                 </button>
                                                             </div>
                                                         @else
                                                             @include('authModal.ratingUser')
                                                         @endif
                                                     @endif
                                                 @else
                                                     @if ($booking->ratings->isNotEmpty())
                                                         <div class="flex justify-center items-center">
                                                             <button type="button"
                                                                 class="text-white bg-gray-400 font-medium rounded-lg text-xs px-3 py-2 text-center"
                                                                 disabled>
                                                                 Rated
                                                             </button>
                                                         </div>
                                                     @else
                                                         @include('authModal.ratingUser')
                                                     @endif
                                                 @endif
                                             @endif
                                             <div class="flex items-center justify-center mt-1">

                                                 <form action="{{ route('booking.print', ['id' => $booking->id]) }}"
                                                     method="GET" target="_blank">
                                                     @csrf
                                                     <button type="submit"
                                                         class="bg-blue-900 text-white text-xs px-3 hover:bg-blue-500 rounded flex gap-2 items-center">
                                                         <svg class="w-3 h-3 text-white dark:text-white"
                                                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                             <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z" />
                                                             <path
                                                                 d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z" />
                                                         </svg>
                                                         Print
                                                     </button>
                                                 </form>
                                             </div>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @else
     <p class="px-4 py-2 bg-red-500 text-white text-center">Please update your profile image to verify your account.
         Click the Update Profile
         Image button at the top-right.</p>
 @endif
 <script>
     const starLabels = document.querySelectorAll('label[id^="star"]');
     const radioButtons = document.querySelectorAll('input[name="rating"]');

     starLabels.forEach((label, index) => {
         label.addEventListener('click', () => {
             radioButtons[index].checked = true;

             // Remove 'bxs-star' class from all stars
             starLabels.forEach((starLabel) => {
                 starLabel.firstElementChild.classList.remove('bxs-star');
                 starLabel.firstElementChild.classList.add('bx-star');
             });

             // Add 'bxs-star' class to selected stars and previous stars
             for (let i = 0; i <= index; i++) {
                 starLabels[i].firstElementChild.classList.remove('bx-star');
                 starLabels[i].firstElementChild.classList.add('bxs-star');
             }
         });
     });
 </script>
 <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
