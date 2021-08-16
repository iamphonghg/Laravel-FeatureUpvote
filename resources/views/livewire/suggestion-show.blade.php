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
                        <div class="text-gray-900">{{ $suggestion->countComment() }} Comments</div>
                    </div>
                    <div class="flex items-center space-x-2 mt-4 md:mt-0">
                        <div class="{{ $suggestion->getStatusClasses()  }} font-extrabold text-xs uppercase rounded-full text-center px-4 w-32 h-7 py-2 leading-none">{{ str_replace('_', ' ', $suggestion->status) }}</div>
                            @if (auth()->check() or $suggestion->currentContributorCanEditSuggestion())
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
                                        <li>
                                            <a
                                                href="#"
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-edit-modal')
                                                "
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            >
                                                Edit
                                            </a>
                                        </li>

                                        @if (auth()->check())
                                            <li>
                                                <a
                                                    href="#"
                                                    @click.prevent="
                                                        isOpen = false
                                                        $dispatch('custom-show-delete-modal')
                                                    "
                                                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                                >
                                                    Delete this
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
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
            <livewire:add-comment
                :suggestion="$suggestion"
            />
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
