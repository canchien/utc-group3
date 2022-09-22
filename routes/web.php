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

/*
/---------------------------------------------------------------------------------
/    Front-end route
/---------------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Frontend'], function () {
     Route::get('/', 'HomeController@index')->name('frontend.home.index');
     //Route::get('product/','ProductController@show');
     Route::get('about', 'AcfController@about');
     Route::get('contact', 'AcfController@contact');
     Route::get('faqs', 'AcfController@faqs');
     Route::get('term', 'AcfController@term');
     Route::get('privacy', 'AcfController@privacy');
     Route::get('help', 'AcfController@help');


     // ***
     //
     // Product *******
     //
     Route::get('listTopSale', 'ProductController@getProductSale')->name('getTopSale');
     Route::get('shop', 'ProductController@shopIndex')->name('shop.index');
     Route::get('shop/PageAjax', 'ProductController@PageAjax');
     Route::get('s/filter', 'ProductController@shopFilter');
     Route::get('san-pham/{id}', 'ProductController@showProduct')->name('product.showProduct');
     Route::get('sp/filter', 'ProductController@filterPrice');
     Route::get('cat/pageAjax', 'ProductController@catPageAjax');

     //
     Route::get('san-pham/phan-trang/', 'ProductController@filterPrice');
     //
     // Category Load ***************
     //
     Route::get('/cat/{id}', 'ProductController@showProductFromCat');

     // Cart *************
     //
     Route::get('cart', 'CartController@index');
     Route::get('addToCard/{id}', 'CartController@getAddToCart')->name('cart.addTocCart');
     Route::get('getTotalQty', 'CartController@getTotalQty')->name('cart.getTotalQty');
     Route::post('cart/remove', 'CartController@getRemoveFromCart')->name('cart.getRemoveFromCart');
     Route::get('checkout', 'CartController@showCheckout');
     Route::post('doCheckout', 'CartController@doCheckout')->name('cart.doCheckout');
     Route::get('checkouted/{orderCode}', 'CartController@checkouted')->name('cart.checkouted');
     Route::get('order/', 'CartController@orderStatus')->name('doOrderSearch');
     Route::get('huy-bo-don-hang/{orderCode}', 'CartController@huyDonHang');

     Route::get('order-search', 'CartController@showOrderSearch');

     Route::post('minusA_Product', 'CartController@minusA_Product')->name('minusA_Product');
});
/*
/-----------------------------------------------------------------------------------
/    back-end route
/-----------------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Backend'], function () {
     Route::get('login', 'LoginController@showLogin')->name('login');
     Route::post('login', 'LoginController@doLogin')->name('admin.doLogin');
     Route::post('logout', 'LoginController@logout')->name('dologout');
     Route::get('register', 'RegisterController@showReg');
     Route::post('register', 'RegisterController@doReg')->name('admin.doRegister');
});
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'auth'], function () {


     Route::get('/', 'DashboardController@index');
     //->middleware('auth');
     // Category ********************************************************************************************
     //
     // Index
     Route::resource('category', 'CategoryController');
     // load
     Route::get('category/get/ajax', 'CategoryController@list')->name('category.getData');
     // fetch data to form
     Route::get('category/get/fetchData', 'CategoryController@fetchData')->name('category.fetchData');
     // Delete A record
     Route::post('category/destroyACategory', 'CategoryController@destroyACategory')->name('category.destroyA');
     // Multi Destroy
     Route::post('category/multiDestroy', 'CategoryController@multiDestroy')->name('category.multiDestroy');
     // ******************************************************************************************************
     // Product **********************************************************************************************
     //
     // Index
     Route::resource('product', 'ProductController');
     // Load data
     Route::get('product/get/list', 'ProductController@getData')->name('product.getData');
     // Delete A record
     Route::post('product/destroyA', 'ProductController@destroyA')->name('product.destroyA');
     // Multi Destroy
     Route::post('product/multiDestroy', 'ProductController@multiDestroy')->name('product.multiDestroy');
     // show update image
     Route::get('update-image/{product}', 'ProductController@showUpdateImage');
     Route::post('do-update-image', 'ProductController@doUpdateImage')->name('doUpdateImage');
     Route::post('delete-image', 'ProductController@deleteImage')->name('deleteImage');
     Route::post('setActive', 'ProductController@setActive')->name('setActive');
     Route::post('setUnactive', 'ProductController@setUnactive')->name('setUnactive');
     // Test
     Route::get('product/get/aaa', 'ProductController@getDataA')->name('product.getDataA');

     // **************************************************************************************************
     // Order
     //
     // index
     Route::get('order', 'OrderController@index');
     // fetch Data
     Route::get('getData', 'OrderController@getData')->name('order.getData');
     // Chấp nhận đơn hàng
     Route::post('acceptOrder', 'OrderController@acceptOrder')->name('acceptOrder');
     Route::post('deniedOrder', 'OrderController@deniedOrder')->name('deniedOrder');
     Route::get('update-order/{order}', 'OrderController@showUpdateOrder');
     Route::post('doUpdateOrder', 'OrderController@doUpdateOrder')->name('doUpdateOrder');
     Route::get('getOrderStatuses', 'OrderController@getOrderStatuses')->name('getOrderStatuses');
     Route::get('ajaxDeleteAOrderStatus', 'OrderController@ajaxDeleteAOrderStatus')->name('ajaxDeleteAOrderStatus');

     Route::group([ 'prefix' => 'customer'],function (){
         Route::get('/','CustomerController@index')->name('list.customer');
         Route::get('/create','CustomerController@create')->name('create.customer');
         Route::post('/create','CustomerController@store');
         Route::get('/edit/{id}','CustomerController@edit')->name('edit.customer');
         Route::post('/edit/{id}','CustomerController@update');
         Route::delete('/delete/{staff}','CustomerController@destroy')->name('staff.destroy');

     });
});

Route::get('/heloworld', function ( ) {
     $user = \App\User::find(1);
     return view('helloworld', compact('user'));
});
