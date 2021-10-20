<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\UserController;
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


Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/sponsor-username-exits', [App\Http\Controllers\CommonController::class, 'sponsorUsernameExists'])->name('sponsorUsernameExits');


    //Admin
    Route::prefix('admin')->group(function () {

        Route::get('login', [App\Http\Controllers\Backend\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [App\Http\Controllers\Backend\AdminLoginController::class, 'login']);
        Route::post('logout', [App\Http\Controllers\Backend\AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin.dashboard');
            Route::resource('user', UserController::class);
        });
     
    });









});