<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\CategoryController;

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

Route::get('/login', function () {
    return "unauthorize";
})->name('login'); // Add a name to the existing route

Route::post("/userRegistration", [UserController::class, 'userRegistration']);
Route::post("/login-api", [UserController::class, 'login']);

Route::get("/profile", [UserController::class, 'profile'])->middleware('auth:api');



Route::middleware('auth:api')->group(function(){
    Route::prefix('/category')->controller(CategoryController::class)->group(function(){
        Route::post('/store','store');
        Route::get('/list','index');
        Route::get('/edit/{id}','edit');
    });
});



