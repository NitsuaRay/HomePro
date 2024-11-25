<section class="text-gray-600 body-font" id="services">
    <div class="container px-5 py-12 mx-auto">
        <div class="w-full mb-6 lg:mb-0 text-center mt-4">
            <h1 class="sm:text-3xl text-4xl font-bold title-font mb-2 text-blue-900">Our <span
                    class="text-amber-700">Services</span></h1>
        </div>
        <div class="flex flex-wrap -m-4 px-8">
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 px-2 py-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/carpentry.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Carpentry</h2>
                    @if ($topCarpenter)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $topCarpenter->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($topCarpenter->photo) ? asset('storage/' . $topCarpenter->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $topCarpenter->first_name }}
                                    {{ $topCarpenter->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 px-2 py-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/construction.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Construction</h2>
                    @if ($topConstruction)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $topConstruction->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($topConstruction->photo) ? asset('storage/' . $topConstruction->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $topConstruction->first_name }}
                                    {{ $topConstruction->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 px-2 py-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/plumbing.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Plumbing</h2>
                    @if ($Plumbing)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Plumbing->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Plumbing->photo) ? asset('storage/' . $Plumbing->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Plumbing->first_name }}
                                    {{ $Plumbing->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 px-2 py-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/electrical.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font ">Electrical</h2>
                    @if ($Electrical)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Electrical->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Electrical->photo) ? asset('storage/' . $Electrical->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Electrical->first_name }}
                                    {{ $Electrical->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/gardening.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Gardening</h2>
                    @if ($Gardening)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Gardening->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Gardening->photo) ? asset('storage/' . $Gardening->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Gardening->first_name }}
                                    {{ $Gardening->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/housue.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Housekeeping</h2>
                    @if ($Housekeeping)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Housekeeping->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Housekeeping->photo) ? asset('storage/' . $Housekeeping->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Housekeeping->first_name }}
                                    {{ $Housekeeping->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/laundry.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Laundry</h2>
                    @if ($Laundry)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Laundry->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Laundry->photo) ? asset('storage/' . $Laundry->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Laundry->first_name }}
                                    {{ $Laundry->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/manicure.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Manicure and Pedicure</h2>
                    @if ($ManicureandPedicure)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $ManicureandPedicure->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($ManicureandPedicure->photo) ? asset('storage/' . $ManicureandPedicure->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $ManicureandPedicure->first_name }}
                                    {{ $ManicureandPedicure->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/nanngy.png') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Babysitter</h2>
                    @if ($Babysitter)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Babysitter->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Babysitter->photo) ? asset('storage/' . $Babysitter->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Babysitter->first_name }}
                                    {{ $Babysitter->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/therapist.png') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Physical Therapy</h2>
                    @if ($Therapy)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Therapy->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Therapy->photo) ? asset('storage/' . $Therapy->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Therapy->first_name }}
                                    {{ $Therapy->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/hairandmakeup.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Hair & Makeup</h2>
                    @if ($HMWA)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $HMWA->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($HMWA->photo) ? asset('storage/' . $HMWA->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $HMWA->first_name }}
                                    {{ $HMWA->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/barber.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Barber</h2>
                    @if ($Barber)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Barber->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Barber->photo) ? asset('storage/' . $Barber->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Barber->first_name }}
                                    {{ $Barber->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/tutor.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Tutor</h2>
                    @if ($Tutor)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Tutor->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Tutor->photo) ? asset('storage/' . $Tutor->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Tutor->first_name }}
                                    {{ $Tutor->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/cook.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Cook</h2>
                    @if ($topRatedCookPersonnel)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $topRatedCookPersonnel->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($topRatedCookPersonnel->photo) ? asset('storage/' . $topRatedCookPersonnel->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $topRatedCookPersonnel->first_name }}
                                    {{ $topRatedCookPersonnel->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/tailor.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Tailoring and Sewing</h2>
                    @if ($Tailor)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $Tailor->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($Tailor->photo) ? asset('storage/' . $Tailor->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $Tailor->first_name }}
                                    {{ $Tailor->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/fitness.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Fitness Training</h2>
                    @if ($fitness)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $fitness->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($fitness->photo) ? asset('storage/' . $fitness->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $fitness->first_name }}
                                    {{ $fitness->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/furniture.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Furniture Assembly and Repair</h2>
                    @if ($furniture)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $furniture->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($furniture->photo) ? asset('storage/' . $furniture->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $furniture->first_name }}
                                    {{ $furniture->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/pet.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Pet Care and Grooming</h2>
                    @if ($topRatedPCGPersonnel)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $topRatedPCGPersonnel->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($topRatedPCGPersonnel->photo) ? asset('storage/' . $topRatedPCGPersonnel->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $topRatedPCGPersonnel->first_name }}
                                    {{ $topRatedPCGPersonnel->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/pest.png') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Pest Control</h2>
                    @if ($pest)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $pest->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($pest->photo) ? asset('storage/' . $pest->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $pest->first_name }}
                                    {{ $pest->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
            <div class="xl:w-1/4 md:w-1/2 p-4">
                <div class="bg-gray-100 p-6 rounded-lg aspect-w-16 aspect-h-9">
                    <img class="h-full rounded w-full object-cover object-center mb-6 sm:h-40"
                        src="{{ asset('backend/assets/images/appliance.jpg') }}" alt="content">
                    <h2 class="text-lg text-blue-900 font-medium title-font">Appliance Repair</h2>
                    @if ($appliance)
                        <!-- Display star icons based on the average rating -->
                        @php
                            $averageRating = $appliance->average_rating ?? 0;
                            $totalStars = 5; // Total number of stars
                            $filledStars = (int) $averageRating; // Number of filled stars (integer part)
                            $hasHalfStar = $averageRating - $filledStars >= 0.5; // Check if there's a half star
                        @endphp
                        <h3>Top Rated Personnel</h3>
                        <div class="flex gap-2">
                            <div>
                                <img src="{{ !empty($appliance->photo) ? asset('storage/' . $appliance->photo) : url('upload/no_image.jpg') }}"
                                    alt="Personnel Image" class="w-24 h-auto rounded-lg">
                            </div>
                            <div>
                                <p>{{ $appliance->first_name }}
                                    {{ $appliance->last_name }}</p>
                                <p class="flex gap-2">{{ number_format($averageRating, 1) }}
                                    @for ($i = 1; $i <= $totalStars; $i++)
                                        @if ($i <= $filledStars)
                                            <!-- Filled star -->
                                            <i class='bx bxs-star  text-yellow-500'></i>
                                        @elseif ($hasHalfStar && $i === $filledStars + 1)
                                            <!-- Half-filled star -->
                                            <i class='bx bxs-star-half text-yellow-500'></i>
                                        @else
                                            <!-- Non-filled star -->
                                            <i class='bx bx-star text-yellow-500'></i>
                                        @endif
                                    @endfor
                                </p>
                                <a href="{{ route('available.personnel') }}"
                                    class="inline-flex text-white bg-blue-900 border-0 py-2 px-3 focus:outline-none hover:bg-amber-700 rounded text-sm">Book
                                    Now</a>
                            </div>
                        </div>
                    @else
                        <p></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
