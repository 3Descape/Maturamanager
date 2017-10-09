<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    protected $fillable = ['description', 'working_time', 'date', 'user_id', 'working_ticket_id', 'confirmed', 'image_path'];
    protected $dates = ['date', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function working_ticket()
    {
        return $this->belongsTo('App\WorkingTicket');
    }

    public function scopeUnconfirmed($query)
    {
        return $query->where('confirmed', false);
    }

    public function scopeMostRecent($query)
    {
        return $query->take(8)->orderBy('created_at', 'desc');
    }
}
