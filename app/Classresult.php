<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Classresult extends Model
{
    //
    use Notifiable;
    protected $table = 'classresults';

    protected $fillable = [
        'year_id', 'term_id', 'form_id', 'form_type', 'student_id', 'student_school_id', 'average_point', 'sum_coff', 'stud_ave', 'position'
    ];
}
