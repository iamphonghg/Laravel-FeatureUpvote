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

    public function mount() {
        $this->title=$this->suggestion->title;
        $this->description=$this->suggestion->description;
        $this->name=$this->suggestion->contributor->name;
        $this->shopName=$this->suggestion->contributor->shop_name;
        $this->email=$this->suggestion->contributor->email;
    }

    public function updateSuggestion() {
        if (!$this->suggestion->currentContributorCanEditSuggestion()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->suggestion->update([
            'title' => $this->title,
            'description' => $this->description
        ]);

        $this->suggestion->contributor->update([
            'name' => $this->name,
            'shop_name' => $this->shopName,
            'email' => $this->email
        ]);

        $this->emit('suggestionWasUpdated');
    }

    public function render()
    {
        return view('livewire.edit-suggestion');
    }
}
