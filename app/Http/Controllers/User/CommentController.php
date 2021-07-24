<?php

namespace App\Http\Controllers\User;

use App\Models\Board;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Contributor;
use App\Models\Suggestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
    public function store(Request $request, $board, Suggestion $suggestion) {
        $contributor = new Contributor();
        if (Auth::check()) {
            $contributor = Contributor::find($_COOKIE['@id']);
        } elseif (isset($_COOKIE['uid'])) {
            $contributor = Contributor::find($_COOKIE['uid']);
        } else {
            $contributor->name = $request->name;
            $contributor->email = $request->email;
            $contributor->shop_name = $request->shop_name;
            $contributor->save();
            setcookie("uid", $contributor->id, time() + 86400 * 365, "/");
        }

        $board = Board::where('short_name', $board)->first();

        $comment = new Comment();
        $comment->content = $request->get('content');
        $comment->suggestion_id = $suggestion->id;
        $comment->contributor_id = $contributor->id;
        if (Auth::check()) {
            $comment->status = 'Approved';
        } else {
            $comment->status = 'Awaiting approval';
        }
        $comment->save();

        return redirect(route('suggestions.show', [$board, $suggestion->id]));
    }
}
