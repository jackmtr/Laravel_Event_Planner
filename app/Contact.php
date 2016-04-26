<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Contact extends Model
{
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

    public $timestamps = false;
}
