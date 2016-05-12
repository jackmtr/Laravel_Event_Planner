<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class GuestList extends Model
{
	protected $primaryKey = "guest_list_id";

	protected $fillable = [
	'additional_guests',
	'rsvp',
	'checked_in_by',
	'contact_id',
	'event_id',
	];

	public $timestamps = false;

    /**
    * A guest is added by a user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    /**
    * A guest is connected to a contact.
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
	public function guestcontacts(){
		return $this->hasMany('App\Contact','contact_id','contact_id');
	}
    public function contact(){
    	return $this->belongsTo('App\Contact');
    }//does this relationship make sense?

    /**
    * A guest belongs to an event.
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function event(){
    	return $this->belongsTo('App\Event');
    }    
}
