<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Usernftwallet;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\RankController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\NewsandEventsController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\Usercryptowallet;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\NftOnsaleController;
use App\Http\Controllers\Backend\NFTProductController;
use App\Http\Controllers\Backend\NFTCategoryController;
use App\Http\Controllers\Backend\NftpurchaseController;
use App\Http\Controllers\Backend\PoolPackageController;
use App\Http\Controllers\Backend\UsdtAddressController;
use App\Http\Controllers\Backend\YieldWalletController;
use App\Http\Controllers\Backend\AdminSupportController;
use App\Http\Controllers\Backend\AdminWithdrawalRequest;
use App\Http\Controllers\Backend\AdminNftWithdrawalRequest;

use App\Http\Controllers\Backend\UseryieldwalletController;
use App\Http\Controllers\Backend\NftcreditrequestController;
use App\Http\Controllers\Backend\NftWalletsPaymentController;
use App\Http\Controllers\Backend\StackingpoolscoinController;
use App\Http\Controllers\Backend\NftpurchaserequestController;
use App\Http\Controllers\Backend\CryptocreditrequestController;
use App\Http\Controllers\Backend\ReferralcommissionsController;
use App\Http\Controllers\Backend\StackingpoolhistoryController;
use App\Http\Controllers\Backend\CryptoWalletsPaymentController;
use App\Http\Controllers\Backend\UsercommissionwalletController;
use App\Http\Controllers\Backend\TradingHistoryController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin-demo-portal', function(){
    return redirect()->route('admin.login');
});

