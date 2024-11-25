<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-blue-900 dark:text-gray-100">
            {{ __('Profile Image') }}
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

    <div class="flex flex-col items-center">
        @if (!empty($user->photo))
            <div class="border-5 border-solid border-dark">
                <img class="rounded-full mt-3 border-3 border-solid border-amber-700"
                    src="{{ "/storage/$user->photo" }}" alt="profile"
                    style="width: 15.375rem; height: 15.375rem; object-fit:cover; border-radius: 50%; object-position: center;">
            </div>
        @else
            <img src="{{ asset('upload/no_image.jpg') }}" alt="Default Profile Picture"
                class="w-10 h-10 border-2 border-gray-500 rounded-full"
                style="width: 15.375rem; height: 15.375rem; object-fit:cover; border-radius: 50%; object-position: center;">
        @endif
        <form method="post" action="{{ route('profile.update.image') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Select profile image in your device.') }}
            </p>
            <div>
                <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" :value="old('photo', $user->photo)"
                    required autofocus autocomplete="photo" />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>

            <div class="flex items-center gap-4 mt-5 justify-end">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>

</section>
