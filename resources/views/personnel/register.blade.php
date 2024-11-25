<x-guest-layout>
    <form method="POST" action="{{ route('personnel.register') }}">
        @csrf
        <div class="flex items-center mb-3">
            <div class="flex items-center">
                <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" class="sm:w-10 w-5 sm:h-10 h-5">
                <h2 class="ml-3 sm:text-2xl text-md text-blue-900 font-bold">Home<span class="text-amber-700">Pro</span>
                </h2>
            </div>
        </div>
        <p class="font-black sm:text-xl text-md text-blue-900 mb-3">Registration Form for Service Personnel</p>

        <!-- Name -->
        <div class=" grid gap-4 mb-4 grid-cols-3">
            <div class="col-span-3 sm:col-span-1">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    First Name
                    <span class="required-text ml-1 text-red-500">* required</span>
                </label>
                <x-text-input type="text" name="first_name" id="first_name" class="block mt-1 w-full"
                    :value="old('first_name')" />
                @error('first_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1">
                <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                    Name</label>
                <x-text-input type="text" name="middle_name" id="middle_name" class="block mt-1 w-full"
                    :value="old('middle_name')" />
                @error('middle_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-3 sm:col-span-1">
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Last Name
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <x-text-input type="text" name="last_name" id="last_name" class="block mt-1 w-full"
                    :value="old('last_name')" />
                @error('last_name')
                    <span class=" text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Phone Number
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label> <x-text-input type="text" name="phone" id="phone" class="block mt-1 w-full"
                    :value="old('phone')" />
                @error('phone')
                    <span class=" text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1">
                <label for="isGCash" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Have Gcash?
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <select name="isGCash" id="isGCash"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="">Select</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                </select>
                @error('service_cat')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1">
                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Birthday
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <x-text-input type="date" name="birthday" id="birthday" class="block mt-1 w-full"
                    :value="old('birthday')" />
                @error('birthday')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <input type="hidden" name="age" id="hidden_age" />

            <div class="col-span-3 sm:col-span-1">
                <label for="service_cat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Service Category
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <select name="service_cat" id="service_cat"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="">Select Service</option>
                    <option value="Carpentry">Carpentry</option>
                    <option value="Construction">Construction</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Plumbing">Plumbing</option>
                    <option value="Housekeeping">Housekeeping</option>
                    <option value="Gardening">Gardening</option>
                    <option value="Laundry">Laundry</option>
                    <option value="Manicure and Pedicure">Manicure and Pedicure</option>
                    <option value="Babysitter">Babysitter</option>
                    <option value="Physical Therapy">Physical Therapy</option>
                    <option value="Hair & Makeup">Hair & Makeup</option>
                    <option value="Barber">Barber</option>
                    <option value="Tutor">Tutor</option>
                    <option value="Cook">Cook</option>
                    <option value="Tailoring and Sewing">Tailoring and Sewing</option>
                    <option value="Fitness Training">Fitness Training</option>
                    <option value="Furniture Assembly and Repair">Furniture Assembly and Repair</option>
                    <option value="Pet Care and Grooming">Pet Care and Grooming</option>
                    <option value="Pest Control">Pest Control</option>
                    <option value="Appliance Repair">Appliance Repair</option>
                    <option value="Computer Technician">Computer Technician</option>
                </select>
                @error('service_cat')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1">
                <label for="fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Fee
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label> <x-text-input type="text" name="fee" id="fee" class="block mt-1 w-full"
                    :value="old('fee')" />
                @error('fee')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-3 sm:col-span-1">
                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Gender
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <select name="gender" id="gender"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5">
                    <option>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Others</option>
                </select>
                @error('gender')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex gap-2 items-center">
            <div class="w-full">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Address
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <x-text-input type="text" id="address" name="address"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm" />
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="w-full">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Email
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <x-text-input type="email" name="email" id="email" class="block mt-1 w-full"
                    :value="old('email')" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Password -->
        <div class="flex gap-2 items-center">
            <div class="mt-4 w-full">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Password
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 w-full">
                <label for="password_confirmation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Confirm Password
                    <span class="required-text ml-1 text-red-500">* required</span>

                </label>
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mt-4">
            <label for="terms" class="flex items-start justify-start gap-2">
                <input type="checkbox" id="terms" name="terms" class="form-checkbox h-4 w-4 text-blue-900">
                <span class="text-xs text-gray-500 font-bold">I am 18 years of age and agree to the terms of the
                    <span class="text-blue-500 underline">HomePro Subscriber Agreement
                    </span> and the <span class="text-blue-500 underline">HomePro Privacy Policy</span>.
                </span>
            </label>
            @error('terms')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('personnel.login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <div class="flex flex-col items-center justify-center">

        <p class="font-black my-5">OR</p>

        <button
            class="inline-flex items-center px-4 sm:py-2 py-1 bg-amber-700 dark:bg-amber-900 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs
                text-white dark:text-white uppercase tracking-widest shadow-sm hover:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-amber-700 disabled:opacity-25 transition ease-in-out duration-150"><a
                href="{{ route('register') }}">Register as
                Homeowner</a></button>
    </div>
</x-guest-layout>
