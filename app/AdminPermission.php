<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdminPermission extends Model
{
    //
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
        'admin_id', 'permission_id'
    ];
}
