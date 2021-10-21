<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionWalletHistory extends Model
{
    use HasFactory;

    protected $table = "commission_wallet_histories";

    public function user_detail(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
