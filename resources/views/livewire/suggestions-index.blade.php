<div>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-1/3">
            <select wire:model="filter" name="otherFilters" id="otherFilters" class="w-full rounded-xl border-none font-semibold px-4 py-2">
                <option value="no_filter">No Filter</option>
                <option value="top_voted">Top Voted</option>
                <option value="my_suggestions">My Suggestions</option>
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <input type="search" placeholder="Find a suggestion" class="w-full rounded-xl bg-white border-none font-semibold pl-9 py-2 placeholder-gray-900">
            <div class="absolute top-0 flex items-center h-full pl-3">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div> <!-- end filters -->

    <div class="suggestions-container space-y-6 my-6">
        @foreach ($suggestions as $suggestion)
            <livewire:suggestion-index
                :key="$suggestion->id"
                :suggestion="$suggestion"
                :votesCount="$suggestion->votes_count"
                :urlName="$urlName"
            />
        @endforeach
    </div> <!-- end suggestions container -->
    <div class="mb-6">
        {{-- {{ $suggestions->links() }} --}}
        {{ $suggestions->appends(request()->query())->links() }}
    </div>
</div>
