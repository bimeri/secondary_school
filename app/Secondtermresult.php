<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Secondtermresult extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'year_id', 'subject_id', 'form_id', 'student_id', 'seq3', 'seq4',
    ];

    public function students(){
        return $this->hasMany('App\Student');
    }
    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
