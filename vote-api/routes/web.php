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

Route::get('/', function () {
    return view('welcome');
});

Route::get('countries', 'CountryController@listAllCountries');

Route::get('countries/{id}', 'CountryController@getCountry');

Route::post('vote', 'VoteController@vote');

Route::get('results', 'VoteController@getResults');