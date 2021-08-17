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

        $this->comment->body = $this->body;
        $this->comment->save();

        $this->comment->contributor->update([
            'name' => $this->name,
            'shop_name' => $this->shopName,
            'email' => $this->email
        ]);

        $this->emit('commentWasUpdated');
    }

    public function render() {
        return view('livewire.edit-comment');
    }
}
