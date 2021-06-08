<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/admin' , [AdminController::class , 'index']);
Route::post('admin/auth' , [AdminController::class , 'auth']) -> name('admin/auth');

Route::group(['middleware' => 'admin_auth'] , function(){

  Route::get('admin/dashboard' , [AdminController::class , 'dashboard']) ;
  
  Route::get('admin/category' , [CategoryController::class , 'index']) -> name('admin/category');

  Route::get('admin/category/manage_category' , [CategoryController::class , 'manage_category']) -> name('admin/category/manage_category'); 

 Route::get('admin/category/manage_category/{id}' , [CategoryController::class , 'manage_category']) ;  
 

  Route::post('category/manage_category_process' , [CategoryController::class , 'manage_category_process']) -> name('category/manage_category_process');

  Route::get('admin/delete/{id}' , [CategoryController::class , 'delete']) ;



  Route::get('admin/coupon' , [CouponController::class , 'index']) -> name('admin/coupon');

  Route::get('admin/coupon/manage_coupon' , [CouponController::class , 'manage_coupon']) -> name('admin/coupon/manage_coupon');


 Route::get('admin/coupon/manage_coupon/{id}' , [CouponController::class , 'manage_coupon']) ;


  Route::post('admin/coupon/manage_coupon_process' , [CouponController::class , 'manage_coupon_process']) -> name('admin/coupon/manage_coupon_process');  

  Route::get('admin/coupon/delete/{id}' , [CouponController::class , 'delete']);  

  // Size Section Start

  Route::get('admin/size' , [SizeController::class , 'index']) -> name('admin/size');

  Route::get('admin/size/manage_size' , [SizeController::class , 'manage_size']) -> name('admin/size/manage_size');

  Route::get('admin/size/manage_size/{id}' , [SizeController::class , 'manage_size']) ;


  Route::post('size/manage_size_process' , [SizeController::class , 'manage_size_process']) -> name('size/manage_size_process');

  Route::get('admin/size/delete/{id}' , [SizeController::class , 'delete']);

  Route::get('admin/size/status/{status}/{id}' , [SizeController::class , 'status']);

  // Size Section End 


  // Color Section Start

  Route::get('admin/color' , [ColorController::class , 'index'])->name('admin/color');
  Route::get('admin/color/manage_color' , [ColorController::class , 'manage_color']) -> name('admin/color/manage_color');

  Route::get('admin/color/manage_color/{id}' , [ColorController::class , 'manage_color']);

  Route::post('color/manage_color_process' , [ColorController::class , 'manage_color_process']) -> name('color/manage_color_process');

  Route::get('admin/color/delete/{id}' , [ColorController::class , 'delete']);

  Route::get('admin/color/status/{status}/{id}' , [ColorController::class , 'status']);
  // Color Section End 


  // Product Section Start

  Route::get('admin/product' , [ProductController::class, 'index']) -> name('admin/product');

  Route::get('admin/product/manage_product', [ProductController::class , 'manage_product']) -> name('admin/product/manage_product');
   
  Route::get('admin/product/manage_product/{id}', [ProductController::class , 'manage_product']) ;
  
  Route::post('admin/product/manage_product_process' , [ProductController:: class , 'manage_product_process']) -> name('admin/product/manage_product_process');

  Route::get('admin/product/delete/{id}' , [ProductController::class , 'delete']);

  Route::get('admin/product/product_attr_delete/{paid}/{pid}' , [ProductController::class , 'product_attr_delete']);

  Route::get('admin/product/product_images_delete/{paid}/{pid}' , [ProductController::class , 'product_images_delete']);

  // Product Section End


  Route::get('admin/logout' , function(){
      session()->forget('ADMIN_LOGIN');
      session()->forget('ADMIN_ID');
      session()->flash('error','Logout Succesfully !!!');
      return redirect('/admin');
  });

  Route::get('admin/updatePassword' , [AdminController::class, 'updatePassword']);


});