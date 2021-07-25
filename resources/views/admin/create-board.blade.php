@extends('layouts.dashboard')

@section('title', 'Feedback boards - Dashboard - Feature Vote')

@section('content')
    <section class="detail-vote container">
        <a href="{{ route('boards.index') }}" class="back text-secondary fw-bold h4 text-decoration-none">
            <i class="bi bi-arrow-left"></i>Back to feedback boards
        </a>
        <div class="row mt-4">
            <div class="row border mt-4">
                <span class="m-3 h4">Create new feedback board</span>
            </div>
            <div class="row border border-top-0 mb-5">
                <div class="row mt-3">
                    <div class="col-lg-12 ms-2">
                        <form method="GET" action="{{ route('boards.store') }}">
                            @csrf
                            @if (isset($boardNameError))
                                @if ($boardNameError)
                                    <div class="alert alert-danger">{{ $boardNameError }}</div>
                                @endif
                            @endif
                            <label for="boardName" class="form-label"><span class="fw-bold h5">Board name</span></label>
                            <div class="mb-4">
                                <input type="text" class="form-control" name="boardName">
                            </div>
                            @if (isset($shortNameError))
                                @if ($shortNameError)
                                    <div class="alert alert-danger">{{ $shortNameError }}</div>
                                @endif
                            @endif
                            <label for="boardName" class="form-label"><span class="fw-bold h5">Short name (used in board URL)</span></label>
                            <div>
                                <input type="text" class="form-control" name="shortName">
                            </div>
                            <label for="boardName" class="form-label mb-4"><span class="fw-bold h6 text-secondary">Unaccented lower case letters and numbers only. No spaces. At least five characters</span></label>
                            <div class="d-flex mb-4 text-center justify-content-end">
                                <button type="submit" class="btn btn-secondary me-2">Create new board</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
