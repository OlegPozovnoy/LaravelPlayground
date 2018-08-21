<?php

namespace App;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //one to one
    public function postt(){

       // return $this->hasOne('App\Post','user_id','id');
        return $this->hasOne('App\Post');
    }

    //one to many
    public function posts(){

        return $this->hasMany('App\Post','user_id','id');
    }


    public function roles(){

        //return $this->belongsToMany('App\Role','role_user','user_id','role_id');
        return $this->belongsToMany('App\Role','role_user','user_id','role_id','id')->withPivot('created_at');

    }


    public function photos(){

        return $this->morphMany('App\Photo','imageable');
    }
}
