<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use Livewire\Component;

class SuggestionIndex extends Component {
    public $suggestion;
    public $votesCount;
    public $urlName;
    public $hasVoted;

    public function mount() {
        $this->hasVoted = $this->suggestion->isVotedByThisBrowser();
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
        return view('livewire.suggestion-index');
    }
}
