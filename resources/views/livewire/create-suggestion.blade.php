<form wire:submit.prevent="createSuggestion" action="#" method="POST" class="space-y-4 px-4 py-6">
    <div>
        <input wire:model.defer="title" type="text" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 py-2 text-sm" placeholder="Title" name="title" >
        @error('title')
            <p class="text-red text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <textarea wire:model.defer="description" name="description" id="description" cols="30" rows="4" class="block w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold px-4 py-2 text-sm m-0" placeholder="Describe your suggestion" ></textarea>
        @error('description')
            <p class="text-red text-xs mt-1">{{ $message }}</p>
        @enderror
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
    <div class="flex items-center justify-between space-x-3">
        <button type="button" class="flex items-center justify-center w-1/2 bg-gray-200 font-bold h-11 text-sm rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
            <svg class="text-gray-600 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>
            <span class="ml-1">Attach</span>
        </button>
        <button type="submit" class="flex items-center justify-center w-1/2 bg-blue font-bold h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">Post</button>
    </div>

    <div>
        @if (session('successMessage'))
            <div
                x-data="{ isVisible: true }"
                x-init="
                    setTimeout(() => {
                        isVisible = false
                    }, 5000)
                "
                x-show.transition.duration.1000ms="isVisible"
                class="text-green mt-4"
            >
                {{ session('successMessage') }}
            </div>
        @endif
    </div>
</form>
