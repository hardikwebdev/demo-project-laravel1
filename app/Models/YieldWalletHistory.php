<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YieldWalletHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount', 'description','type','user_id','final_amount','created_at','updated_at','stacking_pool_id','unique_no'];

    public function user_detail(){
        return $this->belongsTo(User::class,'user_id','id');
    }


    protected $appends = ['createdDate'];

    public function getCreatedDateAttribute(){
        return date('d-M-Y H:i:s',strtotime($this->created_at));
    }
}
