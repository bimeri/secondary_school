<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subject extends Model
{
    //
    use Notifiable;
    protected $fillable = [
        'name', 'code', 'coefficient', 'form_id'
    ];

    public function form(){
        return $this->belongsTo('App\Form');
    }
    public function teachers(){
        return $this->belongsToMany('App\Teacher', 'subject_teacher','subject_id', 'teacher_id');
    }
    public function firsttermresults(){
        return $this->hasMany('App\Firsttermresult');
    }
    public function secondtermresults(){
        return $this->hasMany('App\Secondtermresult');
    }

    public function thirdtermresults(){
        return $this->hasMany('App\Thirdtermresult');
    }
}
