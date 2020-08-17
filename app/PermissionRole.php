<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PermissionRole extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'permission_id', 'role_id'
    ];
}
