<div
    x-cloak
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    x-init="
        Livewire.on('editCommentWasSet', () => {
            isOpen = true
        })
        Livewire.on('commentWasUpdated', () => {
            isOpen = false
        })
    "
    class="fixed z-10 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    <div class="flex items-end justify-center min-h-screen">
        <div
            x-show.transition.opacity="isOpen"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            aria-hidden="true">
        </div>

        <div
            x-show.transition.origin.bottom.duration.300ms="isOpen"
            class="modal bg-white rounded-tl-xl rounded-tr-xl overflow-hidden transform transition-all py-4 sm:max-w-lg sm:w-full"
        >
            <div class="absolute top-0 right-0 pt-6 pr-6">
                <button
                    @click="isOpen = false"
                    class="text-gray-400 hover:text-gray-500"
                >
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-center text-xl font-bold text-gray-900">Edit Comment</h3>

                <form wire:submit.prevent="updateComment" action="#" method="POST" class="space-y-4 px-4 py-6">
                    <div>
                        <textarea wire:model.defer="body" name="body" cols="30" rows="4" class="block w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 py-2 text-sm m-0" placeholder="Your comment" ></textarea>
                        @error('body')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input wire:model.defer="name" type="text" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 text-sm" placeholder="Your name" name="name">
                    </div>
                    <div>
                        <input wire:model.defer="shopName" type="text" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 py-2 text-sm" placeholder="Your shop name" name="shopName">
                    </div>
                    <div>
                        <input wire:model.defer="email" type="email" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 py-2 text-sm mb-2" placeholder="Your email" name="email">
                    </div>
                    <div class="flex items-center justify-end space-x-3">
                        <button type="submit" class="text-center w-36 bg-blue font-bold h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 mr-4">Save</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
