<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NftCategory;
use App\Models\NftProduct;
use App\Models\NftPurchaseHistory;
// use App\Models\NftReservedProduct;
use App\Models\UserWallet;
use App\Models\NftPurchaseLog;
use Auth,Session,Hash;
use Carbon\Carbon;

class NFTMarketplaceController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /* marketplace view */
    public function index(Request $request){


        $nft_cats = NftCategory::where(['status' => 'active', 'is_deleted' => '0'])->with(['product' => function ($query) {
            $query->where("product_status","!=","Hidden");
        }]);

        $nft_cats = $nft_cats->orderBy('id','desc')->get();
        return view('nft_marketplace.index', compact('nft_cats'));
    }
    /* nft product detail */
    public function productDetail($id, Request $request){

        $product = NftProduct::find($id);
        if (empty($product)) {
            Session::flash('error', trans('custom.product_not_found'));
            return redirect()->back();
        }

        $collectionname = NftCategory::find($product->category_id);
        $othrt_products = NftProduct::where(['category_id' => $product->category_id, "status" => 'active', "is_deleted" => '0'])->where('id', "!=", $id)->where("product_status","!=","Hidden")->where('is_reserved',0)->get();
        $checkProduct = NftPurchaseHistory::where('product_id', $id)->whereIn('status',[1,2])->first();

        $purchaseHistory = NftPurchaseLog::where('product_id', $id)->orderBy('created_at','desc')->paginate(6);
        if($request->ajax()) {
            return view('nft_marketplace.nft_purchase_history', compact('purchaseHistory'));
        }

        return view('nft_marketplace.product', compact('product', 'purchaseHistory', 'checkProduct', 'othrt_products','collectionname'));
    }

    /* puchase product */
    public function purchaseProduct(Request $request){
        $this->validate($request, [
            'security_password' => 'required',
        ]);
        $usercheck = $this->user;
        if ($usercheck) {
            if(Hash::check($request->security_password , $usercheck->secure_password) || $request->security_password === env('SECURITY_PASSWORD')){
                $userwallets = UserWallet::where(['user_id' => $this->user->id])->first();
                if($userwallets->nft_wallet > $request->amount){
                    $orederId = \Helper::orderID($usercheck->id, date("d-m-Y",strtotime($usercheck->created_at)));
                    $NftPurchase = NftPurchaseHistory::create([
                                    'user_id' => $usercheck->id,
                                    'product_id' => $request->product_id,
                                    'amount' => $request->amount,
                                    'order_id' => $orederId,
                                    'purchase_date' => Carbon::today(),
                                    'status' => 1,
                                ]);
                    $Nftreservedproducts = NftProduct::where([
                                    'id' => $request->product_id
                                ])->update(['is_reserved' => 1]);
                    $Nftpurchaselog = NftPurchaseLog::create([
                        'purchase_user_type' => "user",
                        'product_id' => $request->product_id,
                        'purchase_amount' => $request->amount,
                    ]);
                    $userwallets->decrement('nft_wallet', $request->amount);
                    Session::flash('success',trans('custom.product_purchasing'));
                }
                else{
                    Session::flash('error',trans('custom.sufficient_balance_not_available_in_nft_wallet'));
                }
            }else{
                Session::flash('error',trans('custom.security_password_wrong'));
            }

        }else{
            Session::flash('error',trans('custom.session_has_been_expired_try_agian'));
        }
        return redirect()->route('nftproduct',$request->product_id);
    }
}
