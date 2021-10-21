<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $table = "withdrawal_requests";

    public function user_detail(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
