<div class="border-2 rounded-lg mb-6">
    @if (! isset($comments) || ! $comments->isNotEmpty())
        <div class="mx-auto w-70 my-10">
            <img src="{{ asset('img/error-404.svg') }}" alt="no boards" class="mx-auto w-32"
                style="mix-blend-mode: luminosity">
            <div class="text-gray-400 text-center font-bold mt-6">No comments found</div>
        </div>
    @else
        <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6 px-6 pt-6">
            <div class="w-36">
                <select wire:model="filter" class="w-full rounded-xl border-blue font-semibold px-4 py-2">
                    <option value="all">All</option>
                    <option value="approved">Approved</option>
                    <option value="deleted">Deleted</option>
                </select>
            </div> <!-- end filter -->

            <div x-data="{ isOpen: false }" class="relative" x-init="
                        window.livewire.on('commentStatusWasUpdated', () => {
                            isOpen = false
                        })
                    ">
                <button @click="isOpen = !isOpen" type="button"
                    class="flex items-center justify-center bg-gray-200 font-bold w-36 h-11 text-sm rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-4 py-3">
                    <span class="mr-1">Set Status</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-cloak @click.away="isOpen = false" x-show.transition.origin.top.left="isOpen"
                    class="absolute z-20 w-52 text-left font-bold text-base bg-white shadow-dialog rounded-xl mt-2">
                    <form wire:submit.prevent="setStatus" action="#" class="space-y-4 px-4 py-6">
                        <div class="space-y-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input wire:model="status" type="radio" checked="checked"
                                        class="bg-gray-200 text-gray-600 border-none" name="radio-direct" value="approved">
                                    <span class="ml-2">Approved</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input wire:model="status" type="radio" name="radio-direct"
                                        class="bg-gray-200 text-red border-none" value="deleted">
                                    <span class="ml-2">Deleted</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center justify-end space-x-3">
                            <button type="submit"
                                class="leading-none text-center w-1/2 bg-blue font-bold h-11 text-sm text-white rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in py-3">Update</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end set status -->
        </div>　
        <!-- end filters and set status -->
        <div class="overflow-x-auto px-6 pb-6">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th>
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider w-1/3">
                                Comment
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider w-1/3">
                                Suggestion
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider w-1/6">
                                Contributor
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider w-1/6">
                                Date
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($comments as $comment)
                            <tr>
                                <td class="px-4 py-4 space-y-1 border-l-2 @if ($comment->status == 'approved') border-gray-600 @else border-red @endif">
                                    <input wire:model="selectedComments" type="checkbox" value="{{ $comment->id }}"
                                        class="rounded-full ">
                                </td>
                                <td class="px-6 py-4 space-y-1 align-top">
                                    <a href="{{ route('suggestion.show', [$board, $comment->suggestion]) }}"
                                        class="underline text-sm text-gray-900" target="_blank">
                                        {{ $comment->body }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 space-y-1 align-top">
                                    <a href="{{ route('suggestion.show', [$board, $comment->suggestion]) }}" class="text-sm text-gray-900 underline" target="_blank">{{ $comment->suggestion->title }}</a>
                                </td>
                                <td class="px-6 py-4 space-y-1 align-top">
                                    <div class="text-sm text-gray-900">{{ $comment->contributor->name }}</div>
                                    <p class="text-sm text-gray-500">{{ $comment->contributor->email }}</p>
                                </td>
                                <td class="px-6 py-4 space-y-1 align-top">
                                    <div class="text-sm text-gray-900">{{ $comment->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- end table -->
    @endif
</div>
