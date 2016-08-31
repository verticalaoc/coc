<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ClanController@query');
Route::get('/clans/{clanTag}/members', 'ClanController@members');
Route::get('/clans/{clanTag}/warlogs', 'ClanController@warlogs');
Route::get('/clans/{clanTag}', 'ClanController@clan');
Route::post('/clans', 'ClanController@clans');
Route::get('/locations', 'ClanController@locations');

