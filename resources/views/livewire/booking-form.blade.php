<form wire:submit.prevent="store" enctype="multipart/form-data">
    @csrf
    <input type="hidden" wire:model="personnelId" value="{{ $personnelId }}">

    <div class="mb-4">
        <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="work_details">Work to be
            done</x-input-label>
        <textarea wire:model="workDetails" class="w-full p-2 border rounded" id="work_details" rows="3" required></textarea>
        @error('workDetails')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="picture_details">Work to be done
            picture</x-input-label>
        <input wire:model="pictureDetails" type="file" class="w-full p-2 border rounded" id="picture_details"
            name="picture_details[]" required multiple>
        @error('pictureDetails')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="service_date">Schedule</x-input-label>
        <input wire:model="serviceDate" class="w-full p-2 border rounded" type="datetime-local" id="service_date"
            name="service_date" required>
        @error('serviceDate')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <x-input-label class="block text-gray-700 text-sm font-bold mb-2" for="payment_method">Payment
            Method</x-input-label>
        <select wire:model="paymentMethod" class="w-full p-2 border rounded" id="payment_method" name="payment_method"
            required>
            <option value="">Select Payment Method</option>
            <option value="Cash On Hand">Cash On Hand</option>
            @if ($personnel->isGCash === 'YES')
                <option value="GCash">GCash</option>
            @else
                <option value=""></option>
            @endif
        </select>
        @error('paymentMethod')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-between">
        <button type="button" class="bg-red-500 hover:bg-red-300 text-white font-bold py-2 px-4 rounded">
            <a href="{{ route('available.personnel') }}">Cancel</a>
        </button>
        <button type="submit" class="bg-blue-900 hover:bg-primary-half text-white font-bold py-2 px-4 rounded"
            wire:target="store" wire:loading.attr="disabled" wire:loading.remove>
            Proceed
        </button>
    </div>
    <div wire:loading wire:target="store">
        <img src="{{ asset('/upload/loading.gif') }}" alt="" width="100">
    </div>
</form>
