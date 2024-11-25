<div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0 md:px-4 px-2">
    <h2 class="text-blue-900 text-lg sm:text-3xl mb-1 font-bold">Contact <span class="text-amber-700">Us</span></h2>
    <form wire:submit.prevent="send" method="POST">
        @csrf
        <div class="relative mb-4">
            <label for="name" class="leading-7 text-sm text-gray-600">Your Name</label>
            <input type="text" id="name" wire:model="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-amber-700 focus:ring-2 focus:ring-amber-700 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            @error('name')
            <div class="bg-red-200 text-red-600 p-2 mt-1">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="relative mb-4">
            <label for="email" class="leading-7 text-sm text-gray-600">Your Email</label>
            <input type="email" id="email" wire:model="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-amber-700 focus:ring-2 focus:ring-amber-700 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            @error('email')
            <div class="bg-red-200 text-red-600 p-2 mt-1">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="relative mb-4">
            <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
            <textarea id="message" wire:model="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-amber-700 focus:ring-2 focus:ring-amber-700 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
            @error('message')
            <div class="bg-red-200 text-red-600 p-2 mt-1">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div wire:loading wire:targe="send">
            <img src="{{ asset('/upload/loading.gif') }}" alt="" width="100">
        </div>
        <button class="text-white bg-blue-900 border-0 py-2 px-6 focus:outline-none hover:bg-amber-700 rounded text-lg" type="submit" wire:target="send" wire:loading.attr="disabled" wire:loading.remove>Send</button>
    </form>
</div>