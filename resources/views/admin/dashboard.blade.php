@extends('layouts.dashboard')

@section('title', 'Feedback boards - Dashboard - Feature Vote')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" aria-current="page" href="#">
                            <span data-feather="home"></span>
                            <i class="bi bi-list-ul"></i>
                            Feedback Boards
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-person-plus"></i>
                            Team
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Feedback boards</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="" class="btn btn-secondary">Create feedback board</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Board</th>
                            <th scope="col">Suggestions</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Votes</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    @if (count($boards) > 0)
                        <tbody>
                            @foreach($boards as $board)
                                <tr>
                                    @php
                                        $suggestions = $board->suggestions;
                                        $comments = $votes = new \Illuminate\Database\Eloquent\Collection();
                                        $pendingSuggestions = $pendingComments = 0;
                                        foreach ($suggestions as $suggestion) {
                                            if ($suggestion->status == 'Awaiting approval') {
                                                $pendingSuggestions++;
                                            }
                                            $comments = $comments->merge($suggestion->comments);
                                            $votes = $votes->merge($suggestion->votes);
                                        }
                                        foreach ($comments as $comment) {
                                            if ($comment->status == 'Awaiting moderation') {
                                                $pendingComments++;
                                            }
                                        }
                                    @endphp
                                    <td>
                                        {{ $board->board_name }}
                                        <a class="d-block" href="{{ route('suggestions.index', $board->short_name) }}">View</a>
                                    </td>
                                    <td>
                                        {{ count($suggestions) }}
                                        <a class="d-block" href="#">{{ $pendingSuggestions }} pending</a>
                                    </td>
                                    <td>
                                        {{ count($comments) }}
                                        <a class="d-block" href="#">{{ $pendingComments }} pending</a>
                                    </td>
                                    <td>{{ count($votes) }}</td>
                                    <td>
                                        <a class="btn btn-outline-secondary">Moderate</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </main>
    </div>
</div>
@endsection
