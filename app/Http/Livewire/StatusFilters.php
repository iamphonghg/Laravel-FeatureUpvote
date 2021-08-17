<?php

namespace App\Http\Livewire;

use App\Models\Board;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component {
    public $urlName;
    public $status;
    public $statusCount;
    public $allCount;  // the "all" count of admin and not login or not-own-this-board admin are different
    public $board;



    public function mount() {
        $this->statusCount = $this->getCountExceptAll();
        $this->status = request()->status ?? 'all';
        $this->board = Board::where('url_name', $this->urlName)->first();
        if ($this->board->user_id == auth()->id()) {
            $this->allCount = Suggestion::where('board_id', $this->board->id)->count();
        } else {
            $this->allCount = Suggestion::where('board_id', $this->board->id)
                    ->where([
                        ['status', '!=', 'awaiting'],
                        ['status', '!=', 'deleted']
                    ])
                    ->count();
        }

        if (Route::currentRouteName() === 'suggestion.show') {
            $this->status = null;
            $this->queryString = [];
        }
    }

    public function setStatus($newStatus) {
        $this->status = $newStatus;
        $this->emit('queryStringUpdatedStatus', $this->status);

        if ($this->getPreviousRouteName() === 'suggestion.show') {
            return redirect()->route('suggestion.index', [
                'board' => $this->urlName,
                'status' => $this->status
            ]);
        }
    }

    public function render() {
        return view('livewire.status-filters', ['board' => $this->board]);
    }

    private function getPreviousRouteName() {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    private function getCountExceptAll()
    {
        return Suggestion::query()
            ->selectRaw("COUNT(CASE WHEN status = 'considering' THEN 'considering' END) AS considering")
            ->selectRaw("COUNT(CASE WHEN status = 'planned' THEN 'planned' END) AS planned")
            ->selectRaw("COUNT(CASE WHEN status = 'not_planned' THEN 'not_planned' END) AS not_planned")
            ->selectRaw("COUNT(CASE WHEN status = 'done' THEN 'done' END) AS done")
            ->first()
            ->toArray();
    }
}
