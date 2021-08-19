<div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
    <nav class="flex items-center justify-between text-xs text-gray-400 mb-4">
        <ul class="flex uppercase font-bold border-b-4 pb-2 space-x-10">
            <li>
                <a wire:click="$set('show', true)" href="#"
                    class="transition duration-150 ease-in border-b-4 pb-2 hover:border-blue @if ($show) border-blue text-gray-900 @endif ">
                    Suggestions
                </a>
            </li>
            <li>
                <a wire:click="$set('show', false)" href="#"
                    class="transition duration-150 ease-in border-b-4 pb-2 hover:border-blue @if (! $show) border-blue text-gray-900 @endif">
                    Comments
                </a>
            </li>
        </ul>
    </nav> <!-- end nav -->
    @if ($show)
        <livewire:suggestion-moderate
            :board="$board"
        />
    @else
        <livewire:comment-moderate
            :board="$board"
        />
    @endif
</div>
