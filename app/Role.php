<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name', 'label'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function addPermission(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    public function removePermission($permission_id)
    {
        return $this->permissions()->detach($permission_id);
    }
}
