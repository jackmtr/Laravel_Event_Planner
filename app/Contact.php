<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
    	'firstName',
    	'lastName',
    	'email',
    	'occupation',
    	'company',
    	'notes',
    ];

    public $timestamps = false;
}
