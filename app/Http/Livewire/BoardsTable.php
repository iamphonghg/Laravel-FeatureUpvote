<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BoardsTable extends Component {
    public $boards;

    public function render() {
        return view('livewire.boards-table');
    }
}
