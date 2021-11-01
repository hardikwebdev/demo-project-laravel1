<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\Helper;

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
        'invest_id',
        'nft_wallet_address'
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
    // protected $appends = [ 'sale_left','sale_right' ];

    //sponsers detail
    public function sponsor() {
        return $this->belongsTo(User::class, 'sponsor_id', 'id');
    }

    public function direct_downline() {
        return $this->hasMany(User::class, 'sponsor_id');
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

     //package
    public function package_detail() {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

      //get downline users 
    public function downlineuser() {
        return $this->hasMany(User::class, 'sponsor_id', 'id')->where(['status'=>'active']);
    }

    // staking_history
    public function staking_history(){
        return $this->hasMany(StackingPool::class);
    }

    public function getProfileImageAttribute($value){
        if(file_exists(public_path('uploads/profile_image/'.$value)) && $value){
            return asset('uploads/profile_image/'.$value);     
        }
        return asset('assets/images/avatar.png');
    }

    public function getTotalStake()
    {
        return Helper::getTotalgroupsales($this);
    }

    // public function getSaleLeftAttribute()
    // {
    //     return Helper::getTotalgroupsalesLeft($this);
    // }

    // public function getSaleRightAttribute()
    // {
    //     return Helper::getTotalgroupsalesRight($this);
    // }

      // placements
    public function placementLeft() {
        return $this->hasMany('App\Models\User', 'placement_id', 'id')->where('child_position','left');
    }

    // placements
    public function placementRight() {
        return $this->hasMany('App\Models\User', 'placement_id', 'id')->where('child_position','right');
    }

}
