<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SuggestionShow extends Component {
    public $suggestion;
    public $votesCount;
    public $hasVoted;

    protected $listeners = ['statusWasUpdated', 'suggestionWasUpdated'];

    public function mount() {
        $this->hasVoted = $this->suggestion->isVotedByThisBrowser();
    }

    public function statusWasUpdated() {
        $this->suggestion->refresh();
    }
    public function suggestionWasUpdated() {
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
        return view('livewire.suggestion-show');
    }
}
