<?php

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

Route::get('/login_admin', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('login_admin');
Auth::routes();

Route::post('/login_by_pass', [App\Http\Controllers\Admin\LoginController::class, 'login_by_pass'])->name('login_by_pass');
Route::get('/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'CheckToken'], function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    
    Route::get('/partner', [App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('partner');
    Route::post('/loadListPartner', [App\Http\Controllers\Admin\PartnerController::class, 'loadList'])->name('loadListPartner');
    Route::post('/findUser', [App\Http\Controllers\Admin\PartnerController::class, 'find'])->name('findUser');
    Route::post('/deletePartner', [App\Http\Controllers\Admin\PartnerController::class, 'delete'])->name('deletePartner');

    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::get('/loadListUser', [App\Http\Controllers\Admin\UserController::class, 'loadList'])->name('loadListUser');
    Route::post('/createUser', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('createUser');
    Route::post('/deleteUser', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('deleteUser');
    Route::post('/changePassword', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('changePassword');

    Route::get('/announcement', [App\Http\Controllers\Admin\AnnouncementController::class, 'index'])->name('announcement');

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');
    Route::get('/listAll', [App\Http\Controllers\Admin\CategoryController::class, 'listAll'])->name('listAll');
    Route::get('/loadListCategory', [App\Http\Controllers\Admin\CategoryController::class, 'loadList'])->name('loadListCategory');
    Route::post('/createCategory', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('createCategory');
    Route::post('/deleteCategory', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('deleteCategory');

    Route::get('lang/{language}', [App\Http\Controllers\LocalizationController::class, 'switch'])->name('localization.switch');
});
