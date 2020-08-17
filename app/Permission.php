<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Permission extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [
         'parent','name', 'name_slug'
    ];

    public function admins(){
        return $this->belongsToMany('App\Admin', 'admin_permission','admin_id', 'permission_id');
    }
    public function roles(){
        return $this->belongsToMany('App\Role', 'permission_role','role_id', 'permission_id');
    }
}
