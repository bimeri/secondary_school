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
    public function teacher(){
        return $this->belongsTo('App\Teacher');
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

    public function files(){
        return $this->hasMany('App\File');
    }

    public function assignments(){
        return $this->hasMany('App\Assignment');
    }

    public static function getClassSubject($class_id){
        return Subject::where('form_id', $class_id)->get();
    }
    public static function getSubjectDetail($sub_id){
        return Subject::where('id', $sub_id)->first();
    }
}
