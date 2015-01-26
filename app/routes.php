<?php
Route::get('/', ['as' => 'projects.index', 'uses' => 'HomeController@index']);

/* Api */
Route::post('post', 'ApiController@postItem');
Route::get('get/{id}', 'ApiController@getItem');
Route::get('get', 'ApiController@getItems');

/* Projects */
Route::get('/project/{id}', ['as' => 'project.view', 'uses' => 'ProjectController@show']);

/* Test Suites */
Route::get('/test_suite/{id}', ['as' => 'suite.view', 'uses' => 'TestSuiteController@show']);