<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('test', 'TestController@getTestPage');
// Route::post('addAccount', 'TestController@addAcount')->name('addAccount');
Auth::routes();

Route::group(['middleware' => ['adminRole']], function () {

    Route::get('/makeSale', 'SaleController@makeSale')->name('makeSale');
    Route::post('/makeSaleProcess', 'SaleController@makeSaleProcess')->name('makeSaleProcess');
    Route::get('/getSaleList', 'SaleController@getSaleList')->name('getSaleList');


});

Auth::routes();

Route::group(['middleware' => [ 'userRole']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/getSale', 'HomeController@getSale')->name('getSale');


// Route::get('/home', 'HomeController@index')->name('home');
});
