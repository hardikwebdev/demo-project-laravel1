<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReferral extends Model
{
    use HasFactory;
    protected $table = "user_referrals";

    public function user_detail(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
