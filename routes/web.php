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
Route::patch('/cart/{id}','CartController@update')->name('cart.update');
Route::delete ('/cart/{id}','CartController@destroy')->name('cart.destroy');
Route::post ('/cart/switchToWishList/{id}','CartController@switchToWishList')->name('cart.switchToWishList');

//ウィッシュリスト
Route::delete ('/wishList/{id}','WishListController@destroy')->name('wishlist.destroy');
Route::post ('/wishList/switchToCart/{id}','WishListController@switchToCart')->name('wishlist.switchToCart');

//チエックアウト
Route::get('/checkout','CheckOutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout','CheckOutController@store')->name('checkout.store');

//クーポン
Route::post('/coupon','CouponController@confirm')->name('coupon.confirm');
Route::delete('/coupon','CouponController@destroy')->name('coupon.destroy');

//Thank youページ
Route::get('/thankyou','ConfirmationController@index')->name('confirmation.index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
