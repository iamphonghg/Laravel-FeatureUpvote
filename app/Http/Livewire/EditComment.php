<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Response;
use Livewire\Component;

class EditComment extends Component {
    public Comment $comment;
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

    protected $listeners = ['setEditComment'];

    public function setEditComment($commentId) {
        $this->comment = Comment::findOrFail($commentId);
        $this->body = $this->comment->body;
        $this->name = $this->comment->contributor->name;
        $this->shopName = $this->comment->contributor->shop_name;
        $this->email = $this->comment->contributor->email;

        $this->emit('editCommentWasSet');
    }

    public function updateComment() {
        if (! $this->comment->currentUserCanEditThisComment()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->comment->update([
            'body' => $this->body
        ]);

        if (! (auth()->check() and $this->comment->contributor_id == auth()->user()->contributor_id)) {
            $this->comment->contributor->update([
                'name' => $this->name,
                'shop_name' => $this->shopName,
                'email' => $this->email
            ]);
        }


        $this->emit('commentWasUpdated');
    }

    public function render() {
        return view('livewire.edit-comment');
    }
}
