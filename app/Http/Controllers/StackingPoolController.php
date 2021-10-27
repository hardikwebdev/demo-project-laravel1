<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StackingPoolPackage;
use App\Models\StackingPool;
use Auth;

class StackingPoolController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /* pool package detail */
    public function detail($id,Request $request){
        $stackingpool = StackingPoolPackage::find($id);
        $stackHistory = StackingPool::where('user_id',$this->user->id)->paginate(1);
        if ($request->ajax()) {
            return view('stacking_pool.stack_history', compact('stackHistory'));
        }
        $user = $this->user;
        return view('stacking_pool.stackpool',compact('stackingpool','stackHistory','user'));
    }
}
