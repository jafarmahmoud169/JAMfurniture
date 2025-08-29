<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\RatingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;

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


Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('auth/register',[AuthController::class,'register']);
    Route::post('auth/login',[AuthController::class,'login']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->middleware(['auth']);

    Route::any('auth/verify-user-email',[AuthController::class,'verifyUserEmail']);
    Route::post('auth/resend-email-verification-code',[AuthController::class,'resendVerificationEmailCode']);


    Route::post('auth/forgot-password', [ResetPasswordController::class, 'sendResetCode']);
    Route::post('auth/resend-reset-code', [ResetPasswordController::class, 'resendResetCode']);
    Route::post('auth/verify-reset-code', [ResetPasswordController::class, 'verifyResetCode']);
    Route::post('auth/reset-password', [ResetPasswordController::class, 'resetPassword']);

    Route::get('user-profile', [ProfileController::class, 'userProfile'])->middleware(['auth', 'verified']);
    Route::post('user-profile/update',  [ProfileController::class, 'profileUpdate'])->middleware(['auth', 'verified']);
    Route::post('user-profile/change-password', [ProfileController::class, 'change_password'])->middleware(['auth', 'verified']);
    Route::delete('user-profile/delete-user', [ProfileController::class, 'deleteUser'])->middleware(['auth', 'verified']);
});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/index', 'index');
    Route::get('/category/show/{id}', 'show_products');
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
    Route::post('/rating/create', [RatingsController::class,'store'])->middleware(['auth', 'verified']);
});




Route::controller(OrderController::class)->group(function () {
    Route::get('/order/show/{id}', 'show')->middleware(['auth', 'verified']);
    Route::post('/order/create', 'store')->middleware(['auth', 'verified']);
    Route::get('/order/get_user_orders', 'get_user_orders')->middleware(['auth', 'verified']);
    Route::post('/order/cancel/{id}', 'cancel')->middleware(['auth', 'verified']);

});
Route::post('/order/pay/{id}',[PaymentController::class,'pay_for_order'])->middleware(['auth', 'verified']);






Route::group([
], function ($router) {

    Route::get('/admin/order/index', [AdminOrderController::class,'index'])->middleware('is_admin');
    Route::post('/admin/order/change_order_status/{id}', [AdminOrderController::class,'change_order_status'])->middleware('is_admin');


    Route::post('/admin/product/update/{id}', [AdminProductController::class,'update'])->middleware('is_admin');
    Route::post('/admin/product/create', [AdminProductController::class,'store'])->middleware('is_admin');
    Route::delete('/admin/product/delete/{id}', [AdminProductController::class,'destroy'])->middleware('is_admin');
    Route::post('/admin/product/make-offer', [AdminProductController::class, 'applyDiscount'])->middleware('is_admin');


    Route::post('/admin/category/update/{id}', [AdminCategoryController::class,'update'])->middleware('is_admin');
    Route::post('/admin/category/create', [AdminCategoryController::class,'store'])->middleware('is_admin');
    Route::delete('/admin/category/delete/{id}', [AdminCategoryController::class,'destroy'])->middleware('is_admin');

});
