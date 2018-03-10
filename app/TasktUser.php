<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasktUser extends Model
{
    //
    protected $fillable = [
        'user_id',
        'task_id'
    ];
}
