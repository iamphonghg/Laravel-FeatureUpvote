<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\SuggestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
CookieController::checkCookie();

Route::get('/', function() {
    return redirect(route('suggestion.index', 'demoproduct'));
});

Route::get('/boards/{board:url_name}', [SuggestionController::class, 'index'])->name('suggestion.index');

Route::get('/boards/{board:url_name}/suggestions/{suggestion:slug}', [SuggestionController::class, 'show'])->name('suggestion.show');

Route::get('/dashboard', [BoardController::class, 'index'])->name('board.index')->middleware('auth');

Route::get('/dashboard/{board:url_name}', [BoardController::class, 'moderate'])->name('board.moderate')->middleware('auth');

require __DIR__.'/auth.php';
