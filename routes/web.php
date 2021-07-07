<?php

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
if (!isset($_COOKIE["list_upvoted_suggestion"])) {
    setcookie("list_upvoted_suggestion", "list:||||", time() + 86400 * 365, "/");
}

Route::get('/', 'SuggestionController@index');

Route::get('/suggestions/create', 'SuggestionController@create');

Route::get('/suggestions/{id}', 'SuggestionController@show');

Route::post('/suggestions/store', 'SuggestionController@store');

Route::post('/suggestions/{id}/comment', 'CommentController@store');

Route::get('/suggestions/{id}/upvote', 'UpvoteController@upvote');

Route::get('/suggestions/{id}/deupvote', 'UpvoteController@deupvote');
