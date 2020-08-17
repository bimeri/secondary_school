<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Studentdiscipline extends Model
{
    //
    use Notifiable;

    protected $fillable = [
        'year_id', 'term_id', 'student_id', 'discipline_id', 'consequences'
    ];

    public function students(){
        return $this->hasMany('App\Student');
    }

    public function disciplines(){
        return $this->hasMany('App\Discipline');
    }
}
