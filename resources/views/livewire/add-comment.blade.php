<div
    x-cloak
    x-data="{ isOpen: false }"
    x-init="
        window.livewire.on('commentWasAdded', () => {
            isOpen = false
        })
    "
    class="relative"
>
    <button @click="isOpen = !isOpen" type="button" class="flex items-center justify-center bg-blue font-bold w-32 h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">Reply</button>

    <div
        @click.away="isOpen = false"
        x-show.transition.origin.top.left="isOpen"
        class="absolute z-10 w-104 text-left font-bold text-base bg-white shadow-dialog rounded-xl mt-2"
    >
        <form wire:submit.prevent="addComment" action="#" class="space-y-4 px-4 py-6">
            <div>
                <textarea wire:model.defer="body" name="commentContent" id="commentContent" cols="30" rows="4" class="w-full bg-gray-100 rounded-xl border-none font-semibold placeholder-gray-900 px-4 py-2" placeholder="Your comment"></textarea>
            </div>
            <div>
                <input wire:model.defer="name" type="text" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 text-sm" placeholder="Your name" name="name" @if (auth()->check()) readonly @endif>
            </div>
            <div>
                <input wire:model.defer="shopName" type="text" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 py-2 text-sm" placeholder="Your shop name" name="shopName" @if (auth()->check()) readonly @endif>
            </div>
            <div>
                <input wire:model.defer="email" type="email" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 py-2 text-sm mb-2" placeholder="Your email" name="email" @if (auth()->check()) readonly @endif>
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="flex items-center justify-center bg-blue font-bold w-1/2 h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">Post Comment</button>
                <button type="button" class="flex items-center justify-center w-32 bg-gray-200 font-bold h-11 text-sm rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <svg class="text-gray-600 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    <span class="ml-1">Attach</span>
                </button>
            </div>
        </form>
    </div>
</div>
