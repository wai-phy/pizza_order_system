<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

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
//Register /Login

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#login');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#register');
});

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
   
    Route::middleware(['admin_auth'])->group(function() {
        //admin//category
        Route::group(['prefix'=>'category'],function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

       // admin account
        Route::prefix('account')->group(function () {
            //password
            Route::get('changePassword',[AdminController::class,'passwordChange'])->name('password#changePage');
            Route::post('change',[AdminController::class,'change'])->name('admin#changePassword');

            //account info profile
            Route::get('profile',[AdminController::class,'profilePage'])->name('admin#profilePage');
            Route::get('editPage',[AdminController::class,'editPage'])->name('admin#editPage');
            Route::post('update/{id}',[AdminController::class,'updateAccount'])->name('admin#update');
        });
            
    
    });
    

    //user home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        Route::get('home', function () {
            return view('user.home');
        })->name('user#home');
    });

});






