<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NftProduct extends Model
{
    use HasFactory;

    protected $table = "nft_products";
    protected $fillable = ['is_deleted'];

    public function nftcategory(){
        return $this->belongsTo(NftCategory::class,'category_id','id');
    }
    public function images()
    {
        return $this->hasMany(NftProductImage::class,'product_id','id');
    }
}
