<?php

namespace App\Http\Livewire;

use App\Models\Board;
use App\Models\Contributor;
use Livewire\Component;
use Livewire\WithPagination;

class SuggestionsIndex extends Component {
    use WithPagination;

    public $urlName;
    public $status = 'all';
    public $filter;
    public $search;

    protected $queryString = [
        'status',
        'filter',
        'search'
    ];

    protected $listeners = ['queryStringUpdatedStatus'];

    public function mount()
    {
        $this->status = request()->status ?? 'all';
    }

    public function updatingFilter() {
        $this->resetPage();
    }
    public function updatingSearch() {
        $this->resetPage();
    }

    public function queryStringUpdatedStatus($newStatus) {
        $this->resetPage();
        $this->status = $newStatus;
    }

    public function currentAdminOwnsThisBoard() {
        $board = Board::where('url_name', $this->urlName)->first();
        return auth()->check()
            and $board->user_id == auth()->id();
    }

    public function render() {
        $board = Board::where('url_name', $this->urlName)->first();

        $contributorId = Contributor::currentContributorId();

        return view('livewire.suggestions-index', [
            'suggestions' => $board->suggestions()
            ->with('contributor')
            ->when(! $this->currentAdminOwnsThisBoard(), function ($query) {
                return $query->where([
                    ['status', '!=', 'awaiting'],
                    ['status', '!=', 'deleted']
                ]);
            })
            ->when($this->status and $this->status !== 'all', function ($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->filter and $this->filter === 'top_voted', function ($query) {
                return $query->orderByDesc('votes_count');
            })
            ->when($this->filter and $this->filter === 'my_suggestions', function ($query) use ($contributorId) {
                return $query->where('contributor_id', $contributorId);
            })
            ->when(strlen($this->search) >= 3, function ($query) use ($contributorId) {
                return $query->where('title', 'like', '%'.$this->search.'%');
            })
            ->withCount('votes')
            ->orderBy('id', 'desc')
            ->simplePaginate(7)
        ]);
    }
}
