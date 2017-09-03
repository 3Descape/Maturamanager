<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingTicket extends Model
{
    protected $fillable = ['name', 'user_id', 'slug', 'description', 'completed', 'thumbnail', 'visible'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->orderBy('pivot_created_at', 'desc');
    }

    public function working_time()
    {
        return $this->hasMany('App\WorkingTime');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
}
