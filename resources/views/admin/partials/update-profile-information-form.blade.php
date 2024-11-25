<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
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
    <form id="send-verification" method="post" action="{{ route('admin.verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6 flex justify-around  w-full"
        enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="">
            <div class="border-5 border-solid border-dark">
                @if (!empty($admin->photo))
                    <img src="{{ "/storage/$admin->photo" }}" alt="Picture to"
                        class="rounded-full border-2 border-gray-500"
                        style="width: 15.375rem; height: 15.375rem; object-fit:cover; border-radius: 50%; object-position: center;">
                @else
                    <img src="{{ asset('upload/no_image.jpg') }}" alt="Default Profile Picture"
                        class="w-30 h-30 border-2 border-gray-500 rounded-full">
                @endif
            </div>
            <div>
                <x-input-label for="photo" :value="__('Profile Picture')" />
                <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" accept="image/*" />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>

        </div>
        <div class="space-y-6 w-120">

            <!-- Name -->
            <div class="flex w-full gap-2 flex-col sm:flex-row">
                <div>
                    <x-input-label for="firstname" :value="__('First Name')" />
                    <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full"
                        :value="old('firs_name', $admin->firstname)" required autofocus autocomplete="first_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
                </div>
                <div>
                    <x-input-label for="middlename" :value="__('Middle Name')" />
                    <x-text-input id="middlename" name="middlename" type="text" class="mt-1 block w-full"
                        :value="old('middlename', $admin->middlename)" autofocus autocomplete="middle_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                </div>
                <div>
                    <x-input-label for="lastname" :value="__('Last Name')" />
                    <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full"
                        :value="old('lastname', $admin->lastname)" required autofocus autocomplete="last_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
                </div>
            </div>

            <!-- Phone, Age -->
            <div class="flex w-full gap-2 flex-col sm:flex-row">
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                        :value="old('username', $admin->username)" required autofocus autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                </div>
                <div>
                    <x-input-label for="phone" :value="__('Phone Number (Ex. 09XXXXXXXXX)')" />
                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                        :value="old('phone', $admin->phone)" required autofocus autocomplete="phone" />
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>
                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <select id="address" name="address"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                        <option value="Ariston East"
                            {{ old('address', $admin->address) == 'Ariston East' ? 'selected' : '' }}>Ariston East
                        </option>
                        <option value="Ariston West"
                            {{ old('address', $admin->address) == 'Ariston West' ? 'selected' : '' }}>Ariston West
                        </option>
                        <option value="Bantog" {{ old('address', $admin->address) == 'Bantog' ? 'selected' : '' }}>
                            Bantog</option>
                        <option value="Baro" {{ old('address', $admin->address) == 'Baro' ? 'selected' : '' }}>Baro
                        </option>
                        <option value="Bobonan" {{ old('address', $admin->address) == 'Bobonan' ? 'selected' : '' }}>
                            Bobonan</option>
                        <option value="Cabalitian"
                            {{ old('address', $admin->address) == 'Cabalitian' ? 'selected' : '' }}>Cabalitian</option>
                        <option value="Calepaan" {{ old('address', $admin->address) == 'Calepan' ? 'selected' : '' }}>
                            Calepaan</option>
                        <option value="Carosucan Norte"
                            {{ old('address', $admin->address) == 'Carosucan Norte' ? 'selected' : '' }}>Carosucan
                            Norte</option>
                        <option value="Carosucan Sur"
                            {{ old('address', $admin->address) == 'Carosucan Sur' ? 'selected' : '' }}>Carosucan Sur
                        </option>
                        <option value="Coldit" {{ old('address', $admin->address) == 'Coldit' ? 'selected' : '' }}>
                            Coldit</option>
                        <option value="Domanpot"
                            {{ old('address', $admin->address) == 'Domanpot' ? 'selected' : '' }}>Domanpot</option>
                        <option value="Dupac" {{ old('address', $admin->address) == 'Dupac' ? 'selected' : '' }}>
                            Dupac</option>
                        <option value="Macalong"
                            {{ old('address', $admin->address) == 'Macalong' ? 'selected' : '' }}>Macalong</option>
                        <option value="Palaris" {{ old('address', $admin->address) == 'Palaris' ? 'selected' : '' }}>
                            Palaris</option>
                        <option value="Poblacion East"
                            {{ old('address', $admin->address) == 'Poblacion East' ? 'selected' : '' }}>Poblacion East
                        </option>
                        <option value="Poblacion West"
                            {{ old('address', $admin->address) == 'Poblacion West' ? 'selected' : '' }}>Poblacion West
                        </option>
                        <option value="San Vicente East"
                            {{ old('address', $admin->address) == 'San Vicente East' ? 'selected' : '' }}>San Vicente
                            East</option>
                        <option value="San Vicente West"
                            {{ old('address', $admin->address) == 'San Vicente West' ? 'selected' : '' }}>San Vicente
                            West</option>
                        <option value="Sanchez" {{ old('address', $admin->address) == 'Sanchez' ? 'selected' : '' }}>
                            Sanchez</option>
                        <option value="Sobol" {{ old('address', $admin->address) == 'Sobol' ? 'selected' : '' }}>
                            Sobol</option>
                        <option value="Toboy" {{ old('address', $admin->address) == 'Toboy' ? 'selected' : '' }}>
                            Toboy</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>
            </div>

            <!-- Extra Address -->
            <div>
                <x-input-label for="extra_add" :value="__('Extra Address Information')" />
                <textarea name="extra_add" id="extra_add" rows="4"
                    class="mt-1 w-full p-2 border  border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">{{ $admin->extra_add }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('extra_add')" />
            </div>
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $admin->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($admin instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$admin->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
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
