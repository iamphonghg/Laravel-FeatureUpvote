<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SuggestionComments extends Component {
    public $suggestion;

    protected $listeners = ['commentWasAdded', 'commentWasDeleted'];

    public function commentWasAdded() {
        $this->suggestion->refresh();
    }
    public function commentWasDeleted() {
        $this->suggestion->refresh();
    }

    public function render() {
        return view('livewire.suggestion-comments', [
            'comments' => $this->suggestion->comments()->where([
                ['status', '!=', 'awaiting'],
                ['status', '!=', 'deleted']
            ])->get(),
        ]);
    }
}
