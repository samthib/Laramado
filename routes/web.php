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

// Route::get('/welcome', function () {
//     return view('welcome');
// });
Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();


/* Product Routes */
Route::get('/', 'ShopController@index')->name('shop.index');
Route::get('/produits', 'ProductController@index')->name('product.index');
Route::get('/produits/{slug}', 'ProductController@show')->name('product.show');
Route::get('/search', 'ProductController@search')->name('product.search') ;

/* Cart Routes */
Route::group(['middleware' => ['auth']], function() {
  Route::get('/panier', 'CartController@index')->name('cart.index');
  Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');
  Route::patch('/panier/{rowId}', 'CartController@update')->name('cart.update');
  Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');
  Route::post('/coupon', 'CartController@storeCoupon')->name('cart.store.coupon');
  Route::delete('/coupon', 'CartController@destroyCoupon')->name('cart.destroy.coupon');
});

/* Checkout Routes */
Route::group(['middleware' => ['auth']], function() {
  Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
  Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
  Route::get('/merci', 'CheckoutController@thankYou')->name('checkout.thankYou');
});


Route::group(['prefix' => 'admin'], function () {
  Voyager::routes();
});
