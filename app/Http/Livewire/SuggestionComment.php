<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SuggestionComment extends Component {
    public $comment;

    protected $listeners = ['commentWasUpdated'];

    public function commentWasUpdated() {
        $this->comment->refresh();
    }

    public function render() {
        return view('livewire.suggestion-comment');
    }
}
