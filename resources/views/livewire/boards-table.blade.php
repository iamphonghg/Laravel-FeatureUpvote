<div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="px-4 py-2 sm:px-0">
            @if (! $boards->isNotEmpty())
                <div class="mx-auto w-70 mt-32">
                    <img src="{{ asset('img/error-404.svg') }}" alt="no boards" class="mx-auto w-32" style="mix-blend-mode: luminosity">
                    <div class="text-gray-400 text-center font-bold mt-6">No boards yet</div>
                </div>
            @else
            <div class="flex flex-col px-4 py-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider">
                                                Board
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider">
                                                Suggestions
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider">
                                                Comments
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs text-gray-700 uppercase tracking-wider">
                                                Votes
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach($boards as $board)
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 space-y-1 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $board->board_name }}</div>
                                                    <a href="{{ route('suggestion.index', $board) }}" class="underline block text-sm text-gray-500" target="_blank">View</a>
                                                </td>
                                                <td class="px-6 py-4 space-y-1 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $board->suggestions_count }}</div>
                                                    <a href="#" class="underline block text-sm text-gray-500">{{ $board->countPendingSuggestion() }} pendings</a>
                                                </td>
                                                <td class="px-6 py-4 space-y-1 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $board->countAllComment() }}</div>
                                                    <a href="#" class="underline block text-sm text-gray-500">{{ $board->countPendingComment() }} pendings</a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-text-top">
                                                    <div class="text-sm text-gray-900">{{ $board->countVote() }}</div>
                                                </td>
                                                <td class="whitespace-nowrap text-center text-sm">
                                                    <a href="{{ route('board.moderate', $board) }}" class="w-28 text-sm text-blue border-2 border-gray-200 bg-white hover:text-gray-50 hover:bg-blue rounded-xl py-2 px-3 leading-none transition ease-in duration-150 text-center">Moderate</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end table -->
            @endif
        </div>
    </div>

</div>
