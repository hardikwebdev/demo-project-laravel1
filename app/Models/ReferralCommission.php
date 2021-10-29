<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount', 'description','status','user_id','from_user_id','stacking_pool_id','percent','actual_percent','percent'];

}
