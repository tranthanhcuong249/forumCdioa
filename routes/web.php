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

Route::get('trangchu','HomeController@index');
//admin login
Route::view('admin/login','admin.pages.login')->name('login.admin');
Route::post('admin/login','UserController@postLogin')->name('admin.login');
Route::get('login','admin\UserController@getLogin')->middleware('checklogout');


Route::get('getproducttype','AjaxController@getProductType');

Route::group(['prefix' => 'admin','middleware' => 'AdminMiddleware'],function (){
        Route::post('edit-user','UserController@postEditUser')->name('admin/edit-user');
        Route::post('updateUser/{id}','UserController@update');
        Route::post('updatePro/{id}','ProductController@update');
        Route::get('/','IndexController@getIndex')->name('admin.index');
        Route::get('logout','UserController@getLogout')->name('admin/logout');
  	 	Route::resource('categories','CategoriesController');
    	Route::resource('producttype','ProductTypeController');
    	Route::resource('product','ProductController');
        Route::resource('user','UserController');
        Route::resource('order','OrderController');
        Route::resource('topictype','TopicTypeController');

});
//client

Route::get('callback/{social}','UserController@handleProviderCallback');
Route::get('login/{social}','UserController@redirectProvider')->name('login.social');
Route::get('logout','UserController@logout');
Route::post('register','UserController@registerClient')->name('register');
Route::post('login','UserController@loginClient')->name('login');
Route::post('updatepass','UserController@updatePassClient')->name('updatepassword');
Route::resource('cart','CartController');
Route::get('addCart/{id}','CartController@addCart')->name('addCart');
Route::post('upcart','CartController@updateCart');
Route::get('checkout','CartController@checkout')->name('cart.ckeckout');
Route::get('checkout','CartController@checkout')->name('cart.ckeckout');

Route::resource('customer','CustomerController');
Route::get('{slug}.html', 'HomeController@getDetail');

//login client
//Route::view('client/login','client.pages.login')->name('login.client');
//Route::post('client/login','HomeController@postLogin')->name('client.login');
//Route::get('login','client\HomeController@getLogin')->middleware('checklogout');

