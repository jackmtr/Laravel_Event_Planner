<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'user_id';
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

    /*public static function boot(){

        parent::boot();

        static::creating(function($user){
            $user->token = str_random(30);
        });
    }*/

    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }    

    /**
    * A user may add many contacts.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function contact(){
        return $this->hasMany('App\Contact');
    }      

    /**
    * A user may add many guests.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function guestList(){
        return $this->hasMany('App\GuestList');
    }     
}
