    <div class="h-full px-3 py-1 overflow-y-auto flex justify-center w-full">
        <div class="flex justify-between w-full">
            <div class="flex gap-4 w-1/2">
                <form class="flex items-center gap-1 w-full" action="{{ route('searchPersonnelAdmin') }}" method="GET">
                    <label for="searchStock" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <input type="text" id="searchBorrow" name="searchBorrow" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  " placeholder="Search here..." required>

                    </div>
                    <button type="submit" class="py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-900 rounded-lg border hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>