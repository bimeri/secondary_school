<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubjectTeacher extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'teacher_id', 'subject_id',
    ];
}
