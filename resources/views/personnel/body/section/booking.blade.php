<div class="sm:ml-64">
    @include('personnel.partials.nav')
    <div class="max-w-7xl mx-auto px-2 mt-2">
        @if (Auth::guard('personnel')->user()->isVerified === 'Verified')
            @include('personnel.body.section.parts.bookingList')
        @else
            <p class="px-4 py-2 bg-red-500 text-white text-center">You are not verified yet. Click the Not Verified
                button at the top and upload a valid id and upload nbi clearance. And wait for the admin to verify your
                account. <br>
                Then update your profile image</p>
        @endif
    </div>
</div>
