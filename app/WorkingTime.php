<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    protected $fillable = ['description', 'working_time', 'user_id', 'working_ticket_id', 'confirmed', 'image_path'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function working_ticket()
    {
        return $this->belongsTo('App\WorkingTicket');
    }
}
