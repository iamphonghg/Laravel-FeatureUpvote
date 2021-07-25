@extends('layouts.suggestion')

@section('title', "Edit comment - $suggestion->title - $board->board_name")

@section('content')
    <section class="detail-vote container">
        <a href="{{ route('suggestions.show', [$board->short_name, $suggestion->id]) }}" class="back text-secondary fw-bold h4 text-decoration-none">
            <i class="bi bi-arrow-left"></i>Back
        </a>
        <div class="row mt-4">
            <div class="row border mt-4">
                <span class="m-3 h4">Edit comment</span>
            </div>
            <div class="row border border-top-0 mb-5">
                <div class="row mt-3">
                    <div class="col-lg-12 ms-2">
                        <form method="GET" action="{{ route('comments.save', $comment) }}">
                            @csrf
                            <label for="content" class="form-label"><span class="fw-bold h5">Message</span></label>
                            <div class="mb-4">
                                <textarea class="form-control" style="height: 140px" name="content">{{ $comment->content }}</textarea>
                            </div>
                            <p>
                                Name: {{ $contributor->name }}
                                <br>
                                Email: {{ $contributor->email }}
                            </p>
                            <div class="d-flex mb-4 text-center justify-content-end">
                                <button type="submit" class="btn btn-secondary me-2">Save</button>
                                <a href="/" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
