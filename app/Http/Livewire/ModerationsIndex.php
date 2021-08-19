<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModerationsIndex extends Component {
    public $board;
    public $show = true;

    public function render() {
        return view('livewire.moderations-index');
    }
}
