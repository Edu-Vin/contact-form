<?php

namespace App\Entities\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactEntity extends Model
{

    protected $table = 'contacts';
    protected $fillable = ['name', 'email', 'message', 'attachment'];

}
