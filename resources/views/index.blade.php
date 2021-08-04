<x-app-layout>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-1/3">
            <select name="category" id="category" class="w-full rounded-xl border-none font-semibold px-4 py-2">
                <option value="Category One">Category One</option>
                <option value="Category Two">Category Two</option>
                <option value="Category Three">Category Three</option>
                <option value="Category Four">Category Four</option>
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select name="otherFilters" id="otherFilters" class="w-full rounded-xl border-none font-semibold px-4 py-2">
                <option value="Filter One">Filter One</option>
                <option value="Filter Two">Filter Two</option>
                <option value="Filter Three">Filter Three</option>
                <option value="Filter Four">Filter Four</option>
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <input type="search" placeholder="Find a suggestion" class="w-full rounded-xl bg-white border-none font-semibold pl-9 py-2 placeholder-gray-900">
            <div class="absolute top-0 flex items-center h-full pl-3">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div> <!-- end filters -->

    <div class="sgts-container space-y-6 my-6">
        <div class="sgt-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-bold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2">Vote</button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row flex-1 px-0 md:px-5 py-4 md:py-6">
                <div class="flex-none mx-4 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
                    <h4 class="text-xl font-bold mt-2 md:mt-0">
                        <a href="#" class="hover:underline">A random title go here</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="bg-gray-200 font-extrabold text-xs uppercase rounded-full text-center px-4 w-28 h-7 py-2 leading-none">Open</div>
                            <div x-data="{ isOpen: false }" class="relative">
                                <button @click="isOpen = !isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>
                                <ul 
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
        <div class="sgt-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-bold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2">Vote</button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row flex-1 px-0 md:px-5 py-4 md:py-6">
                <div class="flex-none mx-4 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
                    <h4 class="text-xl font-bold mt-2 md:mt-0">
                        <a href="#" class="hover:underline">A random title go here</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="bg-gray-200 font-extrabold text-xs uppercase rounded-full text-center px-4 w-28 h-7 py-2 leading-none">Open</div>
                            <div x-data="{ isOpen: false }" class="relative">
                                <button @click="isOpen = !isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>
                                <ul 
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
        <div class="sgt-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-bold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2">Vote</button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row flex-1 px-0 md:px-5 py-4 md:py-6">
                <div class="flex-none mx-4 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
                    <h4 class="text-xl font-bold mt-2 md:mt-0">
                        <a href="#" class="hover:underline">A random title go here</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam ducimus excepturi culpa ab esse veniam perferendis accusantium delectus nostrum a! Harum consequuntur, suscipit unde perspiciatis ut neque qui quo provident.
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="bg-gray-200 font-extrabold text-xs uppercase rounded-full text-center px-4 w-28 h-7 py-2 leading-none">Open</div>
                            <div x-data="{ isOpen: false }" class="relative">
                                <button @click="isOpen = !isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>
                                <ul 
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
        <div class="sgt-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-bold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2">Vote</button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row flex-1 px-0 md:px-5 py-4 md:py-6">
                <div class="flex-none mx-4 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
                    <h4 class="text-xl font-bold mt-2 md:mt-0">
                        <a href="#" class="hover:underline">A random title go here</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="bg-gray-200 font-extrabold text-xs uppercase rounded-full text-center px-4 w-28 h-7 py-2 leading-none">Open</div>
                            <div x-data="{ isOpen: false }" class="relative">
                                <button @click="isOpen = !isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>
                                <ul 
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
        <div class="sgt-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-bold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2">Vote</button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row flex-1 px-0 md:px-5 py-4 md:py-6">
                <div class="flex-none mx-4 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
                    <h4 class="text-xl font-bold mt-2 md:mt-0">
                        <a href="#" class="hover:underline">A random title go here</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="bg-gray-200 font-extrabold text-xs uppercase rounded-full text-center px-4 w-28 h-7 py-2 leading-none">Open</div>
                            <div x-data="{ isOpen: false }" class="relative">
                                <button @click="isOpen = !isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>
                                <ul 
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
        <div class="sgt-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-bold text-2xl">12</div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs uppercase rounded-xl px-3 py-2">Vote</button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row flex-1 px-0 md:px-5 py-4 md:py-6">
                <div class="flex-none mx-4 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full flex flex-col justify-between mx-4 md:mx-5">
                    <h4 class="text-xl font-bold mt-2 md:mt-0">
                        <a href="#" class="hover:underline">A random title go here</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="bg-gray-200 font-extrabold text-xs uppercase rounded-full text-center px-4 w-28 h-7 py-2 leading-none">Open</div>
                            <div x-data="{ isOpen: false }" class="relative">
                                <button @click="isOpen = !isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>
                                <ul 
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
        <!-- <div class="sgt-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer">
            <div class="border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-bold text-2xl text-blue">66</div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-blue border border-gray-200 hover:border-gray-400 transition duration-150 ease-in font-extrabold text-xs text-white uppercase rounded-xl px-3 py-2">Voted</button>
                </div>
            </div>
            <div class="flex px-5 py-6">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=4" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                <div class="mx-5">
                    <h4 class="text-xl font-bold">
                        <a href="#" class="hover:underline">Another random title go here</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facilis veniam illo dolor voluptate tempora minus modi nulla ipsum laboriosam quidem neque maiores numquam sunt repellat soluta dicta voluptas adipisci, iure minima, vitae nisi tempore doloremque esse! Deserunt nostrum enim, minima ducimus molestias accusamus incidunt, ipsum tempore quisquam sunt suscipit? Officia!
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="bg-yellow font-extrabold text-xs uppercase rounded-full text-center px-4 w-28 h-7 py-2 leading-none">Planned</div>
                            <div class="relative">
                                <button class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>                        
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div> end suggestion VOTED container -->
        
    </div> <!-- end suggestions container -->
</x-app-layout>
