@extends('layouts.suggestion')

@section('title', "Add Suggestion - $board->board_name")

@section('content')
    <section class="container">
        <a href="/boards/{{ $board->short_name }}" class="back text-secondary fw-bold h4 text-decoration-none mt-3">
            <i class="bi bi-arrow-left"></i>Back
        </a>
        <h1 class="mt-3">What improvement would you like to see in our product?</h1>
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    @php
                        $title = $content = '';
                        if ($isEdited) {
                            $title = $suggestion->title;
                            $content = $suggestion->content;
                        }
                    @endphp
                    <form action="{{ route('suggestions.store', [$board->short_name]) }}" method="GET">
                        @csrf
                        <label for="title" class="form-label"><span class="fw-bold h5">Title</span></label>
                        <div class="mb-4 input-group">
                            <input type="text" class="form-control" id="title" placeholder="Your suggestion" name="title" value="{{ $title }}">
                        </div>

                        <label for="description" class="form-label"><span class="fw-bold h5">Description</span></label>
                        <div class="mb-4 input-group">
                            <textarea id="query" class="form-control" style="height: 140px" placeholder="Description of your suggestion (optional)" name="content">{{ $content }}</textarea>
                        </div>


                            <a href="" class="btn btn-outline-secondary mb-4">Add image (optional)</a>

                        @php
                            $name = $email = $shop_name = '';
                            $lockInfo = '';
                            $contributor = new \App\Models\Contributor();
                            if (\Illuminate\Support\Facades\Auth::check()) {
                                $lockInfo = 'readonly';
                                $contributor = \App\Models\Contributor::find($_COOKIE['@id']);
                                $name = $contributor->name;
                                $email = $contributor->email;
                                $shop_name = $contributor->shop_name;
                            } elseif (isset($_COOKIE['uid'])) {
                                $contributor = \App\Models\Contributor::find($_COOKIE['uid']);
                                $name = $contributor->name;
                                $email = $contributor->email;
                                $shop_name = $contributor->shop_name;
                            }
                        @endphp

                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class="form-label"><span class="fw-bold h5">Name</span></label>
                                <div class="mb-4 input-group">
                                    <input type="text" class="form-control" id="title" placeholder="Your name" name="name" value="{{ $name }}" {{ $lockInfo }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label"><span class="fw-bold h5">Email</span></label>
                                <div class="mb-4 input-group">
                                    <input type="email" class="form-control" id="title" placeholder="Your email" name="email" value="{{ $email }}" {{ $lockInfo }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label"><span class="fw-bold h5">Shop name</span></label>
                                <div class="mb-4 input-group">
                                    <input type="text" class="form-control" id="title" placeholder="Your shop" name="shop_name" value="{{ $shop_name }}" {{ $lockInfo }}>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex mb-4 text-center justify-content-end">
                            <button type="submit" class="btn btn-secondary me-2">
                                @if (!$isEdited)
                                    Post suggestion
                                @else
                                    Save
                                @endif
                            </button>
                            <a href="/" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                        @if ($isEdited)
                            <input type="hidden" name="isEdited" value="{{ true }}">
                            <input type="hidden" name="suggestion_id" value="{{ $suggestion->id }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
