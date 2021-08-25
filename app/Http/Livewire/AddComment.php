<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Contributor;
use Livewire\Component;

class AddComment extends Component {
    public $suggestion;
    public $body;
    public $name;
    public $shopName;
    public $email;

    protected $rules = [
        'body' => 'required|min:4',
        'name' => 'required|min:4',
        'shopName' => 'required|min:4',
        'email' => 'required|email:rfc,dns'
    ];

    public function mount() {
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

    public function addComment() {
        $this->validate();

        $contributor = Contributor::find(Contributor::currentContributorId());
        if (! auth()->check()) {
            $contributor->update([
                'name' => $this->name,
                'shop_name' => $this->shopName,
                'email' => $this->email
            ]);
        }

        Comment::create([
            'suggestion_id' => $this->suggestion->id,
            'contributor_id' => $contributor->id,
            'body' => $this->body,
            'status' => 'approved'
        ]);

        $this->reset('body');
        $this->emit('commentWasAdded');
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
