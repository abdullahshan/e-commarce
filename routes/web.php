<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\SslCommerzPaymentController;
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

//------Frontend--Page----------//
Route::get('/',[homeController::class, 'index'])->name('frontend.home');


Route::middleware(['auth:sanctum',
config('jetstream.auth_session'),
    'verified'
])->group(function () {
   Route::get('/dashboard', function () {
       // return view('dashboard');
   })->name('dashboard');
});


//-----redirect---Route-----//
Route::get('/redirect',[homeController::class, 'backend'])->name('backend.home')->middleware('auth','verified');
//-----end-----//




Route::group(['middleware' => ['role:admin']], function () {
    

///All Admin Route Start//

//-----categories---part----//
Route::get('/category',[adminController::class, 'category'])->name('category.home');
Route::get('/addcategory',[adminController::class, 'addcategory'])->name('addcategory.home');
Route::get('/allcategory',[adminController::class, 'allcategory'])->name('allcategory.home');
Route::get('/delete/{id}', [adminController::class, 'delete'])->name('delete.home');
//----Categories---end-------//
//------product---part----//
Route::get('/view_product', [adminController::class, 'view_product'])->name('view_product.home');
Route::post('/store_product', [adminController::class, 'store_product'])->name('store_product.home');
Route::get('/all_product', [adminController::class, 'all_product'])->name('all_product.home');
Route::post('/delete_product/{id}', [adminController::class, 'delete_product'])->name('delete_product.home');
Route::get('/update_product/{id}', [adminController::class, 'update_product'])->name('update_product.home');
Route::post('/store_update/{id}',[adminController::class, 'store_update'])->name('store_update.home');
Route::get('/orders_product', [adminController::class, 'orders_product'])->name('orders.home');
Route::get('/order_details/{id}', [adminController::class, 'order_details'])->name('order_detail.home');
// Route::get('/delivered/{id}', [adminController::class, 'delivered'])->name('delivered.home');
Route::get('/pdf_download.home/{id}', [adminController::class, 'pdf_download'])->name('pdf_download.home');
Route::get('/send_email.home/{id}', [adminController::class, 'send_email'])->name('send_email.home');
Route::post('/send_user_email.home/{id}', [adminController::class, 'send_user_email'])->name('send_user_email.home');
Route::get('/search', [adminController::class, 'search'])->name('search.home');
//-----Product---end-----//

///All Admin Route End//

});




Route::get('/text', [adminController::class, 'text'])->name('text.home');







///All Userpage Route start///

///Product section Route start///
Route::get('/product_details/{id}', [homeController::class, 'product_details'])->name('product.details');
Route::post('/Add_to_card/{id}', [homeController::class, 'add_to_card'])->name('add_to_card.home');
Route::get('/show_cart', [homeController::class, 'show_cart'])->name('show_cart.home');
Route::delete('/remove_cart/{id}', [homeController::class, 'remove_cart'])->name('remove_cart.home');
//Orders//
Route::get('/order', [homeController::class, 'order'])->name('order.home');
Route::get('/stripe/{Total_price}', [homeController::class, 'stripe'])->name('stripe.home');
Route::post('/stsripe/{price}', [homeController::class, 'stripePost'])->name('stripe.store');
Route::get('/show_orders', [homeController::class, 'show_orders'])->name('show_orders.home');
Route::get('/cancle_order/{id}', [homeController::class, 'cancle_order'])->name('cancle_order.home');
Route::post('/add_comment.home', [homeController::class, 'add_comment'])->name('add_comment.home');
Route::post('/add_reply', [homeController::class, 'add_reply'])->name('add_reply.home');
Route::get('/search_product', [homeController::class, 'search_product'])->name('search_product.home');
///Product Section Route End///
////////Product page start/////////
Route::get('/product_page', [homeController::class, 'product_page'])->name('product_page.home');
Route::get('/search_product_page', [homeController::class, 'search_product_page'])->name('search_product_page.home');
////////product page end/////////

///All Userpage Route End///





// SSLCOMMERZ Start
Route::get('/checkout/{Total_price}', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
