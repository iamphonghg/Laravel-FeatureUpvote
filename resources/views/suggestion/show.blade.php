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
        :votesCount="$votesCount"
    />

    <livewire:suggestion-comments
        :suggestion="$suggestion"
    />

    @if ($suggestion->currentContributorCanEditSuggestion())
        <livewire:edit-suggestion
            :suggestion="$suggestion"
        />
    @endif
    @if (auth()->check())
        <livewire:delete-suggestion
            :suggestion="$suggestion"
            :urlName="$urlName"
        />
    @endif

    <livewire:edit-comment />
    <livewire:delete-comment />



@endsection
