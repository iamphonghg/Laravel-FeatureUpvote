<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function index() {
        $id = Auth::id();
        $boards = Board::where('user_id', $id)->get();
        return view('admin/dashboard')->with('boards', $boards);
    }

    public function create() {
        return view('admin/create-board');
    }


    public function store(Request $request) {
        $boardNameError = $shortNameError = '';
        if (Board::where('board_name', $request->boardName)->first()) {
            $boardNameError = "$request->boardName already used by another of your company's boards";
        }
        if (Board::where('short_name', $request->shortName)->first()) {
            $shortNameError = "Board short name '$request->shortName' already used by another board.";
        }
        if ($boardNameError or $shortNameError) {
            return view('admin/create-board')->with('boardNameError', $boardNameError)->with('shortNameError', $shortNameError);
        } else {
            $id = Auth::id();
            $board = new Board();
            $board->user_id = $id;
            $board->board_name = $request->boardName;
            $board->short_name = $request->shortName;
            $board->save();
            return redirect(route('boards.index'));
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
