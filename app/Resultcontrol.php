<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Resultcontrol extends Model
{
    //
    use Notifiable;

    public $fillable = [
        'year_id', 'term_id', 'seq_id', 'generateresult_id', 'status'
    ];
}
