<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoWalletHistory extends Model
{
    use HasFactory;
    protected $table = "crypto_wallet_histories";

    public function user_detail(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
