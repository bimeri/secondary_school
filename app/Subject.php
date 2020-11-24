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
    public static function sumClassCoefficient($classId){
        return Subject::where('form_id', $classId)->sum('coefficient');
    }

    public static function getTeacher($subjectId){
       $qr = Teacher::select('full_name')
                    ->join('subject_teacher', 'subject_teacher.teacher_id', 'teachers.id')
                    ->where('subject_teacher.subject_id', $subjectId)->get();
                    $ar = [];
                    foreach($qr as $t){
                    array_push($ar, $t->full_name);
                    }
                    if($qr->count() == 0) {
                        return "Unknown";
                    } else {
                    return  current($ar);
                    }
        return;
    }
}
