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
    <div class="flex items-center justify-center space-x-3">
        <button type="submit" class="justify-center w-1/2 bg-blue font-bold h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in p-6 py-3">Post</button>
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
