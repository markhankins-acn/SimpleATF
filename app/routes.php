<?php
Route::get('/', 'HomeController@index');

/* Api */
Route::post('post', 'ApiController@postItem');
Route::get('get', 'ApiController@getItems');
Route::get('get/{id}', 'ApiController@getItem');