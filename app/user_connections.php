<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_connections extends Model
{
    protected $fillable = ['wink_user_id','added_user_id','gift'];
}
