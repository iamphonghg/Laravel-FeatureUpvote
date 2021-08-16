<?php

namespace App\Http\Livewire;

use App\Models\Board;
use App\Models\Contributor;
use App\Models\Suggestion;
use Livewire\Component;

class CreateSuggestion extends Component {
    public $title;
    public $description;
    public $name;
    public $shopName;
    public $email;
    public $urlName;

    protected $rules = [
        'title' => 'required|min-4',
        'description' => 'required|min-4',
        'name' => 'required|min-4',
        'shopName' => 'required|min-4',
    ];

    public function mount()
    {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        } elseif (isset($_COOKIE['cid'])) {
            $contributor = Contributor::find($_COOKIE['cid']);
            $this->name = $contributor->name;
            $this->shopName = $contributor->shop_name;
            $this->email = $contributor->email;

        }
    }

    public function createSuggestion() {
        // $this->validate();  ---error
        $boardId = Board::where('url_name', $this->urlName)->first()->id;

        $contributor = new Contributor();
        if (auth()->check()) {
            $contributor = Contributor::find(auth()->user()->contributor_id);
        } elseif (isset($_COOKIE['cid'])) {
            $contributor = Contributor::find($_COOKIE['cid']);
            $contributor->update([
                'name' => $this->name,
                'shop_name' => $this->shopName,
                'email' => $this->email
            ]);
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
            'board_id' => $boardId,
            'title' => $this->title,
            'description' => $this->description,
            'status' => 'considering',
        ]);
        session()->flash('successMessage', 'Suggestion was successfully added.');
        $board = $this->urlName;    // after use reset(), urlName will disappear
        $this->reset();
        return redirect()->route('suggestion.index', $board);
    }

    public function render() {
        return view('livewire.create-suggestion');
    }
}
