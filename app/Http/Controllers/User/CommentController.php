<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Contributor;
use App\Models\Suggestion;
use App\Http\Controllers\Controller;

class CommentController extends Controller {
    public function store(Request $request, $id) {
        $contributor = new Contributor();
        $contributor->name = $request->name;
        $contributor->email = $request->email;
        $contributor->shop_name = $request->shop_name;
        $contributor->save();

        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->suggestion_id = $id;
        $comment->contributor_id = $contributor->id;
        $comment->save();

        $suggestion = Suggestion::find($id);
        $suggestion->comments++;
        $suggestion->save();
        return redirect(route('suggestions.show', $id));
    }
}
