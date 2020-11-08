<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function notBlock()
    {
        return ($this->status == 2) ? false : true;
    }

    public function emailVerification()
    {
        return ($this->email_verified_at != null) ? true : false;
    }

    // public function userRoles()
    // {
    //     return $this->hasMany('App\Models\UserRole');
        
    // }

    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile')->withDefault();
    }

    public function otp()
    {
        return $this->hasOne('App\Models\OtpVerification')->withDefault();
    }


}
