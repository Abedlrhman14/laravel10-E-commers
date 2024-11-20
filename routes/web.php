<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Appcontroller;
use App\Http\Controllers\shopcontroller;
use App\Http\Controllers\Ussercontroller;
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

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/my-account',[Ussercontroller::class,'index'])->name('user.index');
});

Route::middleware(['auth','auth.admin'])->group(function(){
    Route::get('/admin',[Admincontroller::class,'index'])->name('admin.index');
});
