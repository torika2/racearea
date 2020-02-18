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
	if(!\Auth::check()){
    	return view('welcome');
	}else{
		return route('home');
	}
})->name('welcome');

Auth::routes();
		//USER SIDE
Route::post('/myCoins','CoinController@layoutCoin')->name('layoutCoin');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/myStream','HomeController@Mystream')->name('mS');
Route::put('/myStream/profile/picture','HomeController@profilePic')->name('profilePic');
Route::delete('myStream/profile/picture/delete','HomeController@profilePicDelete')->name('profilePicDelete');
Route::get('/coinPage','HomeController@buy')->name('coinBuy');
Route::post('/createStream','StreamController@create')->name('createChannel');
Route::post('/channelChat','ChatController@create')->name('chat');
		//USER GOOGLE
Route::get('/auth/redirect/{provider}', 'ServiceController@redirect');
Route::get('/callback/{provider}', 'ServiceController@callback');
		//STREAM
Route::post('/upload','StreamController@uploadPhoto')->name('uploadPhoto');

Route::post('/anotherChan','ChatController@anotherCreate')->name('anotherChat');
Route::post('/buyCoins','CoinController@buy')->name('goCoin');
Route::post('/selectedStream','StreamController@view')->name('streamerGuy');
Route::post('/donateCoin','CoinController@donate')->name('goAnotherCoin');
Route::post('/commss','ChatController@recieve')->name('recieve');
Route::post('/chatWith','ChatController@another')->name('another');
		
Route::post('/donateCoinTo','CoinController@anotherCoinPage')->name('anotherCoinPage');
Route::post('/anotherTopDonator','StreamController@anotherDonator')->name('anotherDonator');
Route::post('/anotherTopDonator/banList','StreamController@bannedUsers')->name('bannedUsers');
Route::post('/another/ban','StreamController@banStreamUser')->name('banStreamUser');
		//ADMIN
Route::get('/admin','AdminController@page')->name('adminPage');
Route::get('/adminController','AdminController@adminContr')->name('adminContr');
Route::post('/admin/editUser','AdminController@userEdit')->name('userEdit');
Route::post('/admin/search','AdminController@letSearch')->name('letSearch');
Route::post('/adminController/search','AdminController@searchAdmin')->name('searchAdmin');
Route::post('/admin/ban','AdminController@adminBan')->name('adminBan');