<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdminRole extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'admin_id', 'role_id'
    ];
}
 