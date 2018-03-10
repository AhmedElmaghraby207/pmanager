<?php

namespace App;

use App\User;
use App\Company;
use App\Project;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
    protected $fillable = [
        'name',
        'days',
        'hours',
        'user_id',
        'project_id',
        'company_id',
        
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }


}
