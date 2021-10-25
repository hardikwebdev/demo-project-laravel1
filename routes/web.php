<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\AdminSupportController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /*check sponsor username exits*/
    Route::post('/sponsor-username-exits', [App\Http\Controllers\CommonController::class, 'sponsorUsernameExists'])->name('sponsorUsernameExits');
    /**Icnumber duplicatioan check */
    Route::any('ic-number-duplication/', [App\Http\Controllers\CommonController::class, 'icNumberDuplication'])->name('icNumberDuplication');
    Route::any('ic-number-duplication-edit/', [App\Http\Controllers\CommonController::class, 'icNumberDuplicationedit'])->name('icNumberDuplicationedit');
    Route::post('/placement-username-exits', 'App\Http\Controllers\CommonController@placementUsernameExists')->name('placementUsernameExits');
    Route::post('/email-exits', 'App\Http\Controllers\CommonController@emailExists')->name('emailExists');
    Route::post('/username-exits', 'App\Http\Controllers\CommonController@usernameExits')->name('usernameExits');

    Route::middleware(['auth','verified'])->group(function () {

        Route::get('/', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
        Route::get('/get-downlineusers', 'AccountController@downlineUsers')->name('downlineUsers');
        Route::get('/get-downlinePlacement', 'AccountController@downlinePlacement')->name('downlinePlacement');
        Route::get('/stacking-pool', 'App\Http\Controllers\HomeController@stacking_pool')->name('stacking_pool');
        Route::get('/stackpool', 'App\Http\Controllers\HomeController@stackpool')->name('stackpool');
        Route::get('/node_management', 'App\Http\Controllers\HomeController@node_management')->name('node_management');

        Route::get('/node_register', 'App\Http\Controllers\HomeController@node_register')->name('node_register');
        Route::get('/crypto_wallets', 'App\Http\Controllers\HomeController@crypto_wallets')->name('crypto_wallets');
        Route::get('/yield_wallet', 'App\Http\Controllers\HomeController@yield_wallet')->name('yield_wallet');
        Route::get('/commission_wallet', 'App\Http\Controllers\HomeController@commission_wallet')->name('commission_wallet');
        Route::get('/nft_wallet', 'App\Http\Controllers\HomeController@nft_wallet')->name('nft_wallet');
        Route::get('/nft_marketplace', 'App\Http\Controllers\HomeController@nft_marketplace')->name('nft_marketplace');
        Route::get('/withdrawal', 'App\Http\Controllers\HomeController@withdrawal')->name('withdrawal');
        Route::get('/ledger', 'App\Http\Controllers\HomeController@ledger')->name('ledger');
        Route::get('/account', 'App\Http\Controllers\HomeController@account')->name('account');
        Route::get('/my_collection', 'App\Http\Controllers\HomeController@my_collection')->name('my_collection');
        Route::get('/help_support', 'App\Http\Controllers\HomeController@help_support')->name('help_support');
        Route::get('/nftproduct', 'App\Http\Controllers\HomeController@nftproduct')->name('nftproduct');
        Route::get('/sell_nft', 'App\Http\Controllers\HomeController@sell_nft')->name('sell_nft');


    });


    //Admin
    Route::prefix('admin')->group(function () {

        Route::get('login', [App\Http\Controllers\Backend\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [App\Http\Controllers\Backend\AdminLoginController::class, 'login']);
        Route::post('logout', [App\Http\Controllers\Backend\AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin.dashboard');
            // user crud
            Route::resource('user', UserController::class);
            // news crud
            Route::resource('news', NewsController::class);


             // support-ticket
            Route::get('support-ticket/{slug}', [App\Http\Controllers\Backend\AdminSupportController::class, 'index1'])->name('support_ticket.index1');
            Route::resource('support_ticket', AdminSupportController::class);
        });

    });











});