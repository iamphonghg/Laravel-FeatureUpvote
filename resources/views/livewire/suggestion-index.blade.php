<div
    x-data
    @click="
        const clicked = $event.target
        const target = clicked.tagName.toLowerCase()
        const ignores = ['button', 'svg', 'path', 'a', 'img']
        if (!ignores.includes(target)) {
            clicked.closest('.suggestion-container').querySelector('.suggestion-link').click()
        }
    "
    class="suggestion-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer"
>
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="@if ($hasVoted) text-blue @endif font-bold text-2xl">{{ $votesCount }}</div>
            <div class="text-gray-500">Votes</div>
        </div>
        @if ($hasVoted)
            <div class="mt-8">
                <button
                    wire:click.prevent="vote"
                    class="w-20 bg-blue text-white border border-blue hover:bg-blue-hover transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2"
                >
                    Voted
                </button>
            </div>
        @else
            <div class="mt-8">
                <button
                    wire:click.prevent="vote"
                    class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2"
                >
                    Vote
                </button>
            </div>
        @endif
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-0 md:px-5 py-4 md:py-6">
        <div class="flex-none mx-4 md:mx-0">
            <a href="#">
                <img src="{{ $suggestion->contributor->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
            <h4 class="text-xl font-bold mt-2 md:mt-0">
                <a href="{{ route('suggestion.show', $suggestion) }}" class="suggestion-link hover:underline">{{ $suggestion->title }}</a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">
                {{ $suggestion->description }}
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 space-x-2">
                    <div>{{ $suggestion->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </div>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <div class="{{ $suggestion->getStatusClasses() }} font-extrabold text-xs uppercase rounded-full text-center px-4 w-32 h-7 py-2 leading-none">{{ $suggestion->status }}</div>
                    <div x-data="{ isOpen: false }" class="relative">
                        <button @click="isOpen = !isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                            <svg fill="currentColor" width="24" height="6">
                                <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                            </svg>
                        </button>
                        <ul
                            x-cloak
                            @click.away="isOpen = false"
                            x-show.transition.origin.top.left="isOpen"
                            class="absolute w-36 font-bold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                        >
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                        </ul>
                    </div>
                </div>

                <div class="flex items-center md:hidden mt-4 md:mt-0">
                    <div class="bg-gray-100 text-center rounded-3xl px-4 py-2 pr-10">
                        <div class="@if ($hasVoted) text-blue @endif text-xs font-bold leading-none">{{ $votesCount }}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400">votes</div>
                    </div>
                    @if ($hasVoted)
                        <button
                            wire:click.prevent="vote"
                            class="bg-blue text-white font-bold w-20 text-sm uppercase rounded-3xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-4 py-2 -mx-8"
                        >
                            Voted
                        </button>
                    @else
                        <button
                            wire:click.prevent="vote"
                            class="bg-gray-300 font-bold w-20 text-sm uppercase rounded-3xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-4 py-2 -mx-8"
                        >
                            Vote
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> <!-- end suggestion container -->
