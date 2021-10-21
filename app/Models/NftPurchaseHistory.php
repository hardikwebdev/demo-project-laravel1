<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftPurchaseHistory extends Model
{
    use HasFactory;

    protected $table = "nft_purchase_histories";

    public function user_detail(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function nftproduct(){
        return $this->belongsTo(NftProduct::class,'product_id','id');
    }
}
