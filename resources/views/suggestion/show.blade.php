<x-app-layout>
    <div>
        <a href="/" class="flex items-center font-bold hover:underline text-base">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            <span>All suggestions</span>
        </a>
    </div>

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
                                @click.away="isOpen = false"
                                x-show.transition.origin.top.left="isOpen"
                                class="absolute w-36 font-bold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0 z-10"
                            >
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex items-center md:hidden mt-4 md:mt-0">
                            <div class="bg-gray-100 text-center rounded-3xl px-4 py-2 pr-10">
                                <div class="text-xs font-bold leading-none">12</div>
                                <div class="text-xxs font-semibold leading-none text-gray-400">votes</div>
                            </div>
                            <button type="button" class="bg-gray-300 font-bold w-20 text-sm uppercase rounded-3xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-4 py-2 -mx-8">
                                <span class="mr-1">Vote</span>
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div> <!-- end suggestion container -->

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex items-center space-x-4 ml-6">
            <div x-data="{ isOpen: false }"class="relative">
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
            <div x-data="{ isOpen: false }" class="relative">
                <button @click="isOpen = !isOpen"type="button" class="flex items-center justify-center bg-gray-200 font-bold w-40 h-11 text-sm rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <span class="mr-1">Set Status</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div
                    @click.away="isOpen = false"
                    x-show.transition.origin.top.left="isOpen"
                    class="absolute z-20 w-76 text-left font-bold text-base bg-white shadow-dialog rounded-xl mt-2"
                >
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div class="space-y-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="bg-gray-200 text-green border-none" name="radio-direct" value="1">
                                    <span class="ml-2">Awaiting approval</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" class="bg-gray-200 text-blue border-none" value="2">
                                    <span class="ml-2">Considering</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" class="bg-gray-200 text-red border-none" value="3">
                                    <span class="ml-2">Planned</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" class="bg-gray-200 text-black border-none" value="3">
                                    <span class="ml-2">Not planned</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" class="bg-gray-200 text-purple border-none" value="3">
                                    <span class="ml-2">Testing</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="radio-direct" class="bg-gray-200 text-gray-400 border-none" value="3">
                                    <span class="ml-2">Done</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <textarea name="updateComment" id="updateComment" cols="30" rows="3" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 border-none font-semibold text-sm px-4 py-2" placeholder="Add an update comment (Optional)"></textarea>
                        </div>
                        <div class="flex items-center justify-between space-x-3">
                            <button type="submit" class="flex items-center justify-center w-1/2 bg-blue font-bold h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">Update</button>
                            <button type="button" class="flex items-center justify-center w-1/2 bg-gray-200 font-bold h-11 text-sm rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                                <svg class="text-gray-600 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                        </div>

                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="notifyVoters" class=" rounded bg-gray-200 border-none" checked="">
                                <span class="ml-2">Notify all voters</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="hidden md:flex items-center space-x-4">
            <div class="text-center rounded-xl bg-white py-2 px-3 font-bold">
                <div class="text-2xl leading-snug">12</div>
                <div class="text-gray-400 leading-none">votes</div>
            </div>
            <button type="button" class="bg-gray-200 font-bold w-32 h-11 text-sm uppercase rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                <span class="mr-1">Vote</span>
            </button>
        </div>
    </div> <!-- end buttons container -->

    <div class="comments-container relative space-y-6 pt-4 ml-22 my-8 mt-1">
        <div class="comment-container relative bg-white rounded-xl flex mt-4">
            <div class="flex flex-1 px-5 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full ml-5">
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, vel.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div class="font-bold text-gray-900">Hoa Hoang</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="relative">
                            <button class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6">
                                    <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>
                            </button>
                            <ul class="hidden absolute w-36 font-bold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end comment container -->
        <div class="is-admin comment-container relative bg-white rounded-xl flex mt-4">
            <div class="flex flex-1 px-5 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                    <div class="text-blue text-center uppercase text-xs font-bold mt-1">Admin</div>
                </div>
                <div class="w-full ml-5">
                    <h4 class="text-xl font-bold">
                        <a href="#" class="hover:underline">Status changed to "Planned"</a>
                    </h4>
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, vel.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div class="font-bold text-blue">HTG</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="relative">
                            <button class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6">
                                    <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>
                            </button>
                            <ul class="hidden absolute w-36 font-bold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end comment container -->
        <div class="comment-container relative bg-white rounded-xl flex mt-4">
            <div class="flex flex-1 px-5 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=9" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full ml-5">
                    <div class="text-gray-600 mt-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, vel.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div class="font-bold text-gray-900">Hoa Hoang</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="relative">
                            <button class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6">
                                    <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>
                            </button>
                            <ul class="hidden absolute w-36 font-bold bg-white shadow-dialog rounded-xl py-3 ml-8">
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end comment container -->
    </div> <!-- end comments container -->
</x-app-layout>
