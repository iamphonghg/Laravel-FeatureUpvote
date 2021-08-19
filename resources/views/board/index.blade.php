@extends('layouts.dashboard')

@section('content')
    <header class="max-w-7xl mx-auto bg-white flex items-center justify-between">
        <div class="mx-9 py-6 mt-4">
            <h1 class="text-3xl font-bold text-gray-900">
                Boards
            </h1>
        </div>
        <div x-data class="mx-9 py-6 mt-4">
            <a
                href="#"
                @click.prevent="
                    Livewire.emit('showCreateBoard')
                "
                class="w-28 text-base text-white bg-blue hover:text-gray-50 hover:bg-blue-hover rounded-xl py-2 px-3 leading-none transition ease-in duration-150 text-center">
                Create new board
            </a>
        </div>
    </header>

    <livewire:boards-table
        :boards="$boards"
    />
    <livewire:create-board />
@endsection
