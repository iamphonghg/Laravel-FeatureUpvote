<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentModerate extends Component {
    public $board;
    public $filter;
    public $status;
    public $selectedComments = [];

    protected $queryString = ['filter'];

    public function mount() {
        if (! isset($this->status)) {
            $this->status = 'approved';
        }
    }

    public function updatingFilter() {
        $this->board->refresh();
    }

    public function setStatus() {
        if (count($this->selectedComments) > 0) {
            foreach ($this->selectedComments as $selectedComment) {
                Comment::find($selectedComment)->update([
                    'status' => $this->status
                ]);

            }
            $this->emit('commentStatusWasUpdated');
            $this->selectedComments = [];
            $this->board->refresh();
        }
    }

    public function render() {
        return view('livewire.comment-moderate', [
            'comments' => Comment::whereIn('suggestion_id', $this->board->suggestions()->pluck('id')->toArray())
            ->with('suggestion', 'contributor')
            ->get()
            ->when($this->filter and $this->filter === 'approved', function ($query) {
                return $query->where('status', 'approved');
            })
            ->when($this->filter and $this->filter === 'deleted', function ($query) {
                return $query->where('status', 'deleted');
            })
        ]);
    }
}
