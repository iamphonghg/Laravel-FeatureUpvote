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

    public function mount() {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        } elseif (isset($_COOKIE['cid'])) {
            $contributor = Contributor::find($_COOKIE['cid']);
            if (isset($contributor)) {
                $this->name = $contributor->name;
                $this->shopName = $contributor->shop_name;
                $this->email = $contributor->email;
            }
        }
    }

    public function addComment() {
        $contributorId = 0;
        if (auth()->check()) {
            $contributorId = auth()->user()->contributor_id;
        } elseif (isset($_COOKIE['cid'])) {
            $contributor = Contributor::find($_COOKIE['cid']);
            if (isset($contributor)) {
                $contributor->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'shop_name' => $this->shopName
                ]);
                $contributorId = $_COOKIE['cid'];
            } else {
                $contributorId = Contributor::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'shop_name' => $this->shopName
                ])->id;
                setcookie("cid", $contributorId, time() + 86400 * 365, "/");
            }
        } else {
            $contributorId = Contributor::create([
                'name' => $this->name,
                'email' => $this->email,
                'shop_name' => $this->shopName
            ])->id;
            setcookie("cid", $contributorId, time() + 86400 * 365, "/");
        }

        Comment::create([
            'suggestion_id' => $this->suggestion->id,
            'contributor_id' => $contributorId,
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
