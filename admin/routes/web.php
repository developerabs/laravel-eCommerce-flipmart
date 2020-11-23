<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

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

Route::get('/', function () {
    return view('Home');
});
Route::get('/addBrand',[BrandController::class,'brandIndex']);
Route::post('/addBrand',[BrandController::class,'addBrand']);
Route::get('/allBrand',[BrandController::class,'allBrandIndex']);
Route::get('/getAllBrand',[BrandController::class,'getAllBrand']);
Route::post('/brandActiveInactive',[BrandController::class,'brandActiveInactive']);
Route::post('/deleteBrand',[BrandController::class,'deleteBrand']);