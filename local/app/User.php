<?php

namespace Responsive;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 
	public $timestamps = true; 
	 
    protected $fillable = [
        'name', 'email', 'password','gender','admin','phone','photo','otp_status','user_slug','confirmation','provider','provider_id', 'referred_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
