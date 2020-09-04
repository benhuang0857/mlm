<?php

namespace App\Models;

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
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'line_id', 'address', 'fb_account', 'ig_account', 'leader_id', 'authorization_code', 'image', 'milage', 'levelcat01', 'levelcat02', 'role', 'remarks'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order')->latest();
    }

    public function childs() {
        return $this->hasMany('App\Models\User','leader_id','id') ;
    }
}
