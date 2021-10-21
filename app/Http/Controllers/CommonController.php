<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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





    

    /***Check sponsor username  */
    protected function sponsorUsernameExists(Request $request){
        $usernameExits = User::where('username',$request->sponsor_username)->where('status','active')->exists();
        if ($usernameExits != null) {
            $isValid = true;
        } else {
            $isValid = false;
        }
        echo json_encode(array(
            'valid' => $isValid,
        ));
    }







    /***Check Ic Number Duplication   */
    protected function icNumberDuplication(Request $request){
        $usernameExits = User::where('username',$request->sponsor_username)->where('status','active')->first();
        $icnumber = $request->ic_number;
        $icNUmberCheck = User::where('identification_number',$icnumber)->where('status','active')->count();
        $isValid = false;
        // return $icnumber;
        if($icNUmberCheck >= 3){
            return json_encode(array(
                    'valid' => 'false',
                ));
        }

        if ($usernameExits != null) {
            $checkIcnumbersameTree = $this->checkIcnumbersameTree($usernameExits->id,$icnumber);
            if($checkIcnumbersameTree == false ){
                echo json_encode(array(
                    'valid' => $isValid,
                ));
                return;
            }
        }
        if($icNUmberCheck >= 3){
            $isValid = false;
        }else if($icNUmberCheck == 0 ){
            $isValid = true;
        }else{
            if ($usernameExits != null) {
                $donwCont = $this->getdownIcnumber($usernameExits->id, $icnumber );
                $upCount = $this->getuplineIcnumber($request->sponsor_username, $icnumber );
                $isValid = false;
                if($donwCont + $upCount < 3 ){
                    $isValid = true;
                }
            } else {
                $isValid = false;
            }
        }
        
        echo json_encode(array(
            'valid' => $isValid,
        ));
    }









    /***Check Ic Number Duplication   */
    protected function icNumberDuplicationedit(Request $request){
        $usernameExits = User::where('username',$request->sponsor_username)->where('status','active')->first();
        $icnumber = $request->ic_number;
        $icNUmberCheck = User::where('identification_number',$icnumber)->where('status','active')->count();
        $isValid = false;
        // return $icnumber;
        if($icNUmberCheck >= 3){
            return json_encode(array(
                    'valid' => 'false',
                ));
        }

        if ($usernameExits != null) {
            $checkIcnumbersameTree = $this->checkIcnumbersameTree1($usernameExits->id,$icnumber);
            if($checkIcnumbersameTree == false ){
                echo json_encode(array(
                    'valid' => $isValid,
                ));
                return;
            }
        }
        if($icNUmberCheck >= 3){
            $isValid = false;
        }else if($icNUmberCheck == 0 ){
            $isValid = true;
        }else{
            if ($usernameExits != null) {
                $donwCont = $this->getdownIcnumber($usernameExits->id, $icnumber );
                $upCount = $this->getuplineIcnumber($request->sponsor_username, $icnumber );
                $isValid = false;
                if($donwCont + $upCount < 3 ){
                    $isValid = true;
                }
            } else {
                $isValid = false;
            }
        }
        
        echo json_encode(array(
            'valid' => $isValid,
        ));
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
