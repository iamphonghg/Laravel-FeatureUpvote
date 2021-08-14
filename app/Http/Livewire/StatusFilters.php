<?php

namespace App\Http\Livewire;

use App\Models\Suggestion;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component {
    public $urlName;
    public $status;
    public $statusCount;



    public function mount() {
        $this->statusCount = $this->getCount();
        $this->status = request()->status ?? 'all';

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
        return view('livewire.status-filters');
    }

    private function getPreviousRouteName() {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    private function getCount()
    {
        return Suggestion::query()
            ->selectRaw("COUNT(*) AS all_statuses")
            ->selectRaw("COUNT(CASE WHEN status = 'considering' THEN 'considering' END) AS considering")
            ->selectRaw("COUNT(CASE WHEN status = 'planned' THEN 'planned' END) AS planned")
            ->selectRaw("COUNT(CASE WHEN status = 'not_planned' THEN 'not_planned' END) AS not_planned")
            ->selectRaw("COUNT(CASE WHEN status = 'done' THEN 'done' END) AS done")
            ->first()
            ->toArray();
    }
}
