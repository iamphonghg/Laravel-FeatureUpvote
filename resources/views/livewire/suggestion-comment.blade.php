<div class="comment-container relative bg-white rounded-xl flex mt-4">
    <div class="flex flex-1 px-5 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->contributor->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="w-full ml-5">
            <div class="text-gray-600">
                {{ $comment->body }}
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 space-x-2">
                    <div class="font-bold text-gray-900"> {{ $comment->contributor->name }}</div>
                    <div>&bull;</div>
                    @if ($comment->contributor_id == $comment->suggestion->contributor_id)
                        <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                        <div>&bull;</div>
                    @endif

                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                @if ($comment->currentUserCanEditThisComment())
                    <div
                        x-data="{ isOpen: false }"
                        class="relative"
                    >
                        <button
                            class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3"
                            @click="isOpen = !isOpen"
                        >
                            <svg fill="currentColor" width="24" height="6">
                                <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                            </svg>
                        </button>
                        <ul
                            class="absolute w-36 font-bold bg-white shadow-dialog rounded-xl py-3 ml-8 z-10"
                            x-cloak
                            x-show.transition.origin.top.left="isOpen"
                            @click.away="isOpen = false"
                            @kewdown.escape.window="isOpen = false"
                        >
                            <li>
                                <a
                                    href="#"
                                    @click.prevent="
                                        isOpen = false
                                        Livewire.emit('setEditComment', {{ $comment->id }})
                                    "
                                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                >
                                    Edit
                                </a>
                            </li>
                            @if ($comment->suggestion->currentAdminOwnsThisBoard())
                                <li>
                                    <a
                                    href="#"
                                    @click.prevent="
                                        isOpen = false
                                        Livewire.emit('setDeleteComment', {{ $comment->id }})
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
        </div>
    </div>
</div> <!-- end comment container -->
