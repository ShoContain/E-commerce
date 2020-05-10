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

Route::get('/','LandingPageController@index')->name('landing-page');

Route::get('/shop','ShopController@index')->name('shop.index');
Route::get('/shop/{slug}','ShopController@show')->name('shop.show');

//カートRoute
Route::get ('/cart','CartController@index')->name('cart.index');
Route::post ('/cart','CartController@store')->name('cart.store');
Route::delete ('/cart/{id}','CartController@destroy')->name('cart.destroy');
Route::post ('/cart','CartController@store')->name('cart.store');
Route::post ('/cart/switchToWishList/{id}','CartController@switchToWishList')->name('cart.switchToWishList');

//ウィッシュリスト
Route::delete ('/wishList/{id}','WishListController@destroy')->name('wishlist.destroy');
Route::post ('/wishList/switchToCart/{id}','WishListController@switchToCart')
    ->name('wishlist.switchToCart');


//カートを空にする
Route::get('empty',function(){
   \Cart::clear();
});
//ウィッシュリストを空にする
Route::get('empty/wishlist',function(){
    app('wishList')->clear();
});

Route::view('/product','product');
Route::view('/checkout','checkout');
Route::view('/thankyou','thankyou');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
