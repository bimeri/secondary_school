<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Generateresult extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'term_id', 'form_id', 'number_of_student','number_passed', 'class_avg', 'highest_avg', 'lowest_avg', 'rank_student'
    ];
}
