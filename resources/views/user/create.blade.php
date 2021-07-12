@extends('layouts.layout')

@section('content')
    <section class="container">
        <a href="/boards/{{ $board }}" class="back text-secondary fw-bold h4 text-decoration-none mt-3">
            <i class="bi bi-arrow-left"></i>Back
        </a>
        <h1 class="mt-3">What improvement would you like to see in our product?</h1>
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <form action="{{ route('suggestions.store', $board) }}" method="GET">
                        @csrf
                        <label for="title" class="form-label"><span class="fw-bold h5">Title</span></label>
                        <div class="mb-4 input-group">
                            <input type="text" class="form-control" id="title" placeholder="Your suggestion" name="title">
                        </div>

                        <label for="description" class="form-label"><span class="fw-bold h5">Description</span></label>
                        <div class="mb-4 input-group">
                            <textarea id="query" class="form-control" style="height: 140px" placeholder="Description of your suggestion (optional)" name="content"></textarea>
                        </div>


                            <a href="" class="btn btn-outline-secondary mb-4">Add image (optional)</a>


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
                                <label for="email" class="form-label"><span class="fw-bold h5">Shop name</span></label>
                                <div class="mb-4 input-group">
                                    <input type="text" class="form-control" id="title" placeholder="Your email" name="shop_name">
                                </div>
                            </div>

                        </div>

                        <div class="d-flex mb-4 text-center justify-content-end">
                            <button type="submit" class="btn btn-secondary me-2">Post suggestion</button>
                            <a href="/" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
