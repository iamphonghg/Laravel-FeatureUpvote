@extends('layouts.suggestion')

@section('title', "User Suggestion - $board->board_name")

@php
    $suggestions = $contributor->suggestions;
    $comments = $contributor->comments;
@endphp

@section('content')
    <section class="container">
        <a href="/boards/{{ $board->short_name }}" class="back text-secondary fw-bold h4 text-decoration-none mt-3">
            <i class="bi bi-arrow-left"></i>{{ $board->board_name }}
        </a>
        <h1 class="mt-3">Contributor</h1>
        <div class="panel">
            <div class="panel-body">
                <p class="margin-bottom">
                    Contributor name: {{ $contributor->name }}
                    <br>
                    Email: {{ $contributor->email }}
                    <br>
                    Date created: {{ $contributor->created_at }}
                </p>
                <h4>Suggestions</h4>
                    @if (count($suggestions) == 0)
                        No suggestions
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Suggestion title</th>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($suggestions as $suggestion)
                                    <tr>
                                        <td>
                                            <a class="d-block" href="{{ route('suggestions.show', [$board->short_name, $suggestion]) }}">{{ $suggestion->title }}</a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                <h4>Comments</h4>
                    @if (count($comments) == 0)
                        <p class="ms-4">No comments</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">Comment</th>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>
                                            {{ $comment->content }}
                                            <p>on <a href="{{ route('suggestions.show', [$board->short_name, $comment->suggestion]) }}"> {{ $comment->suggestion->title }}</a></p>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
            </div>
        </div>
    </section>


@endsection
