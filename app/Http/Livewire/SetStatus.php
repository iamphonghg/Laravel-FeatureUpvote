<?php

namespace App\Http\Livewire;

use Illuminate\Http\Response;
use Livewire\Component;

class SetStatus extends Component {
    public $suggestion;
    public $status;

    public function mount()
    {
        $this->status = $this->suggestion->status;
    }

    public function setStatus() {
        if (!auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->suggestion->status = $this->status;
        $this->suggestion->save();

        $this->emit('statusWasUpdated');
    }

    public function render() {
        return view('livewire.set-status');
    }
}
