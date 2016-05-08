<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneNumber extends Model
{
    use SoftDeletes;

    protected $primaryKey = "phone_number_id";

    protected $fillable = [
    	'phone_number',
    	'contact_id',
    ];

    protected $dates = ["deleted_at"];    

    public $timestamps = false;

    /**
    * A phonenumber is owned by a contact.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function contact(){
    	return $this->belongsTo('App\Contact');
    }
}
