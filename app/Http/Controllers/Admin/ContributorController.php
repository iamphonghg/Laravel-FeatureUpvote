<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Contributor;
use Illuminate\Http\Request;

class ContributorController extends Controller {
    public function index() {
        //
    }


    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }


    public function show($board, Contributor $contributor) {
        $board = Board::where('short_name', $board)->first();
        return view('admin\contributor', compact(['board', 'contributor']));
    }

    public function edit($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {

    }
}
