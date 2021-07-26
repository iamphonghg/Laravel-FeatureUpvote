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
        $board = Board::where('short_name', $board)->first();
        if ($board == null) {
            abort(404);
        } else {
            $suggestions = Suggestion::orderBy('is_pinned', 'DESC')->where('board_id', $board->id)->get();
            if (Auth::check()) {
                return view('admin\board', compact('suggestions', 'board'));
            }
            return view('user\board', compact('suggestions', 'board'));
        }
    }

    public function create($board) {
        $board = Board::where('short_name', $board)->first();
        $isEdited = false;
        return view('user\create', compact('board', 'isEdited'));
    }

    public function store(Request $request, $board) {
        $contributor = new Contributor();
        if (Auth::check()) {
            $contributor = Contributor::find($_COOKIE['@id']);
        } elseif (isset($_COOKIE['uid'])) {
            $contributor = Contributor::find($_COOKIE['uid']);
            $contributor->name = $request->name;
            $contributor->email = $request->email;
            $contributor->shop_name = $request->shop_name;
            $contributor->save();
        } else {
            $contributor->name = $request->name;
            $contributor->email = $request->email;
            $contributor->shop_name = $request->shop_name;
            $contributor->save();
            setcookie("uid", $contributor->id, time() + 86400 * 365, "/");
        }

        $board = Board::where('short_name', $board)->first();
        $suggestion = '';
        if ($request->isEdited) {
            $suggestion = Suggestion::find($request->suggestion_id);
            $suggestion->title = $request->title;
            $suggestion->content = $request->get('content');
            $suggestion->contributor_id = $contributor->id;
            $suggestion->board_id = $board->id;
            if (Auth::check()) {
                $suggestion->status = 'Under consideration';
            }
        } else {
            $suggestion->title = $request->title;
            $suggestion->content = $request->get('content');
            $suggestion->contributor_id = $contributor->id;
            $suggestion->board_id = $board->id;
            if (Auth::check()) {
                $suggestion->status = 'Under consideration';
            }
        }
        $suggestion->save();

        $message = '';
        if (!$request->isEdited) {
            $vote = new Vote();
            $vote->suggestion_id = $suggestion->id;
            $vote->contributor_id = $contributor->id;
            $vote->ip = Controller::getIp();
            $vote->user_agent = $request->userAgent();
            $vote->save();
            $newCookieValue = $_COOKIE["list_voted_suggestion"] . "sgt$suggestion->id-vid$vote->id||||";
            setcookie("list_voted_suggestion", $newCookieValue, time() + 86400 * 365, "/");
            $message = 'Your suggestion was added and is awaiting approval.';
        } else {
            $message = 'Your suggestion was successfully edited.';
        }
        return redirect(route('suggestions.show', [$board->short_name, $suggestion->id]))->with('message', $message);
    }

    public function show($board, Suggestion $suggestion) {
        $board = Board::where('short_name', $board)->first();
        if (Auth::check()) {
            return view('admin\suggestion', compact('board', 'suggestion'));
        }
        return view('user\suggestion', compact('board', 'suggestion'));
    }

    public function pin($board, Suggestion $suggestion) {
        $board = Board::where('short_name', $board)->first();
        $suggestion->is_pinned = true;
        $suggestion->save();
        return redirect(route('suggestions.index', $board->short_name));
    }

    public function unpin($board, Suggestion $suggestion) {
        $board = Board::where('short_name', $board)->first();
        $suggestion->is_pinned = false;
        $suggestion->save();
        return redirect(route('suggestions.index', $board->short_name));
    }
    public function edit($board, Suggestion $suggestion) {
        $board = Board::where('short_name', $board)->first();
        $isEdited = true;
        return view('user\create', compact('board', 'suggestion', 'isEdited'));
    }
}
