<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategorysController;
use App\Http\Controllers\SubCategoryController;

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
/*--======================== All Brand routes ======================*/
Route::get('/brand/addBrand',[BrandController::class,'brandIndex']);
Route::post('/brand/addBrand',[BrandController::class,'addBrand']);
Route::get('/brand/allBrand',[BrandController::class,'allBrandIndex']);
Route::get('/brand/getAllBrand',[BrandController::class,'getAllBrand']);
Route::post('/brand/brandActiveInactive',[BrandController::class,'brandActiveInactive']);
Route::post('/brand/deleteBrand',[BrandController::class,'deleteBrand']);
Route::post('/brand/brandUpdateDetails',[BrandController::class,'brandUpdateDetails']);
Route::post('/brand/brandUpdateConfirm',[BrandController::class,'brandUpdateConfirm']);

/*--======================== All Categorys routes ======================*/
Route::get('/categorys',[CategorysController::class,'categorysIndex']);
Route::post('/categorys/addcategorys',[CategorysController::class,'categorysAddNew']);
Route::get('/categorys/addSubcategorys',[SubCategoryController::class,'subCategorysIndex']);
Route::post('/categorys/addSubcategorys',[SubCategoryController::class,'subCategorysAddNew']);