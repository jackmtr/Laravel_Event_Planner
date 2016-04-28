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
    ];

    protected $dates = ["deleted_at"];

    public $timestamps = false;
}
