<?php

namespace App\Http\Livewire;

use App\Models\Board;
use Illuminate\Http\Response;
use Livewire\Component;

class CreateBoard extends Component {
    public $boardName;
    public $urlName;

    public function createBoard() {
        if (! auth()->check()) {
            Response::HTTP_FORBIDDEN;
        }

        Board::create([
            'user_id' => auth()->id(),
            'board_name' => $this->boardName,
            'url_name' => $this->urlName,
        ]);

        $this->reset();
        return redirect()->route('board.index');
    }

    public function render() {
        return view('livewire.create-board');
    }
}
