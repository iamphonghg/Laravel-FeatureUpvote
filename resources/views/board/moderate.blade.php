@extends('layouts.dashboard')

@section('content')
<div>
    <header class="max-w-7xl mx-auto bg-white flex items-center justify-between">
        <div class="mx-9 py-6 mt-4">
            <div>
                <a href="{{ route('board.index', $board) }}" class="flex items-center font-bold hover:underline text-base">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Back to boards</span>
                </a>
            </div>
            <div class="flex items-baseline justify-between space-x-3">
               <h1 class="inline-block text-3xl font-bold text-gray-900 py-2">
                    {{ $board->board_name }}
                </h1>
                <a href="{{ route('suggestion.index', $board) }}" class="underline text-gray-500" target="_blank">View</a>
            </div>
        </div>
    </header>

    <livewire:moderations-index
        :board="$board"
    />
</div>

@endsection
