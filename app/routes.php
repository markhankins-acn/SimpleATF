<?php
Route::get('/', 'HomeController@index');

/* Api */
Route::post('users', 'ApiController@postItem');