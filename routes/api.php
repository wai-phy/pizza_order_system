<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Get
Route::get('products/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);

//Post
Route::post('create/category',[RouteController::class,'createCategory']);
Route::get('delete/category/{id}',[RouteController::class,'deleteCategory']);

//contact
Route::post('create/contact',[RouteController::class,'createContact']);
Route::post('delete/contact',[RouteController::class,'deleteContact']);

//update 
Route::get('category/detail/{id}',[RouteController::class,'categoryDetail']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);