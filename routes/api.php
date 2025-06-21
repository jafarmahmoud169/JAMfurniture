<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\RatingsController;
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
    Route::get('user-profile', action: [AuthController::class, 'userProfile'])->middleware(['auth', 'verified']);
    Route::post('user-profile/update', action: [AuthController::class, 'profileUpdate'])->middleware(['auth', 'verified']);


    Route::post('auth/forgot-password', [AuthController::class, 'sendResetCode']);
    Route::post('auth/resend-reset-code', [AuthController::class, 'resendResetCode']);
    Route::post('auth/reset-password', [AuthController::class, 'resetPassword']);

});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/index', 'index');
    Route::get('/category/show/{id}', 'show_products');
    Route::post('/admin/category/update/{id}', 'update')->middleware('is_admin');
    Route::post('/admin/category/create', 'store')->middleware('is_admin');
    Route::delete('/admin/category/delete/{id}', 'destroy')->middleware('is_admin');
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
    Route::get('/product/offers', 'offers_products');
    Route::get('/product/show/{id}', 'show');
    Route::get('/product/search/{key}', 'search');
    Route::post('/admin/product/update/{id}', 'update')->middleware('is_admin');
    Route::post('/admin/product/create', 'store')->middleware('is_admin');
    Route::delete('/admin/product/delete/{id}', 'destroy')->middleware('is_admin');
});



Route::middleware('auth:api')->post('user-profile/change-password', [AuthController::class, 'change_password']);
Route::delete('/user-profile/delete-user', [AuthController::class, 'deleteUser']);

Route::post('/rating/create', [RatingsController::class,'store'])->middleware(['auth', 'verified']);





Route::controller(OrderController::class)->group(function () {
    Route::get('/order/show/{id}', 'show')->middleware(['auth', 'verified']);
    Route::post('/order/create', 'store')->middleware(['auth', 'verified']);
    Route::get('/order/get_user_orders', 'get_user_orders')->middleware(['auth', 'verified']);
    Route::get('/admin/order/index', 'index')->middleware('is_admin');
    Route::post('/admin/order/change_order_status/{id}', 'change_order_status')->middleware('is_admin');
    Route::delete('/order/delete/{id}', 'destroy')->middleware(['auth', 'verified']);

});
Route::post('/order/pay/{id}',[PaymentController::class,'pay_for_order'])->middleware(['auth', 'verified']);
