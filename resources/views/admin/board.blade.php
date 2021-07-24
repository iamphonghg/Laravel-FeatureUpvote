@extends('layouts.suggestion')

@section('title', "View Contributor - $board->board_name")

@section('content')

    @php

    @endphp

    <section class="control">
        <div id="control" class="container d-flex flex-wrap justify-content-between">
            <div class="left">
                <a href="" class="btn btn-outline-secondary">Top</a>
                <a href="" class="btn btn-outline-secondary">New</a>

                <div class="dropdown d-inline">
                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        All
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="book-dropdown">
                        <li><a href="#" class="dropdown-item">All</a></li>
                        <li><a href="#" class="dropdown-item">All except done</a></li>
                        <li><a href="#" class="dropdown-item">Under consideration</a></li>
                        <li><a href="#" class="dropdown-item">Planned</a></li>
                        <li><a href="#" class="dropdown-item">Not planned</a></li>
                        <li><a href="#" class="dropdown-item">Done</a></li>
                    </ul>
                </div>
                <div class="filters d-inline">
                    <input class="showDeleted" name="deleted" type="checkbox" value="1">
                    <label for="shoeDeleted">Show deleted</label>
                </div>
            </div>

            <div class="right">
                <form class="d-flex" id="searchArea">
                    <input type="text" class="form-control me-2" placeholder="Search" aria-label="Search">
                    <a href="{{ route('suggestions.create', $board->short_name) }}" class="btn btn-secondary text-nowrap" id="btnAdd">ADD YOUR SUGGESTION</a>
                </form>
            </div>
        </div>
    </section>

    <section id="listSuggestions" class="mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="list-group">

                    @foreach ($suggestions as $suggestion)
                        @if ($suggestion->status != 'Deleted')
                            @if ($suggestion->status == 'Awaiting approval')
                                @php
                                    $unmoderated = "opacity: 0.5";
                                @endphp
                            @else
                                @php
                                    $unmoderated = '';
                                @endphp
                            @endif
                        @endif
                        <div class="list-group-item py-3" style="{{ $unmoderated }}">
                            <div class="row">
                                <div class="col-3 d-flex">
                                    <div class="votes p-4 border-end">
                                        <a href="{{ route('suggestions.show', [$board->short_name, $suggestion]) }}" class="btn">
                                            <span class="h1">{{ count($suggestion->votes) }}</span>
                                            <p>votes</p>
                                            @if (isset($_COOKIE["list_voted_suggestion"]))
                                                @if (strpos($_COOKIE["list_voted_suggestion"], "sgt$suggestion->id") !== false)
                                                    <p><i class="bi bi-check2"></i>Voted up</p>
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-9 justify-content-left">
                                    <div class="infos p-4">
                                        <a href="{{ route('suggestions.show', [$board->short_name, $suggestion->id]) }}" class="text-decoration-none text-dark"><h3 class="h4">{{ $suggestion->title }}</h3></a>
                                        <p>
                                            Suggested by:
                                            <span class="fw-bold">{{ $suggestion->contributor->name }}</span>
                                            {{ date("d M 'y", strtotime($suggestion->created_at)) }} | Upvoted: {{ date("d M 'y", strtotime($suggestion->last_voted_at)) }} |
                                            <a href="{{ route('suggestions.show', [$board, $suggestion->id]) }}" class="text-secondary">Comments: {{ count($suggestion->comments) }}</a>
                                        </p>
                                        @if ($suggestion->is_pinned)
                                            <label for="" class="bg-success text-light px-2 py-1 rounded">
                                                <i class="bi bi-bookmark"></i>
                                                Pinned
                                            </label>
                                            <a href="{{ route('suggestions.unpin', [$board->short_name, $suggestion]) }}" class="btn btn-outline-secondary">
                                                <i class="bi bi-x"></i>
                                                Unpin
                                            </a>
                                        @elseif ($suggestion->status != 'Awaiting approval')
                                            <a href="{{ route('suggestions.pin', [$board->short_name, $suggestion]) }}" class="btn btn-outline-secondary">
                                                <i class="bi bi-bookmark"></i>
                                                Pin this
                                            </a>
                                        @endif
                                        <label for="" class="bg-dark text-light px-2 py-1 rounded">{{ $suggestion->status }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

