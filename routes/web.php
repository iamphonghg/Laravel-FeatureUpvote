<?php
    if (!isset($_COOKIE["list_voted_suggestion"])) {
        setcookie("list_voted_suggestion", "list:||||", time() + 86400 * 365, "/");
    }

    Route::get('/intro', 'Admin\AdminController@index');
    Route::get('/signin', 'Admin\SigninController@index');
    Route::get('/dashboard', 'Admin\AdminController@dashboard');

    Route::resource('{short_name}/suggestions', 'User\SuggestionController')->except([
        'index'
    ]);
    Route::get('/{short_name}', 'User\SuggestionController@index');

    Route::post('/suggestions/{id}/comment', 'User\CommentController@store');

    Route::get('/suggestions/{id}/vote', 'User\VoteController@vote');
    Route::get('/suggestions/{id}/devote', 'User\VoteController@devote');
