<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class GuestList extends Model
{
	protected $primaryKey = "guest_list_id";

	protected $fillable = [
	'additional_guests',
	'rsvp',
	'checked_in_by',//should eventually remove, shouldnt be editable
	'contact_id',//should eventually remove, shouldnt be editable
	'event_id',//should eventually remove, shouldnt be editable
	];
//INSERT INTO guest_lists (additional_guests, rsvp, checked_in_by, contact_id, event_id, notes) VALUES (4, 1, 2, 349,30,'Need 3 parking lots');
	public $timestamps = false;//might remove to allow timstamps

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
