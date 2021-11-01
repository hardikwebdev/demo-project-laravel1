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
use App\Http\Controllers\Backend\YieldWalletController;
use App\Http\Controllers\Backend\CryptoWalletsPaymentController;
use App\Http\Controllers\Backend\CryptocreditrequestController;
use App\Http\Controllers\Backend\NftWalletsPaymentController;
use App\Http\Controllers\Backend\NftcreditrequestController;
use App\Http\Controllers\Backend\NftpurchaseController;
use App\Http\Controllers\Backend\NftpurchaserequestController;
use App\Http\Controllers\Backend\NFTCategoryController;
use App\Http\Controllers\Backend\NFTProductController;
use App\Http\Controllers\Backend\Usercryptowallet;
use App\Http\Controllers\Backend\Usernftwallet;
use App\Http\Controllers\Backend\UseryieldwalletController;
use App\Http\Controllers\Backend\UsercommissionwalletController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\Backend\StackingpoolscoinController;
use App\Http\Controllers\Backend\StackingpoolhistoryController;
use App\Http\Controllers\Backend\ReferralcommissionsController;
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
    /**Icnumber duplicatioan check */
    Route::any('ic-number-duplication/', [App\Http\Controllers\CommonController::class, 'icNumberDuplication'])->name('icNumberDuplication');
    Route::any('ic-number-duplication-edit/', [App\Http\Controllers\CommonController::class, 'icNumberDuplicationedit'])->name('icNumberDuplicationedit');
    Route::post('/placement-username-exits', 'App\Http\Controllers\CommonController@placementUsernameExists')->name('placementUsernameExits');
    Route::post('/email-exits', 'App\Http\Controllers\CommonController@emailExists')->name('emailExists');
    Route::post('/username-exits', 'App\Http\Controllers\CommonController@usernameExits')->name('usernameExits');
    Route::get('withdrawl-request/{key}', 'App\Http\Controllers\CommonController@withdrawlRequestVerify')->name('withdrawlRequestVerify');

    Route::middleware(['auth','verified'])->group(function () {

        Route::get('/', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
        Route::get('/get-downlineusers', 'App\Http\Controllers\HomeController@downlineUsers')->name('downlineUsers');
        Route::get('/get-downlinePlacement', 'App\Http\Controllers\HomeController@downlinePlacement')->name('downlinePlacement');

        Route::get('/stacks', 'App\Http\Controllers\StackingPoolController@index')->name('stacks');
        Route::post('/stacking-pool', 'App\Http\Controllers\StackingPoolController@stacking_pool')->name('staking_pool');
        Route::get('/stack/{id}', 'App\Http\Controllers\StackingPoolController@detail')->name('stakepool');
        Route::get('/node_management', 'App\Http\Controllers\AccountController@node_management')->name('node_management');

        Route::get('/node_register', 'App\Http\Controllers\AccountController@addmember')->name('node_register');
        Route::post('/createmember', 'App\Http\Controllers\AccountController@createMember')->name('createmember');

        Route::get('/crypto_wallets', 'App\Http\Controllers\WalletController@cryptoWallets')->name('crypto_wallets');
        Route::any('/crypto_wallets_form', 'App\Http\Controllers\WalletController@cryptoWalletForm')->name('cryptoWalletForm');
        Route::get('/yield_wallet', 'App\Http\Controllers\WalletController@yieldWallet')->name('yield_wallet');
        Route::any('/yield_wallet-request', 'App\Http\Controllers\WalletController@yieldWalletStore')->name('yield_wallet_store');

        Route::get('/commission_wallet', 'App\Http\Controllers\HomeController@commission_wallet')->name('commission_wallet');
        Route::get('/nft_wallet', 'App\Http\Controllers\HomeController@nft_wallet')->name('nft_wallet');
        Route::get('/nft_marketplace', 'App\Http\Controllers\HomeController@nft_marketplace')->name('nft_marketplace');
        // Route::get('/withdrawal', 'App\Http\Controllers\HomeController@withdrawal')->name('withdrawal');
        Route::get('/ledger', 'App\Http\Controllers\HomeController@ledger')->name('ledger');
        Route::get('/account', 'App\Http\Controllers\AccountController@profile')->name('account');
        Route::post('/personal-detail-upadte', 'App\Http\Controllers\AccountController@updatePersonalDetail')->name('personal-detail-upadte');
        Route::post('/bank-detail-upadte', 'App\Http\Controllers\AccountController@updateBankDetail')->name('bank-detail-upadte');
        Route::get('/my_collection', 'App\Http\Controllers\HomeController@my_collection')->name('my_collection');
        // Route::get('/help_support', 'App\Http\Controllers\HomeController@help_support')->name('help_support');
        Route::get('/nftproduct', 'App\Http\Controllers\HomeController@nftproduct')->name('nftproduct');
        Route::get('/sell_nft', 'App\Http\Controllers\HomeController@sell_nft')->name('sell_nft');
        Route::get('/withdrawal', 'App\Http\Controllers\WithdrawalController@index')->name('withdrawal');
        Route::post('/withdrawal-request', 'App\Http\Controllers\WithdrawalController@withdrawalRequest')->name('withdrawal-request');
        // Route::resource('help-support', 'App\Http\Controllers\SupportTicketController')->name('help-support');
        Route::resource('help_support', SupportTicketController::class);
        Route::get('help-support-replay/{id}', [SupportTicketController::class, 'supportReplay'])->name('supportReplay');
        Route::get('help-support-close/{slug}', [SupportTicketController::class, 'supportClose'])->name('supportClose');
        Route::post('help-support-replay-message', [SupportTicketController::class, 'supportReplayPost'])->name('supportReplayPost');


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

            Route::prefix('user')->group(function () {
                 // Crypto wallet
              Route::resource('crypto-wallet-history', Usercryptowallet::class);
               // nft wallet
               Route::resource('nft-wallet-history', Usernftwallet::class);
               // yield wallet
               Route::resource('yield-wallet-history', UseryieldwalletController::class);
                //Commission wallet
              Route::resource('commission-wallet-history', UsercommissionwalletController::class);
            });
            // News Crud
            Route::resource('news', NewsController::class);

            // Slider
            Route::resource('slider', SliderController::class);


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

            // Yield Wallet History
            Route::resource('yield_wallet', YieldWalletController::class);
            Route::any('yield-wallet-history-export',[YieldWalletController::class, 'exportData'])->name('yield-wallet-history-export.export');

            // Stacking Pool History
            Route::resource('stacking_pool_history', StackingpoolhistoryController::class);
            Route::any('stacking-pool-history-export',[StackingpoolhistoryController::class, 'exportData'])->name('stacking_pool_history.export');

            // Referral commissions
            Route::resource('referral_commission', ReferralcommissionsController::class);         

            // Crypto Wallets Payment History
            Route::resource('crypto_wallets_payment_history', CryptoWalletsPaymentController::class);
            Route::any('crypto_wallets_payment_history_export',[CryptoWalletsPaymentController::class, 'exportData'])->name('crypto_wallets_payment_history.export');

            // Crypto Wallets USDT Credit Requests Approve or Reject.
            Route::resource('crypto_wallets_credit_request', CryptocreditrequestController::class);
            Route::any('crypto_wallets_credit_request_export',[CryptocreditrequestController::class, 'exportData'])->name('crypto_wallets_credit_request.export');

            // Nft Wallets Payment History
            Route::resource('nft_wallets_payment_history', NftWalletsPaymentController::class);
            Route::any('nft_wallets_payment_history_export',[NftWalletsPaymentController::class, 'exportData'])->name('nft_wallets_payment_history.export');

            // Nft Wallets USDT Credit Requests Approve or Reject.
            Route::resource('nft_wallets_credit_request', NftcreditrequestController::class);
            Route::any('nft_wallets_credit_request_export',[NftcreditrequestController::class, 'exportData'])->name('nft_wallets_credit_request.export');

            // NFT Purchase History
            Route::resource('nft_purchase_history', NftpurchaseController::class);
            Route::any('nft_purchase_history_export',[NftpurchaseController::class, 'exportData'])->name('nft_purchase_history.export');


            // NFT Purchase Requests
            Route::resource('nft_purchase_request', NftpurchaserequestController::class);
            Route::any('nft_purchase_request_export',[NftpurchaserequestController::class, 'exportData'])->name('nft_purchase_request.export');

            //Stacking Pools Coin
            Route::resource('stacking-pools-coin', StackingpoolscoinController::class);
        });
    });











});