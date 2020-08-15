<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;
// Below three were for Laravel standard password reset, which I did not use
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// Above three were for Laravel standard password reset, which I did not use

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens, Authenticatable, Authorizable, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_at', 'updated_at', 'last_logged_in', //'remember_token' Tried using Laravel standard password reset, but did not use it in the end
    ];

    public function todos() {
        return $this->hasMany('App\Stat');
    }
}
