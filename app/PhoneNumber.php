<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $primaryKey = "phone_number_id";

    protected $fillable = [
    	'phone_number',
    	'contact_id',
    ];

    public $timestamps = false;
}
