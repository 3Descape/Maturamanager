<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    public function working_times()
    {
        return $this->hasMany('App\WorkingTime');
    }

    public function working_tickets()
    {
        return $this->belongsToMany('App\WorkingTicket')->withTimestamps();
    }

    public function working_tickets_created()
    {
        return $this->hasMany('App\WorkingTicket');
    }

    /**
     * Return associated roles for the user
     * @method roles
     * @return Collection
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function removeRole($id)
    {
        return $this->roles()->detach($id);
    }

    /**
     * Checks if user is associated with a given role
     * @method hasRole
     * @param  string  $role String representing a role or Class of App\Role
     * @return boolean       Returns wheter user has role or not
     */
    public function hasRole($role)
    {
        if(is_string($role)){
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersection($this->roles)->count();
    }

    public function hasPermission($permission)
    {
        $contains = $this->roles()
        ->with('permissions')
        ->get()
        ->map(function($item) use ($permission){
            return $item->permissions
            ->contains('name', $permission);
        });

        return in_array(true, $contains->toArray());
    }

    public function cleanUp()
    {
        return $this->hasMany('App\CleanUpPerson');
    }

    public function scopeGetBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
