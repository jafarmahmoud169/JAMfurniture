<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('auth/register',[AuthController::class,'register']);
    Route::post('auth/login',[AuthController::class,'login']);
    Route::any('auth/verify-user-email',[AuthController::class,'verifyUserEmail']);
    Route::post('auth/resend-email-verification-code',[AuthController::class,'resendVerificationEmailCode']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->middleware(['auth']);
    Route::get('auth/user-profile', [AuthController::class, 'userProfile'])->middleware(['auth', 'verified']);
});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/index', 'index');
    Route::get('/category/show/{id}', 'show_products');
    Route::post('/category/update/{id}', 'update')->middleware('is_admin');
    Route::post('/category/create', 'store')->middleware('is_admin');
    Route::delete('/category/delete/{id}', 'destroy')->middleware('is_admin');
});
Route::controller(LocationController::class)->group(function () {
    Route::get('/location/get_user_locations','get_user_locations')->middleware(['auth', 'verified']);
    Route::post('/location/update/{id}', 'update')->middleware(['auth', 'verified']);
    Route::post('/location/create', 'store')->middleware(['auth', 'verified']);
    Route::delete('/location/delete/{id}', 'destroy')->middleware(['auth', 'verified']);
});
Route::controller(ProductController::class)->group(function () {
    Route::get('/product/index', 'index');
    Route::get('/product/trendy', 'trendy_products');
    Route::get('/product/show/{id}', 'show');
    Route::get('/product/search/{key}', 'search');
    Route::post('/product/check_availability', 'check_availability')->middleware(['auth','verified']);
    Route::post('/product/update/{id}', 'update')->middleware('is_admin');
    Route::post('/product/create', 'store')->middleware('is_admin');
    Route::delete('/product/delete/{id}', 'destroy')->middleware('is_admin');
});



Route::controller(CartController::class)->group(function () {
    Route::get('/cart/get_user_cart','get_user_cart')->middleware(['auth', 'verified']);
    Route::post('/cart/add_to_cart', 'add_to_cart')->middleware(['auth', 'verified']);
    Route::post('/cart/remove_from_cart', 'remove_from_cart')->middleware(['auth', 'verified']);
    Route::post('/cart/update', 'update')->middleware(['auth', 'verified']);
});





Route::controller(OrderController::class)->group(function () {
    Route::get('/order/index', 'index')->middleware('is_admin');
    Route::get('/order/show/{id}', 'show')->middleware(['auth', 'verified']);
    Route::post('/order/create', 'store')->middleware(['auth', 'verified']);
    Route::get('/order/get_user_orders', 'get_user_orders')->middleware(['auth', 'verified']);
    Route::post('/order/change_order_status/{id}', 'change_order_status')->middleware('is_admin');

});
Route::post('/order/pay',[PaymentController::class,'pay_for_order'])->middleware(['auth', 'verified']);
