<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StackingPoolPackage;
use App\Models\Slider;
use App\Models\User;
use Auth;
use App\Models\NftCategory;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(function ($request, $next) {
        $this->user = Auth::user();
        return $next($request);
    });
       $this->middleware('auth');
   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $user = $this->user;
        $sliders = Slider::all();
        $stacking_pool = StackingPoolPackage::all();
        $nft_cats = NftCategory::orderBY('id','desc')->limit(3)->get();
        $locale = app()->getLocale();
        // if ($locale == 'en' || $locale == 'ko' || $locale == 'th' || $locale == 'vi') {
        //     $locale = 'en';
        // } else {
        //     $locale = 'cn';
        // }
        $news = News::where(['status' => 'active', 'is_deleted' => null, 'lang' => $locale])->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard',compact('user','sliders','stacking_pool','news','nft_cats'));
    }

    public function stacking_pool(){
        return view('stacking_pool.index');
    }

    

    public function crypto_wallets(){
        return view('crypto_wallet.index');
    }

    public function yield_wallet(){
        return view('yield_wallet.index');
    }

    public function commission_wallet(){
        return view('commission_wallet.index');
    }

    public function nft_wallet(){
        return view('nft_wallet.index');
    }

    public function withdrawal(){
        return view('withdrawal.index');
    }

    public function nft_marketplace(){
        return view('nft_marketplace.index');
    }

    public function ledger(){
        return view('reports.index');
    }

    public function account(){
        return view('profile.profile');
    }


    public function my_collection(){
        return view('profile.my_collection');
    }

    public function help_support(){
        return view('help_support.index');
    }

    public function nftproduct(){
        return view('nft_marketplace.product');
    }

    public function sell_nft(){
        return view('nft_marketplace.sell_nft');
    }


    public function downlinePlacement(Request $request){
        $downlineUser = User::where('placement_id',$request->id)->where('status',1)->where('id','!=',$request->id)->get();
        return view('mynetworkdownlinePlacement',compact('downlineUser'));
    }

    
    public function downlineUsers(Request $request){
        $downlineUser = User::where('sponsor_id',$request->id)->where('status',1)->where('id','!=',$request->id)->get();
        return view('mynetworkdownline',compact('downlineUser'));
    }

}
