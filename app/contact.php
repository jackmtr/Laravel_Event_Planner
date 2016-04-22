<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
    	'first_name',
    	'last_name',
		'email',
		'occupation',
		'company',
		'wechat_id',
		'notes',
		//'user_id',
		'added_by',
    ];

    public $timestamps = false;
}
