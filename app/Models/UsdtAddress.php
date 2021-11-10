<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsdtAddress extends Model
{
    use HasFactory;

    Protected $fillable = ['name','value','image'];
}
