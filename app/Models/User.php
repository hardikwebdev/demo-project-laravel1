<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sponsor_id',
        'placement_id',
        'child_position',
        'name',
        'username',
        'email',
        'password',
        'secure_password',
        'identification_number',
        'phone_number',
        'signature',
        'address',
        'city',
        'state',
        'country_id',
        'status',
        'profile_image',
        'rank_id',
        'package_id',
        'invest_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'secure_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [ 'deleted_at' ];

    //sponsers detail
    public function sponsor() {
        return $this->belongsTo(User::class, 'sponsor_id', 'id');
    }
    
    //sponsers detail
    public function child_sponsor() {
        return $this->belongsTo(User::class, 'id', 'sponsor_id');
    }

    //country
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    //userbank
    public function userbank() {
        return $this->belongsTo(UserBank::class, 'id', 'user_id');
    }

    //userAgreement
    public function user_agreement() {
        return $this->belongsTo(UserAgreement::class, 'id', 'user_id');
    }

    //user wallet
    public function userwallet() {
        return $this->belongsTo(UserWallet::class, 'id', 'user_id');
    }
}
