<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\Upvote;
use Illuminate\Http\Request;

class UpvoteController extends Controller
{
    public function upvote(Request $request, $id) {
//        $suggestion = Suggestion::find($id);
//        $suggestion->votes++;
//        $suggestion->save();
//
//        $upvote = new Upvote();
//        $upvote->suggestion_id = $id;
//        $upvote->ip = Controller::getIp();
//        $upvote->user_agent = $request->userAgent();
//        $upvote->save();
//
//        $newCookieValue = $_COOKIE["list_upvoted_suggestion"] . "sgt$suggestion->id-uvid$upvote->id||||";
//        setcookie("list_upvoted_suggestion", $newCookieValue, time() + 86400 * 365, "/");

        return redirect("/suggestions/$id");
    }

    public function deupvote($id) {
//        $suggestion = Suggestion::find($id);
//        $suggestion->votes--;
//        $suggestion->save();
//        $upvotes = explode("||||", $_COOKIE["list_upvoted_suggestion"]);
//        $upvoteId = 0;
//        for ($i = 1; $i < count($upvotes); $i++) {
//            if (strpos($upvotes[$i], "sgt$id-") !== false) {
//                $upvoteId = explode("-uvid", $upvotes[$i])[1];
//                break;
//            }
//        }
//        $upvote = Upvote::find($upvoteId);
//        $upvote->delete();
//
//        $newCookie = str_replace("||sgt$id-uvid$upvoteId||", "", $_COOKIE["list_upvoted_suggestion"]);
//        setcookie("list_upvoted_suggestion", $newCookie, time() + 86400 * 365, "/");
        return redirect("/suggestions/$id");
    }
}
