<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StackingPool;
use App\Models\StackingPoolPackage;
use App\Models\PairingCommission;
use App\Models\ReferralCommission;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\YieldWalletHistory;


class LedgerController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function ledger(Request $request){
        $stackingpool = StackingPool::with('staking_pool_package')->where('user_id', '=', $this->user->id)->paginate(10);

        $stackingPoolPackage = StackingPoolPackage::where(['is_deleted' => '0', 'status' => 'active'])->pluck('name', 'id');


        $paring_commissions = PairingCommission::where('user_id', '=', $this->user->id)->paginate(10);

        $referral_commission = ReferralCommission::with(['from_user_detail' => function ($query) {
                $query->withTrashed();
            },
            'staking_pool' => function ($query) {
                $query->with('staking_pool_package');
            }
        ])->where('user_id', '=', $this->user->id)->paginate(10);

        $roi = YieldWalletHistory::with('user_detail')->where('user_id', '=', $this->user->id)->where('description', '=', 'ROI')->paginate(10);
        

        // if($request->type == 1){
        //         $where = [];
        //         if ($request->get('start_date')) {
        //             $where[] = ['created_at', ">=", date("Y-m-d H:i:s", strtotime($request->get('start_date')))];
        //         }
        //         if ($request->get('end_date')) {
        //             $where[] = ['created_at', "<=", date("Y-m-d 23:59:59", strtotime($request->get('end_date')))];
        //         }
        //         if ($request->get('stackingpoolpackage')) {
        //             $where[] = ['stacking_pool_package_id', "=", $request->stackingpoolpackage];
        //         }

        //         $stackingpool = $stackingpool->where($where);
        // }

       



        if ($request->ajax()) {
            if($request->htype == 1){
                return view('reports.partials.staking_pools_history', compact('stackingpool'));
            }elseif($request->htype == 2){
                return view('reports.partials.nodes_management_history', compact('paring_commissions'));
            }elseif($request->htype == 3){
                return view('reports.partials.referral_commissions', compact('referral_commission'));
            }elseif($request->htype == 4){
                return view('reports.partials.roi', compact('roi'));
            }else{
                return view('reports.index', compact('stackingpool', 'stackingPoolPackage', 'paring_commissions','referral_commission','roi'));
            }
        } 
        return view('reports.index', compact('stackingpool', 'stackingPoolPackage', 'paring_commissions','referral_commission','roi'));
    }




    public function stakingPoolExport(Request $request){
        $where = [];
        if ($request->get('start_date')) {
            $where[] = ['created_at', ">=", date("Y-m-d H:i:s", strtotime($request->get('start_date')))];
        }
        if ($request->get('end_date')) {
            $where[] = ['created_at', "<=", date("Y-m-d 23:59:59", strtotime($request->get('end_date')))];
        }
        if ($request->get('stackingpoolpackage')) {
            $where[] = ['stacking_pool_package_id', "=", $request->stackingpoolpackage];
        }
        $datas = StackingPool::with('staking_pool_package')->where('user_id', '=', $this->user->id)->where($where)->get();
        $file_name = public_path('uploads/export/stackingpool/'.time().'_'.'stakingpool'.'_export.xlsx');
        $path = public_path("uploads/export/stackingpool/");
        if(!\File::isDirectory($path)) {
            \File::makeDirectory($path,  $mode = 0755, $recursive = true);
        }
        $files = (new FastExcel($datas))->export($file_name,function ($data) {
        
            return [
                'AMOUNT' => $data->amount!=null?$data->amount:0,
                'STAKING POOLS' => $data->staking_pool_package->name!=null?$data->staking_pool_package->name:'-',
                'DURATION' => $data->stacking_period!=null?$data->stacking_period:'-',
                'DATE' => $data->created_at!=null?date("d/m/Y",strtotime($data->created_at)):'-',
            ];
        });
        return response()->download($file_name);
    }



    public function pairingCommissionsExport(Request $request){
        $where = [];
        if ($request->get('c_start_date')) {
            $where[] = ['created_at', ">=", date("Y-m-d H:i:s", strtotime($request->get('c_start_date')))];
        }
        if ($request->get('c_end_date')) {
            $where[] = ['created_at', "<=", date("Y-m-d 23:59:59", strtotime($request->get('c_end_date')))];
        }
        $datas = PairingCommission::where('user_id', '=', $this->user->id)->where($where)->get();
        $file_name = public_path('uploads/export/node-managment/'.time().'_'.'nodemanagment'.'_export.xlsx');
        $path = public_path("uploads/export/node-managment/");
        if(!\File::isDirectory($path)) {
            \File::makeDirectory($path,  $mode = 0755, $recursive = true);
        }
        $files = (new FastExcel($datas))->export($file_name,function ($data) {
        
            return [
                'SALES LEFT' => $data->left_sale!=null?$data->left_sale:0,
                'SALES RIGHT' => $data->right_sale!=null?$data->right_sale:0,
                'CARRY FORWARD LEFT' => $data->commission_got_from == 'right'?$data->carry_forward:0,
                'CARRY FORWARD RIGHT' => $data->commission_got_from == 'left'?$data->carry_forward:0,
                'DAILY LIMIT' => $data->daily_limit!=null?$data->daily_limit:0,
                'PERCENTAGE' => $data->pairing_percent!=null?$data->pairing_percent.'%':0,
                'DATE' => $data->created_at!=null?date("d/m/Y",strtotime($data->created_at)):'-',
            ];
        });
        return response()->download($file_name);
    }



    public function viewbreakdown(Request $request,$id){
        // $stackingpool = StackingPool::with('staking_pool_package')->find($id);
        $stackingpool = ReferralCommission::with([
            'from_user_detail' => function ($query) {
                $query->withTrashed();
            },
        ])->where('user_id', '=', $this->user->id)->where('stacking_pool_id', '=', $id)->orderBy('id', 'desc')->paginate(3);
        $view = view("reports.modal.viewbreakdown",compact('stackingpool'))->render();
        return response()->json(['viewbreakdown'=>$view]);
    }
}
