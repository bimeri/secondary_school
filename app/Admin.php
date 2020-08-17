<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'is_super', 'email', 'user_name', 'profile', 'gender', 'date_of_birth', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles(){
        return $this->belongsToMany('App\Role', 'admin_role', 'admin_id', 'role_id');
    }
    public function permissions(){
        return $this->belongsToMany('App\Permission', 'admin_permission','admin_id', 'permission_id');
    }
}
