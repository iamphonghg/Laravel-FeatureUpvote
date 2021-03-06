<?php

namespace App\Http\Livewire;

use Illuminate\Http\Response;
use Livewire\Component;

class SuggestionShow extends Component {
    public $suggestion;
    public $votesCount;
    public $hasVoted;

    protected $listeners = ['statusWasUpdated', 'suggestionWasUpdated', 'commentWasAdded', 'commentWasDeleted'];

    public function mount() {
        $this->hasVoted = $this->suggestion->isVotedByCurrentUser();
    }

    public function statusWasUpdated() {
        $this->suggestion->refresh();
    }
    public function suggestionWasUpdated() {
        $this->suggestion->refresh();
    }
    public function commentWasAdded() {
        $this->suggestion->refresh();
    }
    public function commentWasDeleted() {
        $this->suggestion->refresh();
    }

    public function vote() {
        if ($this->hasVoted) {
            $this->suggestion->removeVote();
            $this->votesCount--;
            $this->hasVoted = false;
        } else {
            $this->suggestion->vote();
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }

    public function render() {
        if (! $this->suggestion->currentAdminOwnsThisBoard() and ($this->suggestion->status == 'deleted' or $this->suggestion->status == 'awaiting')) {
            abort(Response::HTTP_FORBIDDEN);
        }
        return view('livewire.suggestion-show');
    }
}
