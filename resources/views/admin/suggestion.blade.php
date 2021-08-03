@extends('layouts.suggestion')

@section('title', "$suggestion->title - $board->board_name")

@php
    $approvedCommentCount = \App\Models\Comment::where('suggestion_id', $suggestion->id)->where('status', 'Approved')->count();
    $allComments = $suggestion->comments;
@endphp
@section('content')
    <section class="container">
        <a href="/boards/{{ $board->short_name }}" class="back text-secondary fw-bold h4 text-decoration-none mt-3">
            <i class="bi bi-arrow-left"></i>All suggestions
        </a>
        <h1 class="mt-3">{{ $suggestion->title }}</h1>
        @if (session('mssg'))
            <div class="alert alert-success" role="alert">{{ session('mssg') }}</div>
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
                        <a href="#" class="btn btn-outline-secondary mt-1">View votes</a>
                    </div>
                </div>
                <div class="col-9 justify-content-left">
                    <div class="infos p-4">
                        <h3 class="h4">{{ $suggestion->content }}</h3>
                        <p>
                            Suggested by:
                            <a href="{{ route('contributors.show', [$board->short_name, $suggestion->contributor]) }}" class="fw-bold">
                                {{ $suggestion->contributor->name }}
                            </a>
                            <span class="fw-bold font-italic">{{ $suggestion->contributor->email }}</span>
                            {{ date("d M 'y", strtotime($suggestion->created_at)) }} | Voted: {{ date("d M 'y", strtotime($suggestion->last_voted_at)) }} |
                            <span class="text-secondary">Comments: {{ $approvedCommentCount }}</span>
                        </p>
                        @if ($suggestion->is_pinned)
                            <label for="" class="bg-success text-light px-2 py-1 rounded">Pinned</label>
                        @endif
                        <label for="" class="bg-dark text-light px-2 py-1 rounded">{{ $suggestion->status }}</label>
                    </div>
                </div>
                <div class="control border-top p-1">
                    <a class="btn btn-outline-secondary" href="{{ route('suggestions.edit', [$board->short_name, $suggestion->id]) }}">Edit</a>
                    <div class="dropdown d-inline">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                            Change status
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="book-dropdown">
                            <li><a href="#" class="dropdown-item">Awaiting approval</a></li>
                            <li class="dropdown-divider" role="separator"></li>
                            <li><a href="#" class="dropdown-item">Under consideration</a></li>
                            <li><a href="#" class="dropdown-item">Planned</a></li>
                            <li><a href="#" class="dropdown-item">Not planned</a></li>
                            <li><a href="#" class="dropdown-item">Done</a></li>
                            <li class="dropdown-divider" role="separator"></li>
                            <li><a href="#" class="dropdown-item">Deleted</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @if (count($allComments) > 0)

                <div class="row border mt-4">
                    <span class="m-3"><i class="bi bi-chat-left-dots me-2"></i>Comments: {{ $approvedCommentCount }}</span>
                </div>

                @foreach ($allComments as $comment)
                    <div class="row border border-top-0">
                        <p class="fst-italic mt-3 ms-3">{{ date("d M 'y", strtotime($comment->created_at)) }}</p>
                        <a href="{{ route('contributors.show', [$board->short_name, $comment->contributor]) }}" class="fw-bold ms-3">{{ $comment->contributor->name }}</a>
                        <p class="fst-italic mt-3 ms-3">{{ $comment->contributor->email }}</p>
                        @if ($comment->contributor->shop_name == '@dmin')
                            <p class="">
                                <label for="" class="bg-success text-light px-2 py-1 rounded col-1">Admin</label>
                            </p>
                        @endif
                        <p class="d-inline ms-3">{{ $comment->content }}</p>
                        @if ($comment->status == 'Awaiting approval')
                            <p class="">
                                <label for="" class="bg-dark text-light px-2 py-1 rounded col-2 text-wrap-none">Awaiting approval</label>
                            </p>
                        @endif
                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-outline-secondary m-3 w-25">Edit</a>
                        @php
                            $isActive1 = $isActive2 = $isActive3 = $isActive4 = '';
                            if ($comment->status == 'Awaiting approval') {
                                $isActive1 = 'active';
                            } elseif ($comment->status == 'Approved') {
                                $isActive2 = 'active';
                            } elseif ($comment->status == 'Deleted') {
                                $isActive3 = 'active';
                            } elseif ($comment->status == 'Spam') {
                                $isActive4 = 'active';
                            }
                        @endphp
                        <div class="btn-group" role="group">
                            <a class="btn btn-xss btn-outline-secondary"  {{ $isActive1 }}>Awaiting approval</a>
                            <a class="btn btn-xss btn-outline-secondary"  {{ $isActive2 }}>Approved</a>
                            <a class="btn btn-xss btn-outline-secondary"  {{ $isActive3 }}>Deleted</a>
                            <a class="btn btn-xss btn-outline-secondary"  {{ $isActive4 }}>Spam</a>
                        </div>
                    </div>
                @endforeach
            @endif
            @php
                $name = $email = $shop_name = '';
                $lockInfo = 'readonly';
                $contributor = \App\Models\Contributor::find($_COOKIE['@id']);
                $name = $contributor->name;
                $email = $contributor->email;
                $shop_name = $contributor->shop_name;
            @endphp

            @if ($suggestion->status != 'Awaiting approval' and $suggestion->status != 'Deleted')
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
                                            <input type="text" class="form-control" id="title" placeholder="Your name" name="name" value="{{ $contributor->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email" class="form-label"><span class="fw-bold h5">Email</span></label>
                                        <div class="mb-4 input-group">
                                            <input type="email" class="form-control" id="title" placeholder="Your email" name="email" value="{{ $contributor->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="shop-name" class="form-label"><span class="fw-bold h5">Shop name</span></label>
                                        <div class="mb-4 input-group">
                                            <input type="text" class="form-control" id="title" placeholder="Your shop" name="shop_name" value="{{ $contributor->shop_name }}" readonly>
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
