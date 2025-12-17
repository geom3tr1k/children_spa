<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/reg', [AuthController::class, 'reg']);
Route::post('/login', [AuthController::class, 'authorisation']);
Route::post('/logout', [AuthController::class, 'logOut'])->middleware('auth:sanctum');
Route::post('/upload/{id}', [AuthController::class, 'uploadUser'])->middleware('auth:sanctum');
Route::post('/setAdmin/{id}', [AuthController::class, 'setAdmin'])->middleware('auth:sanctum');
Route::delete('/delAdmin/{id}', [AuthController::class, 'delAdmin'])->middleware('auth:sanctum');
Route::post('/add', [MainController::class, 'addCard'])->middleware('auth:sanctum');
Route::delete('/delete/{id}', [MainController::class, 'deleteAdd'])->middleware('auth:sanctum');
Route::get('/admins', [AuthController::class, 'getAdmins'])->middleware('auth:sanctum');
Route::get('/users', [AuthController::class, 'getUsers'])->middleware('auth:sanctum');
Route::get('/products', [MainController::class, 'getProduct']);
Route::get('/products/{category}', [MainController::class, 'getProductCategory']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [MainController::class, 'index']);
    Route::post('/cart/add/{product}', [MainController::class, 'add']);
    Route::post('/cart/decrease/{product}', [MainController::class, 'decrease']);
    Route::delete('/cart/remove/{product}', [MainController::class, 'remove']);
    Route::delete('/cart/clear', [MainController::class, 'clear']);
    Route::post('/checkout', [MainController::class, 'checkout']);
});
Route::middleware('auth:sanctum')->get('/my-orders', [MainController::class, 'myOrders']);
