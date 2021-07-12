<?php

namespace App\Http\Controllers\User;

use App\Models\Suggestion;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoteController extends Controller
{
    public function vote(Request $request, $board, Suggestion $suggestion) {
        $vote = new Vote();
        $vote->suggestion_id = $suggestion->id;
        if (!isset($_COOKIE["uid"])) {
            $vote->contributor_id = 0;
        } else {
            $vote->contributor_id = $_COOKIE["uid"];
        }
        $vote->ip = Controller::getIp();
        $vote->user_agent = $request->userAgent();
        $vote->save();

        $newCookieValue = $_COOKIE["list_voted_suggestion"] . "sgt$suggestion->id-vid$vote->id||||";
        setcookie("list_voted_suggestion", $newCookieValue, time() + 86400 * 365, "/");

        return redirect(route('suggestions.show', [$board, $suggestion->id]));

    }

    public function devote($board, Suggestion $suggestion) {
        $votes = explode("||||", $_COOKIE["list_voted_suggestion"]);
        $voteId = 0;
        for ($i = 1; $i < count($votes); $i++) {
            if (strpos($votes[$i], "sgt$suggestion->id-") !== false) {
                $voteId = explode("-vid", $votes[$i])[1];
                break;
            }
        }
        $vote = Vote::find($voteId);
        $vote->delete();

        $newCookie = str_replace("||sgt$suggestion->id-vid$voteId||", "", $_COOKIE["list_voted_suggestion"]);
        setcookie("list_voted_suggestion", $newCookie, time() + 86400 * 365, "/");
        return redirect(route('suggestions.show', [$board, $suggestion->id]));
    }
}
