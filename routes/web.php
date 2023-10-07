<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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

            //admin list
            Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'deleteAdmin'])->name('admin#delete');
            // Route::get('roleChange/{id}',[AdminController::class,'roleChangePage'])->name('admin#roleChange');
            // Route::post('change/role',[AdminController::class,'roleChange'])->name('admin#change');
            Route::get('role/change',[AdminController::class,'changeRole'])->name('admin#changeRole');
        });

        //product 
        Route::prefix('product')->group(function(){
            Route::get('pizzaList',[ProductController::class,'pizzaListPage'])->name('product#pizzaPage');
            Route::get('pizzaCreate',[ProductController::class,'pizzaCreatePage'])->name('product#CreatePage');
            Route::post('create',[ProductController::class,'pizzaCreate'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'pizzaDelete'])->name('product#delete');
            Route::get('detail/{id}',[ProductController::class,'pizzaDetail'])->name('product#detail');
            Route::get('edit/{id}',[ProductController::class,'pizzaEdit'])->name('product#editPage');
            Route::post('update',[ProductController::class,'pizzaUpdate'])->name('product#update');
        });

        //Order 
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'orderStatus'])->name('admin#orderStatus');
            Route::get('ajax/change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

        //user list in admin view
        Route::prefix('user')->group(function(){
            Route::get('list',[AdminController::class,'userList'])->name('admin#userList');
            Route::get('change/role',[AdminController::class,'userChangeRole'])->name('admin#userChangeRole');
            Route::get('deleteUser/{id}',[AdminController::class,'deleteUser'])->name('admin#deleteUser');
            //contact list
            Route::get('getContact',[AdminController::class,'contactList'])->name('admin#contactList');
            Route::get('deleteContact/{id}',[AdminController::class,'deleteContact'])->name('admin#deleteContact');

        });
            
    
    });
    

    //user home
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
       Route::get('/home',[UserController::class,'homePage'])->name('user#home');
       Route::get('/filter/{id}',[UserController::class,'filterPizza'])->name('filter#pizza');
       Route::get('history',[UserController::class,'history'])->name('user#history');

       Route::prefix('pizza')->group(function () {
           Route::get('pizzaDetail/{id}',[UserController::class,'pizzaDetail'])->name('pizza#DetailPage');
          
       });
       Route::prefix('cartList')->group(function () {
            Route::get('pizzaCart',[UserController::class,'pizzaCartList'])->name('pizza#Cart');
       
        });
      

       //account 
       Route::prefix('password')->group(function () {
           Route::get('changePage',[UserController::class,'changePasswordPage'])->name('user#passwordChangePage');
           Route::post('change',[UserController::class,'changePassword'])->name('user#passwordChange');
       });

       Route::prefix('account')->group(function () {
            Route::get('editProfile',[UserController::class,'editProfilePage'])->name('user#editProfile');
            Route::post('updateProfile/{id}',[UserController::class,'updateUserProfile'])->name('user#updateProfile');
        });


        //ajax
        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/cart',[AjaxController::class,'clearCurrentCart'])->name('ajax#clearCurrentCart');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });

        Route::prefix('contact')->group(function () {
            Route::get('contactPage',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('createContact',[ContactController::class,'createContact'])->name('user#createContact');
            Route::get('thank',[ContactController::class,'thankYou'])->name('user#thankYou');
        });
    });

});






