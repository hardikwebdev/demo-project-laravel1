<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StackingPool extends Model
{
    use HasFactory;
    protected $table = "stacking_pools";

    protected $fillable = [
        'user_id',
        'stacking_pool_package_id',
        'amount',
        'percent',
        'stacking_period',
        'range',
        'commission',
        'created_at',
        'updated_at'
    ];

    public function user_detail(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function staking_pool_package(){
        return $this->hasOne('App\Models\StackingPoolPackage','id','stacking_pool_package_id');
    }
}
