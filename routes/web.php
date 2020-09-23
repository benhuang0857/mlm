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

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/edit', 'AdminController@edit')->name('admin');
Route::post('/admin/update', 'AdminController@update')->name('admin');
Route::get('/admin/contract', 'AdminController@show_pdf')->name('admin');


//商品
Route::get('/admin/product/index','ProductController@index')->name('admin');
Route::get('/admin/product/create','ProductController@create')->name('admin');
Route::post('/admin/product/create/store','ProductController@store')->name('admin');
Route::get('/admin/product/{id}/edit','ProductController@edit')->name('admin');
Route::post('/admin/product/{id}/update','ProductController@update')->name('admin');
Route::delete('/admin/product/{id}/delete','ProductController@destroy')->name('admin');

//商品分類
Route::get('/admin/product/category', 'CategoryController@index');
Route::post('/admin/product/category/store', 'CategoryController@store');

//購買頁面
Route::get('/admin/shop/index','ShopController@index')->name('admin');

//購物車
Route::post('/admin/add-to-cart/{id}','CartController@getAddToCart');
Route::get('/admin/cart/delete/{id}','CartController@deleteCartItem');
Route::get('/admin/shop/cart','CartController@getCart');

//結帳頁面
Route::get('/admin/shop/checkout','CartController@getCheckout');
Route::post('/admin/shop/checkout/submit','CartController@postCheckout');

//自己的訂單
Route::get('/admin/order-history','AdminController@getHistoryOrders');
Route::get('/admin/order-history/{id}','AdminController@showHistoryOrdersDetail');

//下線訂單
Route::get('/admin/order-history-member','AdminController@showYourMemberOrders');
Route::post('/admin/order-history/{id}/update','AdminController@updateOrdersStatus');
Route::post('/admin/order-history/{id}/cancel','AdminController@cancelOrders');
Route::post('/admin/order-history/{id}/delete','AdminController@deleteOrders');

//升級
Route::post('/admin/levelup','AdminController@levelUp');

//顯示線下會員
Route::get('/admin/members','AdminController@ShowMembersPage');
Route::get('/admin/allmembers','AdminController@ShowAllMembersPage');
Route::get('/admin/members/{id}','AdminController@ShowYourMembersInfo');
Route::post('/admin/members/{id}/update','AdminController@UpdateYourMembersInfo');
Route::delete('/admin/members/{id}/delete','AdminController@DeleteYourMember');

//搜尋會員
Route::post('/admin/allmembers/search','AdminController@SearchMember');