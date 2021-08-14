@extends('layouts.app', ['urlName' => $urlName])

@section('content')
    <livewire:suggestions-index
        :urlName="$urlName"
    />
@endsection
