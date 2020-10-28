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

// Admin
Route::get('/login_admin', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('login_admin');
Route::post('/login_by_pass', [App\Http\Controllers\Admin\LoginController::class, 'login_by_pass'])->name('login_by_pass');
Route::get('/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout');
Route::post('/generateToken', [App\Http\Controllers\Admin\LoginController::class, 'generateToken'])->name('generateToken');
Route::post('/verifyToken', [App\Http\Controllers\Admin\LoginController::class, 'verifyToken'])->name('verifyToken');
Route::post('/createPassword', [App\Http\Controllers\Admin\LoginController::class, 'createPassword'])->name('createPassword');
Route::post('/getLatLong', [App\Http\Controllers\Admin\LoginController::class, 'getLatLong'])->name('getLatLong');
Route::post('/admin/coordinateProvince', [App\Http\Controllers\Admin\LoginController::class, 'coordinateProvince'])->name('adminCoordinateProvince');
Route::post('/admin/coordinateCity', [App\Http\Controllers\Admin\LoginController::class, 'coordinateCity'])->name('adminCoordinateCity');
Route::post('/admin/coordinateDistrict', [App\Http\Controllers\Admin\LoginController::class, 'coordinateDistrict'])->name('adminCoordinateDistrict');

// User
Route::get('/user/login', [App\Http\Controllers\User\LoginController::class, 'index'])->name('login');
Route::get('/user/widget/{id}/{tahun}', [App\Http\Controllers\User\LoginController::class, 'widget'])->name('widget');
Route::post('/user/validateLogin', [App\Http\Controllers\User\LoginController::class, 'validateLogin'])->name('validateLogin');
Route::post('/user/loginbyPassword', [App\Http\Controllers\User\LoginController::class, 'loginbyPassword'])->name('loginbyPassword');
Route::post('/user/loginbyPin', [App\Http\Controllers\User\LoginController::class, 'loginbyPin'])->name('loginbyPin');
Route::post('/user/loginbyOtp', [App\Http\Controllers\User\LoginController::class, 'loginbyOtp'])->name('loginbyOtp');
Route::post('/user/sendCode', [App\Http\Controllers\User\LoginController::class, 'sendCode'])->name('sendCode');
Route::get('/login_by_google', [App\Http\Controllers\User\LoginController::class, 'loginbyGoogle'])->name('loginbyGoogle');
Route::get('/login_by_facebook', [App\Http\Controllers\User\LoginController::class, 'loginbyFacebook'])->name('loginbyFacebook');
Route::get('/login_by_facebook/callback', [App\Http\Controllers\User\LoginController::class, 'loginbyFacebookCallback'])->name('loginbyFacebookCallback');

Route::get('/user/logoutUser', [App\Http\Controllers\User\LoginController::class, 'logout'])->name('logoutUser');

Route::get('lang/{language}', [App\Http\Controllers\LocalizationController::class, 'switch'])->name('localization.switch');

Auth::routes();

Route::group(['middleware' => 'CheckToken'], function () {
    // Admin
    Route::get('/index', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::post('/detailChart', [App\Http\Controllers\Admin\HomeController::class, 'loadList'])->name('detailChart');
    Route::post('/chart', [App\Http\Controllers\Admin\HomeController::class, 'chart'])->name('loadChart');
    Route::post('/chartDetail', [App\Http\Controllers\Admin\HomeController::class, 'chartDetail'])->name('chartDetail');
    Route::post('/mapsDetail', [App\Http\Controllers\Admin\HomeController::class, 'mapsDetail'])->name('mapsDetail');
    Route::post('/getCoordinate', [App\Http\Controllers\Admin\HomeController::class, 'getCoordinate'])->name('getCoordinate');
    Route::post('/coordinateCity', [App\Http\Controllers\Admin\HomeController::class, 'coordinateCity'])->name('coordinateCity');
    Route::post('/coordinateDistrict', [App\Http\Controllers\Admin\HomeController::class, 'coordinateDistrict'])->name('coordinateDistrict');

    Route::get('/partner', [App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('partner');
    Route::post('/loadListPartner', [App\Http\Controllers\Admin\PartnerController::class, 'loadList'])->name('loadListPartner');
    Route::post('/listAllPartner', [App\Http\Controllers\Admin\PartnerController::class, 'listAll'])->name('listAllPartner');
    Route::post('/findUser', [App\Http\Controllers\Admin\PartnerController::class, 'find'])->name('findUser');
    Route::post('/findProv', [App\Http\Controllers\Admin\PartnerController::class, 'findProv'])->name('findProv');
    Route::post('/findCity', [App\Http\Controllers\Admin\PartnerController::class, 'findCity'])->name('findCity');
    Route::post('/deletePartner', [App\Http\Controllers\Admin\PartnerController::class, 'delete'])->name('deletePartner');
    Route::post('/createPartner', [App\Http\Controllers\Admin\PartnerController::class, 'create'])->name('createPartner');

    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::get('/loadListUser', [App\Http\Controllers\Admin\UserController::class, 'loadList'])->name('loadListUser');
    Route::post('/createUser', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('createUser');
    Route::post('/deleteUser', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('deleteUser');
    Route::post('/changePassword', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('changePassword');

    Route::get('/announcement', [App\Http\Controllers\Admin\AnnouncementController::class, 'index'])->name('announcement');
    Route::post('/loadListAnnouncement', [App\Http\Controllers\Admin\AnnouncementController::class, 'loadList'])->name('loadListAnnouncement');
    Route::post('/createAnnouncement', [App\Http\Controllers\Admin\AnnouncementController::class, 'create'])->name('createAnnouncement');
    Route::post('/deleteAnnoucement', [App\Http\Controllers\Admin\AnnouncementController::class, 'delete'])->name('deleteAnnoucement');

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');
    Route::get('/loadListCategory', [App\Http\Controllers\Admin\CategoryController::class, 'loadList'])->name('loadListCategory');
    Route::post('/createCategory', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('createCategory');
    Route::post('/deleteCategory', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('deleteCategory');
});

Route::group(['middleware' => 'CheckTokenUser'], function () {
    // User
    Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('index');
    Route::get('/user/showHome', [App\Http\Controllers\User\HomeController::class, 'home'])->name('showHome');
    Route::get('/user/balance', [App\Http\Controllers\User\HomeController::class, 'balance'])->name('balance');
    Route::get('/user/category', [App\Http\Controllers\User\HomeController::class, 'category'])->name('categoryUser');
    Route::post('/user/takeBalance', [App\Http\Controllers\User\HomeController::class, 'takeBalance'])->name('takeBalance');
    Route::get('/user/profile', [App\Http\Controllers\User\HomeController::class, 'profile'])->name('profile');
    Route::post('/user/editProfile', [App\Http\Controllers\User\HomeController::class, 'editProfile'])->name('editProfile');
    Route::post('/user/changePassword', [App\Http\Controllers\User\HomeController::class, 'changePassword'])->name('changePassUser');
    Route::post('/user/comition', [App\Http\Controllers\User\HomeController::class, 'comition'])->name('comition');
    Route::get('/user/listBank', [App\Http\Controllers\User\HomeController::class, 'listBank'])->name('listBank');
    Route::post('/user/notification', [App\Http\Controllers\User\HomeController::class, 'notification'])->name('notification');
    Route::post('/user/getCoordinate', [App\Http\Controllers\User\HomeController::class, 'getCoordinate'])->name('getCoordinateUser');
    Route::post('user//coordinateCity', [App\Http\Controllers\User\HomeController::class, 'coordinateCity'])->name('coordinateCityUser');
    Route::post('user/coordinateDistrict', [App\Http\Controllers\User\HomeController::class, 'coordinateDistrict'])->name('coordinateDistrictUser');

    Route::get('/user/downline', [App\Http\Controllers\User\DownlineController::class, 'index'])->name('downline');
    Route::get('/user/partner/{tipe}', [App\Http\Controllers\User\DownlineController::class, 'downline'])->name('partnerUser');
    Route::post('/user/list', [App\Http\Controllers\User\DownlineController::class, 'loadList'])->name('listUser');
    Route::post('/user/listall', [App\Http\Controllers\User\DownlineController::class, 'listAll'])->name('listAllUser');
    Route::post('/user/find', [App\Http\Controllers\User\DownlineController::class, 'find'])->name('Userfind');
    Route::post('/user/findCode', [App\Http\Controllers\User\DownlineController::class, 'findCode'])->name('findCode');
    Route::post('/user/findProv', [App\Http\Controllers\User\DownlineController::class, 'findProv'])->name('findProvUser');
    Route::post('/user/findCity', [App\Http\Controllers\User\DownlineController::class, 'findCity'])->name('findCityUser');
    Route::post('/user/delete', [App\Http\Controllers\User\DownlineController::class, 'delete'])->name('disabledUser');
    Route::post('/user/create', [App\Http\Controllers\User\DownlineController::class, 'create'])->name('saveUser');

    Route::get('/user/config', [App\Http\Controllers\User\ConfigController::class, 'index'])->name('config');

    Route::get('/user/account', [App\Http\Controllers\User\AccountController::class, 'loadList'])->name('account');
    Route::post('/user/createBank', [App\Http\Controllers\User\AccountController::class, 'create'])->name('createBank');
    Route::post('/user/deleteBank', [App\Http\Controllers\User\AccountController::class, 'delete'])->name('disabledBank');
});