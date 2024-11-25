<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        @include('toastmessage.message2')

        <div class="flex items-center mb-3">
            <div class="flex items-center">
                <img src="{{ asset('backend/assets/images/logo.png') }}" alt="" class="sm:w-10 w-5 sm:h-10 h-5">
                <h2 class="ml-3 sm:text-2xl text-md text-blue-900 font-bold">Home<span class="text-amber-700">Pro</span>
                </h2>
            </div>
        </div>
        <p class="font-black sm:text-xl text-md text-blue-900 mb-3">Registration Form for Homeowner</p>
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
                    <span class=" text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-3 sm:col-span-1">
                <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                    Name
                    <span class="required-text ml-1 text-blue-500">* optional</span>
                </label>
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

                </label>
                <x-text-input type="text" name="phone" id="phone" class="block mt-1 w-full"
                    :value="old('phone')" />
                @error('phone')
                    <span class=" text-red-500 text-sm">{{ $message }}</span>
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

        <div class="flex gap-2 items-center mb-4">
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

        <div class=" grid gap-4 mb-4 grid-cols-4">
            <!-- Province Select -->
            <div class="col-span-4 sm:col-span-1">
                <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Province
                    <span class="required-text ml-1 text-red-500">* required</span>
                </label>
                <select id="province" name="province"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                    <option value="">Select Province</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Municipality Select -->
            <div class="col-span-4 sm:col-span-1">
                <label for="municipality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Municipality
                    <span class="required-text ml-1 text-red-500">* required</span>
                </label>
                <select id="municipality" name="municipality"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                    <option value="">Select Municipality</option>
                    <!-- Municipality options will be populated dynamically using JavaScript -->
                </select>
            </div>

            <!-- Barangay Select -->
            <div class="col-span-4 sm:col-span-1">
                <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Barangay
                    <span class="required-text ml-1 text-red-500">* required</span>
                </label>
                <select id="barangay" name="barangay"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                    <option value="">Select Barangay</option>
                    <!-- Barangay options will be populated dynamically using JavaScript -->
                </select>
            </div>

            <!-- House# / Zone -->
            <div class="col-span-4 sm:col-span-1">
                <label for="extra_add" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    House # / Street
                    <span class="required-text ml-1 text-red-500">* required</span>
                </label>
                <input id="autocomplete" name="extra_add" id="extra_add" placeholder="House # / Street"
                    type="text"
                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-amber-700 dark:focus:border-amber-700 focus:ring-amber-700 dark:focus:ring-amber-700 rounded-md shadow-sm">
                @error('address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Password -->
        <div class="flex gap-2 items-center sm:flex-row flex-col w-full">
            <div class="relative flex-1  w-full">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password"
                    required autocomplete="current-password" />
                <span class="absolute inset-y-12 right-0 pr-3 flex items-center text-lg leading-5"
                    onclick="togglePassword('password', 'password-icon')">
                    <i id="password-icon" class="fa fa-eye"></i>
                </span>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="relative flex-1  w-full">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <span class="absolute inset-y-12 right-0 pr-3 flex items-center text-lg leading-5"
                    onclick="togglePassword('password_confirmation', 'password-icon2')">
                    <i id="password-icon2" class="fa fa-eye"></i>
                </span>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        <div class="flex gap-2 items-center">
            <div class="mt-4 w-ful">
                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Profile Picture
                    <span class="required-text ml-1 text-red-500">* required</span>
                </label> <input
                    class="block w-full  border border-amber-700 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="photo" name="photo" type="file" class="mt-1 block w-full" accept="image/*">
                @error('photo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4 w-ful">
                <label for="validID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white relative">
                    Valid ID Picture
                    <span class="required-text ml-1 text-red-500">* required</span>
                </label> <input
                    class="block w-full border border-amber-700 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="validID" name="validID" type="file" class="mt-1 block w-full" accept="image/*">
                @error('validID')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="mt-4">
            <label for="accepted_terms" class="flex items-start justify-start gap-2">
                <input type="checkbox" id="accepted_terms" name="accepted_terms"
                    class="form-checkbox h-4 w-4 text-blue-900">
                <span class="text-xs text-gray-500 font-bold">I am 18 years of age and agree to the terms of the
                    <span class="text-blue-500 underline">HomePro Subscriber Agreement
                    </span> and the <span class="text-blue-500 underline">HomePro Privacy Policy</span>.
                </span>
            </label>
            @error('accepted_terms')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered? Login') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <div class="flex flex-col items-center justify-center">

            <p class="font-black my-5">OR</p>

            <button
                class="inline-flex items-center px-4 sm:py-2 py-1 bg-amber-700 dark:bg-amber-900 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs
                text-white dark:text-white uppercase tracking-widest shadow-sm hover:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-amber-700 disabled:opacity-25 transition ease-in-out duration-150"><a
                    href="{{ route('personnel.register') }}">Register as Service
                    Personnel</a></button>
        </div>
    </form>
</x-guest-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

<script>
    function togglePassword(fieldId, iconId) {
        const passwordField = document.getElementById(fieldId);
        const passwordIcon = document.getElementById(iconId);
        const isPassword = passwordField.type === 'password';
        passwordField.type = isPassword ? 'text' : 'password';
        passwordIcon.className = isPassword ? 'fa fa-eye-slash' : 'fa fa-eye';
    }

    $(document).ready(function() {
        $('#province').change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('fetch.municipalities') }}",
                    data: {
                        province_id: provinceId
                    },
                    success: function(res) {
                        if (res) {
                            $('#municipality').empty();
                            $('#municipality').append(
                                '<option value="">Select Municipality</option>');
                            $.each(res, function(key, value) {
                                $('#municipality').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        } else {
                            $('#municipality').empty();
                        }
                    }
                });
            } else {
                $('#municipality').empty();
                $('#barangay').empty();
            }
        });

        $('#municipality').change(function() {
            var municipalityId = $(this).val();
            if (municipalityId) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('fetch.barangays') }}",
                    data: {
                        municipality_id: municipalityId
                    },
                    success: function(res) {
                        if (res) {
                            $('#barangay').empty();
                            $('#barangay').append(
                                '<option value="">Select Barangay</option>');
                            $.each(res, function(key, value) {
                                $('#barangay').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        } else {
                            $('#barangay').empty();
                        }
                    }
                });
            } else {
                $('#barangay').empty();
            }
        });
    });
</script>
