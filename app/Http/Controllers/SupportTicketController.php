<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models as Model;
use Auth;

class SupportTicketController extends Controller
{
    public function __construct()
    {
        $this->limit = 10;  
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        if($locale == 'en'){
            $locale = 'subject_en';
        }else{
            $locale = 'subject_ch';
        }
        $user = Model\User::with('userbank')->where('id',$this->user->id)->where(['status' => 'active', 'deleted_at' => null])->first();
        // echo $request->get('htype');
        // exit;
        $query = Model\SupportTicket::where('user_id',$this->user->id);
        if ($request->get('htype') != "" && $request->get('htype') != 2) {
            $query->where('status', $request->get('htype'));
        }
        $general_search = $request->get('general_search');
        if ($general_search && $general_search != '') {
            $query = $query->where(function ($query) use ($general_search) {
                $query->where('message', 'LIKE', '%' . $general_search . '%');
                $query->orWhere('subject_id', 'LIKE', '%' . $general_search . '%');
            });
        }
        $supportTicket = $query->orderBy('created_at', 'desc')->paginate($this->limit);
        if ($request->ajax()) {
            return view('helpsupport/helpsupportajax', compact('supportTicket','locale'));
        }
        $openTicketCount =  Model\SupportTicket::where('user_id',$this->user->id)->where('status','0')->count();
        $closeTicketCount = Model\SupportTicket::where('user_id',$this->user->id)->where('status','1')->count();
        
        $supportSubject = Model\SuportSubject::where('status','Active')->pluck($locale,'id');
        return view('help_support.index',compact('user','supportTicket','supportSubject','openTicketCount','closeTicketCount','locale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
