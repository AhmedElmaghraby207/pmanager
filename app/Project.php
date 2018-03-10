<?php

namespace App;

use App\User;
use App\Task;
use App\Company;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'days',
        'user_id',
        'company_id'
    ];



    public function users()
    {
        return $this->belongsToMany('App\User');
    }

   
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }


}
