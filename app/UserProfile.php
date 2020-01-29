<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    
    protected $fillable =['username','email','skills','experience','image',];
}
