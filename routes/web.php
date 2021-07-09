<?php
    if (!isset($_COOKIE["list_upvoted_suggestion"])) {
        setcookie("list_upvoted_suggestion", "list:||||", time() + 86400 * 365, "/");
    }

    Route::get('/intro', 'Admin\AdminController@index');
    Route::get('/signin', 'Admin\SigninController@index');
    Route::get('/dashboard', 'Admin\AdminController@dashboard');

    Route::resource('suggestions', 'User\SuggestionController')->parameters([
        'suggestions' => 'id'
    ])->except([
        'index'
    ]);
    Route::get('/{short_name}', 'User\SuggestionController@index');

    Route::post('/suggestions/{id}/comment', 'User\CommentController@store');

    Route::get('/suggestions/{id}/upvote', 'User\UpvoteController@upvote');
    Route::get('/suggestions/{id}/deupvote', 'User\UpvoteController@deupvote');
