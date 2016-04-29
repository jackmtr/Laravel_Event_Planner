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
}
