<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use Illuminate\Http\Response;
use Livewire\Component;

class EditSuggestion extends Component {
    public $suggestion;
    public $title;
    public $description;
    public $name;
    public $shopName;
    public $email;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:4',
        'name' => 'required|min:4',
        'shopName' => 'required|min:4',
        'email' => 'required|email:rfc,dns'
    ];

    public function mount() {
        $this->title=$this->suggestion->title;
        $this->description=$this->suggestion->description;
        $this->name=$this->suggestion->contributor->name;
        $this->shopName=$this->suggestion->contributor->shop_name;
        $this->email=$this->suggestion->contributor->email;
    }

    public function updateSuggestion() {
        if (! $this->suggestion->currentUserCanEditThisSuggestion()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->suggestion->update([
            'title' => $this->title,
            'description' => $this->description
        ]);

        if (! (auth()->check() and $this->suggestion->contributor_id == auth()->user()->contributor_id)) {
            $this->suggestion->contributor->update([
                'name' => $this->name,
                'shop_name' => $this->shopName,
                'email' => $this->email
            ]);
        }

        $this->emit('suggestionWasUpdated');
    }

    public function render()
    {
        return view('livewire.edit-suggestion');
    }
}
