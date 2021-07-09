<?php
namespace App\Http\Controllers\User;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Contributor;
use App\Models\Vote;
use App\Http\Controllers\Controller;

class SuggestionController extends Controller {
    public function index($shortName) {
        $board = Board::where('short_name', $shortName)->first();
        if ($board == null) {
            abort(404);
        } else {
            $suggestions = $board->suggestions;
            return view('user\main', compact('suggestions', 'shortName'));
        }
    }

    public function create() {
        return view('user\create');
    }

    public function store(Request $request) {
        $contributor = new Contributor();
        $contributor->name = $request->name;
        $contributor->email = $request->email;
        $contributor->shop_name = $request->shop_name;
        $contributor->save();

        $suggestion = new Suggestion();
        $suggestion->title = $request->title;
        $suggestion->content = $request->get('content');
        $suggestion->contributor_id = $contributor->id;
        $suggestion->save();
        $vote = new Vote();
        $vote->suggestion_id = $suggestion->id;
        $vote->ip = Controller::getIp();
        $vote->name_and_email = "$contributor->name ($contributor->email)";
        $vote->user_agent = $request->userAgent();
        $vote->save();

        $newCookieValue = $_COOKIE["list_voted_suggestion"] . "sgt$suggestion->id-uvid$vote->id||||";
        setcookie("list_voted_suggestion", $newCookieValue, time() + 86400 * 365, "/");

        return redirect(route('suggestions.show', $suggestion->id))->with('success', 'Your suggestion was added and approved.');
    }

    public function show($shortName, Suggestion $suggestion) {
        return view('user\detail', compact('shortName', 'suggestion'));
    }

    public function edit($id) {
    }

    public function update(Request $request, $id) {
    }

    public function destroy($id) {
    }
}
