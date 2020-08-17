<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Secondtermresult extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'subject_id', 'student_id', 'seq3', 'seq4',
    ];
}