Route::get('locale/{locale}', function ($locale) {
	Session::put('locale', $locale);
	return redirect()->back();
});
Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/test-reset-mail', [App\Http\Controllers\Auth\RegisterController::class, 'testResetMail']);

    /*check sponsor username exits*/
    Route::post('/sponsor-username-exits', [App\Http\Controllers\CommonController::class, 'sponsorUsernameExists'])->name('sponsorUsernameExits');
    /**Icnumber duplicatioan check */
    Route::any('ic-number-duplication/', [App\Http\Controllers\CommonController::class, 'icNumberDuplication'])->name('icNumberDuplication');
    Route::any('ic-number-duplication-edit/', [App\Http\Controllers\CommonController::class, 'icNumberDuplicationedit'])->name('icNumberDuplicationedit');
    Route::post('/placement-username-exits', 'App\Http\Controllers\CommonController@placementUsernameExists')->name('placementUsernameExits');
    Route::post('/email-exits', 'App\Http\Controllers\CommonController@emailExists')->name('emailExists');
    Route::post('/username-exits', 'App\Http\Controllers\CommonController@usernameExits')->name('usernameExits');
    Route::get('withdrawl-request/{key}', 'App\Http\Controllers\CommonController@withdrawlRequestVerify')->name('withdrawlRequestVerify');
    Route::get('nft-withdrawl-request/{key}', 'App\Http\Controllers\CommonController@NftWithdrawalRequest')->name('nftwithdrawlRequestVerify');
    Route::get('counter-offer-request/{key}', 'App\Http\Controllers\CommonController@counterofferrequest')->name('user.counterofferrequest');
    Route::get('calculate-pairing-commission', 'App\Http\Controllers\CommonController@pairingCommission')->name('calculate-pairing');
    Route::get('calculate-referral-commission', 'App\Http\Controllers\CommonController@referralCommission')->name('calculate-referral');

    Route::get('sold-nft-request', 'App\Http\Controllers\CommonController@soldRequest')->name('sold-request');

    Route::any('online-payment-response/my/{slug}', 'App\Http\Controllers\WalletController@online_payment_callback_my')->name('online-payment-my-response');
    Route::any('online-payment-response-nft/my/{slug}', 'App\Http\Controllers\NftWalletController@online_payment_callback_my')->name('online-payment-my-response-nft');

    //payment confrim usdt
    Route::any('wallets/usdt-payment-confirm', 'App\Http\Controllers\WalletController@usdtPaymnetConfirm')->name('usdtPaymnetConfirm');
    //payment cancel url usdt   
    Route::get('wallets/usdt-payment-cancel/{id}', 'App\Http\Controllers\WalletController@usdtPaymnetCancel')->name('usdtPaymnetCancel');
    Route::any('wallets/coinpayment-ipn', 'App\Http\Controllers\WalletController@paymnetIpn')->name('PaymnetIpn');

    Route::middleware(['auth','verified','Checkuseractive'])->group(function () {

        Route::get('/', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
        Route::get('/get-downlineusers', 'App\Http\Controllers\HomeController@downlineUsers')->name('downlineUsers');
        Route::get('/get-downlinePlacement', 'App\Http\Controllers\HomeController@downlinePlacement')->name('downlinePlacement');
        Route::post('/update-password', 'App\Http\Controllers\AccountController@updatePassword')->name('update-password');
        Route::post('/update-secure-password', 'App\Http\Controllers\AccountController@updateSecurePassword')->name('update-secure-password');


        Route::get('/node_register', 'App\Http\Controllers\AccountController@addmember')->name('node_register');
        Route::post('/createmember', 'App\Http\Controllers\AccountController@createMember')->name('createmember');

        Route::get('/crypto_wallets', 'App\Http\Controllers\WalletController@cryptoWallets')->name('crypto_wallets');
        Route::any('/crypto_wallets_form', 'App\Http\Controllers\WalletController@cryptoWalletForm')->name('cryptoWalletForm');

        Route::get('/commission_wallet', 'App\Http\Controllers\WalletController@commission_wallet')->name('commission_wallet');
        Route::post('/commission_wallet-request', 'App\Http\Controllers\WalletController@commissionWalletStore')->name('commission-wallet-store');
        Route::get('/nft_marketplace', 'App\Http\Controllers\NFTMarketplaceController@index')->name('nft_marketplace');
        Route::get('/nft_marketplace/{id}', 'App\Http\Controllers\NFTMarketplaceController@productDetail')->name('nftproduct');
        Route::post('/nft_marketplace/purchase-product', 'App\Http\Controllers\NFTMarketplaceController@purchaseProduct')->name('purchase-product');
        // Route::get('/withdrawal', 'App\Http\Controllers\HomeController@withdrawal')->name('withdrawal');
        // Ledger route
        Route::get('/ledger', 'App\Http\Controllers\LedgerController@ledger')->name('ledger');
        Route::post('/stackingpoolpackageajax', 'App\Http\Controllers\LedgerController@stackingpoolpackageAjax')->name('stackingpoolpackage-ajax');
        Route::post('/pairingcommissionajax', 'App\Http\Controllers\LedgerController@pairingCommissionAjax')->name('pairingcommissionajax');
        Route::post('/referralcommissionajax', 'App\Http\Controllers\LedgerController@referralCommissionAjax')->name('referralcommissionajax');
        Route::post('/roiajx', 'App\Http\Controllers\LedgerController@roiAjax')->name('roiajax');
        Route::get('/view-breakdown/{id}', 'App\Http\Controllers\LedgerController@viewbreakdown')->name('view.breakdown');
        Route::post('/ledger/staking-export', 'App\Http\Controllers\LedgerController@stakingPoolExport')->name('reports-staking-pool-export');
        Route::post('/ledger/pairing-commissions-export', 'App\Http\Controllers\LedgerController@pairingCommissionsExport')->name('reports-pairing-commissions-export');
        Route::post('/ledger/referral-commissions-export', 'App\Http\Controllers\LedgerController@referralCommissionsExport')->name('referral-commissions-export');
        Route::post('/ledger/roi-export', 'App\Http\Controllers\LedgerController@roiExport')->name('roi-export');
        
        Route::get('/account', 'App\Http\Controllers\AccountController@profile')->name('account');
        Route::post('/personal-detail-upadte', 'App\Http\Controllers\AccountController@updatePersonalDetail')->name('personal-detail-upadte');
        Route::post('/bank-detail-upadte', 'App\Http\Controllers\AccountController@updateBankDetail')->name('bank-detail-upadte');
        Route::post('/update-profile-image', 'App\Http\Controllers\AccountController@updateImage')->name('updateImage');
        Route::post('/nft-wallet-address-upadte', 'App\Http\Controllers\AccountController@updateNFTWalletAddress')->name('nft-wallet-address-update');
        Route::get('/my_collection', 'App\Http\Controllers\AccountController@my_collection')->name('my_collection');
        // Route::get('/help_support', 'App\Http\Controllers\HomeController@help_support')->name('help_support');
        Route::get('/sell_nft', 'App\Http\Controllers\AccountController@sell_nft')->name('sell_nft');
        Route::get('/viewnftsell/{id}', 'App\Http\Controllers\AccountController@viewNFTSell')->name('view.nftsell');
        Route::get('/viewcounteroffer/{id}', 'App\Http\Controllers\AccountController@viewcounteroffer')->name('nft.viewcounteroffer');
        Route::post('/saleproduct', 'App\Http\Controllers\AccountController@salenftproduct')->name('saleproduct');
        Route::post('/counterofferstatus', 'App\Http\Controllers\AccountController@counterofferstatus')->name('counterofferstatus');
        Route::get('/withdrawal', 'App\Http\Controllers\WithdrawalController@index')->name('withdrawal');
        Route::post('/withdrawal-request', 'App\Http\Controllers\WithdrawalController@withdrawalRequest')->name('withdrawal-request');
        Route::any('resend-email/{id}', 'App\Http\Controllers\WithdrawalController@resendEmail')->name('resendEmail');
        Route::any('nft-resend-email/{id}', 'App\Http\Controllers\NftWalletController@nftresendEmail')->name('nftresendEmail');
       


        Route::get('/faq', 'App\Http\Controllers\HomeController@helpandfaq')->name('helpandfaq');
        // Route::resource('help-support', 'App\Http\Controllers\SupportTicketController')->name('help-support');
        Route::resource('help_support', SupportTicketController::class);
        Route::get('help-support-replay/{id}', [SupportTicketController::class, 'supportReplay'])->name('supportReplay');
        Route::get('help-support-close/{slug}', [SupportTicketController::class, 'supportClose'])->name('supportClose');
        Route::post('help-support-replay-message', [SupportTicketController::class, 'supportReplayPost'])->name('supportReplayPost');

        Route::get('/stacks', 'App\Http\Controllers\StackingPoolController@index')->name('stacks');
        Route::post('/stacking-pool', 'App\Http\Controllers\StackingPoolController@stacking_pool')->name('staking_pool');
        Route::get('/stack/{id}', 'App\Http\Controllers\StackingPoolController@detail')->name('stakepool');
        Route::get('staking-pool/investmentperiod/{id}', 'App\Http\Controllers\StackingPoolController@investmentperiod')->name('stock-market-investment-period');
        Route::post('/stake-plan-change/{id}', 'App\Http\Controllers\StackingPoolController@changePlan')->name('stake-plan-change');
        Route::middleware(['checkUserStaking'])->group(function () {
            Route::resource('news-and-events', NewsandEventsController::class);

            Route::get('/node_management', 'App\Http\Controllers\AccountController@node_management')->name('node_management');

            Route::get('/yield_wallet', 'App\Http\Controllers\WalletController@yieldWallet')->name('yield_wallet');
            Route::any('/yield_wallet-request', 'App\Http\Controllers\WalletController@yieldWalletStore')->name('yield_wallet_store');

            Route::get('/commission_wallet', 'App\Http\Controllers\WalletController@commission_wallet')->name('commission_wallet');
            Route::post('/commission_wallet-request', 'App\Http\Controllers\WalletController@commissionWalletStore')->name('commission-wallet-store');
            Route::get('/nft_wallet', 'App\Http\Controllers\NftWalletController@index')->name('nft_wallet');
            Route::any('/nft_wallets_form', 'App\Http\Controllers\NftWalletController@nftWalletForm')->name('nftWalletForm');
        Route::post('/nftwithdrawal-request', 'App\Http\Controllers\NftWalletController@withdrawalRequest')->name('nftwithdrawal-request');

        // Route::get('/withdrawal', 'App\Http\Controllers\HomeController@withdrawal')->name('withdrawal');
        // Ledger route
            Route::get('/ledger', 'App\Http\Controllers\LedgerController@ledger')->name('ledger');
            Route::post('/stackingpoolpackageajax', 'App\Http\Controllers\LedgerController@stackingpoolpackageAjax')->name('stackingpoolpackage-ajax');
            Route::post('/pairingcommissionajax', 'App\Http\Controllers\LedgerController@pairingCommissionAjax')->name('pairingcommissionajax');
            Route::post('/referralcommissionajax', 'App\Http\Controllers\LedgerController@referralCommissionAjax')->name('referralcommissionajax');
            Route::post('/roiajx', 'App\Http\Controllers\LedgerController@roiAjax')->name('roiajax');
            Route::any('ledger/commissionbreakdown', 'App\Http\Controllers\LedgerController@commissionbreakdown')->name('commissionbreakdown');
            Route::post('/ledger/staking-export', 'App\Http\Controllers\LedgerController@stakingPoolExport')->name('reports-staking-pool-export');
            Route::post('/ledger/pairing-commissions-export', 'App\Http\Controllers\LedgerController@pairingCommissionsExport')->name('reports-pairing-commissions-export');
            Route::post('/ledger/referral-commissions-export', 'App\Http\Controllers\LedgerController@referralCommissionsExport')->name('referral-commissions-export');
            Route::post('/ledger/roi-export', 'App\Http\Controllers\LedgerController@roiExport')->name('roi-export');
            Route::get('/withdrawal', 'App\Http\Controllers\WithdrawalController@index')->name('withdrawal');
            Route::post('/withdrawal-request', 'App\Http\Controllers\WithdrawalController@withdrawalRequest')->name('withdrawal-request');
            Route::any('resend-email/{id}', 'App\Http\Controllers\WithdrawalController@resendEmail')->name('resendEmail');

        });
    });


 });