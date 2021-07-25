@extends('layouts.suggestion')
@php

@endphp
@section('title', "$suggestion->title - $board->board_name")

@section('content')
    <section class="container">
        <a href="/boards/{{ $board->short_name }}" class="back text-secondary fw-bold h4 text-decoration-none mt-3">
            <i class="bi bi-arrow-left"></i>All suggestions
        </a>
        <h1 class="mt-3">{{ $suggestion->title }}</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <section class="detail-vote container">
            <div class="row border mt-4">
                <div class="col-3 d-flex">
                    <div class="votes p-4 border-end">
                        <p class="h1">{{ count($suggestion->votes) }}</p>
                        <p>votes</p>
                        @if (strpos($_COOKIE["list_voted_suggestion"], "sgt$suggestion->id-") !== false)
                            <a href="{{ route('suggestions.devote', [$board->short_name, $suggestion->id]) }}" class="btn btn-outline-secondary d-block"><i class="bi bi-check2"></i>Voted up</a>
                        @else
                            <a href="{{ route('suggestions.vote', [$board->short_name, $suggestion->id]) }}" class="btn btn-secondary d-block">Vote</a>
                        @endif
                    </div>
                </div>
                <div class="col-9 justify-content-left">
                    <div class="infos p-4">
                        <h3 class="h4">{{ $suggestion->content }}</h3>
                        <p>
                            Suggested by:
                            <span class="fw-bold">
                                {{ $suggestion->contributor->name }}
                            </span>
                            {{ date("d M 'y", strtotime($suggestion->created_at)) }} | Voted: {{ date("d M 'y", strtotime($suggestion->last_voted_at)) }} |
                            <span class="text-secondary">Comments: {{ count($suggestion->comments) }}</span>
                        </p>
                        @if ($suggestion->is_pinned)
                            <label for="" class="bg-success text-light px-2 py-1 rounded">Pinned</label>
                        @endif
                        <label for="" class="bg-dark text-light px-2 py-1 rounded">{{ $suggestion->status }}</label>
                    </div>
                </div>
            </div>

            @if (count($suggestion->comments) > 0)
                @php
                    {{
                        $comments = $suggestion->comments;
                    }}
                @endphp
                <div class="row border mt-4">
                    <span class="m-3"><i class="bi bi-chat-left-dots me-2"></i>Comments: {{ count($comments) }}</span>
                </div>

                @foreach ($comments as $comment)
                    @if ($comment->status == 'Awaiting approval' and isset($_COOKIE['uid']) and $_COOKIE['uid'] == $comment->contributor_id)
                        <div class="row border border-top-0">
                            <p class="fst-italic mt-3 ms-3">{{ date("d M 'y", strtotime($comment->created_at)) }}</p>
                            <p class="fw-bold ms-3">{{ $comment->contributor->name }}</p>
                            @if ($comment->contributor->shop_name == '@dmin')
                                <p class="">
                                    <label for="" class="bg-success text-light px-2 py-1 rounded col-1">Admin</label>
                                </p>
                            @endif
                            <p class="d-inline ms-3">{{ $comment->content }}</p>
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-outline-secondary m-3 w-25">Edit</a>
                        </div>
                    @elseif ($comment->status != 'Awaiting approval' and $comment->status != 'Deleted')
                        <div class="row border border-top-0">
                            <p class="fst-italic mt-3 ms-3">{{ date("d M 'y", strtotime($comment->created_at)) }}</p>
                            <p class="fw-bold ms-3">{{ $comment->contributor->name }}</p>
                            @if ($comment->contributor->shop_name == '@dmin')
                                <p class="">
                                    <label for="" class="bg-success text-light px-2 py-1 rounded col-1">Admin</label>
                                </p>
                            @endif
                            <p class="d-inline ms-3">{{ $comment->content }}</p>
                        </div>
                    @endif
                @endforeach
            @endif

            @php
                $name = $email = $shop_name = '';
                if (isset($_COOKIE['uid'])) {
                    $contributor = \App\Models\Contributor::find($_COOKIE['uid']);
                    $name = $contributor->name;
                    $email = $contributor->email;
                    $shop_name = $contributor->shop_name;
                }
            @endphp
            @if ($suggestion->status == 'Awaiting approval' and isset($_COOKIE['uid']) and $_COOKIE['uid'] == $suggestion->contributor_id)
                <a href="{{ route('suggestions.edit', [$board->short_name, $suggestion->id]) }}" class="btn btn-outline-secondary m-3">Edit</a>
            @else
                <div class="row border mt-4">
                    <span class="m-3"><i class="bi bi-plus-square me-2"></i>Add a comment</span>
                </div>
                <div class="row border border-top-0 mb-5">
                    <div class="row mt-3">
                        <div class="col-lg-12 ms-2">
                            <form method="POST" action="{{ route('suggestions.comment', [$board->short_name, $suggestion->id]) }}">
                                @csrf
                                <label for="description" class="form-label"><span class="fw-bold h5">Message</span></label>
                                <div class="mb-4 input-group">
                                    <textarea id="query" class="form-control" style="height: 140px" placeholder="Your comment" name="content"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name" class="form-label"><span class="fw-bold h5">Name</span></label>
                                        <div class="mb-4 input-group">
                                            <input type="text" class="form-control" id="title" placeholder="Your name" name="name" value="{{ $name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label"><span class="fw-bold h5">Email</span></label>
                                        <div class="mb-4 input-group">
                                            <input type="email" class="form-control" id="title" placeholder="Your email" name="email" value="{{ $email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="shop-name" class="form-label"><span class="fw-bold h5">Shop name</span></label>
                                        <div class="mb-4 input-group">
                                            <input type="text" class="form-control" id="title" placeholder="Your shop" name="shop_name" value="{{ $shop_name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mb-4 text-center justify-content-end">
                                    <button type="submit" class="btn btn-secondary me-2">Post comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </section>

    </section>

@endsection
