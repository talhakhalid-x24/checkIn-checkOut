<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDetailController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[UserDetailController::class,'index']);
Route::get('/add',[UserDetailController::class,'create']);
Route::post('/store',[UserDetailController::class,'store']);
Route::post('overtime',[UserDetailController::class,'add'])->name('overtime');
Route::get('/show/{id}',[UserDetailController::class,'show']);
Route::get('/allow/{id}',[UserDetailController::class,'allow']);
Route::get('/not-allow/{id}',[UserDetailController::class,'notAllow']);
Route::get('/leave',[UserDetailController::class,'leave']);
