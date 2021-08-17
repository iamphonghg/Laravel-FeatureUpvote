<div
    x-data="{ isOpen: false }"
    class="relative"
    x-init="
        window.livewire.on('statusWasUpdated', () => {
            isOpen = false
        })
    "
>
    <button @click="isOpen = !isOpen"type="button" class="flex items-center justify-center bg-gray-200 font-bold w-40 h-11 text-sm rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
        <span class="mr-1">Set Status</span>
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <div
        x-cloak
        @click.away="isOpen = false"
        x-show.transition.origin.top.left="isOpen"
        class="absolute z-20 w-52 text-left font-bold text-base bg-white shadow-dialog rounded-xl mt-2"
    >
        <form wire:submit.prevent="setStatus" action="#" class="space-y-4 px-4 py-6">
            <div class="space-y-2">
                <div>
                    <label class="inline-flex items-center">
                        <input wire:model="status" type="radio" checked="" class="bg-gray-200 text-red border-none" name="radio-direct" value="awaiting">
                        <span class="ml-2">Awaiting approval</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input wire:model="status" type="radio" name="radio-direct" class="bg-gray-200 text-blue border-none" value="considering">
                        <span class="ml-2">Considering</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input wire:model="status" type="radio" name="radio-direct" class="bg-gray-200 text-purple border-none" value="planned">
                        <span class="ml-2">Planned</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input wire:model="status" type="radio" name="radio-direct" class="bg-gray-200 text-yellow border-none" value="not_planned">
                        <span class="ml-2">Not planned</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input wire:model="status" type="radio" name="radio-direct" class="bg-gray-200 text-green border-none" value="done">
                        <span class="ml-2">Done</span>
                    </label>
                </div>
            </div>

            {{-- <div>
                <textarea name="updateComment" id="updateComment" cols="30" rows="3" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold text-sm px-4 py-2" placeholder="Add an update comment (Optional)"></textarea>
            </div> --}}
            <div class="flex items-center justify-center space-x-3">
                <button type="submit" class="leading-none text-center w-1/2 bg-blue font-bold h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in py-3">Update</button>
            </div>
        </form>
    </div>
</div>
