<div class="sm:ml-64">
    @include('admin.partials.nav')
    <div class="max-w-7xl mx-auto px-2 mt-2">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
            <div class="flex justify-between items-center">
                @include('adminModal.searhFilterPersonnelPrint')
            </div>
            <div class="overflow-x-auto mt-2">
                <form class="flex gap-2 flex-col" action="{{ route('generate.pdfPersonnel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Picture
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Gender
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Age
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Earnings
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Verification
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($personnel as $key => $personnels)
                            <tr class="{{ $key % 2 == 0 ? 'bg-white' : 'bg-gray-100' }} border-b">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input name="selected_booking_id[]" value="{{ $personnels->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if (!empty($personnels->photo))
                                    <img src="{{ "/storage/$personnels->photo" }}" alt="Picture to" class="rounded-full h-8 w-auto">
                                    @else
                                    <img src="{{ asset('backend/assets/images/logo.png') }}" alt="Default Pic" class="rounded-full h-8 w-auto">
                                    @endif
                                </th>
                                <td class="px-6 py-4">
                                    {{ $personnels->first_name }} {{ $personnels->last_name }} <br>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $personnels->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $personnels->phone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $personnels->gender }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $personnels->age }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $personnels->earning }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $personnels->address }} <br>
                                    {{ $personnels->extra_add }}
                                </td>
                                <td class="px-6 py-4">
                                    <button class="flex items-center justify-around w-24 {{ $personnels->isVerified === 'Verified' ? 'bg-gray-500' : 'bg-red-700' }} text-white font-medium px-2 rounded" type="submit" {{ $personnels->isVerified === 'Verified' ? 'disabled' : '' }}>
                                        {{ $personnels->isVerified }}
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-white  border-b">
                                <td colspan="9"></td>
                                <td colspan="1" class=" flex justify-center items-center">
                                    <button type="submit" class="bg-blue-900 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded flex gap-2 items-center">
                                        <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z" />
                                            <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z" />
                                        </svg>
                                        <span>Print</span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the header checkbox and all table row checkboxes
    const checkboxAll = document.getElementById('checkbox-all');
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');

    // Add an event listener to the header checkbox
    checkboxAll.addEventListener('change', function() {
        // Loop through all checkboxes in the table rows and set their checked property
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkboxAll.checked;
        });
    });

    // Add an event listener to each table row checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Check if all checkboxes in the table rows are checked and update the header checkbox accordingly
            let allChecked = true;
            checkboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    allChecked = false;
                }
            });
            checkboxAll.checked = allChecked;
        });
    });
</script>