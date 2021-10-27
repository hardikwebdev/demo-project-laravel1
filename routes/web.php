<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\AdminSupportController;

use App\Http\Controllers\Backend\RankController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\AdminWithdrawalRequest;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PoolPackageController;
use App\Http\Controllers\Backend\NFTCategoryController;
use App\Http\Controllers\Backend\NFTProductController;

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

Route::get('/admin', function(){
    return redirect()->route('admin.login');
});

Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /*check sponsor username exits*/
    Route::post('/sponsor-username-exits', [App\Http\Controllers\CommonController::class, 'sponsorUsernameExists'])->name('sponsorUsernameExits');
    Route::post('/username-exits', [App\Http\Controllers\CommonController::class, 'usernameExits'])->name('usernameExits');
    /**Icnumber duplicatioan check */
    Route::any('ic-number-duplication/', [App\Http\Controllers\CommonController::class, 'icNumberDuplication'])->name('icNumberDuplication');
    Route::any('ic-number-duplication-edit/', [App\Http\Controllers\CommonController::class, 'icNumberDuplicationedit'])->name('icNumberDuplicationedit');
    Route::post('/placement-username-exits', 'App\Http\Controllers\CommonController@placementUsernameExists')->name('placementUsernameExits');
    Route::post('/email-exits', 'App\Http\Controllers\CommonController@emailExists')->name('emailExists');
    Route::post('/username-exits', 'App\Http\Controllers\CommonController@usernameExits')->name('usernameExits');

    Route::middleware(['auth','verified'])->group(function () {

        Route::get('/', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
        Route::get('/get-downlineusers', 'App\Http\Controllers\HomeController@downlineUsers')->name('downlineUsers');
        Route::get('/get-downlinePlacement', 'App\Http\Controllers\HomeController@downlinePlacement')->name('downlinePlacement');
        Route::get('/stacking-pool', 'App\Http\Controllers\HomeController@stacking_pool')->name('stacking_pool');
        Route::get('/stack/{id}', 'App\Http\Controllers\StackingPoolController@detail')->name('stackpool');
        Route::get('/node_management', 'App\Http\Controllers\AccountController@node_management')->name('node_management');

        Route::get('/node_register', 'App\Http\Controllers\AccountController@addmember')->name('node_register');
        Route::post('/createmember', 'App\Http\Controllers\AccountController@createMember')->name('createmember');

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
            // User Crud
            Route::resource('user', UserController::class);
            // News Crud
            Route::resource('news', NewsController::class);


            // Support Ticket
            Route::get('support-ticket/{slug}', [AdminSupportController::class, 'index1'])->name('support_ticket.index1');
            Route::resource('support_ticket', AdminSupportController::class);


            // Rank-setting
            Route::resource('rank_setting', RankController::class);

            // General Setting
            Route::resource('setting', SettingController::class);

            // Withdrawal Request 
            Route::resource('withdrawal_request', AdminWithdrawalRequest::class);
            Route::post('bankproof',  [AdminWithdrawalRequest::class, 'bank_proofs'])->name('user.bank_proofs');
            Route::any('withdrawal-request-export',[AdminWithdrawalRequest::class, 'exportData'])->name('withdrawal_request.export');

            // package crud
            Route::resource('packages', PackageController::class);
            Route::resource('pool-packages', PoolPackageController::class);
            // NFT Category
            Route::resource('nft-category', NFTCategoryController::class);
            // NFT Product
            Route::resource('nft-product', NFTProductController::class);

        });
    });











});