@extends('layouts.app', ['urlName' => $urlName])

@section('content')
    <div>
        <a href="{{ $backUrl }}" class="flex items-center font-bold hover:underline text-base">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            <span>All suggestions</span>
        </a>
    </div>

    <livewire:suggestion-show
        :suggestion="$suggestion"
        :votesCount="$votesCount"
    />

    @if ($suggestion->currentContributorCanEditSuggestion())
        <livewire:edit-suggestion
            :suggestion="$suggestion"
        />
    @endif

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
@endsection
