@extends('layouts.layout')

@section('content')
    <section class="container">
        <a href="/" class="back text-secondary fw-bold h4 text-decoration-none mt-3">
            <i class="bi bi-arrow-left"></i>All suggestions
        </a>
        <h1 class="mt-3">{{ $suggestion->title }}</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <section class="detail-vote container">
            <div class="row border mt-4">
                <div class="col-3 d-flex">
                    <div class="votes p-4 border-end">
                        <p class="h1">{{ $suggestion->votes }}</p>
                        <p>votes</p>
                        @if (strpos($_COOKIE["list_upvoted_suggestion"], "sgt$suggestion->id-") !== false)
                            <a href="/suggestions/{{ $suggestion->id }}/deupvote" class="btn btn-outline-secondary d-block"><i class="bi bi-check2"></i>Voted up</a>
                        @else
                            <a href="/suggestions/{{ $suggestion->id }}/upvote" class="btn btn-secondary d-block">Upvote</a>
                        @endif
                    </div>
                </div>
                <div class="col-9 justify-content-left">
                    <div class="infos p-4">
                        <h3 class="h4">{{ $suggestion->content }}</h3>
                        <p>
                            Suggested by:
                            <span class="fw-bold">{{ $suggestion->contributor->name }}</span> {{ date("d M 'y", strtotime($suggestion->created_at)) }} | Upvoted: {{ date("d M 'y", strtotime($suggestion->upvoted_at)) }} |
                            <a href="#" class="text-secondary">Comments: {{ $suggestion->comments }}</a>
                        </p>
                        @if ($suggestion->is_pinned)
                            <label for="" class="bg-success text-light px-2 py-1 rounded">Pinned</label>
                        @endif
                        <label for="" class="bg-dark text-light px-2 py-1 rounded">{{ $suggestion->evaluation }}</label>
                    </div>
                </div>
            </div>

            @if ($suggestion->comments > 0)
                @php
                    {{
                        $comments = App\Models\Suggestion::find($suggestion->id)->getComments;
                    }}
                @endphp
                <div class="row border mt-4">
                    <span class="m-3"><i class="bi bi-chat-left-dots me-2"></i>Comments: {{ $suggestion->comments }}</span>
                </div>

                @foreach ($comments as $comment)
                    <div class="row border border-top-0">
                        <p class="fst-italic mt-3 ms-3">{{ date("d M 'y", strtotime($comment->created_at)) }}</p>
                        <p class="fw-bold ms-3">{{ $comment->contributor->name }}</p>
                        <p class="d-inline ms-3">{{ $comment->content }}</p>
                    </div>
                @endforeach
            @endif


            <div class="row border mt-4">
                <span class="m-3"><i class="bi bi-plus-square me-2"></i>Add a comment</span>
            </div>
            <div class="row border border-top-0 mb-5">
                <div class="row mt-3">
                    <div class="col-lg-12 ms-2">
                        <form method="POST" action="/suggestions/{{ $suggestion->id }}/comment">
                            @csrf
                            <label for="description" class="form-label"><span class="fw-bold h5">Message</span></label>
                            <div class="mb-4 input-group">
                                <textarea id="query" class="form-control" style="height: 140px" placeholder="Your comment" name="content"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="form-label"><span class="fw-bold h5">Name</span></label>
                                    <div class="mb-4 input-group">
                                        <input type="text" class="form-control" id="title" placeholder="Your name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label"><span class="fw-bold h5">Email</span></label>
                                    <div class="mb-4 input-group">
                                        <input type="email" class="form-control" id="title" placeholder="Your email" name="email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="shop-name" class="form-label"><span class="fw-bold h5">Shop name</span></label>
                                    <div class="mb-4 input-group">
                                        <input type="text" class="form-control" id="title" placeholder="Your shop" name="shop_name">
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

        </section>

    </section>

@endsection
