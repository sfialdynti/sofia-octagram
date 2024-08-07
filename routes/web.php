<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[LoginController::class,'login']);
Route::get('/login',[LoginController::class,'login']);
Route::post('/auth',[LoginController::class,'auth']);
Route::get('/logout',[LoginController::class,'logout']);

Route::middleware(['login'])->group(function(){
    Route::get('/user',[UserController::class, 'user']);
    Route::get('/user',[UserController::class, 'show']);
    Route::post('/user/create',[UserController::class, 'create']);
    Route::get('/user/create',[UserController::class, 'add']);
    Route::get('/user/update/{id}',[UserController::class,'edit']);
    Route::post('/user/update/{id}',[UserController::class,'update']);
    Route::get('/user/delete/{id}',[UserController::class,'delete']);


    Route::get('/index',[CategoryController::class,'index']);

    Route::get('/category',[CategoryController::class, 'show']);
    Route::get('/category/create',[CategoryController::class,'add']);
    Route::post('/category/create',[CategoryController::class,'create']);
    Route::post('/category/search',[CategoryController::class,'search']);
    Route::get('/category/delete/{id}',[CategoryController::class,'delete']);
    Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
    Route::post('/category/edit/{id}',[CategoryController::class,'update']);
});