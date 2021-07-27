@extends('layouts.suggestion')

@section('title', "Edit suggestion - $board->board_name")

@php

@endphp

@section('content')
    <section class="container">
        <a href="/boards/{{ $board->short_name }}" class="back text-secondary fw-bold h4 text-decoration-none mt-3">
            <i class="bi bi-arrow-left"></i>All suggestions
        </a>
        <h1 class="mt-3">Suggestion not found</h1>
        <h2 class="mt-3">This suggestion is awaiting moderation.</h2>
    </section>
@endsection
