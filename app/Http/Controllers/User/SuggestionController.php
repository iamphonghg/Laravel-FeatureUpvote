<?php

namespace App\Http\Controllers\User;

use App\Models\Boards;
use Illuminate\Http\Request;
use App\Models\Suggestion;
use App\Models\Contributor;
use App\Models\Vote;
use App\Http\Controllers\Controller;

class SuggestionController extends Controller {

    public function index(Request $request, $shortName) {
        $suggestions = Board::where('short_name', $shortName)->first();
        return view('user\main')->with('suggestions', $suggestions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $upvote = new Upvote();
        $upvote->suggestion_id = $suggestion->id;
        $upvote->ip = Controller::getIp();
        $upvote->name_and_email = "$contributor->name ($contributor->email)";
        $upvote->user_agent = $request->userAgent();
        $upvote->save();

        $newCookieValue = $_COOKIE["list_upvoted_suggestion"] . "sgt$suggestion->id-uvid$upvote->id||||";
        setcookie("list_upvoted_suggestion", $newCookieValue, time() + 86400 * 365, "/");

        return redirect(route('suggestions.show', $suggestion->id))->with('success', 'Your suggestion was added and approved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suggestion = Suggestion::findOrFail($id);
        return view('user\detail')->with('suggestion', $suggestion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
