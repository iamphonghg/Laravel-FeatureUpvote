<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Contributor;
use App\Models\Suggestion;
use App\Http\Controllers\Controller;

class CommentController extends Controller {
    public function store(Request $request, $board, Suggestion $suggestion) {
        $contributor = new Contributor();
        $contributor->name = $request->name;
        $contributor->email = $request->email;
        $contributor->shop_name = $request->shop_name;
        $contributor->save();
        setcookie("uid", $contributor->id, time() + 86400 * 365, "/");

        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->suggestion_id = $suggestion->id;
        $comment->contributor_id = $contributor->id;
        $comment->status = 'Awaiting approval';
        $comment->save();

        return redirect(route('suggestions.show', [$board, $suggestion->id]));
    }
}
