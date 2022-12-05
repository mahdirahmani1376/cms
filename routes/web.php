<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/post',[PostController::class,'index'])->name('post');
Route::get('/post/{post}',[PostController::class,'show'])->name('post');
Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/', [AdminsController::class, 'index'])->name('admin.index');

    Route::get('/posts',[PostController::class,'index'])->name('post.index');
    Route::get('/posts/create',[PostController::class,'create'])->name('post.create');
    Route::post('/posts',[PostController::class,'store'])->name('post.store');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('post.destroy');
    Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::patch('/posts/{post}',[PostController::class,'update'])->name('post.update');
});
