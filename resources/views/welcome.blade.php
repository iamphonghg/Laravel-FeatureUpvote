@extends('layouts.layout')

@section('content')

@php

@endphp

<section class="control">
    <div id="control" class="container d-flex flex-wrap justify-content-between">
        <div class="left">
            <a href="" class="btn btn-outline-secondary">Top</a>
            <a href="" class="btn btn-outline-secondary">New</a>

            <div class="btn-group pull-left filterBy" role="group" aria-label="filterBy">
                <button type="button" class="btn btn-xs btn-default border-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                All
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#" id="item-all">All</a></li>
                    <li><a href="#" id="item-allexceptdone">All except done</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#" id="item-underconsideration">Under consideration</a></li>
                    <li><a href="#" id="item-planned">Planned</a></li>
                    <li><a href="#" id="item-notplanned">Not planned</a></li>
                    <li><a href="#" id="item-done">Done</a></li>
                </ul>
            </div>
        </div>

        <div class="right">
            <form class="d-flex" id="searchArea">
                <input type="text" class="form-control me-2" placeholder="Search" aria-label="Search">
                <a href="/suggestions/create" class="btn btn-secondary text-nowrap" id="btnAdd">ADD YOUR SUGGESTION</a>
            </form>
        </div>
    </div>
</section>

<section id="listSuggestions" class="mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="list-group">

                @foreach ($suggestions as $suggestion)
                <div class="list-group-item py-3">
                    <div class="row">
                        <div class="col-3 d-flex">
                            <div class="votes p-4 border-end">
                                <a href="/suggestions/{{ $suggestion->id }}" class="btn">
                                    <span class="h1">{{ $suggestion->votes }}</span>
                                    <p>votes</p>
                                    @if (isset($_COOKIE["list_upvoted_suggestion"]))
                                        @if (strpos($_COOKIE["list_upvoted_suggestion"], "||sgt$suggestion->id||") !== false)
                                            <p><i class="bi bi-check2"></i>Voted up</p>
                                        @endif
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="col-9 justify-content-left">
                            <div class="infos p-4">
                                <a href="/suggestions/{{ $suggestion->id }}" class="text-decoration-none text-dark"><h3 class="h4">{{ $suggestion->title }}</h3></a>
                                <p>
                                    Suggested by:
                                    <span class="fw-bold">{{ $suggestion->contributor->name }}</span> {{ date("d M 'y", strtotime($suggestion->created_at)) }} | Upvoted: {{ date("d M 'y", strtotime($suggestion->upvoted_at)) }} |
                                    <a href="/suggestions/{{ $suggestion->id }}" class="text-secondary">Comments: {{ $suggestion->comments }}</a>
                                </p>
                                @if ($suggestion->is_pinned)
                                    <label for="" class="bg-success text-light px-2 py-1 rounded">Pinned</label>
                                @endif
                                <label for="" class="bg-dark text-light px-2 py-1 rounded">{{ $suggestion->evaluation }}</label>
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

