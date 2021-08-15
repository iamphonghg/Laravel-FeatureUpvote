<div class="suggestion-and-buttons container">
    <div class="suggestion-container bg-white rounded-xl flex mt-4">
        <div class="flex flex-col md:flex-row md:flex-1 px-0 md:px-5 py-4 md:py-6">
            <div class="flex-none mx-4 md:mx-0">
                <a href="#">
                    <img src="{{ $suggestion->contributor->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
                <h4 class="text-xl font-bold mt-2 md:mt-0">
                    <a href="#" class="hover:underline">{{ $suggestion->title }}</a>
                </h4>
                <div class="text-gray-600 mt-3 mr-4">
                    {{ $suggestion->description }}
                </div>
                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 space-x-2">
                        <div class="hidden md:block font-bold text-gray-900">{{ $suggestion->contributor->name }}</div>
                        <div class="hidden md:block">&bull;</div>
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
                                class="absolute w-36 font-bold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0 z-10"
                            >
                                @if ($suggestion->currentContributorCanEditSuggestion())
                                    <li>
                                        <a
                                            href="#"
                                            @click="
                                                isOpen = false
                                                $dispatch('custom-show-edit-modal')
                                            "
                                            class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                        >
                                            Edit
                                        </a>
                                    </li>
                                @endif
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
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
                                    class="bg-blue text-white font-bold w-20 text-sm uppercase rounded-3xl border border-gray-200 hover:bg-blue-hover transition duration-150 ease-in px-4 py-2 -mx-8"
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

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex items-center space-x-4 ml-6">
            <div x-cloak x-data="{ isOpen: false }"class="relative">
                <button @click="isOpen = !isOpen" type="button" class="flex items-center justify-center bg-blue font-bold w-32 h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">Reply</button>

                <div
                    @click.away="isOpen = false"
                    x-show.transition.origin.top.left="isOpen"
                    class="absolute z-10 w-104 text-left font-bold text-base bg-white shadow-dialog rounded-xl mt-2"
                >
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div>
                            <textarea name="commentContent" id="commentContent" cols="30" rows="4" class="w-full bg-gray-100 rounded-xl border-none font-semibold placeholder-gray-900 px-4 py-2" placeholder="Your comment"></textarea>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button" class="flex items-center justify-center bg-blue font-bold w-1/2 h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">Post Comment</button>
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
            @auth
                <livewire:set-status
                    :suggestion="$suggestion"
                />
            @endauth
        </div>

        <div class="hidden md:flex items-center space-x-4">
            <div class="text-center rounded-xl bg-white py-2 px-3 font-bold">
                <div class="@if ($hasVoted) text-blue @endif text-2xl leading-snug">{{ $votesCount }}</div>
                <div class="text-gray-400 leading-none">votes</div>
            </div>
            @if ($hasVoted)
                <button
                    wire:click.prevent="vote"
                    class="bg-blue text-white font-bold w-32 h-11 text-sm leading-none uppercase rounded-xl border border-gray-200 hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                >
                    Voted
                </button>
            @else
                <button
                    wire:click.prevent="vote"
                    class="bg-gray-200 font-bold w-32 h-11 text-sm leading-none uppercase rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                >
                    Vote
                </button>
            @endif
        </div>
    </div> <!-- end buttons container -->
</div> <!-- end suggestion and buttons container -->
