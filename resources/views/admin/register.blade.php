<x-guest-layout>
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div class="flex items-center mb-3">
            <div class="flex items-center">
                <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" class="sm:w-10 w-5 sm:h-10 h-5">
                <h2 class="ml-3 sm:text-2xl text-md text-blue-900 font-bold">Home<span class="text-amber-700">Pro</span>
                </h2>
            </div>
        </div>
        <p class="font-black sm:text-xl text-md text-blue-900 mb-3">Registration Form</p>
        <!-- Name -->
        <div class="flex flex-col justify-between gap-1 sm:flex-row">
            <div class="flex-1">
                <x-input-label for="firstname" :value="__('First Name')" />
                <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"
                    required autofocus autocomplete="firstname" />
                @error('firstname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-1">
                <x-input-label for="middlename" :value="__('Middle Name')" />
                <x-text-input id="middlename" class="block mt-1 w-full" type="text" name="middlename"
                    :value="old('middlename')" autofocus autocomplete="middlename" />
                @error('middle_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-1">
                <x-input-label for="lastname" :value="__('Last Name')" />
                <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                    required autofocus autocomplete="lastname" />
                @error('lastname')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex flex-col justify-between gap-1 sm:flex-row mt-4">
            <div class="flex-1">
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                    required autofocus autocomplete="username" />
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex-1">
                <x-input-label for="gender" :value="__('Gender')" />
                <div class="flex space-x-1 border-2 border-gray-300 mt-1 rounded-md shadow-sm px-1 py-1.5">
                    <div class="flex items-center gap-1">
                        <input type="radio" id="male" name="gender" value="male"
                            class="form-radio text-blue-500" />
                        <label for="male" class="text-gray-700 dark:text-white">Male</label>
                    </div>
                    <div class="flex items-center gap-1">
                        <input type="radio" id="female" name="gender" value="female"
                            class="form-radio text-pink-500" />
                        <label for="female" class="text-gray-700 dark:text-white">Female</label>
                    </div>
                    <div class="flex items-center  gap-1">
                        <input type="radio" id="other" name="gender" value="other"
                            class="form-radio text-purple-500" />
                        <label for="other" class="text-gray-700 dark:text-white">Other</label>
                    </div>
                    @error('gender')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex-1">
                <x-input-label for="address" :value="__('Address')" />
                <select id="address" name="address"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                    <option>Select Address</option>
                    <option value="Ariston East">Ariston East</option>
                    <option value="Ariston West">Ariston West</option>
                    <option value="Bantog">Bantog</option>
                    <option value="Baro">Baro</option>
                    <option value="Bobonan">Bobonan</option>
                    <option value="Cabalitian">Cabalitian</option>
                    <option value="Calepaan">Calepaan</option>
                    <option value="Carosucan Norte">Carosucan Norte</option>
                    <option value="Carosucan Sur">Carosucan Sur</option>
                    <option value="Coldit">Coldit</option>
                    <option value="Domanpot">Domanpot</option>
                    <option value="Dupac">Dupac</option>
                    <option value="Macalong">Macalong</option>
                    <option value="Palaris">Palaris</option>
                    <option value="Poblacion East">Poblacion East</option>
                    <option value="Poblacion West">Poblacion West</option>
                    <option value="San Vicente East">San Vicente East</option>
                    <option value="San Vicente West">San Vicente West</option>
                    <option value="Sanchez">Sanchez</option>
                    <option value="Sobol">Sobol</option>
                    <option value="Toboy">Toboy</option>
                </select>
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="flex flex-col justify-between gap-1 sm:flex-row mt-4">

            <!-- Phone Number -->
            <div class="flex-1">
                <x-input-label for="phone" :value="__('Phone Number ( Ex 09XXXXXXXXX )')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                    :value="old('phone')" required autocomplete="phone" />
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="flex-1">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="email" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('admin.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
