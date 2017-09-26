<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class WorkingTicket extends Model
{
    protected $fillable = ['name', 'user_id', 'slug', 'markup', 'html', 'completed', 'thumbnail', 'visible'];

    protected $appends = ['timeCount'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->orderBy('pivot_created_at', 'desc');
    }

    public function working_times()
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

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = nl2br($value);
    }

    public function getTimeCountAttribute()
    {
        return round($this->working_times->where('working_ticket_id', $this->id)->where('user_id', Auth::user()->id)->sum('working_time')/60, 2);
    }
}
