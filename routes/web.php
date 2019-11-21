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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/myStream','HomeController@Mystream')->name('mS');
Route::get('/coinPage','HomeController@buy')->name('coinBuy');
Route::post('/createStream','StreamController@create')->name('createChannel');
Route::post('/channelChat','ChatController@create')->name('chat');
Route::post('/anotherChan','ChatController@anotherCreate')->name('anotherChat');
Route::post('/buyCoins','CoinController@buy')->name('goCoin');
Route::post('/selectedStream','StreamController@view')->name('streamerGuy');
Route::post('/donateCoin','CoinController@donate')->name('goAnotherCoin');

