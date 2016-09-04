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


// clans
Route::get('/', 'ClanController@queryClans');
Route::get('/queryClans', 'ClanController@queryClans');
Route::get('/clans', 'ClanController@clans');

Route::get('/clans/{clanTag}/members', 'ClanController@members');
Route::get('/clans/{clanTag}/warlogs', 'ClanController@warlogs');
Route::get('/clans/{clanTag}', 'ClanController@clan');



// for dev, get clan from db
Route::get('/clansFromDb', 'ClanController@clansFromDb');
// for dev, get locations
Route::get('/locations', 'ClanController@locations');


// clan ranking
Route::get('/queryClanRankings', 'ClanRankingController@queryClanRankings');
Route::get('/clanRankings', 'ClanRankingController@clanRankings');