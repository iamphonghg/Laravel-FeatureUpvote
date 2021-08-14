<?php

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
if (!isset($_COOKIE["voted_suggestion_list"])) {
    setcookie("voted_suggestion_list", "list:||", time() + 86400 * 365, "/");
}

Route::get('/', function() {
    return redirect(route('suggestion.index', 'demoproduct'));
});

Route::get('/boards/{board:url_name}', [SuggestionController::class, 'index'])->name('suggestion.index');

Route::get('/boards/{board:url_name}/suggestions/{suggestion:slug}', [SuggestionController::class, 'show'])->name('suggestion.show');

require __DIR__.'/auth.php';
