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

//login and logout
Route::get('/', 'LoginController@showLoginForm');
Route::get('login/', 'LoginController@showLoginForm');
Route::post('login/', 'LoginController@login');

Route::get('logout/', 'LogoutController@logout');

Route::get('menu', 'MenuController@index');

//products
Route::get('products', 'ProductController@index');

//deals
Route::get('deal/update/{id}', 'DealController@update');
Route::get('deal/add/', 'DealController@add');
Route::post('deal/save', 'DealController@save');
Route::get('deal', 'DealController@index');

// customers
Route::get('customer',array('uses'=>'CustomerController@index'));
Route::get('customer/{id}',array('uses'=>'CustomerController@show'));
Route::post('customer/add',array('uses'=>'CustomerController@save'));
Route::put('customer/update/{id}',array('uses'=>'CustomerController@update'));
Route::put('customer/delete/{id}',array('uses'=>'CustomerController@delete'));

//shop
Route::get('shop', 'ShopController@index');
Route::post('shop', 'ShopController@addToCart');

Route::get('cart/view', 'ShopController@viewCart');