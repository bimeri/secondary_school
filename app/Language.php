<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Language extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'locale', 'active'
    ];
}
