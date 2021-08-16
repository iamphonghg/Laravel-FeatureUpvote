<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Response;
use Livewire\Component;

class DeleteComment extends Component {
    public Comment $comment;

    protected $listeners = ['setDeleteComment'];

    public function setDeleteComment($commentId) {
        $this->comment = Comment::findOrFail($commentId);

        $this->emit('deleteCommentWasSet');
    }

    public function deleteComment() {
        if (! auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->comment->update([
            'status' => 'deleted'
        ]);

        $this->emit('commentWasDeleted');
    }

    public function render() {
        return view('livewire.delete-comment');
    }
}
