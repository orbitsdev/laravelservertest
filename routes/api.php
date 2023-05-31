<?php

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [AuthApiController::class , 'getUsers'])->name('api.getUsers');

Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');
Route::post('/register', [AuthApiController::class, 'register'])->name('api.register');
Route::post('/logout', [AuthApiController::class, 'logout'])->name('api.logout');
Route::post('/create-product', [ProductApiController::class, 'create'])->name('api.product.create');
Route::post('/delete-product', [ProductApiController::class, 'delete'])->name('api.product.delete');


