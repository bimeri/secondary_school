<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Firsttermresult extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'subject_id', 'form_id', 'student_id', 'seq1', 'seq2',
    ];

    public function subject(){
        return $this->belongsTo('App\subject');
    }
    public function student(){
        return $this->belongsTo('App\Student');
    }
}
