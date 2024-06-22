<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get method
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);//READ *

//POST create
Route::post('create/category',[RouteController::class,'categoryCreate']);
Route::post('create/contact',[RouteController::class,'createContact']);//Create

//delete
Route::get('category/delete/{id}',[RouteController::class,'deleteCategory']);//Delete

//post method
// Route::post('category/details',[RouteController::class,'categoryDetails']);

//get method
Route::get('category/details/{id}',[RouteController::class,'categoryDetails']);//Read

Route::post('category/update',[RouteController::class,'categoryUpdate']);//UPDATE


// Product list
// http://localhost:8000/api/product/list (GET)

//category list
// http://localhost:8000/api/category/list

//create category
//http://localhost:8000/api/create/category (POST)
// {
//     name:''
// }
