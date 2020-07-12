<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'IndexController@index');
Route::match(['get', 'post'], '/admin', 'AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', 'AdminController@logout');

//list  category page
Route::get('/categories/{url}', 'ProductController@products');

// product detail

Route::get('/products/{id}', 'ProductController@productDetails');
Route::get('/get-product-price', 'ProductController@getProductPrice');

//cart

Route::match(['get', 'post'], '/add-to-cart', 'ProductController@addToCart');
Route::match(['get', 'post'], '/cart', 'ProductController@getCart');
Route::get('/delete-cart-item/{id}', 'ProductController@deleteCartItem');
Route::post('/update-cart-item/{id}', 'ProductController@updateCartItem');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-password', 'AdminController@checkPassword');
    Route::match(['get', 'post'], '/admin/update-password', 'AdminController@updatePassword');

    // categories admin
    Route::match(['get', 'post'], '/admin/add-category', 'CategoryController@addCategory');
    Route::match(['get', 'post'], '/admin/edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], '/admin/delete-category/{id}', 'CategoryController@deleteCategory');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories');

    // products admin
    Route::match(['get', 'post'], '/admin/add-product', 'ProductController@addProduct');
    Route::match(['get', 'post'], '/admin/edit-product/{id}', 'ProductController@editProduct');
    Route::get('/admin/view-products', 'ProductController@viewProducts');
    Route::get('/admin/delete-product-image/{id}', 'ProductController@deleteProductImage');
    Route::get('/admin/delete-product/{id}', 'ProductController@deleteProduct');
    Route::get('/admin/delete-product-alt-image/{id}', 'ProductController@deleteProductAltImage');

    // products attribute admin
    Route::match(['get', 'post'], '/admin/add-attributes/{id}',  'ProductController@addAttributes');
    Route::match(['get', 'post'], '/admin/edit-attributes/{id}',  'ProductController@editAttributes');
    Route::match(['get', 'post'], '/admin/add-images/{id}',  'ProductController@addImages');
    Route::get('/admin/delete-attribute/{id}', 'ProductController@deleteAttribute');


    //coupons
    Route::get('/admin/view-coupons', 'CouponsController@viewCoupons');
    Route::match(['get', 'post'], '/admin/add-coupon', 'CouponsController@addCoupon');
    Route::match(['get', 'post'], '/admin/edit-coupon/{id}', 'CouponsController@editCoupon');
    Route::get('/admin/delete-coupon/{id}', 'CouponsController@deleteCoupon');
});
