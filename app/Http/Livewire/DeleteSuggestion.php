<?php

namespace App\Http\Livewire;

use App\Models\Suggestion;
use App\Models\Vote;
use Illuminate\Http\Response;
use Livewire\Component;

class DeleteSuggestion extends Component
{
    public $suggestion;
    public $urlName;

    public function deleteSuggestion() {
        if (! auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->suggestion->update([
            'status' => 'deleted'
        ]);

        return redirect()->route('suggestion.index', $this->urlName);
    }

    public function render()
    {
        return view('livewire.delete-suggestion');
    }
}
