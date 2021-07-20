<?php
namespace App\Http\Controllers\User;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Contributor;
use App\Models\Vote;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller {
    public function index($board) {
        $boardRes = Board::where('short_name', $board)->first();
        if ($boardRes == null) {
            abort(404);
        } else {
            $suggestions = $boardRes->suggestions;
            if (Auth::check()) {
                return view('admin\main', compact('suggestions', 'board'));
            }
            return view('user\main', compact('suggestions', 'board'));
        }
    }

    public function create($board) {
        return view('user\create')->with('board', $board);
    }

    public function store(Request $request, $board) {
        $contributor = new Contributor();
        $contributor->name = $request->name;
        $contributor->email = $request->email;
        $contributor->shop_name = $request->shop_name;
        $contributor->save();
        setcookie("uid", $contributor->id, time() + 86400 * 365, "/");

        $suggestion = new Suggestion();
        $suggestion->title = $request->title;
        $suggestion->content = $request->get('content');
        $suggestion->contributor_id = $contributor->id;
        $suggestion->board_id = Board::where('short_name', $board)->first()->id;
        $suggestion->save();

        $vote = new Vote();
        $vote->suggestion_id = $suggestion->id;
        $vote->contributor_id = $contributor->id;
        $vote->ip = Controller::getIp();
        $vote->user_agent = $request->userAgent();
        $vote->save();

        $newCookieValue = $_COOKIE["list_voted_suggestion"] . "sgt$suggestion->id-vid$vote->id||||";
        setcookie("list_voted_suggestion", $newCookieValue, time() + 86400 * 365, "/");

        return redirect(route('suggestions.show', [$board, $suggestion->id]))->with('success', 'Your suggestion was added and approved.');
    }

    public function show($board, Suggestion $suggestion) {
        return view('user\detail', compact('board', 'suggestion'));
    }
}
