<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserReferral;
use Illuminate\Http\Request;
use App\Helpers\Helper;

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

     /** Check sponsor username **/
    protected function placementUsernameExists(Request $request){
        $usernameExits = User::where('username',$request->placement_username)->where('status',1)->exists();
        if ($usernameExits != null) {
            $placement = User::where('username',$request->placement_username)->where('status',1)->first();
            $placementCount = User::where('placement_id',$placement->id)->where('status',1)->where('child_position',$request->child_position)->count();
            if($placementCount > 0){
                $isValid = false;
            }
            $user = User::where('username',$request->sponsor_check)->where('status',1)->first();
            $user_reference = UserReferral::where('user_id',$user->id)->first();
            // $upline_ids = $user_reference!=null?(array)$user_reference->downline_ids:[];
            $upline_ids = Helper::getUplineSponsorIds($user);
            $isValid = false;

            if($placementCount == 0 && $placement && (in_array($placement->id, $upline_ids) || empty($upline_ids))){
                $isValid = true;
            }
            // echo "<pre>";
            // print_r($upline_ids);
            //     die('test2');

        } else {
                die('test1');

            $isValid = false;
        }
        echo json_encode(array(
            'valid' => $isValid,
        ));
    }

    /***Check Username   */
    // protected function usernameExits(Request $request){
    //     $usernameExits = User::where('username',$request->username)->first();
    //     if ($usernameExits === null) {
    //         $isValid = true;
    //     } else {
    //         $isValid = false;
    //     }
    //     echo json_encode(array(
    //         'valid' => $isValid,
    //     ));
    // }

    /***Check email   */
    protected function emailExists(Request $request){
        $emailExits = User::where('email',$request->email)->first();
        if ($emailExits === null) {
            $isValid = true;
        } else {
            $isValid = false;
        }
        echo json_encode(array(
            'valid' => $isValid,
        ));
    }

    /***Check sponsor username  */
    protected function sponsorUsernameExists(Request $request)
    {
        $usernameExits = User::where('username', $request->sponsor_username)
            ->where('status', 1)
            ->exists();
        if ($usernameExits != null) {
            $isValid = true;
        } else {
            $isValid = false;
        }
        echo json_encode([
            'valid' => $isValid,
        ]);
    }

    /***Check Ic Number Duplication   */
    protected function icNumberDuplication(Request $request)
    {
        $usernameExits = User::where('username', $request->sponsor_username)
            ->where('status', 1)
            ->first();
        $icnumber = $request->ic_number;
        $icNUmberCheck = User::where('identification_number', $icnumber)
            ->where('status', 1)
            ->count();
        $isValid = false;
        // return $icnumber;
        if ($icNUmberCheck >= 3) {
            return json_encode([
                'valid' => 'false',
            ]);
        }

        if ($usernameExits != null) {
            $checkIcnumbersameTree = $this->checkIcnumbersameTree(
                $usernameExits->id,
                $icnumber
            );
            if ($checkIcnumbersameTree == false) {
                echo json_encode([
                    'valid' => $isValid,
                ]);
                return;
            }
        }
        if ($icNUmberCheck >= 3) {
            $isValid = false;
        } elseif ($icNUmberCheck == 0) {
            $isValid = true;
        } else {
            if ($usernameExits != null) {
                $donwCont = $this->getdownIcnumber(
                    $usernameExits->id,
                    $icnumber
                );
                $upCount = $this->getuplineIcnumber(
                    $request->sponsor_username,
                    $icnumber
                );
                $isValid = false;
                if ($donwCont + $upCount < 3) {
                    $isValid = true;
                }
            } else {
                $isValid = false;
            }
        }

        echo json_encode([
            'valid' => $isValid,
        ]);
    }

    /***Check Ic Number Duplication   */
    protected function icNumberDuplicationedit(Request $request)
    {
        $usernameExits = User::where('username', $request->sponsor_username)
            ->where('status', 1)
            ->first();
        $icnumber = $request->ic_number;
        $icNUmberCheck = User::where('identification_number', $icnumber)
            ->where('status', 1)
            ->count();
        $isValid = false;
        // return $icnumber;
        if ($icNUmberCheck >= 3) {
            return json_encode([
                'valid' => 'false',
            ]);
        }

        if ($usernameExits != null) {
            $checkIcnumbersameTree = $this->checkIcnumbersameTree1(
                $usernameExits->id,
                $icnumber
            );
            if ($checkIcnumbersameTree == false) {
                echo json_encode([
                    'valid' => $isValid,
                ]);
                return;
            }
        }
        if ($icNUmberCheck >= 3) {
            $isValid = false;
        } elseif ($icNUmberCheck == 0) {
            $isValid = true;
        } else {
            if ($usernameExits != null) {
                $donwCont = $this->getdownIcnumber(
                    $usernameExits->id,
                    $icnumber
                );
                $upCount = $this->getuplineIcnumber(
                    $request->sponsor_username,
                    $icnumber
                );
                $isValid = false;
                if ($donwCont + $upCount < 3) {
                    $isValid = true;
                }
            } else {
                $isValid = false;
            }
        }

        echo json_encode([
            'valid' => $isValid,
        ]);
    }

    /**Check Icnumber same tree or not  */
    protected function checkIcnumbersameTree($userid, $icnumber)
    {
        $sponser_details = User::where('id', $userid)->first();
        $count = User::where('identification_number', $icnumber)
            ->where(['status' => 'active'])
            ->where('id', '!=', $sponser_details->id)
            ->count();
        $exists = 0;

        if ($count > 0) {
            $downline_ids = $upline_ids = [];
            $user_ids = User::where('identification_number', $icnumber)
                ->where(['status' => 'active'])
                ->pluck('id');
            $user_reference = UserReferral::where(
                'user_id',
                $sponser_details->id
            )->first();
            $downline_ids =
                $user_reference != null ? $user_reference->downline_ids : [];
            $upline_ids =
                $user_reference != null ? $user_reference->upline_ids : [];
            $normal_count = 0;
            $downline_count = 0;
            $downline_count = 0;
            if (
                ($downline_ids != null && is_array($downline_ids)) ||
                ($upline_ids != null && is_array($upline_ids))
            ) {
                foreach ($user_ids as $key => $value) {
                    if ($downline_count >= 3 || $normal_count >= 1) {
                        $exists = 1;
                        break;
                    }
                    if (
                        is_array($downline_ids) &&
                        in_array($value, $downline_ids)
                    ) {
                        $downline_count++;
                    } elseif (
                        is_array($upline_ids) &&
                        in_array($value, $upline_ids)
                    ) {
                        $downline_count++;
                    } elseif ($sponser_details->id == $value) {
                        $downline_count++;
                    } else {
                        $normal_count++;
                    }
                }
                if ($downline_count >= 3 || $normal_count >= 1) {
                    $exists = 1;
                }
                // print_r(['downline_count'=>$downline_count,'normal_count'=>$normal_count,'exists'=>$exists]);die();
            } else {
                $exists = 0;
            }
        }
        if ($exists) {
            return false;
        } else {
            return true;
        }

        // $firstIc = User::where('identification_number',$icnumber)->where('status','active')->where('is_deleted','0')->first();
        // if($firstIc){
        //     $useridfirst = $firstIc->id;
        // }else{
        //     $useridfirst = $userid;
        // }
        // $usernameExits = User::where('id',$userid)->where('status','active')->where('is_deleted','0')->first();
        // if($usernameExits != null){
        //     $allDownlineids = UserReferral::where('user_id',$useridfirst)->value('downline_ids');
        //     $allDownlineids = $allDownlineids!=null?$allDownlineids:[];
        //     $alluserExist = User::where('identification_number',$icnumber)->where('status','active')->where('is_deleted','0')->first();
        //     if($alluserExist != null && !empty($allDownlineids) && is_array($allDownlineids) && !in_array($usernameExits->id,$allDownlineids)){
        //         return false;
        //     }
        // }
        // return true;
    }

    /**Check Icnumber same tree or not  */
    protected function checkIcnumbersameTree1($userid, $icnumber)
    {
        $sponser_details = User::where('id', $userid)->first();
        $count = User::where('identification_number', $icnumber)
            ->where(['status' => 'active', 'is_deleted' => '0'])
            ->where('id', '!=', $sponser_details->id)
            ->count();
        $exists = 0;

        if ($count > 0) {
            $downline_ids = $upline_ids = [];
            $user_ids = User::where('identification_number', $icnumber)
                ->where(['status' => 'active', 'is_deleted' => '0'])
                ->pluck('id');
            $user_reference = UserReferral::where(
                'user_id',
                $sponser_details->id
            )->first();
            $downline_ids =
                $user_reference != null ? $user_reference->downline_ids : [];
            $upline_ids =
                $user_reference != null ? $user_reference->upline_ids : [];
            $normal_count = 0;
            $downline_count = 0;
            $downline_count = 0;
            if (
                ($downline_ids != null && is_array($downline_ids)) ||
                ($upline_ids != null && is_array($upline_ids))
            ) {
                foreach ($user_ids as $key => $value) {
                    if ($downline_count >= 3 || $normal_count > 1) {
                        $exists = 1;
                        break;
                    }
                    if (
                        is_array($downline_ids) &&
                        in_array($value, $downline_ids)
                    ) {
                        $downline_count++;
                    } elseif (
                        is_array($upline_ids) &&
                        in_array($value, $upline_ids)
                    ) {
                        $downline_count++;
                    } elseif ($sponser_details->id == $value) {
                        $downline_count++;
                    } else {
                        $normal_count++;
                    }
                }
                if ($downline_count >= 3 || $normal_count > 1) {
                    $exists = 1;
                }
                // print_r(['downline_count'=>$downline_count,'normal_count'=>$normal_count,'exists'=>$exists]);die();
            } else {
                $exists = 0;
            }
        }
        if ($exists) {
            return false;
        } else {
            return true;
        }

        // $firstIc = User::where('identification_number',$icnumber)->where('status','active')->where('is_deleted','0')->first();
        // if($firstIc){
        //     $useridfirst = $firstIc->id;
        // }else{
        //     $useridfirst = $userid;
        // }
        // $usernameExits = User::where('id',$userid)->where('status','active')->where('is_deleted','0')->first();
        // if($usernameExits != null){
        //     $allDownlineids = UserReferral::where('user_id',$useridfirst)->value('downline_ids');
        //     $allDownlineids = $allDownlineids!=null?$allDownlineids:[];
        //     $alluserExist = User::where('identification_number',$icnumber)->where('status','active')->where('is_deleted','0')->first();
        //     if($alluserExist != null && !empty($allDownlineids) && is_array($allDownlineids) && !in_array($usernameExits->id,$allDownlineids)){
        //         return false;
        //     }
        // }
        // return true;
    }

    /**Check downline and upline Ic number validation  */
    protected function getdownIcnumber($sponserId, $icnumber, $i = 1)
    {
        $usernameExits = User::where('sponsor_id', $sponserId)
            ->where('status', 1)
            ->get();
        $icNUmberCheck = User::where('identification_number', $icnumber)
            ->where('status', 1)
            ->first();
        // dd($sponserId);
        // dd($usernameExits);
        $downCount = 0;
        if (count($usernameExits)) {
            foreach ($usernameExits as $key => $value) {
                # code...
                if ($value->identification_number == $icnumber) {
                    $downCount = $i;
                    $i++;
                }
                $this->getdownIcnumber($value->id, $icnumber, $i);
            }
        }
        return $downCount;
    }

    protected function getuplineIcnumber($sponserName, $icnumber, $i = 1)
    {
        $usernameExits = User::where('username', $sponserName)
            ->where('status', 1)
            ->first();
        $upCount = 0;
        if (!empty($usernameExits) || $usernameExits != null) {
            if ($usernameExits->identification_number == $icnumber) {
                $upCount = $i;
                $i++;
            }
            $this->getuplineIcnumber(
                $usernameExits->sponserName,
                $icnumber,
                $i
            );
        }
        return $upCount;
    }


      /***Check Username   */
    protected function usernameExits(Request $request){
        $usernameExits = User::where('username',$request->username)->first();
        if ($usernameExits === null) {
            $isValid = true;
        } else {
            $isValid = false;
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
