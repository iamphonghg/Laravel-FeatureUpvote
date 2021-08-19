<?php

namespace App\Http\Livewire;

use App\Models\Suggestion;
use Livewire\Component;

class SuggestionModerate extends Component {
    public $board;
    public $filter;
    public $status;
    public $selectedSuggestions = [];

    protected $queryString = ['filter'];

    public function mount() {
        if (! isset($this->status)) {
            $this->status = 'awaiting';
        }
    }

    public function updatingFilter() {
        $this->board->refresh();
    }

    public function setStatus() {
        if (count($this->selectedSuggestions) > 0) {
            foreach ($this->selectedSuggestions as $selectedSuggestion) {
                Suggestion::find($selectedSuggestion)->update([
                    'status' => $this->status
                ]);

            }
            $this->emit('suggestionStatusWasUpdated');
            $this->selectedSuggestions = [];
            $this->board->refresh();
        }
    }

    public function render() {
        return view('livewire.suggestion-moderate', [
            'suggestions' => $this->board->suggestions()
                ->with('contributor')->get()
                ->when($this->filter and $this->filter === 'awaiting', function ($query) {
                    return $query->where('status', 'awaiting');
                })
                ->when($this->filter and $this->filter === 'considering', function ($query) {
                    return $query->where('status', 'considering');
                })
                ->when($this->filter and $this->filter === 'planned', function ($query) {
                    return $query->where('status', 'planned');
                })
                ->when($this->filter and $this->filter === 'not_planned', function ($query) {
                    return $query->where('status', 'not_planned');
                })
                ->when($this->filter and $this->filter === 'done', function ($query) {
                    return $query->where('status', 'done');
                })
                ->when($this->filter and $this->filter === 'deleted', function ($query) {
                    return $query->where('status', 'deleted');
                })
        ]);
    }
}
