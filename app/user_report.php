<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_report extends Model
{
    protected $fillable = ['report_by_user_id','reason_id','additional_info'];
}
