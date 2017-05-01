<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manage_users extends Model
{
	protected $fillable = ['id','gender', 'email','image','name','verified'];

    function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }
}
