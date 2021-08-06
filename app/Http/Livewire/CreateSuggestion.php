<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use App\Models\Suggestion;
use Livewire\Component;

class CreateSuggestion extends Component {
    public $title;
    public $description;
    public $name;
    public $shopName;
    public $email;

    protected $rules = [
        'title' => 'required|min-4',
        'description' => 'required|min-4',
        'name' => 'required|min-4',
        'shopName' => 'required|min-4',
    ];

    public function createSuggestion() {
        // $this->validate();  ---error
        $contributor = new Contributor();
        if (isset($_COOKIE['cid'])) {
            $contributor = Contributor::find($_COOKIE['cid']);
            $contributor->name = $this->name;
            $contributor->shop_name = $this->shopName;
            $contributor->email = $this->email;
        } else {
            $contributor = Contributor::create([
                'name' => $this->name,
                'email' => $this->email,
                'shop_name' => $this->shopName,
            ]);
            setcookie("cid", $contributor->id, time() + 86400 * 365, "/");
        }
        Suggestion::create([
            'contributor_id' => $contributor->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => 'Considering',
        ]);
        session()->flash('successMessage', 'Suggestion was successfully added.');
        $this->reset();
        return redirect()->route('suggestion.index');
    }

    public function render() {
        return view('livewire.create-suggestion');
    }
}
