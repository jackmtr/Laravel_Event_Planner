<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
	use SoftDeletes;

	protected $primaryKey = "contact_id";

	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'occupation',
		'company',
		'wechat_id',
		'notes',
		'added_by',
		'guest_of_id',
	];

	protected $dates = ["deleted_at"];

	public $timestamps = false;

	/**
	* A contact may be on many guestlists.
	*
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	*/
	public function guestList(){
		return $this->hasMany('App\GuestList');
	}	

	/**
	* A contact may have many phonenumbers.
	*
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	*/
	public function phoneNumber(){
		return $this->hasMany('App\PhoneNumber');
	}

    /**
    * A contact is added by a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(){
    	return $this->belongsTo('App\User');
    }	    	  
}
