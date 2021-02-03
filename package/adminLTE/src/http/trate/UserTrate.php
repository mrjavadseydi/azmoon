<?php
namespace MrjavadSeydi\AdminLTE\http\trate;
use MrjavadSeydi\AdminLTE\Models\Permission;
use MrjavadSeydi\AdminLTE\Models\Role;

trait UserTrate
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function hasRole($roles)
    {
        return !! $roles->intersect($this->roles)->all();
    }
    public function hasPermission($permission)
    {
        return $this->permissions->contains('name' , $permission->name) || $this->hasRole($permission->roles);
    }
}
