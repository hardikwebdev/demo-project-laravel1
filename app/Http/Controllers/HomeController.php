<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StackingPoolPackage;
use App\Models\Slider;
use App\Models\User;
use Auth;
use App\Models\NftCategory;
use App\Models\News;
use App\Models\StackingPool;
use App\Models\UserWallet;
use App\Models\CommissionWalletHistory;
use App\Models\PairingCommission;
use App\Models\ReferralCommission;
use App\Models\YieldWalletHistory;

use DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Setting;
use App\Models\Package;
use App\Helpers\Helper;

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
        $staking_pool = StackingPoolPackage::orderBy('id','desc')
                                            ->limit(8)
                                            ->get()
                                            ->map(function($pool) use ($user){
                                                $pool->investedAmount = StackingPool::where('user_id',$user->id)->where('stacking_pool_package_id',$pool->id)->sum('amount');
                                                return $pool;
                                            });
        $nft_cats = NftCategory::orderBy('id','desc')->limit(3)->get();
        $locale = app()->getLocale();
        // if ($locale == 'en' || $locale == 'ko' || $locale == 'th' || $locale == 'vi') {
        //     $locale = 'en';
        // } else {
        //     $locale = 'cn';
        // }
        $news = News::where(['status' => 'active', 'lang' => $locale])->orderBy('created_at', 'desc')->take(5)->get();
        $allDownlineids = Helper::getAllDownlineIds($this->user->id,1);
        $allDownlineids = (is_array($allDownlineids)) ? $allDownlineids : [];

        $pairing_commissions = PairingCommission::select(DB::raw("sum(pairing_commission) as amount"),DB::raw("DATE_FORMAT(created_at,'%Y-%m') as year"))->where('user_id',$user->id)->groupBy('year')->get()->toArray();
        $referral_commissions = ReferralCommission::select(DB::raw("sum(amount) as amount"),DB::raw("DATE_FORMAT(created_at,'%Y-%m') as year"))->where('user_id',$user->id)->groupBy('year')->get()->toArray();
        $roi_commissions = YieldWalletHistory::select(DB::raw("sum(amount) as amount"),DB::raw("DATE_FORMAT(created_at,'%Y-%m') as year"))->where('description','ROI')->where('user_id',$user->id)->groupBy('year')->get()->toArray();


        /* get last 12 month series */
        $start = Carbon::today()->subMonths(12);
        $i = 0;
        foreach (CarbonPeriod::create($start, '1 month', Carbon::today()) as $month) {
            $months[] = $month->format('Y-m');
            $i++;
        }

        /* collect series data for each month */
        $graph['sale_left'] = [];
        $graph['sale_right'] = [];
        $graph['pairing_commission'] = [];

        foreach ($months as $key => $month) {
            foreach($referral_commissions as $sale){
                if($sale['year'] == $month){
                    $graph['referral_commission'][] = $sale['amount'];
                }else{
                    $graph['referral_commission'][] = 0;
                }
            }

            foreach($roi_commissions as $sale){
                if($sale['year'] == $month){
                    $graph['roi_commission'][] = $sale['amount'];
                }else{
                    $graph['roi_commission'][] = 0;
                }
            }

            foreach($pairing_commissions as $sale){
                if($sale['year'] == $month){
                    $graph['pairing_commission'][] = $sale['amount'];
                }else{
                    $graph['pairing_commission'][] = 0;
                }
            }
        }
        return view('dashboard',compact('user','sliders','staking_pool','news','nft_cats','graph','months'));
    }

    public function crypto_wallets(){
        return view('crypto_wallet.index');
    }

    public function yield_wallet(){
        return view('yield_wallet.index');
    }

    public function commission_wallet(Request $request){
        $userWallet = UserWallet::where('user_id',$this->user->id)->first();
        $history = CommissionWalletHistory::where('user_id',$this->user->id)->where('amount','>',0)->orderby('id','desc')->orderby('id','desc')->paginate(10);
        if($request->ajax()){
            return view('yield_wallet.partials.history',compact('history'));
        }
        return view('commission_wallet.index',compact('userWallet', 'history'));
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
        $downlineUser = User::where('placement_id',$request->id)->where('status','active')->where('id','!=',$request->id)->get();
        return view('mynetworkdownlinePlacement',compact('downlineUser'));
    }

    
    public function downlineUsers(Request $request){
        $downlineUser = User::where('sponsor_id',$request->id)->where('status','active')->where('id','!=',$request->id)->get();
        return view('mynetworkdownline',compact('downlineUser'));
    }


    public function helpandfaq(){
        return view('help_faq.faq');
    }

}
