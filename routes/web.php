<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
Route::get('/post/{post}',[PostController::class,'show'])->name('post');

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/', [AdminsController::class, 'index'])->name('admin.index');
    ####################################################posts##########################################################
    Route::get('/posts',[PostController::class,'index'])->name('post.index');
    Route::get('/posts/create',[PostController::class,'create'])->name('post.create');
    Route::post('/posts',[PostController::class,'store'])->name('post.store');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->middleware('can:delete,post')->name('post.destroy');
    Route::get('/posts/{post}/edit',[PostController::class,'edit'])->middleware('can:view,post')->name('post.edit');
    Route::patch('/posts/{post}',[PostController::class,'update'])->name('post.update');
    ####################################################roles##########################################################
    Route::middleware(['role:Admin','auth'])->group(function(){
        Route::get('/users',[UserController::class,'index'])->name('users.index');
        Route::put('/users/{user}/attach',[UserController::class,'attach'])->name('user.role.attach');
        Route::put('/users/{user}/detach',[UserController::class,'detach'])->name('user.role.detach');

        Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
        Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
        Route::delete('/roles/{role}/destroy',[RoleController::class,'destroy'])->name('roles.destroy');
        Route::get('/roles/{role}/edit',[RoleController::class,'edit'])->name('roles.edit');
        Route::put('/roles/{role}/update',[RoleController::class,'update'])->name('roles.update');
        Route::put('/roles/{role}/attach',[RoleController::class,'attach_permissions'])->name('roles.permissions.attach');
        Route::put('/roles/{role}/detach',[RoleController::class,'detach_permissions'])->name('roles.permissions.detach');

        Route::get('/permissions',[PermissionController::class,'index'])->name('permissions.index');
        Route::post('/permissions',[PermissionController::class,'store'])->name('permissions.store');
        Route::put('/permissions/{permission}/update',[PermissionController::class,'update'])->name('permissions.update');
        Route::get('/permissions/{permission}/edit',[PermissionController::class,'edit'])->name('permissions.edit');
        Route::delete('/permissions/{permission}/destroy',[PermissionController::class,'destroy'])->name('permissions.destroy');
    });

    ####################################################users##########################################################
    Route::get('/users/{user}/profile',[UserController::class,'show'])->middleware(['auth','can:view,user'])->name('user.profile.show');
    Route::put('/users/{user}/profile',[UserController::class,'update'])->name('user.profile.update');
    Route::delete('/admin/users/{user}',[UserController::class,'destroy'])->name('user.destroy');


});

