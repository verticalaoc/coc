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

// index
Route::get('/', 'ClanController@index');

// FAQ
Route::get('/faq', 'ClanController@faq');

// about
Route::get('/about', 'ClanController@about');

// clans
Route::get('/queryClans', 'ClanController@queryClans');
Route::get('/clans', 'ClanController@clans');

// member
Route::get('/queryMember', 'ClanController@queryMember');
Route::get('/member/{memberTag}', 'ClanController@member');
Route::get('queryMemberWithTag', 'ClanController@queryMemberWithTag');

// player
Route::get('/queryPlayer', 'PlayerController@queryPlayer');
Route::get('/players/{playerTag}', 'PlayerController@player');


// monitored clans
Route::get('/monitoredClans', 'MonitoredClanController@monitoredClans');

// user input monitored clans
Route::get('/userInputMonitoredClans', 'MonitoredClanController@userInputMonitoredClans');
Route::get('/userInputMonitoredClans/add', 'MonitoredClanController@pageAddUserInputMonitoredClans');
Route::post('/userInputMonitoredClans', 'MonitoredClanController@addUserInputMonitoredClans');


// others
Route::get('/clans/{clanTag}/members', 'ClanController@members');
Route::get('/clans/{clanTag}/warlogs', 'ClanController@warlogs');
Route::get('/clans/{clanTag}', 'ClanController@clan');

// clan ranking
Route::get('/queryClanRankings', 'ClanRankingController@queryClanRankings');
Route::get('/clanRankings', 'ClanRankingController@clanRankings');


// [dev] get clan from db
Route::get('/clansFromDb', 'ClanController@clansFromDb');

// [dev] get locations
Route::get('/locations', 'ClanController@locations');

// [dev] query the top clans and insert into monitoredClans table
Route::get('/dev/collectClansToMonitor', 'DevController@collectClansToMonitor');

// [dev] save clans async
Route::get('/dev/saveClans', 'DevController@saveClans');

// [dev] collect ignore clans
//Route::get('/dev/collectIgnoreClans', 'DevController@collectIgnoreClans');
//Route::get('/deleteClans', 'DevController@deleteClans');