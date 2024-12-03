<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Appcontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\shopcontroller;
use App\Http\Controllers\Ussercontroller;
use App\Http\Controllers\WishlsitController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/',[Appcontroller::class,'index'])->name('app.index');
Route::get('/shop',[shopcontroller::class,'index'])->name('shop.index');
Route::get('/product/{slug}',[shopcontroller::class,'productDettails'])->name('shop.product.details');

Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/stote',[CartController::class,'addToCart'])->name('cart.store');
Route::put('/cart/update',[CartController::class,'uptadeCart'])->name('cart.update');
Route::delete('/cart/remove',[CartController::class,'removeItem'])->name('cart.remove');
Route::delete('/cart/clear',[CartController::class,'clearCart'])->name('cart.clear');

Route::post('/wishlist/add',[WishlsitController::class,'addProductToWishlist'])->name('wishlist.store');

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/my-account',[Ussercontroller::class,'index'])->name('user.index');
});

Route::middleware(['auth','auth.admin'])->group(function(){
    Route::get('/admin',[Admincontroller::class,'index'])->name('admin.index');
});

