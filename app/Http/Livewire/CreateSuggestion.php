<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CookieController;
use App\Models\Board;
use App\Models\Contributor;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class CreateSuggestion extends Component {
    public $title;
    public $description;
    public $name;
    public $shopName;
    public $email;
    public $urlName;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:4',
        'name' => 'required|min:4',
        'shopName' => 'required|min:4',
        'email' => 'required|email:rfc,dns'
    ];

    protected $listeners = ['commentWasAdded', 'commentWasUpdated'];

    public function commentWasAdded() {
        $this->reset();
        $this->mount();
    }
    public function commentWasUpdated() {
        $this->reset();
        $this->mount();
    }

    public function mount()
    {
        $contributor = Contributor::find(Contributor::currentContributorId());
        if ($contributor) {
            if ($contributor->name == 'New User') {
                $this->name = '';
            } else {
                $this->name = $contributor->name;
            }
            $this->shopName = $contributor->shop_name;
            $this->email = $contributor->email;
        }
    }

    /**
     * Create new suggestion, then vote for it, update contributor information if the current user is
     * normal user.
     */
    public function createSuggestion() {
        $this->validate();

        $board = Board::where('url_name', $this->urlName)->first();

        $contributor = Contributor::find(Contributor::currentContributorId());
        if (! auth()->check()) {
            $contributor->update([
                'name' => $this->name,
                'shop_name' => $this->shopName,
                'email' => $this->email
            ]);
        }

        $suggestion = Suggestion::create([
            'contributor_id' => $contributor->id,
            'board_id' => $board->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => 'considering',
        ]);

        $suggestion->vote();

        session()->flash('successMessage', 'Suggestion was successfully added.');
        $this->reset();
        return redirect()->route('suggestion.index', $board->url_name);
    }

    public function render() {
        return view('livewire.create-suggestion');
    }
}
