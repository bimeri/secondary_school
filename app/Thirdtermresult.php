<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Thirdtermresult extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'subject_id', 'student_id', 'seq5', 'seq6',
    ];
}
