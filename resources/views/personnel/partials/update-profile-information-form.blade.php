<section class="w-full">
    <header>
        <h2 class="text-lg font-bold text-blue-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
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
    </header>

    <form method="post" action="{{ route('personnel.profile.update') }}" class="mt-3 space-y-3 flex gap-6 w-full"
        enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="w-1/3">
            <div class="border-5 border-solid border-dark">
                @if (!empty($personnel->photo))
                    <img src="{{ "/storage/$personnel->photo" }}" alt="Picture to"
                        class="rounded-full border-2 border-gray-500"
                        style="width: 15.375rem; height: 15.375rem; object-fit:cover; border-radius: 50%; object-position: center;">
                @else
                    <img src="{{ asset('upload/no_image.jpg') }}" alt="Default Profile Picture"
                        class="w-30 h-30 border-2 border-gray-500 rounded-full">
                @endif
            </div>
            <div class="mt-3 ">
                <x-input-label for="photo" :value="__('Profile Picture')" />
                <x-text-input id="photo" name="photo" type="file" class="block w-full" accept="image/*" />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>

            <div class="mt-3">
                <x-input-label for="service_cat" :value="__('Service Category')" />
                <select id="service_cat" name="service_cat"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                    <option value="Carpentry"
                        {{ old('service_cat', $personnel->service_cat) == 'Carpentry' ? 'selected' : '' }}>Carpentry
                    </option>
                    <option value="Construction"
                        {{ old('service_cat', $personnel->service_cat) == 'Construction' ? 'selected' : '' }}>
                        Construction</option>
                    <option value="Electrical"
                        {{ old('service_cat', $personnel->service_cat) == 'Electrical' ? 'selected' : '' }}>Electrical
                    </option>
                    <option value="Plumbing"
                        {{ old('service_cat', $personnel->service_cat) == 'Plumbing' ? 'selected' : '' }}>Plumbing
                    </option>
                    <option value="Cleaning"
                        {{ old('service_cat', $personnel->service_cat) == 'Cleaning' ? 'selected' : '' }}>Cleaning
                    </option>
                    <option value="Housekeeping"
                        {{ old('service_cat', $personnel->service_cat) == 'Housekeeping' ? 'selected' : '' }}>
                        Housekeeping</option>
                    <option value="Gardening"
                        {{ old('service_cat', $personnel->service_cat) == 'Gardening' ? 'selected' : '' }}>Gardening
                    </option>
                    <option value="Laundry"
                        {{ old('service_cat', $personnel->service_cat) == 'Laundry' ? 'selected' : '' }}>Laundry
                    </option>
                    <option value="Manicure and Pedicur"
                        {{ old('service_cat', $personnel->service_cat) == 'Manicure and Pedicur' ? 'selected' : '' }}>
                        Manicure and Pedicur</option>
                    <option value="Computer Technician"
                        {{ old('service_cat', $personnel->service_cat) == 'Computer Technician' ? 'selected' : '' }}>
                        Computer Technician</option>
                    <option value="Babysitter"
                        {{ old('service_cat', $personnel->service_cat) == 'Babysitter' ? 'selected' : '' }}>Babysitter
                    </option>
                    <option value="Physical Therapy"
                        {{ old('service_cat', $personnel->service_cat) == 'Physical Therapy' ? 'selected' : '' }}>
                        Physical Therapy</option>
                    <option value="Hair & Makeup"
                        {{ old('service_cat', $personnel->service_cat) == 'Hair & Makeup' ? 'selected' : '' }}>Hair &
                        Makeup</option>
                    <option value="Barber"
                        {{ old('service_cat', $personnel->service_cat) == 'Barber' ? 'selected' : '' }}>Barber</option>
                    <option value="Tutor"
                        {{ old('service_cat', $personnel->service_cat) == 'Tutor' ? 'selected' : '' }}>Tutor</option>
                    <option value="Cook"
                        {{ old('service_cat', $personnel->service_cat) == 'Cook' ? 'selected' : '' }}>Cook</option>
                    <option value="Tailoring and Sewing"
                        {{ old('service_cat', $personnel->service_cat) == 'Tailoring and Sewing' ? 'selected' : '' }}>
                        Tailoring and Sewing</option>
                    <option value="Fitness Training"
                        {{ old('service_cat', $personnel->service_cat) == 'Fitness Training' ? 'selected' : '' }}>
                        Fitness Training</option>
                    <option value="Furniture Assembly and Repair"
                        {{ old('service_cat', $personnel->service_cat) == 'Furniture Assembly and Repair' ? 'selected' : '' }}>
                        Furniture Assembly and Repair</option>
                    <option value="Pet Care and Grooming"
                        {{ old('service_cat', $personnel->service_cat) == 'Pet Care and Grooming' ? 'selected' : '' }}>
                        Pet Care and Grooming</option>
                    <option value="Pest Control"
                        {{ old('service_cat', $personnel->service_cat) == 'Pest Control' ? 'selected' : '' }}>Pest
                        Control</option>
                    <option value="Appliance Repair"
                        {{ old('service_cat', $personnel->service_cat) == 'Appliance Repair' ? 'selected' : '' }}>
                        Appliance Repair</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('service_cat')" />
            </div>
            <div class="mt-3">
                <x-input-label for="description" :value="__('Additional Skill')" />
                <select id="description" name="description"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                    <option value="">Add Additional Skill</option>
                    <option value="Carpentry"
                        {{ old('description', $personnel->description) == 'Carpentry' ? 'selected' : '' }}>Carpentry
                    </option>
                    <option value="Construction"
                        {{ old('description', $personnel->description) == 'Construction' ? 'selected' : '' }}>
                        Construction</option>
                    <option value="Electrical"
                        {{ old('description', $personnel->description) == 'Electrical' ? 'selected' : '' }}>Electrical
                    </option>
                    <option value="Plumbing"
                        {{ old('description', $personnel->description) == 'Plumbing' ? 'selected' : '' }}>Plumbing
                    </option>
                    <option value="Cleaning"
                        {{ old('description', $personnel->description) == 'Cleaning' ? 'selected' : '' }}>Cleaning
                    </option>
                    <option value="Housekeeping"
                        {{ old('description', $personnel->description) == 'Housekeeping' ? 'selected' : '' }}>
                        Housekeeping</option>
                    <option value="Gardening"
                        {{ old('description', $personnel->description) == 'Gardening' ? 'selected' : '' }}>Gardening
                    </option>
                    <option value="Laundry"
                        {{ old('description', $personnel->description) == 'Laundry' ? 'selected' : '' }}>Laundry
                    </option>
                    <option value="Manicure and Pedicur"
                        {{ old('description', $personnel->description) == 'Manicure and Pedicur' ? 'selected' : '' }}>
                        Manicure and Pedicur</option>
                    <option value="Computer Technician"
                        {{ old('description', $personnel->description) == 'Computer Technician' ? 'selected' : '' }}>
                        Computer Technician</option>
                    <option value="Babysitter"
                        {{ old('description', $personnel->description) == 'Babysitter' ? 'selected' : '' }}>Babysitter
                    </option>
                    <option value="Physical Therapy"
                        {{ old('description', $personnel->description) == 'Physical Therapy' ? 'selected' : '' }}>
                        Physical Therapy</option>
                    <option value="Hair & Makeup"
                        {{ old('description', $personnel->description) == 'Hair & Makeup' ? 'selected' : '' }}>Hair &
                        Makeup</option>
                    <option value="Barber"
                        {{ old('description', $personnel->description) == 'Barber' ? 'selected' : '' }}>Barber</option>
                    <option value="Tutor"
                        {{ old('description', $personnel->description) == 'Tutor' ? 'selected' : '' }}>Tutor</option>
                    <option value="Cook"
                        {{ old('description', $personnel->description) == 'Cook' ? 'selected' : '' }}>Cook</option>
                    <option value="Tailoring and Sewing"
                        {{ old('description', $personnel->description) == 'Tailoring and Sewing' ? 'selected' : '' }}>
                        Tailoring and Sewing</option>
                    <option value="Fitness Training"
                        {{ old('description', $personnel->description) == 'Fitness Training' ? 'selected' : '' }}>
                        Fitness Training</option>
                    <option value="Furniture Assembly and Repair"
                        {{ old('description', $personnel->description) == 'Furniture Assembly and Repair' ? 'selected' : '' }}>
                        Furniture Assembly and Repair</option>
                    <option value="Pet Care and Grooming"
                        {{ old('description', $personnel->description) == 'Pet Care and Grooming' ? 'selected' : '' }}>
                        Pet Care and Grooming</option>
                    <option value="Pest Control"
                        {{ old('description', $personnel->description) == 'Pest Control' ? 'selected' : '' }}>Pest
                        Control</option>
                    <option value="Appliance Repair"
                        {{ old('description', $personnel->description) == 'Appliance Repair' ? 'selected' : '' }}>
                        Appliance Repair</option>
                </select> <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
        </div>
        <div class="space-y-4 w-5/6">
            <div class="flex w-full gap-2 flex-col sm:flex-row">
                <div class="flex-1">
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                        :value="old('first_name', $personnel->first_name)" required autofocus autocomplete="first_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>
                <div class="flex-1">
                    <x-input-label for="middle_name" :value="__('Middle Name')" />
                    <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full"
                        :value="old('middle_name', $personnel->middle_name)" autofocus autocomplete="middle_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                </div>
                <div class="flex-1">
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                        :value="old('last_name', $personnel->last_name)" required autofocus autocomplete="last_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                </div>
            </div>
            <input type="hidden" name="age" id="hidden_age" />

            <div class="flex w-full gap-2 flex-col sm:flex-row">
                <div class="flex-1">
                    <x-input-label for="phone" :value="__('Phone Number (Ex. 09XXXXXXXXX)')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                        :value="old('phone', $personnel->phone)" required autofocus autocomplete="phone" />
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>
                <div class="flex-1">
                    <x-input-label for="birthday" :value="__('Birthday')" />
                    <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"
                        :value="old('birthday', $personnel->birthday)" required autofocus autocomplete="birthday" />
                    <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                </div>
                <div class="flex-1">
                    <x-input-label for="fee" :value="__('Fee')" />
                    <x-text-input id="fee" name="fee" type="text" class="mt-1 block w-full"
                        :value="old('fee', $personnel->fee)" required autofocus autocomplete="fee" />
                    <x-input-error class="mt-2" :messages="$errors->get('fee')" />
                </div>

            </div>
            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                    :value="old('address', $personnel->address)" required autofocus autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $personnel->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div>
                <x-input-label for="extra_add" :value="__('Landmark/Location')" />
                <textarea name="extra_add" id="extra_add" rows="2"
                    class="mt-1 w-full p-2 border  border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">{{ $personnel->extra_add }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('extra_add')" />
            </div>
            <div>
                <x-input-label for="extra_add_picture" :value="__('Landmark/Location Picture')" />
                <x-text-input id="extra_add_picture" name="extra_add_picture" type="file"
                    class="mt-1 block w-full" accept="image/*" />
                <x-input-error class="mt-2" :messages="$errors->get('extra_add_picture')" />
            </div>


            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
    </form>
</section>
