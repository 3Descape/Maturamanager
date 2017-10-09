<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CleanUpPerson extends Model
{
    protected $fillable = ['user_id', 'date'];
    protected $dates = ['date', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
