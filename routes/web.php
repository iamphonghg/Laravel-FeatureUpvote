<?php
    if (!isset($_COOKIE["list_voted_suggestion"])) {
        setcookie("list_voted_suggestion", "list:||||", time() + 86400 * 365, "/");
    }

    Route::get('/intro', 'Admin\AdminController@index');
    Route::get('/signin', 'Admin\SigninController@index');
    Route::get('/dashboard', 'Admin\AdminController@dashboard');

    Route::get('/boards/{board}', 'User\SuggestionController@index')->name('suggestions.index');
    Route::get('/boards/{board}/suggestions', 'User\SuggestionController@store')->name('suggestions.store');
    Route::get('/boards/{board}/suggestions/create', 'User\SuggestionController@create')->name('suggestions.create');
    Route::get('/boards/{board}/suggestions/{suggestion}', 'User\SuggestionController@show')->name('suggestions.show');

    Route::post('/boards/{board}/suggestions/{suggestion}/comment', 'User\CommentController@store')->name('suggestions.comment');

    Route::get('/boards/{board}/suggestions/{suggestion}/vote', 'User\VoteController@vote')->name('suggestions.vote');
    Route::get('/boards/{board}/suggestions/{suggestion}/devote', 'User\VoteController@devote')->name('suggestions.devote');
