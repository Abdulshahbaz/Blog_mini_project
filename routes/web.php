<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; 
/*
| */
// -----------------HOME PAGE------------------
Route::get('/',[AuthController::class,'index']);


// --------------------Admin login----------------------
Route::get('admin-login',[AdminController::class,'login'])->name('login');
Route::post('admin-login',[AdminController::class,'login_show'])->name('login_admin');

// -----------------------Only Admin Access---------------
 Route::group(['middleware'=>'admin'],function()
      {                  
         Route::get('dashboard',[AdminController::class,'create'])->name('dashboard');
         Route::get('users-list',[AdminController::class,'users_list'])->name('users.list');
         Route::post('users-list/{id}',[AdminController::class,'toggle_button'])->name('toggle.button');
         Route::post('post-list/{id}',[AdminController::class,'toggle_post'])->name('toggle.post');
         Route::get('edits/{id}',[AdminController::class,'edits'])->name('edits');
         Route::post('update-post/{id}',[AdminController::class,'update_post'])->name('update.post');
         Route::post('delete-post/{id}',[AdminController::class,'delete_post'])->name('delete.post');
      });
  

//---------------------Login User Access thise Route-----------------------------
Route::group(['middleware'=>'auth'],function()
{
    Route::get('users/dashboard',[AuthController::class,'users_show'])->name('users.dashbpoard');
    Route::get('my-blog',[AuthController::class,'my_blog'])->name('my.blog');
    Route::get('post-blog',[AuthController::class,'post_blog'])->name('post.blog');
    Route::post('post-blog',[AuthController::class,'post_store'])->name('post.store');
    Route::get('edit/{id}',[AuthController::class,'edit'])->name('edit.show');
    Route::post('update/{id}',[AuthController::class,'update'])->name('update');
    Route::post('delete/{id}',[AuthController::class,'delete'])->name('delete');   
}); 
  

//-------------------------------Without Login User Show-----------------------------
Route::group(['middleware'=>'guest'],function()
{
   Route::get('login',[AuthController::class,'login'])->name('login');
   Route::post('login',[AuthController::class,'login_user'])->name('login');
   Route::get('register',[AuthController::class,'register_view'])->name('register');
   Route::post('registers',[AuthController::class,'register_store'])->name('registers');

});
//-----------------------thise route access login admin and users----------------------
 Route::post('logout',[AuthController::class,'logout'])->name('logout');  
           