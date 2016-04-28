<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestList extends Model
{
	use SoftDeletes;

	protected $primaryKey = "guest_list_id";

	protected $fillable = [
	'additional_guests',
	'rsvp',
	'checked_in_by',
	'contact_id',
	'event_id',
	];

	protected $dates = ["deleted_at"];

	public $timestamps = false;
}
