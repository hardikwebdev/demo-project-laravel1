<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoWallet extends Model
{
    use HasFactory;

    protected $table = "crypto_wallets";

   
    public function user_detail(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
