<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StackingPoolPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_deleted','name','price','icon','symbol'
    ];

    public function stackingpoolcoins(){
        return $this->hasMany('App\Models\StackingPoolCoin','stacking_pool_package_id');
    }
}
