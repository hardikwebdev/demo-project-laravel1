<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftProduct extends Model
{
    use HasFactory;

    protected $table = "nft_products";

    public function nftcategory(){
        return $this->belongsTo(NftCategory::class,'category_id','id');
    }
}
