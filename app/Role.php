<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Role extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [
        'name'
    ];
    public function admins(){
        return $this->belongsToMany('App\Admin', 'admin_role', 'admin_id', 'role_id');
    }
    public function permissions(){
        return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
    }
}
